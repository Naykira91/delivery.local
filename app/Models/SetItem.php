<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetItem extends Model
{
    public $timestamps = false;

    protected $fillable = ['set_id','product_id','qty','sort'];

    public function set()
    {
        return $this->belongsTo(Product::class, 'set_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
