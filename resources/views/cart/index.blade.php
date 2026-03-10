@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
    @php use Illuminate\Support\Facades\Storage; @endphp

    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold">Корзина</h1>

        @if(count($items))
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                <button class="text-sm text-gray-500 hover:text-black">Очистить</button>
            </form>
        @endif
    </div>

    @if(!count($items))
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <div class="text-gray-600">Корзина пуста.</div>
            <a href="{{ route('menu') }}" class="inline-block mt-3 text-rose-600 hover:text-rose-700">
                Перейти в меню →
            </a>
        </div>
    @else
        <div class="grid lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 space-y-3">
                @foreach($items as $item)
                    @php
                        $p = $item['product'];
                        $img = $p->mainImage?->path ? Storage::url($p->mainImage->path) : null;
                    @endphp

                    <div class="bg-white border border-gray-100 rounded-2xl p-4 flex gap-4">
                        <div class="w-28 h-20 bg-gray-100 rounded-xl overflow-hidden shrink-0">
                            @if($img)
                                <img src="{{ $img }}" alt="{{ $p->name }}" class="w-full h-full object-cover">
                            @endif
                        </div>

                        <div class="flex-1">
                            <div class="font-medium">{{ $p->name }}</div>
                            <div class="text-sm text-gray-500">
                                @if($p->pieces) {{ $p->pieces }} шт @endif
                                @if($p->pieces && $p->weight_grams) · @endif
                                @if($p->weight_grams) {{ $p->weight_grams }} г @endif
                            </div>

                            <div class="mt-2 flex items-center justify-between">
                                <div class="font-semibold">{{ $p->price }} ₽</div>

                                <div class="flex items-center gap-2">
                                    <form action="{{ route('cart.dec', $p) }}" method="POST">
                                        @csrf
                                        <button class="w-9 h-9 border rounded-xl hover:bg-gray-50">−</button>
                                    </form>

                                    <div class="w-8 text-center">{{ $item['qty'] }}</div>

                                    <form action="{{ route('cart.inc', $p) }}" method="POST">
                                        @csrf
                                        <button class="w-9 h-9 border rounded-xl hover:bg-gray-50">+</button>
                                    </form>

                                    <form action="{{ route('cart.remove', $p) }}" method="POST">
                                        @csrf
                                        <button class="ml-2 text-sm text-gray-500 hover:text-black">Удалить</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="font-semibold whitespace-nowrap">
                            {{ $item['line_total'] }} ₽
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="bg-white border border-gray-100 rounded-2xl p-4 h-fit sticky top-28">
                <div class="flex items-center justify-between">
                    <div class="text-gray-600">Итого</div>
                    <div class="text-xl font-semibold">{{ $total }} ₽</div>

                </div>

                <form action="{{ route('cart.clear') }}" method="POST" class="mt-3">
                    @csrf
                    <button class="w-full border border-gray-200 rounded-xl px-4 py-3 hover:bg-gray-50">
                        Очистить корзину
                    </button>
                </form>
                <a href="{{ route('checkout.create') }}"
                   class="mt-4 w-full inline-flex items-center justify-center bg-rose-500 text-white rounded-xl px-4 py-3 hover:bg-rose-600 transition">
                    Перейти к оформлению
                </a>

                <div class="mt-3 text-xs text-gray-500">
                    Оформление заказа сделаем на следующем шаге.
                </div>
            </div>

        </div>
    @endif
@endsection
