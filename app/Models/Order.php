<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lab;

use App\Models\OrderItem;
use App\Models\User;

class Order extends Model
{
    protected $guarded = [];
    protected $table ='orders';
    protected $fillable =['user_id','total','status'];

    public function OrderItems(){
        return $this->hasMany(OrderItem::class,'order_id','id');
    }

    public function lab(){
        return $this->hasOne(OrderItem::class,'lab_id','id');
    }
    
    public function user(){

        return $this->hasOne(User::class,'id','user_id');

    }
}
