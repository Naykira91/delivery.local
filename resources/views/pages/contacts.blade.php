@extends('layouts.app')

@section('title', 'Контакты')

@section('content')
    <section class="py-8 md:py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-gray-900">
                    Контакты
                </h1>

                <p class="mt-4 max-w-3xl text-base md:text-lg text-gray-600 leading-7">
                    Свяжитесь с нами удобным способом, оформляйте заказ онлайн или забирайте его самостоятельно.
                    Ниже — все основные контакты, адрес пункта самовывоза и карта.
                </p>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="lg:col-span-1 space-y-6">
                    <div class="rounded-2xl border border-orange-100 bg-orange-50 p-5 md:p-6 shadow-sm">
                        <h2 class="text-xl font-semibold text-gray-900">
                            Наши контакты
                        </h2>

                        <div class="mt-5 space-y-5">
                            <div>
                                <p class="text-sm text-gray-500">Короткий номер</p>
                                <p class="mt-1 text-lg font-semibold text-gray-900">
                                    222-345
                                </p>
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
                                    class="mt-1 inline-block text-base font-medium text-orange-700 hover:text-orange-800 break-all"
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
                                <p class="text-sm text-gray-500">Адрес самовывоза</p>
                                <p class="mt-1 text-gray-900 leading-6">
                                    Нежинская улица, 1Б, Пригородный
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 shadow-sm">
                        <h2 class="text-xl font-semibold text-gray-900">
                            График работы
                        </h2>

                        <div class="mt-4 divide-y divide-gray-100">
                            <div class="flex items-center justify-between py-3 text-gray-700">
                                <span>Понедельник</span>
                                <span class="font-medium text-gray-900">10:00–21:30</span>
                            </div>
                            <div class="flex items-center justify-between py-3 text-gray-700">
                                <span>Вторник</span>
                                <span class="font-medium text-gray-900">10:00–21:30</span>
                            </div>
                            <div class="flex items-center justify-between py-3 text-gray-700">
                                <span>Среда</span>
                                <span class="font-medium text-gray-900">10:00–21:30</span>
                            </div>
                            <div class="flex items-center justify-between py-3 text-gray-700">
                                <span>Четверг</span>
                                <span class="font-medium text-gray-900">10:00–21:30</span>
                            </div>
                            <div class="flex items-center justify-between py-3 text-gray-700">
                                <span>Пятница</span>
                                <span class="font-medium text-gray-900">10:00–22:30</span>
                            </div>
                            <div class="flex items-center justify-between py-3 text-gray-700">
                                <span>Суббота</span>
                                <span class="font-medium text-gray-900">10:00–22:30</span>
                            </div>
                            <div class="flex items-center justify-between py-3 text-gray-700">
                                <span>Воскресенье</span>
                                <span class="font-medium text-gray-900">10:00–21:30</span>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 shadow-sm">
                        <h2 class="text-xl font-semibold text-gray-900">
                            Как с нами связаться
                        </h2>

                        <ul class="mt-4 space-y-3 text-gray-700">
                            <li class="flex items-start gap-3">
                                <span class="mt-1 h-2.5 w-2.5 rounded-full bg-orange-500 flex-shrink-0"></span>
                                <span>Позвоните нам, если хотите быстро уточнить детали заказа.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1 h-2.5 w-2.5 rounded-full bg-orange-500 flex-shrink-0"></span>
                                <span>Напишите в Telegram или VK, если удобнее общаться в мессенджере.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1 h-2.5 w-2.5 rounded-full bg-orange-500 flex-shrink-0"></span>
                                <span>Для самовывоза лучше оформить заказ заранее — мы приготовим всё к вашему приезду.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 shadow-sm overflow-hidden">
                        <h2 class="text-xl font-semibold text-gray-900">
                            Пункт самовывоза
                        </h2>

                        <p class="mt-3 text-gray-600 leading-7">
                            Вот так выглядит наша точка. Если забираете заказ самостоятельно, ориентируйтесь на вывеску
                            и фирменные цвета.
                        </p>

                        <div class="mt-5 overflow-hidden rounded-2xl border border-gray-100">
                            <img
                                src="{{ asset('images/contacts-point.jpg') }}"
                                alt="Пункт самовывоза Пару палок"
                                class="w-full h-auto object-cover"
                            >
                        </div>
                    </div>

                    <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 shadow-sm overflow-hidden">
                        <h2 class="text-xl font-semibold text-gray-900">
                            Мы на карте
                        </h2>

                        <p class="mt-3 text-gray-600 leading-7">
                            Адрес: Нежинская улица, 1Б, Пригородный
                        </p>

                        <div class="mt-5 overflow-hidden rounded-2xl border border-gray-100">
                            <div class="aspect-[16/10] md:aspect-[16/8]">
                                <iframe
                                    src="https://yandex.ru/map-widget/v1/?ll=55.254466%2C51.770490&z=17&pt=55.254466,51.770490,pm2rdm"
                                    width="100%"
                                    height="100%"
                                    frameborder="0"
                                    allowfullscreen="true"
                                    style="position:relative;"
                                ></iframe>
                            </div>
                        </div>

                        <p class="mt-4 text-sm text-gray-500 leading-6">
                            Если карта отображается неточно, свяжитесь с нами — подскажем, как удобнее добраться.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
