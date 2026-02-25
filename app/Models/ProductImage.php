<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'path', 'sort', 'is_main', 'alt'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
