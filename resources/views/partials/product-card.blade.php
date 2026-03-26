@php
    use Illuminate\Support\Facades\Storage;

    $img = $product->card_image_path ? Storage::url($product->card_image_path) : null;
    $qty = (int)(($cart[$product->id] ?? 0));
@endphp

<div class="h-full border border-gray-100 rounded-2xl overflow-hidden bg-white shadow-sm hover:shadow-md hover:border-orange-200 transition flex flex-col">

    {{-- Фото --}}
    <a href="{{ route('product.show', $product->slug) }}" class="block">
        <div class="aspect-[4/3] bg-gray-100">
            @if($img)
                <img src="{{ $img }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            @endif
        </div>
    </a>

    {{-- Контент карточки --}}
    <div class="p-3 flex flex-col flex-1">

        {{-- Название --}}
        <a href="{{ route('product.show', $product->slug) }}" class="block">
            <div class="font-medium leading-snug min-h-[2.75rem]">
                {{ $product->name }}
            </div>

            <div class="text-xs text-gray-500 mt-1">
                @if($product->pieces)
                    {{ $product->pieces }} шт
                @endif

                @if($product->pieces && $product->weight_grams)
                    ·
                @endif

                @if($product->weight_grams)
                    {{ $product->weight_grams }} г
                @endif
            </div>
        </a>

        {{-- Низ карточки --}}
        <div class="mt-auto pt-3 flex flex-col gap-2">

            {{-- Цена --}}
            <div class="flex items-baseline gap-2">
                <div class="font-semibold text-base">
                    {{ $product->price }} ₽
                </div>

                @if(!is_null($product->old_price))
                    <div class="text-sm text-gray-400 line-through">
                        {{ $product->old_price }} ₽
                    </div>
                @endif
            </div>

            {{-- Кнопка "В корзину" --}}
            <form action="{{ route('cart.add', $product) }}"
                  method="POST"
                  class="js-cart-add {{ $qty > 0 ? 'hidden' : '' }}">
                @csrf

                <button type="submit"
                        class="w-full bg-orange-500 text-white rounded-xl px-3 py-2 text-sm font-medium
                               transition hover:bg-orange-600 active:scale-[0.97]
                               focus:outline-none focus:ring-2 focus:ring-orange-300">
                    В корзину
                </button>
            </form>

            {{-- Счётчик --}}
            <div class="js-cart-qty flex items-center justify-between gap-2 {{ $qty > 0 ? '' : 'hidden' }}"
                 data-product-id="{{ $product->id }}">

                <form action="{{ route('cart.dec', $product) }}"
                      method="POST"
                      class="js-cart-dec w-1/3">
                    @csrf

                    <button type="submit"
                            class="w-full h-10 border border-gray-200 rounded-xl
                                   text-lg font-medium text-gray-600
                                   transition hover:bg-gray-100 active:scale-[0.95]">
                        −
                    </button>
                </form>

                <div class="js-qty text-center w-1/3 font-semibold text-base text-gray-800">
                    {{ $qty }}
                </div>

                <form action="{{ route('cart.inc', $product) }}"
                      method="POST"
                      class="js-cart-inc w-1/3">
                    @csrf

                    <button type="submit"
                            class="w-full h-10 rounded-xl
                                   bg-orange-500 text-white text-lg font-medium
                                   transition hover:bg-orange-600 active:scale-[0.95]">
                        +
                    </button>
                </form>

            </div>

        </div>
    </div>
</div>
