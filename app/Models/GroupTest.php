<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class GroupTest extends Model
{
    protected $guarded = [];

    protected $table = 'grouptests';

    protected $fillable=['name','status'];

        /* The roles that belong to the GroupTest
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
         */
        public function subtest(): BelongsToMany{

            return $this->belongsToMany(SubTest::class, 'table_grouptest_test', 'grouptest_id','sub_tests_id');
        }
    
        public function getSubtestAttribute(){
            return explode(',', $this->sub_tests);    
        }

}
