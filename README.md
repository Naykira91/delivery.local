# Пару палок

Pet-проект сайта доставки еды на Laravel.

## Что реализовано

- каталог товаров по категориям
- карточки товаров
- корзина
- оформление заказа
- отправка уведомлений о заказе по email
- подготовка архитектуры под дополнительные каналы уведомлений

## Стек

- Laravel
- PHP 8
- MySQL
- Blade
- Tailwind / Vite

## Локальный запуск

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run dev
php artisan serve
