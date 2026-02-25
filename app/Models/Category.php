<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'sort', 'is_active'];

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('sort')
            ->orderBy('category_product.sort');
    }
}
