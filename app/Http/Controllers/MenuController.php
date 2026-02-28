<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string)$request->get('q', ''));

        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort')
            ->with(['products' => function ($query) use ($q) {
                $query->where('is_active', true)
                    ->with(['mainImage']) // для карточки достаточно
                    ->when($q !== '', function ($qq) use ($q) {
                        $qq->where('name', 'like', "%{$q}%");
                    });
            }])
            ->get();

        return view('menu.index', compact('categories', 'q'));
    }
}
