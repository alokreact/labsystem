<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\OrderItem;
Use App\Models\SubTest;
use Mail;
use App\Service\PdfService;
use App\Models\Report;
use App\Mail\OrderEmail;
use App\Models\Order;
use App\Models\Address;
use App\Models\Patient;
use App\Models\Coupon;

use ZipArchive;
use File;
use App\Mail\RegistrationEmail;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ProfileController extends Controller{

    public $carts;

    public function __construct(){

        $this->carts= [];

    }
    public function index(){
         $user = Auth::User();    
         if($user){
            $carts =[];

            $order_items = Order::where('user_id',$user->id)->get();
            //$reports =Report::where('user_id',$user->id)->get();
            //dd($order_items);
            return view('Front-end.Profile.booking',compact('order_items','carts'));
         }
         else{
             abort('404');
         }
    }

    public function check(){

        return view('Front-end.Checkout.newcheckout');
    }

    public function emailTemplate(){

        $data= [
            'date'=>now(),
            'order_id'=>'123456',
            'name'=>'John Doe',
            'email'=>'john@gmail.com',
            'phone'=>'9976543132',
            'tests' =>[
                'test_name'=> 'AAROGYAM XL',
                'price'=>'1200',
                'qty'=>'1',
            ],
        ];
        // $tests =[
        //         'test_name'=> 'AAROGYAM XL',
        //         'price'=>'1200',
        //         'qty'=>'1',
        // ];

        Mail::to('me.alokprasad54@gmail.com')->send(new OrderEmail($data));

        return view('Email.ordermail', compact('data'));
    }

    public function send_email(){
      
        $data= [
            'date'=>now(),
            'order_id'=>'123456',
            'name'=>'John Doe',
            'email'=>'john@gmail.com',
            'phone'=>'9976543132',
            'tests' =>[
                'test_name'=> 'AAROGYAM XL',
                'price'=>'1200',
                'qty'=>'1',
            ],
        ];

       return view('Email.test');

       //Mail::to('alok.nayak1026@gmail.com')->send(new RegistrationEmail($data));
             

        // $pdfService = new PdfService();
        // $pdfContent = $pdfService->generatePdfFromView('emails.order', $data);
    
        // //Send email with PDF attachment
        // $pdfFileName = 'order.pdf';

        // Mail::send([], [], function ($message) use ($pdfContent, $pdfFileName) {
        //     $message->to('me.alokprasad54@gmail.com')
        //         ->subject('Order Confirmation')
        //         ->attachData($pdfContent, $pdfFileName, ['mime' => 'application/pdf']);
        // });

        return "Email sent with PDF attachment!";
    }

    public function product(){

        return view('Front-end.Profile.booking');
    }

    public function prescription(){
        $carts =[];
        return view('Front-end.Profile.tpl.prescription',compact('carts'));
    }

    public function address(){

        $addresses = Address::where('user_id', Auth::user()->id)->get();
        return view('Front-end.Profile.tpl.address',compact('addresses'));
    }

    public function patient(){
        $patients = Patient::where('user_id', Auth::user()->id)->get();
        
        return view('Front-end.Profile.tpl.patient',compact('patients'));
    }

    public function coupon(){

        $user_id = Auth::user()->id;
        
        if($user_id){
            $coupon = Coupon::where('user_id',$user_id)->get();
            return view('Front.Profile.coupon',compact('coupon'));
        }
        else{
            abort('404');
        }
    }

    public function createPatient(){
        return view('Front-end.Profile.components.patient_form');
    }
    public function profile($id){
        $profile = User::find($id);
        return view('Front-end.Profile.profile',compact('profile'));
    }

    public function downloadReports($id){
        $order_items = OrderItem::where('order_id',$id)->get();   
        
        if($order_items->count()>0){
            $images = $order_items->pluck('report_url')->toArray();  
            $filteredImages = array_filter($images, function ($value) {
                return $value !== null;
            });
            $temp = '';
            foreach($filteredImages as $image){
                $temp .=$image.',';
            }
            $image_arr = explode(',', $temp);
            $images =[];

            for($i=0 ; $i< count($image_arr)-1; $i++){
                if(!in_array($image_arr[$i],$images)){
                    $images[] = public_path('images/reports/'.$image_arr[$i]);
                }
            }

            $zipFilePath = tempnam(sys_get_temp_dir(), 'download');

            // Create a new ZipArchive instance
            $zip = new ZipArchive(); 
            // Open the ZIP file for writing
                if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
             
                    foreach ($images as $image) {
                        if (File::exists($image)) {
                            $zip->addFile($image, basename($image));
                        }
                    }
            $zip->close();
            return Response::download($zipFilePath, 'reports.zip')->deleteFileAfterSend(true);
            }
        }
        else{
            abort(404);
        }    
    }
    public function paymentFail(){
        return view('Errors.Paymentfailed');
    }
}
