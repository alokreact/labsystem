<?php
namespace App\Service;

use App\Models\Package;
use App\Models\SubTest;


class CartService{

    public static function get_cart_items(){
        $packages =[];
        $tests =[];
        $cart = session()->get('cart', []);         
        return $cart;
        //return $items;
    }

    public static function get_checkout_items( $items){
//dd($items);
       $checkout_items=  collect(session('cart'))->map(function (
            $row,
            $index
        ) use ($items) {
            $quantity = (int) $row['quantity'];
            $cost = (float) $items[$index]->price;
            $subtotal = $cost * $quantity;

             return [
                'id' => $row['id'],
                'qty' => $quantity,
                'name' => $items[$index]->name,
                'lab_name' => $items[$index]->lab_name,
                'cost' => $cost,
                'subtotal' => round($subtotal, 2),
            ];
        });

        return $checkout_items;
    }
    public static function getType($items){

        $type = $items->pluck('options')->pluck('type');

         return $type;
    }
    public static function flatten_ar($arr){
        $temp =[];
        foreach($arr as $val){
                if(is_array($val)){
                    $temp =$val;
                }
        }
        return $temp;
    }

    public static function  discountCalculation(float $price, float $total): float{
    
        $cleanedString = str_replace(',', '', $total);
        $discountPercentage = 10;
    
            $discountAmount =  ($discountPercentage / 100)* intval($total);
            $newPrice = intval($price) - intval($discountAmount);        
      
        return $newPrice;

    }

}

?>