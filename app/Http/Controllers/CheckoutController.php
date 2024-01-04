<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use Auth;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;
use App\Models\Patient;
use App\Models\Package;
use App\Models\User;

use App\Service\CartService;
use App\Service\OrderService;
use App\Service\SmsService;

use App\Models\Address;

use Mail;
use App\Mail\OrderEmail;
use Illuminate\Support\Collection;
use App\Service\PdfService;

use Razorpay\Api\Api;
use Symfony\Component\HttpFoundation\Response;

class CheckoutController extends Controller
{
    private $razorpayId = "DLDiT3zaLoZI9ZsN27Yd7dJ0";
    private  $razorpayKey = "rzp_test_BqPPqd2H5aA49G";

    //private $razorpayId = "rHIkpFOzmESeLw2IpNbhyI99";
    //private $razorpayKey = "rzp_live_Sov1SDDvaLh47j";

    public function  index(){
        $user = Auth::user();
        if($user && Auth::user()->role == '2'){   
            return view('Front-end.Checkout.index');
        }
        else{
            return view('Front.Auth.signin')->with('error','Credntial are incorrect, Please try again after sometime!');       
        }
    }

    public function confirmation(){
        $user_id = Auth::user()->id;        
        return view('Front-end.Checkout.confirmation');

    }

    public function success(){
        $user_id = Auth::user()->id;        
        return view('Front-end.checkout.confirmation');
    }

    public function handlePaymentfailed(){
        abort(404);
    }

    public function checkout(){
        try{
            $cartItems =  \Cart::getContent();          
            $type  = CartService::getType($cartItems);   
            $products =[];  
            $total =[];
            
            if($type[0] === 'package'){    
                $product_id = $cartItems->pluck('options')->pluck('product_id');
                $products = Package::find($product_id);  
                $total = \Cart::total();
            }
           
            $patients = Patient::where('user_id','=',Auth::user()->id)->get();
            $addresses = Address::where('user_id', Auth::user()->id)->get();
            $product_names = OrderService::getProductnames($cartItems);   
            //dd($cartItems);
            return view('Front.Checkout.index',compact('type','total','products','cartItems','patients','addresses','product_names'));
        }
        catch (Exception $e){
            //\DB::rollback();
            return  response()->json(['data'=>[],'message'=>'Some Error, Please try again!'],400);
        }
    }

    public function save_order(Request $request){                
        $data = $request->all();
        if($data['pay_option'] === '2'){          
            $recieptId = mt_rand(10000, 99999);
            $items =  \Cart::content();
            $type = CartService::getType($items);

            if($type[0] === 'package'){
                $data['total'] = \Cart::total();
                $res = $this->save_package_order($recieptId,$data,$items);
                if($res){
                    return redirect()->route('confirmation');
                }
                else{
                    abort('404');
                }
            }
            else{
                $data['total'] = OrderService::total($items);
                $test_order = $this->save_test_order($recieptId,$items,$data);
                
                if($test_order){
                    return redirect()->route('confirmation');
                }
                else{
                    abort('404');
                }
            }      
        }
        else{    
            $recieptId = mt_rand(10000, 99999);
            $items =  \Cart::content();
            $type = CartService::getType($items);
            
            if($type[0] === 'package'){
                $data['total'] = \Cart::total();
                $response = $this->save_razorpay_package_order($recieptId,$data,$items);
                if($response){
                    return view('Front-end.Cart.payment-page', compact('response'));
                    //return redirect()->route('confirmation');
                }
                else{
                    abort('404');
                }
            }
            else{
                $total=  OrderService::total($items);
                $data['total'] = $total;
        
                $response = $this->save_razorpay_test_order($recieptId,$data,$items);
                if($response){
                    return view('Front-end.Cart.payment-page', compact('response'));
                }
                else{
                    abort('404');
                }
            }
        }
        
    }

    public function razorpay(){        
        return view('Front-end.Checkout.razorpay');
    }
    
