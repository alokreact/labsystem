<?php 
namespace App\Service;
use Illuminate\Support\Facades\Http;
use PragmaRX\Google2FA\Google2FA;

class  SmsService{

      
    public static function sendOTP($phoneNumber, $otp){
        //dd($phoneNumber);
         $baseUrl = 'smspackage.wiaratechnologies.com/api/mt/SendSMS';
   
        $queryParameters =  [
            'APIKey' => 'eFdx3x5kT0yNhX1EnTqtCw',
            'senderid' => 'CALABS',
            'channel'=>2,
            'DCS'=>0,
            'flashsms'=>0,
            'number'=>$phoneNumber,
            'text'=>'<#>Use ' .$otp.  ' as verification code on Calllabs. Valid for 10 minutes.',
            'route'=>31
        ];

        $fullUrl = self::baseUrl . '?' . http_build_query($queryParameters);

        $response = Http::post($fullUrl);


        if($response->successful()){
            // Request was successful (status code 2xx)
            $responseData = $response->json(); // Assuming the response is JSON   
            return $responseData;

        }else {
            // Request failed (status code not in 2xx)
            $errorData = $response->json(); // Assuming the error response is JSON
        }
    }

    public static function sendConfirmationmsg($phoneNumber, $otp){
        //dd($phoneNumber);
        
         $baseUrl = 'smspackage.wiaratechnologies.com/api/mt/SendSMS';
   
        $queryParameters =  [
            'APIKey' => 'eFdx3x5kT0yNhX1EnTqtCw',
            'senderid' => 'CALABS',
            'channel'=>2,
            'DCS'=>0,
            'flashsms'=>0,
            'number'=>$phoneNumber,
            'text'=>'Dear User Thankyou for booking with CallLabs. Your Order No ' . $otp . ' is Placed Successfully..',
            'route'=>31
        ];

        $fullUrl = $baseUrl . '?' . http_build_query($queryParameters);

        $response = Http::post($fullUrl);

        if($response->successful()){
            // Request was successful (status code 2xx)
            $responseData = $response->json(); // Assuming the response is JSON   
            return $responseData;

        }else {
            // Request failed (status code not in 2xx)
            $errorData = $response->json(); // Assuming the error response is JSON
        }
    }

}
