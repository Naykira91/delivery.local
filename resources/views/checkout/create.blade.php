@extends('layouts.app')

@section('title', 'Оформление заказа')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold">Оформление заказа</h1>
    </div>

    @php
        $inputClass = 'w-full border border-gray-200 rounded-xl px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-rose-300';
    @endphp

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <form
                id="checkoutForm"
                action="{{ route('checkout.store') }}"
                method="POST"
                class="bg-white border border-gray-100 rounded-2xl p-5 space-y-5"
            >
                @csrf

                {{-- honeypot --}}
                <div class="hidden">
                    <input type="text" name="website" tabindex="-1" autocomplete="off">
                </div>

                {{-- Имя --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Имя</label>
                    <input
                        type="text"
                        name="customer_name"
                        value="{{ old('customer_name') }}"
                        required
                        maxlength="100"
                        class="{{ $inputClass }} @error('customer_name') border-red-500 @enderror"
                    >
                    @error('customer_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Телефон --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Телефон</label>
                    <input
                        type="tel"
                        name="customer_phone"
                        value="{{ old('customer_phone') }}"
                        placeholder="+7 (___) ___-__-__"
                        inputmode="tel"
                        autocomplete="tel"
                        maxlength="18"
                        required
                        class="{{ $inputClass }} @error('customer_phone') border-red-500 @enderror"
                    >
                    @error('customer_phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Оплата --}}
                <div>
                    <label class="block text-sm font-medium mb-2">Способ оплаты</label>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="payment_method" value="cash" {{ old('payment_method', 'cash') === 'cash' ? 'checked' : '' }}>
                            <span>Наличными</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="payment_method" value="transfer" {{ old('payment_method') === 'transfer' ? 'checked' : '' }}>
                            <span>Переводом</span>
                        </label>
                    </div>
                </div>

                {{-- Получение --}}
                <div>
                    <label class="block text-sm font-medium mb-2">Способ получения</label>

                    <div class="flex flex-col sm:flex-row gap-4 mb-3">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="delivery_type" value="delivery" class="js-delivery-type" {{ old('delivery_type', 'delivery') === 'delivery' ? 'checked' : '' }}>
                            <span>Доставка</span>
                        </label>

                        <label class="flex items-center gap-2">
                            <input type="radio" name="delivery_type" value="pickup" class="js-delivery-type" {{ old('delivery_type') === 'pickup' ? 'checked' : '' }}>
                            <span>Самовывоз</span>
                        </label>
                    </div>

                    {{-- АДРЕС --}}
                    <div id="addressFields">
                        <div class="mb-3">
                            <label class="block text-sm font-medium mb-1">Улица и дом</label>
                            <input
                                type="text"
                                name="address"
                                value="{{ old('address') }}"
                                maxlength="255"
                                class="{{ $inputClass }} @error('address') border-red-500 @enderror"
                                placeholder="Например: ул. Ленина, 15"
                            >
                            @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="inline-flex items-center gap-2">
                                <input type="checkbox" name="is_private_house" value="1" id="privateHouseCheckbox" {{ old('is_private_house') ? 'checked' : '' }}>
                                <span>Частный дом</span>
                            </label>
                        </div>

                        <div id="flatFields" class="grid grid-cols-2 gap-4">
                            <input type="text" name="apartment" value="{{ old('apartment') }}" placeholder="Квартира" class="{{ $inputClass }}">
                            <input type="text" name="entrance" value="{{ old('entrance') }}" placeholder="Подъезд" class="{{ $inputClass }}">
                            <input type="text" name="floor" value="{{ old('floor') }}" placeholder="Этаж" class="{{ $inputClass }}">
                            <input type="text" name="intercom" value="{{ old('intercom') }}" placeholder="Домофон" class="{{ $inputClass }}">
                        </div>

                        {{-- Доставка инфо --}}
                        <div class="mt-4 bg-sky-50 border border-sky-200 rounded-2xl p-4 text-sm text-gray-700">
                            <div class="font-medium mb-2">Доставка бесплатная:</div>
                            <div class="space-y-1 text-xs leading-relaxed">
                                <div>Пригородный, Крона — от 1000 ₽</div>
                                <div>Жил городок, Нежинка, Нежинка 3, Золотой квартал, 23 микрорайон, Ростоши — от 1500 ₽</div>
                                <div>Мира, Мёртвый город — от 2000 ₽</div>
                                <div>Центр города, Степной, Ивановка, Экодолье, Приуралье — от 2500 ₽</div>
                                <div>Весенний, Южный, Карачи, Маяк — от 3000 ₽</div>
                                <div>Армада, Каменноозёрное — от 3500 ₽</div>
                                <div>Приуральский, Яровой, Беленовка — от 4000 ₽</div>
                                <div>Чулошников — от 5000 ₽</div>
                                <div>Чебеньки, Студенцы, Вязовка — от 6000 ₽</div>
                                <div>Пречистинка, Островное — от 6500 ₽</div>
                            </div>
                        </div>
                    </div>

                    {{-- Самовывоз --}}
                    <div id="pickupInfo" class="mt-3 bg-gray-50 border border-gray-200 rounded-2xl p-4 text-sm text-gray-700 hidden">
                        <div class="font-medium mb-1">Самовывоз</div>
                        <div>Адрес и время готовности уточнит менеджер.</div>
                    </div>
                </div>

                {{-- Комментарий --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Комментарий</label>
                    <textarea
                        name="comment"
                        rows="4"
                        maxlength="500"
                        class="{{ $inputClass }}"
                        placeholder="Комментарий к заказу"
                    >{{ old('comment') }}</textarea>
                </div>

                {{-- Кнопка --}}
                <button
                    id="checkoutSubmitBtn"
                    type="submit"
                    class="w-full bg-orange-500 text-white rounded-xl px-4 py-3 font-medium hover:bg-orange-600 transition"
                >
                    Подтвердить заказ
                </button>
            </form>
        </div>

        {{-- КОРЗИНА --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-5 h-fit sticky top-28">
            <h2 class="font-semibold mb-4">Ваш заказ</h2>

            <div class="space-y-3">
                @foreach($items as $item)
                    <div class="flex justify-between text-sm">
                        <span>{{ $item['product']->name }} × {{ $item['qty'] }}</span>
                        <span>{{ $item['line_total'] }} ₽</span>
                    </div>
                @endforeach
            </div>

            <div class="border-t mt-4 pt-4 flex justify-between">
                <span class="text-gray-600">Итого</span>
                <span class="text-lg font-semibold">{{ $total }} ₽</span>
            </div>
        </div>
    </div>
@endsection

@vite('resources/js/pages/checkout.js')
