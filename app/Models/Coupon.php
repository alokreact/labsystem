<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Order;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable =['code','expires_at','name','type','amount'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function scopeSearch($query, $keywords){

        return $this->where('name', 'LIKE', '%'.$keywords.'%');
    }

    public function order(){

        return $this->belongsToMany(Order::class,'coupon_user_order')->withPivot('coupon_id');
    }

    
}
