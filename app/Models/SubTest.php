<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTest extends Model
{
    use  HasFactory;

    protected $guarded = [];
    protected $table = 'sub_tests';

    public function parenttest(){

        return $this->belongsToMany(ParentTest::class,'parent_test_id','id');
    }
    public function getLab(){

        return $this->belongsToMany(Lab::class,'lab_package','sub_test_id','lab_id')->withPivot(['price']);;
    }

    public function organ(){

        return $this->belongsToMany(Organ::class,'organ_tests','organ_id','test_id');
    }
    public function scopeStatus($query){
        return $query->where('status', '=', 1);
    }
}