    public function handleCallback(Request $request){

        $api = new Api($this->razorpayKey, $this->razorpayId);
        $razorpay_order_id = $request->input('razorpay_order_id');
        $razorpay_payment_id = $request->input('razorpay_payment_id');
        $razorpay_signature = $request->input('razorpay_signature');

        // Verify the payment
        $attributes = array(
            'razorpay_order_id' => $razorpay_order_id,
            'razorpay_payment_id' => $razorpay_payment_id,
            'razorpay_signature' => $razorpay_signature,
        );

        //dd($attributes);
        
        try{            
        
            $res= $api->utility->verifyPaymentSignature($attributes);
            $order = Order::where('razorpayId',$razorpay_order_id)->get();
   
            // $patient = $request->input('patient');
            // $address = $request->input('address');
            // $recieptId = $request->input('recieptId');
        
            // $slot_day = $request->input('slot_day');
            // $slot_time = $request->input('slot_time');
            
            $items =\Cart::content();
            //dd($items);
            $type = CartService::getType($items);
   
            if($type[0] === 'package'){
                    $res = $this->save_package_order_items($order,$items,$razorpay_payment_id);
                    if($res){
                        return redirect()->route('confirmation');
                    }
            }
            else{

                $res = $this->save_test_order_items($order,$items,$razorpay_payment_id);
                
                    if($res){
                        
                        return redirect()->route('confirmation');
                    }
        
                    

             
            }
            // Payment is successful, you can update your database here or perform any other actions.
        } catch (\Exception $e) {
            //return view('payment.failed');
            dd($e->getMessage());
        }
        //return redirect()->route('confirmation'); 
    }

    public function save_package_order($recieptId,$data,$items){

        //dd($items);
        $order_id = OrderService::save_package_order($data); 
        $response = OrderService::save_package_order_items($order_id,$items);

        if($response > 0){
            $order =  Order::find($order_id);
            $type ='package';

            $orderItems = OrderItem::with('package')->where('order_id', $order_id)->get();
            $patients = Patient::find(explode(',',$order->patient_id));     
            $address = Address::find($data['address']);
        
            if(session()->has('coupon_sesssion')){
                $sessionArray = session('coupon_sesssion', []);
                if(isset($sessionArray['coupon_id'])){
                    $res = $this->insertCoupon($order_id); 
                }
            }

            $data['product_names'] = OrderService::getProductNamesForAdmin($orderItems, $type);
            $data['items'] = OrderService::getLabNames($orderItems,$type);

            //dd($data['items']);
            $data['total'] = $order->total;
            $data['date'] = now();
            $data['order_id'] = $recieptId;
            $data['address'] = $address;
            $data['patients'] = $patients;
            $data['slot_day'] = $order->order_date;
            $data['slot_time'] = $order->collection_time;
            $data['phone']  = Auth::user()->phone;               
            
                $pdfService = new PdfService();
                $pdfContent = $pdfService->generatePdfFromView('emails.order', $data);
                //Send email with PDF attachment
                
                $pdfFileName = 'order.pdf';
                $email = $data['address']->email;

                Mail::send([], [], function ($message) use ($pdfContent, $pdfFileName,$email) {
                    $message->to($email)
                        ->subject('Order Confirmation')
                        ->attachData($pdfContent, $pdfFileName, ['mime' => 'application/pdf']);
                });

                if(isset($data['phone'])){
                    SmsService::sendConfirmationmsg($data['phone'],$recieptId);            
                }   
            
                \Cart::destroy();
                $cartItems =   \Cart::content();
                
                if(count($cartItems)===0 ){
                    return true;
                }
        }       
    }

