<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Services\OrderNotifications\OrderNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendOrderNotifications implements ShouldQueue
{
    use InteractsWithQueue;

    public int $tries = 3;
    public int $timeout = 30;

    public function __construct(
        private readonly OrderNotificationService $notificationService,
    ) {}

    public function handle(OrderCreated $event): void
    {
        $this->notificationService->sendNewOrderNotifications($event->order);
    }

    public function failed(OrderCreated $event, Throwable $e): void
    {
        Log::error('Order notification job failed permanently', [
            'order_id' => $event->order->id,
            'message' => $e->getMessage(),
        ]);
    }
}
