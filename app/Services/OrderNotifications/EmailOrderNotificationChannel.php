<?php

namespace App\Services\OrderNotifications;

use App\Mail\NewOrderMail;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailOrderNotificationChannel
{
    public function send(Order $order): void
    {
        $to = config('order_notifications.manager_email');

        Log::info('EmailOrderNotificationChannel started', [
            'order_id' => $order->id,
            'to' => $to,
        ]);

        if (!$to) {
            Log::warning('Manager email is empty', [
                'order_id' => $order->id,
            ]);
            return;
        }

        Mail::to($to)->send(new NewOrderMail($order));

        Log::info('EmailOrderNotificationChannel finished', [
            'order_id' => $order->id,
            'to' => $to,
        ]);
    }
}
