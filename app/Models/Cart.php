<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\CartItem;

use App\models\Lab;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable =['product_name','user_id','session_id','product_id','product_name',
                            'qty','name','email','phone'];

     public function cartItems(){
        return $this->hasMany(CartItem::class);
     }

     public function lab(){
     
      return $this->hasOne(Lab::class,'id','lab_id');
   }

}
