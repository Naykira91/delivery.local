@php
    use Illuminate\Support\Facades\Storage;
    $img = $product->card_image_path ? Storage::url($product->card_image_path) : null;
@endphp

<a href="{{ route('product.show', $product->slug) }}"
   class="border border-gray-100 rounded-2xl overflow-hidden bg-white shadow-sm hover:shadow-md transition">
    <div class="aspect-[4/3] bg-gray-100">
        @if($img)
            <img src="{{ $img }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
        @endif
    </div>

    <div class="p-3 flex flex-col gap-2">
        <div class="font-medium leading-snug">{{ $product->name }}</div>

        <div class="text-xs text-gray-500">
            @if($product->pieces) {{ $product->pieces }} шт @endif
            @if($product->pieces && $product->weight_grams) · @endif
            @if($product->weight_grams) {{ $product->weight_grams }} г @endif
        </div>

        <div class="flex items-baseline gap-2">
            <div class="font-semibold">{{ $product->price }} ₽</div>
            @if(!is_null($product->old_price))
                <div class="text-sm text-gray-400 line-through">{{ $product->old_price }} ₽</div>
            @endif
        </div>

        <button type="button"
                class="mt-1 w-full bg-rose-500 text-white rounded-xl px-3 py-2 text-sm hover:bg-rose-600">
            В корзину
        </button>
    </div>
</a>
