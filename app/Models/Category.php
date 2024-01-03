<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Package;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Category extends Model
{
    protected $guarded = [];

    /**
     * Get the user that owns the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'category');
    }
}
