<?php

namespace App\Services\Checkout;

use App\Models\Order;

class CheckoutOrderResult
{
    public function __construct(
        public readonly ?Order $order,
        public readonly array $items,
        public readonly float $total,
    ) {
    }
}
