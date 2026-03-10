<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Доставка еды')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
<header class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-gray-100 shadow-sm">
    <div class="container mx-auto px-4 py-4 flex items-center gap-6">

        <!-- Логотип -->
        <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-semibold">
            <span class="text-rose-500 text-2xl">🍣</span>
            <span>Delivery</span>
        </a>

        <!-- Поиск -->
        <form action="{{ route('menu') }}" class="ml-auto hidden md:flex items-center gap-2">
            <input name="q"
                   value="{{ $q ?? '' }}"
                   class="border border-gray-200 rounded-xl px-4 py-2 w-72 focus:outline-none focus:ring-2 focus:ring-rose-400"
                   placeholder="Поиск по меню">
            <button class="bg-rose-500 text-white px-4 py-2 rounded-xl hover:bg-rose-600 transition">
                Найти
            </button>
        </form>

        <!-- Контакты -->
        <div class="hidden lg:flex flex-col text-sm text-right">
            <a href="tel:+79000000000" class="font-semibold text-gray-800">
                +7 900 000-00-00
            </a>
            <span class="text-gray-500">Ежедневно 11:00–23:00</span>
        </div>
        @php($cartCount = array_sum(session('cart', [])))

        <a href="{{ route('cart.index') }}" class="ml-3 text-sm hover:text-rose-600">
            🛒 Корзина
            <span id="cartCount"
                  class="ml-1 inline-flex items-center justify-center min-w-6 h-6 px-2 rounded-full bg-rose-500 text-white text-xs {{ $cartCount ? '' : 'hidden' }}">
        {{ $cartCount }}
    </span>
        </a>

    </div>

    <!-- Нижняя строка навигации -->
    <div class="container mx-auto px-4 pb-3 flex gap-6 text-sm text-gray-600">
        <a href="{{ route('delivery') }}" class="hover:text-rose-500 transition">Доставка и оплата</a>
        <a href="{{ route('contacts') }}" class="hover:text-rose-500 transition">Контакты</a>
    </div>
</header>

<main class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-6">
        @yield('content')
    </div>
</main>

<footer class="border-t bg-white">
    <div class="container mx-auto px-4 py-6 text-sm text-gray-600 flex flex-col gap-2">
        <div class="flex flex-wrap gap-4">
            <span>📞 <a class="text-black" href="tel:+79000000000">+7 900 000-00-00</a></span>
            <span>📍 Оренбург</span>
            <span>🕒 11:00–23:00</span>
        </div>
        <div class="flex flex-wrap gap-4">
            <a class="hover:text-black" href="#">VK</a>
            <a class="hover:text-black" href="#">Telegram</a>
            <a class="hover:text-black" href="#">Instagram*</a>
        </div>
        <div class="text-xs text-gray-400">*если используете</div>
    </div>
</footer>
@stack('scripts')
</body>
</html>
