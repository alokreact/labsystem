<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lab;

use App\Models\ParentTest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\SubTest;


class Package extends Model
{
    use  HasFactory;

    protected $guarded = [];
   
    protected $fillable = ['lab_name','category','package_name','price','package_desc','image','status'];

    // public function parenttest()
    // {
    //     return $this->hasOne(ParentTest::class,);
    // }

    public function getLab(){
        return $this->hasOne (Lab::class,'id','lab_name');
    }

    public function lab(){
        return $this->hasOne (Lab::class,'id','lab_id');
    }

    public function parenttest()
    {
        return $this->belongsToMany(ParentTest::class,'package_parent','package_id','parent_test_id');
    }

    public function getCategory(){
        return $this->hasOne (Category::class,'id', 'category');
    }

    public function grouptest(){
        return $this->belongsToMany(GroupTest::class,'package_parent','package_id','parent_test_id');
    }

   
}