    public function save_test_order($recieptId,$items,$data){
        $order_id = OrderService::save_order($data);
        $response = OrderService::save_order_items($order_id,$items);
    
        //dd($order_id);

        if(count($response) >0){   
            $type ='test';
            $order =  Order::find($order_id);
            $orderItems = OrderItem::with('subtest')->where('order_id', $order_id)->get();

            $patients = Patient::find(explode(',',$order->patient_id));     
            $address = Address::find($data['address']);
        
            if(session()->has('coupon_sesssion')){

                $sessionArray = session('coupon_sesssion', []);
                if(isset($sessionArray['coupon_id'])){
                    $res = $this->insertCoupon($order_id); 
                }
            }

            $data['total'] = $order->total;
            $data['items'] = OrderService::getLabNames($orderItems,$type);

            $data['product_names'] = OrderService::getProductNamesForAdmin($orderItems,$type);
            $data['date'] = now();
            $data['order_id'] = $recieptId;
            $data['address'] = $address;
            $data['patients'] = $patients; 
            $data['slot_day'] = $order->order_date;
            $data['slot_time'] = $order->collection_time;
            $data['phone']  = Auth::user()->phone;                        
        
            $pdfService = new PdfService();
            $pdfContent = $pdfService->generatePdfFromView('emails.order', $data);
            

            //Send email with PDF attachment
            
            $pdfFileName = 'order.pdf';
            $email = $data['address']->email;

            Mail::send([], [], function ($message) use ($pdfContent, $pdfFileName,$email) {
                $message->to($email)
                    ->subject('Order Confirmation')
                    ->attachData($pdfContent, $pdfFileName, ['mime' => 'application/pdf']);
            });
            if(isset($data['phone'])){
                SmsService::sendConfirmationmsg($data['phone'],$recieptId);            
            }  

            \Cart::destroy();
            $cartItems = \Cart::content();
            
            session()->forget('coupon_sesssion');   
  
            
            if(count($cartItems)===0 ){
                return true;
            }              
        }
    }

    public function insertCoupon(float $order_id){
        $user = Auth::user();
        
        $sessionArray = session('coupon_sesssion', []);

        $coupon_id = $sessionArray['coupon_id'];

        $data[$coupon_id] = [

            'order_id'=>$order_id
        ];

        $result = $user->coupon()->sync($data);

        if (!empty($result['attached']) || !empty($result['detached'])) {
        
            return $result;
        }
        else{

            return false;
        }






    }

    public function save_razorpay_package_order($recieptId,$data,$items){
      
        $api = new Api($this->razorpayKey, $this->razorpayId);  
        $order = [
            'receipt'         => 'order_'.$recieptId,
            'amount'          => (int)$data['total'] * 100, // 39900 rupees in paise
            'currency'        => 'INR'
        ];
            $razorpayOrder = $api->order->create($order);
            $data['razorpayId'] = $razorpayOrder['id'];
            
            $order_id = OrderService::save_package_order($data);

            if($order_id >0 ){
                $order =  Order::find($order_id);

                $user = User::find(Auth::user()->id);

                //dd($user);
                $response = [
                    'razorpayOrderId' => $razorpayOrder['id'],
                    'razorpayId' => $this->razorpayId,
                    'currency' => 'INR',
                    'user_address' => $order->user_address,
                    'patient' => $order->patient_id,
                    'description' => 'New Test',
                    'pay_option' => 1,
                    'recieptId' => $recieptId,
                    'user_id' => Auth::user()->id,
                    'order_date'=>$order->order_date,
                    'collection_time'=>$order->collection_time,
                    'total'=> $data['total'] ,
                    'user_name'=>$user->name,
                    'user_email'=>$user->email,
                    'user_phone'=>$user->phone,             
                ];

                return $response;
            }           
    }

    public function save_package_order_items ($order,$items,$razorpay_payment_id){
        //dd($order);
        $order_id = $order[0]->id;
        $response = OrderService::save_package_order_items($order_id,$items);

        if($response > 0){
            $order =  Order::find($order_id);
           
            $data=[
                'status' => 1,
                'payment_id' =>$razorpay_payment_id    
    
            ];
            $order->update($data);
            $type ='package';


            $orderItems = OrderItem::with('package')->where('order_id', $order_id)->get();
            $patients = Patient::find(explode(',',$order->patient_id));     
            $address = Address::find($order->user_address);
        
            $data['product_names'] = OrderService::getProductNamesForAdmin($orderItems, $type);
            $data['items'] = OrderService::getLabNames($orderItems,$type);

            //dd($data['items']);
            $data['total'] = $order->total;
            $data['date'] = now();
            $data['order_id'] = $order->recieptId;
            $data['address'] = $address;
            $data['patients'] = $patients;
            $data['slot_day'] = $order->order_date;
            $data['slot_time'] = $order->collection_time;
            $data['phone']  = Auth::user()->phone;               
            
                $pdfService = new PdfService();
                $pdfContent = $pdfService->generatePdfFromView('emails.order', $data);
                //Send email with PDF attachment
                
                $pdfFileName = 'order.pdf';
                $email = $data['address']->email;

                Mail::send([], [], function ($message) use ($pdfContent, $pdfFileName,$email) {
                    $message->to($email)
                        ->subject('Order Confirmation')
                        ->attachData($pdfContent, $pdfFileName, ['mime' => 'application/pdf']);
                });

                if(isset($data['phone'])){
                    SmsService::sendConfirmationmsg($data['phone'],$order->recieptId);            
                }   
                \Cart::destroy();
                $cartItems =   \Cart::content();
                
                if(count($cartItems)===0 ){
                    return true;
                }
        }     
    }

