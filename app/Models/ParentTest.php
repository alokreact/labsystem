<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Package;



class ParentTest extends Model
{
    protected $guarded = [];
    protected $table = 'parent_tests';

    public function subtest(){
        return $this->belongsToMany(SubTest::class,'sub_tests','id');
    }

    // public function package(){
    //     return $this->hasMany(Package::class,'id','parent_test_id');
    // }

    
}
