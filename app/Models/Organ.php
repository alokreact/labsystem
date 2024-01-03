<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lab;
use App\Models\SubTest;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Organ extends Model
{
    protected $table ='organs';

    protected $fillable =['name','image'];

    public function subtest(): BelongsToMany
    {
            return $this->belongsToMany(SubTest::class, 'organ_tests','organ_id', 'test_id');
    }
    
   
}
