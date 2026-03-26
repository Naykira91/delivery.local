<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Services\Checkout\CheckoutOrderService;

class CheckoutController extends Controller
{
    public function create()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Корзина пуста');
        }

        $checkout = app(CheckoutOrderService::class)->prepareCart($cart);

        if ($checkout->items === []) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Корзина пуста');
        }

        return view('checkout.create', [
            'items' => $checkout->items,
            'total' => $checkout->total,
        ]);
    }

    public function store(StoreOrderRequest $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Корзина пуста');
        }

        $result = app(CheckoutOrderService::class)->create(
            data: $request->validatedForOrder(),
            cart: $cart
        );

        if ($result->items === []) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Корзина пуста');
        }

        session()->forget('cart');

        return redirect()
            ->route('home')
            ->with('success', 'Спасибо! Заказ №' . $result->order->id . ' успешно оформлен. Мы скоро свяжемся с вами.');
    }
}