    public function save_razorpay_test_order($recieptId,$data,$items){

        $api = new Api($this->razorpayKey, $this->razorpayId);  
        $order = [
            'receipt'         => 'order_'.$recieptId,
            'amount'          => (int)$data['total'] * 100, // 39900 rupees in paise
            'currency'        => 'INR'
        ];
            $razorpayOrder = $api->order->create($order);
            $data['razorpayId'] = $razorpayOrder['id'];
            
            $order_id = OrderService::save_order($data);

            if($order_id >0 ){
                $order =  Order::find($order_id);
                $user = User::find(Auth::user()->id);

                //dd($user);
                $response = [
                    'razorpayOrderId' => $razorpayOrder['id'],
                    'razorpayId' => $this->razorpayId,
                    'currency' => 'INR',
                    'user_address' => $order->user_address,
                    'patient' => $order->patient_id,
                    'description' => 'New Test',
                    'pay_option' => 1,
                    'recieptId' => $recieptId,
                    'user_id' => Auth::user()->id,
                    'order_date'=>$order->order_date,
                    'collection_time'=>$order->collection_time,
                    'total'=> $data['total'] ,
                    'user_name'=>$user->name,
                    'user_email'=>$user->email,
                    'user_phone'=>$user->phone,             
                ];
                return $response;
            }           
    } 

    public function save_test_order_items($order,$items, $razorpay_payment_id){

        $order_id = $order[0]->id;
        $response = OrderService::save_order_items($order_id,$items);
        if($response > 0){

            $order =  Order::find($order_id);
           
            $data=[
                'status' => 1,
                'payment_id' =>$razorpay_payment_id    
    
            ];
            $order->update($data);
            $type ='test';
 
            $order =  Order::find($order_id);
            $orderItems = OrderItem::with('subtest')->where('order_id', $order_id)->get();

            $patients = Patient::find(explode(',',$order->patient_id));     
            $address = Address::find($order->user_address);
        
            $data['total'] = $order->total;
            $data['items'] = OrderService::getLabNames($orderItems,$type);

            $data['product_names'] = OrderService::getProductNamesForAdmin($orderItems,$type);
            $data['date'] = now();
            $data['order_id'] = $order->recieptId;
            $data['address'] = $address;
            $data['patients'] = $patients; 
            $data['slot_day'] = $order->order_date;
            $data['slot_time'] = $order->collection_time;
            $data['phone']  = Auth::user()->phone;                        
            //dd($data);
        
            $pdfService = new PdfService();
            $pdfContent = $pdfService->generatePdfFromView('emails.order', $data);
            
            //Send email with PDF attachment
            
            $pdfFileName = 'order.pdf';
            $email = $data['address']->email;

            Mail::send([], [], function ($message) use ($pdfContent, $pdfFileName,$email) {
                $message->to($email)
                    ->subject('Order Confirmation')
                    ->attachData($pdfContent, $pdfFileName, ['mime' => 'application/pdf']);
            });

            if(isset($data['phone'])){
                SmsService::sendConfirmationmsg($data['phone'],$order->recieptId);            
            }   
            \Cart::destroy();
            $cartItems =   \Cart::content();
            
            if(count($cartItems)===0 ){
                return true;
            }              
        }    

    }

}
