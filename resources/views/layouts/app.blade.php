<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Доставка еды')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header class="sticky top-0 z-50 bg-black text-white border-b border-neutral-800 shadow-sm">
    <div class="container mx-auto px-4 py-4 flex items-center gap-6">

        <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0">
            <div class="bg-white rounded-xl p-1 shadow-sm">
                <img src="/images/logo.png" alt="Пару палок" class="h-8 w-auto">
            </div>

            <div class="flex flex-col leading-tight">
                <span class="font-semibold text-white">Пару палок</span>
                <span class="text-xs text-neutral-400">суши & роллы</span>
            </div>
        </a>

        <form action="{{ route('menu') }}" class="ml-auto hidden md:flex items-center gap-2">
            <input
                name="q"
                value="{{ $q ?? '' }}"
                class="border border-neutral-700 bg-neutral-900 text-white rounded-xl px-4 py-2 w-72 focus:outline-none focus:ring-2 focus:ring-orange-400"
                placeholder="Поиск по меню"
            >
            <button class="bg-orange-500 text-white px-4 py-2 rounded-xl hover:bg-orange-600 transition">
                Найти
            </button>
        </form>

        <div class="hidden lg:flex flex-col text-sm text-right">
            <a href="tel:+79000000000" class="font-semibold text-white">
                +7 900 000-00-00
            </a>
            <span class="text-neutral-400">Ежедневно 11:00–23:00</span>
        </div>

        @php($cartCount = array_sum(session('cart', [])))

        <a href="{{ route('cart.index') }}" class="ml-3 text-sm text-white hover:text-orange-400 transition">
            🛒 Корзина
            <span
                id="cartCount"
                class="ml-1 inline-flex items-center justify-center min-w-6 h-6 px-2 rounded-full bg-orange-500 text-white text-xs {{ $cartCount ? '' : 'hidden' }}"
            >
                {{ $cartCount }}
            </span>
        </a>
    </div>

    <div class="container mx-auto px-4 pb-3 flex gap-6 text-sm text-neutral-300">
        <a href="{{ route('menu') }}" class="hover:text-orange-400 transition">Меню</a>
        <a href="{{ route('delivery') }}" class="hover:text-orange-400 transition">Доставка и оплата</a>
        <a href="{{ route('contacts') }}" class="hover:text-orange-400 transition">Контакты</a>
    </div>
</header>

<main class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-6">

        @if (session('success'))
            <div class="mb-4 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-red-800">
                {{ session('error') }}
            </div>
        @endif

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
            <a class="hover:text-black" href="https://t.me/parupalok56">Telegram</a>
            <a class="hover:text-black" href="#">Instagram*</a>
        </div>
        <div class="text-xs text-gray-400">*если используете</div>
    </div>
</footer>
</body>
</html>
