<?php

namespace App\Services\Checkout;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CheckoutOrderService
{
    public function prepareCart(array $cart): CheckoutOrderResult
    {
        $products = $this->loadProducts($cart);

        $items = [];
        $total = 0.0;

        foreach ($cart as $id => $qty) {
            $product = $products->get((int) $id);

            if (!$product) {
                continue;
            }

            $lineTotal = (float) $product->price * (int) $qty;
            $total += $lineTotal;

            $items[] = [
                'product' => $product,
                'qty' => (int) $qty,
                'line_total' => $lineTotal,
            ];
        }

        return new CheckoutOrderResult(
            order: null,
            items: $items,
            total: $total,
        );
    }

    public function create(array $data, array $cart): CheckoutOrderResult
    {
        $prepared = $this->prepareCart($cart);

        if ($prepared->items === []) {
            return $prepared;
        }

        $order = DB::transaction(function () use ($data, $prepared) {
            $order = Order::create([
                ...$data,
                'total_price' => $prepared->total,
                'status' => 'new',
            ]);

            foreach ($prepared->items as $item) {
                $product = $item['product'];

                $order->items()->create([
                    'product_id'   => $product->id,
                    'product_name' => $product->name,
                    'price'        => $product->price,
                    'qty'          => $item['qty'],
                    'line_total'   => $item['line_total'],
                ]);
            }

            return $order;
        });

        return new CheckoutOrderResult(
            order: $order,
            items: $prepared->items,
            total: $prepared->total,
        );
    }

    private function loadProducts(array $cart)
    {
        $ids = array_map('intval', array_keys($cart));

        return Product::query()
            ->whereIn('id', $ids)
            ->where('is_active', true)
            ->with('mainImage')
            ->get()
            ->keyBy('id');
    }
}
