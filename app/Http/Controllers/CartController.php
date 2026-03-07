<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function cart(): array
    {
        return session()->get('cart', []);
    }

    private function saveCart(array $cart): void
    {
        session()->put('cart', $cart);
    }

    public function index()
    {
        $cart = $this->cart();

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
            $p = $products->get((int) $id);
            if (!$p) {
                continue;
            }

            $line = $p->price * $qty;
            $total += $line;

            $items[] = [
                'product' => $p,
                'qty' => $qty,
                'line_total' => $line,
            ];
        }

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Product $product, Request $request)
    {
        $cart = $this->cart();

        $cart[$product->id] = ($cart[$product->id] ?? 0) + 1;

        $this->saveCart($cart);

        if ($request->expectsJson()) {
            return response()->json([
                'ok' => true,
                'product_id' => $product->id,
                'qty' => $cart[$product->id],
                'count' => array_sum($cart),
            ]);
        }

        return back()->with('success', 'Добавлено в корзину');
    }

    public function inc(Product $product, Request $request)
    {
        $cart = $this->cart();

        if (isset($cart[$product->id])) {
            $cart[$product->id]++;
        } else {
            $cart[$product->id] = 1;
        }

        $this->saveCart($cart);

        if ($request->expectsJson()) {
            return response()->json([
                'ok' => true,
                'product_id' => $product->id,
                'qty' => $cart[$product->id],
                'count' => array_sum($cart),
            ]);
        }

        return back();
    }

    public function dec(Product $product, Request $request)
    {
        $cart = $this->cart();

        if (isset($cart[$product->id])) {
            $cart[$product->id]--;

            if ($cart[$product->id] <= 0) {
                unset($cart[$product->id]);
            }

            $this->saveCart($cart);
        }

        $qty = (int) ($cart[$product->id] ?? 0);

        if ($request->expectsJson()) {
            return response()->json([
                'ok' => true,
                'product_id' => $product->id,
                'qty' => $qty,
                'count' => array_sum($cart),
            ]);
        }

        return back();
    }

    public function remove(Product $product, Request $request)
    {
        $cart = $this->cart();

        unset($cart[$product->id]);

        $this->saveCart($cart);

        if ($request->expectsJson()) {
            return response()->json([
                'ok' => true,
                'product_id' => $product->id,
                'qty' => 0,
                'count' => array_sum($cart),
            ]);
        }

        return back();
    }

    public function clear(Request $request)
    {
        session()->forget('cart');

        if ($request->expectsJson()) {
            return response()->json([
                'ok' => true,
                'count' => 0,
            ]);
        }

        return back();
    }
}
