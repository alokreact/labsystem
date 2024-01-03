<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SubTest;
use App\Models\Package;
use App\Models\Order;
use App\Models\Patient;
use App\Models\Lab;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    
    protected $fillable =['product_id','user_id','order_id','price','qty','report_url','patient_id','type'];

    public function subtest()
    {
        return $this->hasMany(SubTest::class,'id','product_id');
        
    }

    public function package()
    {
        return $this->hasMany(Package::class,'id','product_id');   
    }

    public function order(){

        return $this->hasOne(Order::class,'id','order_id');   
    }
    public function patient(){
        return $this->hasMany(Patient::class,'id','patient_id');
    }

    public function lab(){

        return $this->hasOne(Lab::class,'id','lab_id');
    }

}
