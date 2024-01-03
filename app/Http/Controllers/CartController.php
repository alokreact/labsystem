<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lab;
use App\Models\SubTest;

//use App\Models\Cart;

use App\Models\Package;
use App\Service\CartService;
use App\Models\CartItem;
use App\Models\Coupon;

use Auth;

use Illuminate\Support\Collection;

use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller{

        

    public function addPackage(Request $request){       
        if(\Cart::count() > 0){

            $carts = \Cart::content();

            $type = CartService::getType($carts);
            //dd($type);

            if(in_array('test',$type->toArray())){
                \Cart::destroy();
            }
        }
        $productId = $request->input('productId');
        $product = Package::findOrFail($productId);
    
        //dd($product);
        \Cart::setGlobalTax(0);
        \Cart::add(['id' => $product->lab_name, 'name' => $product->package_name, 
                    'qty' => 1, 
                    'price' => $product->price,
                    'weight' =>0, 
                    'taxRate'=>0,
                    'options' => ['product_id' => $productId,'type'=>'package']
                  ]);

        $cart = \Cart::count();
        //dd($cart);
        return response()->json(['cart'=>$cart,'message' =>'Succesfully Added'], Response::HTTP_OK);
       //return response()->json(['status' => 200, 'message' =>'Succesfully Added'], Response::HTTP_OK);
    }

    public function cart(){
        $user = Auth::user();        
        if($user && Auth::user()->role == '2'){
            $carts =[];
            $carts = \Cart::getContent();
            $product_names =[];
            if(\Cart::getTotalQuantity() > 0){
                $type = CartService::getType($carts);
                //dd($type);
                if($type[0] === 'package'){
                    $product_id = $carts->pluck('options')->pluck('product_id');
                    $products = Package::find($product_id);    
                    return view('Front.Packagecart.index',compact('carts','products'));
                }
                $product_id=$carts->pluck('attributes')[0]['product_id'];
                $products = SubTest::find($product_id);
                $product_names = $products->pluck('sub_test_name');
            }
            return view('Front.Cart.cart',compact('carts','product_names'));
        } 
        else {
            return redirect()->route('signin');
        }
    }

    public function remove_product(Request $request){
        //dd($request->all());
        $productId = $request->input('id');    
        //dd($productId);
        //Check if the product is already in the cart
        $cartItem = \Cart::search(function ($cartItem, $rowId) use ($productId) {
                return $cartItem->id == $productId;
        })->first();
        //dd($cartItem);
        if($cartItem){
            \Cart::remove($cartItem->rowId);
        }
        session()->flash('success', 'Product successfully removed!');   
    }

    public function update_product(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function addToCart(Request $request){
        \Cart::clear();
        $productId = $request->input('productId');
        $productId_arr = explode(',',$productId);
       
        $single_price = $request->input('singleprice');
        $product = SubTest::find($productId_arr);
        $labId = $request->input('labId');
        $price = $request->input('price');
        $lab = Lab::find($labId);

      
        \Cart::add(['id' => $labId, 
        'name' => $lab->lab_name, 
        'quantity' => 1, 
        'price' => $price, 
        'attributes' => 
                ['product_id' => $productId_arr,
                      'single_price'=>explode(',',$single_price),
                      'type'=>'test']
        ]);
        $items = \Cart::getContent();
        //dd($items);

        $cart = \Cart::getTotalQuantity();

        return response()->json(['cart'=>$cart,'message' =>'Succesfully Added'], Response::HTTP_OK);
    }

    public function applyCoupon(Request $request){

        $cartItems = \Cart::content();
        $type = CartService::getType($cartItems);
        $coupon_code = $request->post('coupon_code');

        if($type[0] === 'package'){
            $totalWithoutDiscount = \Cart::total();
                $cleanedString = str_replace(',', '', $totalWithoutDiscount);
                $discountPercentage = 10;
        
                foreach($cartItems as $item){            
                    $discountAmount =  ($discountPercentage / 100)* intval($item->price);
                    $newPrice = intval($item->price) - intval($discountAmount);        
                    \Cart::update($item->rowId, [
                        'price' => $newPrice,
                    ]);
                }
                $cartItems = \Cart::content();
                $finalTotal = \Cart::total();
                return response()->json(['total'=> $finalTotal], 200);
        }
        
        else{

            $totalWithoutDiscount = \Cart::total();
            $cleanedString = str_replace(',', '', $totalWithoutDiscount);
            $discountPercentage = 10;

         
        
            $discountAmount =  ($discountPercentage / 100)* intval($totalWithoutDiscount);
            $newPrice = intval($totalWithoutDiscount) - intval($discountAmount);            
            
            //dd($newPrice);
    
            $res = $this->saveCcouponInsession($coupon_code,'10',$newPrice);

            if($res){
                return response()->json(['total'=> $newPrice], 200); 
            }
        }
    }

    public function saveCcouponInsession($coupon_code,$amt,$newPrice ): bool{
      
        $cartItems = \Cart::content();
        $Total = \Cart::total();

        $data =[
                'coupon_name'=>$coupon_code,
                'amount'=>$amt,
                'cartItems'=>$cartItems,
                'price'=>$newPrice,
                'total'=>$Total                
        ];
        session(['coupon_sesssion' => $data]);
        return true;
    }

    public function applyRefralCoupon(Request $request){
        $coupon_code = $request->post('coupon');
        $valid_coupon = $this->isValidCoupon($coupon_code);  
        
        if($valid_coupon){
            
            $cartItems = \Cart::content();
            $sessionArray = session('coupon_sesssion', []);
            $price = $sessionArray ['price'];
            $total = $sessionArray ['total'];

            $finalTotal = CartService::discountCalculation($price,$total);
           
            $data =[
                'coupon_name'=>$coupon_code,
                'cartItems'=>$cartItems,
                'price'=>$sessionArray['price'],
                'total'=>$finalTotal,
                'coupon_id'=>$valid_coupon[0]->id,                
            ]; 
            session(['coupon_sesssion' => $data]); 
            return response()->json(['status'=>'success','total'=> $finalTotal,'coupon_name'=>$valid_coupon[0]->name], 200);
        }
        else{
            //dd($valid_coupon);
            return response()->json(['status'=>'error','message'=>'No Coupon Exist'], 200);
        }
    }

    public function isValidCoupon(string $coupon_code) {
        //\DB::connection()->enableQueryLog();
        $coupon_code = trim($coupon_code);
        $coupon = Coupon::search($coupon_code)->get();
       // dd($coupon);
        if($coupon->count()>0){
            return $coupon;
        }
        else{

            return false;
        }
    }
   
}
