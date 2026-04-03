@extends('layouts.app')

@section('title', 'Доставка и оплата')

@section('content')
    <section class="py-8 md:py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-gray-900">
                    Доставка и оплата
                </h1>

                <p class="mt-4 max-w-3xl text-base md:text-lg text-gray-600 leading-7">
                    Доставка и самовывоз роллов, суши и фастфуда в Пригородном.
                    Готовим всё свежее только после оформления заказа — чтобы вы получали вкусную,
                    аккуратно приготовленную еду.
                </p>

                <p class="mt-3 inline-flex rounded-full bg-orange-50 px-4 py-2 text-sm font-medium text-orange-700">
                    Вкусно — палочки оближешь!
                </p>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="lg:col-span-2 space-y-6">
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 shadow-sm">
                        <h2 class="text-xl font-semibold text-gray-900">
                            Условия доставки
                        </h2>

                        <p class="mt-3 text-gray-600 leading-7">
                            Бесплатная доставка действует от определённой суммы заказа —
                            в зависимости от района.
                        </p>

                        <div class="mt-5 overflow-hidden rounded-2xl border border-gray-100">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-100">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">
                                            Район доставки
                                        </th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">
                                            Бесплатно от
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 bg-white">
                                    <tr>
                                        <td class="px-4 py-4 text-sm text-gray-700 leading-6">Пригородный, Крона</td>
                                        <td class="px-4 py-4 text-sm font-semibold text-gray-900 whitespace-nowrap">от 1 000 ₽</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 text-sm text-gray-700 leading-6">
                                            Жилгородок, Нежинка, Нежинка 3, Золотой квартал, 23 микрорайон, Ростоши
                                        </td>
                                        <td class="px-4 py-4 text-sm font-semibold text-gray-900 whitespace-nowrap">от 1 500 ₽</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 text-sm text-gray-700 leading-6">Мира, Мёртвый город</td>
                                        <td class="px-4 py-4 text-sm font-semibold text-gray-900 whitespace-nowrap">от 2 000 ₽</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 text-sm text-gray-700 leading-6">
                                            Центр города, Степной, Ивановка, Экодолье, Приуралье
                                        </td>
                                        <td class="px-4 py-4 text-sm font-semibold text-gray-900 whitespace-nowrap">от 2 500 ₽</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 text-sm text-gray-700 leading-6">Весенний, Южный, Карачи, Маяк</td>
                                        <td class="px-4 py-4 text-sm font-semibold text-gray-900 whitespace-nowrap">от 3 000 ₽</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 text-sm text-gray-700 leading-6">Армада, Каменноозёрное</td>
                                        <td class="px-4 py-4 text-sm font-semibold text-gray-900 whitespace-nowrap">от 3 500 ₽</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 text-sm text-gray-700 leading-6">Приуральский, Яровой, Беленовка</td>
                                        <td class="px-4 py-4 text-sm font-semibold text-gray-900 whitespace-nowrap">от 4 000 ₽</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 text-sm text-gray-700 leading-6">Чулошников</td>
                                        <td class="px-4 py-4 text-sm font-semibold text-gray-900 whitespace-nowrap">от 5 000 ₽</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 text-sm text-gray-700 leading-6">Чебеньки, Студенцы, Вязовка</td>
                                        <td class="px-4 py-4 text-sm font-semibold text-gray-900 whitespace-nowrap">от 6 000 ₽</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 text-sm text-gray-700 leading-6">Пречистинка, Островное</td>
                                        <td class="px-4 py-4 text-sm font-semibold text-gray-900 whitespace-nowrap">от 6 500 ₽</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <p class="mt-4 text-sm text-gray-500 leading-6">
                            Если вы не уверены, к какой зоне относится ваш адрес, просто позвоните нам —
                            мы подскажем условия доставки.
                        </p>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 shadow-sm">
                            <h2 class="text-xl font-semibold text-gray-900">
                                Оплата
                            </h2>

                            <ul class="mt-4 space-y-3 text-gray-700">
                                <li class="flex items-start gap-3">
                                    <span class="mt-1 h-2.5 w-2.5 rounded-full bg-orange-500 flex-shrink-0"></span>
                                    <span>Наличными при получении</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="mt-1 h-2.5 w-2.5 rounded-full bg-orange-500 flex-shrink-0"></span>
                                    <span>Переводом</span>
                                </li>
                            </ul>

                            <p class="mt-4 text-sm text-gray-500 leading-6">
                                Оплатить заказ можно удобным для вас способом при оформлении или получении заказа.
                            </p>
                        </div>

                        <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 shadow-sm">
                            <h2 class="text-xl font-semibold text-gray-900">
                                Самовывоз
                            </h2>

                            <p class="mt-4 text-gray-700 leading-7">
                                Забрать заказ самостоятельно можно по адресу:
                            </p>

                            <p class="mt-3 font-medium text-gray-900">
                                Нежинская улица, 1Б, Пригородный
                            </p>

                            <p class="mt-4 text-sm text-gray-500 leading-6">
                                Все блюда готовятся по факту заказа, поэтому лучше оформить заказ заранее.
                            </p>
                        </div>
                    </div>
                </div>

                <aside class="space-y-6">
                    <div class="rounded-2xl border border-orange-100 bg-orange-50 p-5 md:p-6 shadow-sm">
                        <h2 class="text-xl font-semibold text-gray-900">
                            Контакты
                        </h2>

                        <div class="mt-5 space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Короткий номер</p>
                                <p class="mt-1 text-lg font-semibold text-gray-900">222-345</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Телефон</p>
                                <a
                                    href="tel:+79991062956"
                                    class="mt-1 inline-block text-lg font-semibold text-orange-700 hover:text-orange-800"
                                >
                                    +7 (999) 106-29-56
                                </a>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Telegram</p>
                                <a
                                    href="https://t.me/parupalok56"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="mt-1 inline-block text-base font-medium text-orange-700 hover:text-orange-800"
                                >
                                    @parupalok56
                                </a>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">VK</p>
                                <a
                                    href="https://vk.com/parupalok56"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="mt-1 inline-block text-base font-medium text-orange-700 hover:text-orange-800 break-all"
                                >
                                    vk.com/parupalok56
                                </a>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Адрес</p>
                                <p class="mt-1 text-gray-900 leading-6">
                                    Нежинская улица, 1Б, Пригородный
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 shadow-sm">
                        <h2 class="text-xl font-semibold text-gray-900">
                            Важно знать
                        </h2>

                        <ul class="mt-4 space-y-3 text-gray-700">
                            <li class="flex items-start gap-3">
                                <span class="mt-1 h-2.5 w-2.5 rounded-full bg-orange-500 flex-shrink-0"></span>
                                <span>Готовим только после оформления заказа.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1 h-2.5 w-2.5 rounded-full bg-orange-500 flex-shrink-0"></span>
                                <span>Минимальная сумма бесплатной доставки зависит от района.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1 h-2.5 w-2.5 rounded-full bg-orange-500 flex-shrink-0"></span>
                                <span>Если остались вопросы — позвоните нам или напишите в Telegram.</span>
                            </li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
