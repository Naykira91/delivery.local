<?php

namespace App\Services\OrderNotifications;

use App\Models\Order;

class OrderNotificationService
{
    public function __construct(
        private readonly EmailOrderNotificationChannel $emailChannel,
        //private readonly VkOrderNotificationChannel $vkChannel,
    ) {}

    public function sendNewOrderNotifications(Order $order): void
    {
        $this->emailChannel->send($order);
        //$this->vkChannel->send($order);
    }
}
