<?php
namespace App\Service;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;
use App\Models\Patient;
use App\Service\CartService;
use App\Models\SubTest;
use Auth;

class  OrderService{

    public static function save_order($data){
        //dd($data);
        $recieptId = mt_rand(10000, 99999);
        
        $order = new Order;
        $order->user_id=Auth::user()->id;
        $order->status= 2;
        $order->pay_option= $data['pay_option'];
        $order->recieptId = $recieptId;
        $order->currency = 'INR';
        $order->user_address = $data['address'];
        $order->description = 'New Test Booking';
        $order->order_date= $data['slot_day'];
        $order->collection_time=$data['slot_time'];
        $order->total= $data['total'];
        $order->razorpayId = $order->pay_option === '1'?$data['razorpayId']:'';
        $order->patient_id= implode(',',$data['patient']);
       
        $order->save();
        return $order->id;

    }

    public static function save_package_order($data){
        //dd($data);
        $recieptId = mt_rand(10000, 99999);
            
            $order = new Order;
            $order->user_id=Auth::user()->id;
            $order->status= 2;
            $order->pay_option= $data['pay_option'];
            $order->recieptId = $recieptId;
            $order->currency = 'INR';
            $order->user_address = $data['address'];
            $order->description = 'New Test Booking';
            $order->order_date= $data['slot_day'];
            $order->collection_time=$data['slot_time'];
            $order->total= $data['total'];
            $order->razorpayId = $order->pay_option === '1'?$data['razorpayId']:'';
            $order->patient_id= implode(',',$data['patient']);
            $order->save();

            return $order->id;
    }


    public static function total($items){
        
        if(session()->has('coupon_sesssion')){

            $total = self::checkCouponSession();
            return $total;
        }
        else{
            foreach($items as $item){
                return $item->price;
            }
        }  
    }
    public static function checkCouponSession(){
        
        $sessionArray = session('coupon_sesssion', []);
        return $sessionArray['total'];
    }

    public static function getProductnames($carts){
        $product_id=$carts->pluck('options')[0]['product_id'];
        $products = SubTest::find($product_id);
        $product_names = $products->pluck('sub_test_name');
        return $product_names;
    }


    public static function getProductNamesForAdmin($order_items,$type){
        $subtests =[];
        $product_names = [];
        
        //dd($order_items);

        if($type === 'test'){
            if(count($order_items)>0 ){
                foreach($order_items as $item){
                    $subtests [] = $item ->subtest->toArray();
                }
                foreach ($subtests as $test){
                    $product_names[] =$test[0]['sub_test_name'];
                }
                return $product_names;
            }
        }
        else{
            foreach($order_items as $item){

                $subtests [] = $item->package->toArray();
            }
            foreach ($subtests as $test){
                $product_names[] =$test[0]['package_name'];
            }
            return $product_names;
        }    

    }

    public static function getLabNames($order_items,$type){

        $labs =[];
        $lab_names = [];
        if($type === 'test'){  
            if(count($order_items)>0 ){
                foreach($order_items as $item){
                    $labs['name'][] = $item->lab->toArray();
                    $labs['price'][] = $item->price;       
                }
                foreach ($labs['name'] as $key=>$lab){
                    $lab_names['name'][] =$lab['lab_name'];
                    $lab_names['price'][] =$labs['price'][$key];
                }
                return $lab_names;
            }
        }
        else{

            foreach($order_items as $item){
                $labs['name'][] = $item->lab->toArray();
                $labs['price'][] = $item->price;       
            }
            foreach ($labs['name'] as $key=>$lab){
                $lab_names['name'][] =$lab['lab_name'];
                $lab_names['price'][] =$labs['price'][$key];
            }
            return $lab_names;

        }
    }
    public static function getProductPrice($carts){

        $product_price=$carts->pluck('options')->pluck('single_price');
        return $product_price;
    }

    public static function flatten_ar($arr){
        $temp =[];
       
        foreach($arr as $val){
            if(is_array($val)){
                $temp = $val;
            }      
        }

        return $temp;
    }


    public static function save_order_items($order_id, $items){

            $insertedIds =[];
            $lab_id = $items->pluck('id');

            //dd($lab_id[0]);
            
            $product_ids = $items->pluck('options')->pluck('product_id');
            $prices = $items->pluck('options')->pluck('single_price');
            $pr = self::flatten_ar($prices);
           // dd($pr);

            foreach($product_ids as $ids){
                foreach($ids as $key=>$id){
                    $order_item = new OrderItem;
                    $order_item->user_id=Auth::user()->id;
                    $order_item->product_id= trim($id);
                    $order_item->order_id= $order_id;
                    $order_item->price= $pr[$key];
                    $order_item->qty= 1;
                    $order_item->lab_id= $lab_id[0];
                    $order_item->type= 'test';
          
                    $order_item->save();
                    $insertedIds[] = $order_item->id;        
                }
             }
        
            return $insertedIds;                    
        }

        public static function save_package_order_items($order_id, $items){
            $insertedIds =[];
            $lab_id = $items->pluck('id');
            $product_ids = $items->pluck('options')->pluck('product_id');
            
            foreach($items as $key=>$item){

                    $order_item = new OrderItem;
                    $order_item->user_id=Auth::user()->id;
                    $order_item->product_id= trim($item->options['product_id']);
                    $order_item->order_id= $order_id;
                    $order_item->price= $item->price;
                    $order_item->qty= 1;
                    $order_item->lab_id= $item->id;
                    $order_item->type= 'package';
                    $order_item->save();
                    $insertedIds = $order_item->id;        
             }
            return $insertedIds;                    
        }
    
}

