@extends('layouts.app')

@section('title', $product->name)

@section('content')
    @php
        use Illuminate\Support\Facades\Storage;
        $main = $product->mainImage?->path ? Storage::url($product->mainImage->path) : null;
    @endphp

    <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-gray-100 rounded-2xl overflow-hidden aspect-[4/3]">
            @if($main)
                <img src="{{ $main }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            @endif
        </div>

        <div class="flex flex-col gap-3">
            <h1 class="text-2xl font-semibold">{{ $product->name }}</h1>

            <div class="text-sm text-gray-600">
                @if($product->pieces) {{ $product->pieces }} шт @endif
                @if($product->pieces && $product->weight_grams) · @endif
                @if($product->weight_grams) {{ $product->weight_grams }} г @endif
            </div>

            <div class="flex items-baseline gap-2">
                <div class="text-xl font-semibold">{{ $product->price }} ₽</div>
                @if(!is_null($product->old_price))
                    <div class="text-gray-400 line-through">{{ $product->old_price }} ₽</div>
                @endif
            </div>

            <button type="button" class="border rounded-xl px-4 py-3 hover:bg-gray-50">
                В корзину
            </button>

            @if($product->description)
                <div class="mt-2">
                    <div class="font-medium mb-1">Описание</div>
                    <div class="text-gray-700 whitespace-pre-line">{{ $product->description }}</div>
                </div>
            @endif

            @if($product->composition)
                <div class="mt-2">
                    <div class="font-medium mb-1">Состав</div>
                    <div class="text-gray-700 whitespace-pre-line">{{ $product->composition }}</div>
                </div>
            @endif

            @if($product->type === 'set' && $product->items->count())
                <div class="mt-4">
                    <div class="font-medium mb-2">Входит в сет</div>
                    <ul class="list-disc pl-5 text-gray-700">
                        @foreach($product->items as $item)
                            <li>{{ $item->name }} × {{ $item->pivot->qty }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection
