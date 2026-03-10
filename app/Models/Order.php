<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'delivery_type',
        'payment_method',
        'address',
        'apartment',
        'entrance',
        'floor',
        'intercom',
        'is_private_house',
        'comment',
        'total_price',
        'status',
    ];

    protected $casts = [
        'is_private_house' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
