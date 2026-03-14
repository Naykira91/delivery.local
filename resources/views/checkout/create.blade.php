@extends('layouts.app')

@section('title', 'Оформление заказа')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold">Оформление заказа</h1>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <form action="{{ route('checkout.store') }}" method="POST" class="bg-white border border-gray-100 rounded-2xl p-5 space-y-4">
                @csrf
                <div class="hidden">
                    <label for="website">Website</label>
                    <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Имя</label>
                    <input type="text"
                           name="customer_name"
                           value="{{ old('customer_name') }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-rose-300">
                    @error('customer_name')
                    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Телефон</label>
                    <input type="text"
                           name="customer_phone"
                           value="{{ old('customer_phone') }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-rose-300"
                           placeholder="+7 900 000-00-00">
                    @error('customer_phone')
                    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Способ оплаты --}}
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

                    @error('payment_method')
                    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Способ получения + адрес --}}
                <div>
                    <label class="block text-sm font-medium mb-2">Способ получения</label>

                    <div class="flex flex-col sm:flex-row gap-4 mb-3">
                        <label class="flex items-center gap-2">
                            <input type="radio"
                                   name="delivery_type"
                                   value="delivery"
                                   class="js-delivery-type"
                                {{ old('delivery_type', 'delivery') === 'delivery' ? 'checked' : '' }}>
                            <span>Доставка</span>
                        </label>

                        <label class="flex items-center gap-2">
                            <input type="radio"
                                   name="delivery_type"
                                   value="pickup"
                                   class="js-delivery-type"
                                {{ old('delivery_type') === 'pickup' ? 'checked' : '' }}>
                            <span>Самовывоз</span>
                        </label>
                    </div>

                    @error('delivery_type')
                    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                    @enderror

                    <div id="addressFields">
                        <div class="mb-3">
                            <label class="block text-sm font-medium mb-1">Улица и дом</label>
                            <input type="text"
                                   name="address"
                                   value="{{ old('address') }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-rose-300"
                                   placeholder="Улица и номер дома">
                            @error('address')
                            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="inline-flex items-center gap-2">
                                <input type="checkbox"
                                       name="is_private_house"
                                       value="1"
                                       id="privateHouseCheckbox"
                                    {{ old('is_private_house') ? 'checked' : '' }}>
                                <span>Частный дом</span>
                            </label>
                        </div>

                        <div id="flatFields" class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-medium mb-1">Квартира</label>
                                <input type="text"
                                       name="apartment"
                                       value="{{ old('apartment') }}"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-rose-300"
                                       placeholder="Квартира">
                                @error('apartment')
                                <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1">Подъезд</label>
                                <input type="text"
                                       name="entrance"
                                       value="{{ old('entrance') }}"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-rose-300"
                                       placeholder="Подъезд">
                                @error('entrance')
                                <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1">Этаж</label>
                                <input type="text"
                                       name="floor"
                                       value="{{ old('floor') }}"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-rose-300"
                                       placeholder="Этаж">
                                @error('floor')
                                <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1">Домофон</label>
                                <input type="text"
                                       name="intercom"
                                       value="{{ old('intercom') }}"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-rose-300"
                                       placeholder="Домофон">
                                @error('intercom')
                                <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div id="deliveryInfo" class="mt-3 bg-sky-50 border border-sky-200 rounded-2xl p-4 text-sm text-gray-700">
                            <div class="font-medium mb-2">Доставка бесплатная:</div>
                            <div class="space-y-1">
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

                    <div id="pickupInfo" class="mt-3 bg-gray-50 border border-gray-200 rounded-2xl p-4 text-sm text-gray-700 hidden">
                        <div class="font-medium mb-1">Самовывоз</div>
                        <div>Забрать заказ можно самостоятельно. Адрес и время готовности уточнит менеджер.</div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Комментарий</label>
                    <textarea name="comment"
                              rows="4"
                              class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-rose-300"
                              placeholder="Комментарий к заказу">{{ old('comment') }}</textarea>
                    @error('comment')
                    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full bg-rose-500 text-white rounded-xl px-4 py-3 font-medium hover:bg-rose-600 transition">
                    Подтвердить заказ
                </button>
            </form>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl p-5 h-fit sticky top-28">
            <h2 class="font-semibold mb-4">Ваш заказ</h2>

            <div class="space-y-3">
                @foreach($items as $item)
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <div class="font-medium">{{ $item['product']->name }}</div>
                            <div class="text-sm text-gray-500">{{ $item['qty'] }} × {{ $item['product']->price }} ₽</div>
                        </div>
                        <div class="font-medium whitespace-nowrap">{{ $item['line_total'] }} ₽</div>
                    </div>
                @endforeach
            </div>

            <div class="border-t border-gray-100 mt-4 pt-4 flex items-center justify-between">
                <div class="text-gray-600">Итого</div>
                <div class="text-xl font-semibold">{{ $total }} ₽</div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deliveryRadios = document.querySelectorAll('.js-delivery-type');
            const addressFields = document.getElementById('addressFields');
            const pickupInfo = document.getElementById('pickupInfo');
            const privateHouseCheckbox = document.getElementById('privateHouseCheckbox');
            const flatFields = document.getElementById('flatFields');

            function toggleDeliveryType() {
                const selected = document.querySelector('.js-delivery-type:checked')?.value;

                if (selected === 'pickup') {
                    addressFields.classList.add('hidden');
                    pickupInfo.classList.remove('hidden');
                } else {
                    addressFields.classList.remove('hidden');
                    pickupInfo.classList.add('hidden');
                }
            }

            function togglePrivateHouse() {
                if (!privateHouseCheckbox) return;

                if (privateHouseCheckbox.checked) {
                    flatFields.classList.add('hidden');
                } else {
                    flatFields.classList.remove('hidden');
                }
            }

            deliveryRadios.forEach((radio) => {
                radio.addEventListener('change', toggleDeliveryType);
            });

            if (privateHouseCheckbox) {
                privateHouseCheckbox.addEventListener('change', togglePrivateHouse);
            }

            toggleDeliveryType();
            togglePrivateHouse();
        });
    </script>
@endpush
