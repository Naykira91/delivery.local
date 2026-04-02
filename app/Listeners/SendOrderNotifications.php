<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Services\OrderNotifications\OrderNotificationService;
use Throwable;
use Illuminate\Support\Facades\Log;

class SendOrderNotifications
{
    public function __construct(
        private readonly OrderNotificationService $notificationService,
    ) {}

    public function handle(OrderCreated $event): void
    {
        try {
            $this->notificationService->sendNewOrderNotifications($event->order);
        } catch (Throwable $e) {
            Log::error('Failed to send order notifications', [
                'order_id' => $event->order->id,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
