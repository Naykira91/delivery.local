<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function create()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Корзина пуста');
        }

        $ids = array_keys($cart);

        $products = Product::query()
            ->whereIn('id', $ids)
            ->where('is_active', true)
            ->with('mainImage')
            ->get()
            ->keyBy('id');

        $items = [];
        $total = 0;

        foreach ($cart as $id => $qty) {
            $product = $products->get((int) $id);

            if (!$product) {
                continue;
            }

            $lineTotal = $product->price * $qty;
            $total += $lineTotal;

            $items[] = [
                'product' => $product,
                'qty' => $qty,
                'line_total' => $lineTotal,
            ];
        }

        if (empty($items)) {
            return redirect()->route('cart.index')
                ->with('error', 'Корзина пуста');
        }

        return view('checkout.create', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Корзина пуста');
        }

        $validated = $request->validate([
            'customer_name'   => ['required', 'string', 'max:255'],
            'customer_phone'  => ['required', 'string', 'max:30'],
            'delivery_type'   => ['required', 'in:delivery,pickup'],
            'payment_method'  => ['required', 'in:cash,transfer'],
            'address'         => ['nullable', 'string', 'max:500'],
            'comment'         => ['nullable', 'string', 'max:1000'],
        ]);

        if ($validated['delivery_type'] === 'delivery' && empty($validated['address'])) {
            return back()
                ->withErrors(['address' => 'Укажите адрес доставки'])
                ->withInput();
        }

        $ids = array_keys($cart);

        $products = Product::query()
            ->whereIn('id', $ids)
            ->where('is_active', true)
            ->get()
            ->keyBy('id');

        $items = [];
        $total = 0;

        foreach ($cart as $id => $qty) {
            $product = $products->get((int) $id);

            if (!$product) {
                continue;
            }

            $lineTotal = $product->price * $qty;
            $total += $lineTotal;

            $items[] = [
                'product' => $product,
                'qty' => $qty,
                'line_total' => $lineTotal,
            ];
        }

        if (empty($items)) {
            return redirect()->route('cart.index')
                ->with('error', 'Корзина пуста');
        }

        $order = Order::create([
            'customer_name'  => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'delivery_type'  => $validated['delivery_type'],
            'payment_method' => $validated['payment_method'],
            'address'        => $validated['delivery_type'] === 'delivery'
                ? ($validated['address'] ?? null)
                : null,
            'comment'        => $validated['comment'] ?? null,
            'total_price'    => $total,
            'status'         => 'new',
        ]);

        foreach ($items as $item) {
            $product = $item['product'];

            $order->items()->create([
                'product_id'   => $product->id,
                'product_name' => $product->name,
                'price'        => $product->price,
                'qty'          => $item['qty'],
                'line_total'   => $item['line_total'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('home')
            ->with('success', 'Заказ успешно оформлен');
    }
}
