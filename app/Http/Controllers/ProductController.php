<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show(string $slug)
    {
        $product = Product::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->with([
                'categories',
                'images',
                'mainImage',
                'items.mainImage', // если это сет — покажем состав
            ])
            ->firstOrFail();

        return view('product.show', compact('product'));
    }
}
