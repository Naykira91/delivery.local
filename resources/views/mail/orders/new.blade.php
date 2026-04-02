<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новый заказ №{{ $order->id }}</title>
</head>
<body style="margin:0; padding:0; background:#f4f4f5; font-family: Arial, Helvetica, sans-serif; color:#111827;">
<div style="max-width:700px; margin:0 auto; padding:32px 16px;">
    <div style="background:#ffffff; border-radius:16px; padding:24px; box-shadow:0 4px 18px rgba(0,0,0,0.06);">
        <div style="margin-bottom:24px;">
            <div style="font-size:28px; font-weight:700; color:#f97316; margin-bottom:8px;">
                Пару палок
            </div>
            <div style="font-size:22px; font-weight:700;">
                Новый заказ №{{ $order->id }}
            </div>
        </div>

        <table cellpadding="0" cellspacing="0" border="0" width="100%" style="margin-bottom:24px; border-collapse:collapse;">
            <tr>
                <td style="padding:8px 0; width:180px; color:#6b7280;">Имя</td>
                <td style="padding:8px 0; font-weight:600;">{{ $order->customer_name }}</td>
            </tr>
            <tr>
                <td style="padding:8px 0; color:#6b7280;">Телефон</td>
                <td style="padding:8px 0; font-weight:600;">{{ $order->customer_phone }}</td>
            </tr>
            <tr>
                <td style="padding:8px 0; color:#6b7280;">Получение</td>
                <td style="padding:8px 0;">{{ $order->delivery_type === 'delivery' ? 'Доставка' : 'Самовывоз' }}</td>
            </tr>
            <tr>
                <td style="padding:8px 0; color:#6b7280;">Оплата</td>
                <td style="padding:8px 0;">{{ $order->payment_method === 'cash' ? 'Наличными' : 'Перевод' }}</td>
            </tr>
        </table>

        @if($order->delivery_type === 'delivery')
            <div style="margin-bottom:24px;">
                <div style="font-size:18px; font-weight:700; margin-bottom:12px;">Адрес доставки</div>
                <div style="padding:16px; background:#fafafa; border:1px solid #e5e7eb; border-radius:12px;">
                    <div style="margin-bottom:8px;"><strong>Адрес:</strong> {{ $order->address }}</div>

                    @if($order->is_private_house)
                        <div><strong>Тип адреса:</strong> Частный дом</div>
                    @else
                        <div><strong>Квартира:</strong> {{ $order->apartment ?: '—' }}</div>
                        <div><strong>Подъезд:</strong> {{ $order->entrance ?: '—' }}</div>
                        <div><strong>Этаж:</strong> {{ $order->floor ?: '—' }}</div>
                        <div><strong>Домофон:</strong> {{ $order->intercom ?: '—' }}</div>
                    @endif
                </div>
            </div>
        @endif

        @if($order->comment)
            <div style="margin-bottom:24px;">
                <div style="font-size:18px; font-weight:700; margin-bottom:12px;">Комментарий</div>
                <div style="padding:16px; background:#fafafa; border:1px solid #e5e7eb; border-radius:12px;">
                    {{ $order->comment }}
                </div>
            </div>
        @endif

        <div style="margin-bottom:24px;">
            <div style="font-size:18px; font-weight:700; margin-bottom:12px;">Состав заказа</div>

            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse:collapse;">
                <thead>
                <tr>
                    <th align="left" style="padding:10px 12px; background:#f9fafb; border-bottom:1px solid #e5e7eb;">Позиция</th>
                    <th align="center" style="padding:10px 12px; background:#f9fafb; border-bottom:1px solid #e5e7eb;">Кол-во</th>
                    <th align="right" style="padding:10px 12px; background:#f9fafb; border-bottom:1px solid #e5e7eb;">Цена</th>
                    <th align="right" style="padding:10px 12px; background:#f9fafb; border-bottom:1px solid #e5e7eb;">Сумма</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td style="padding:10px 12px; border-bottom:1px solid #e5e7eb;">{{ $item->product_name }}</td>
                        <td align="center" style="padding:10px 12px; border-bottom:1px solid #e5e7eb;">{{ $item->qty }}</td>
                        <td align="right" style="padding:10px 12px; border-bottom:1px solid #e5e7eb;">{{ number_format($item->price, 0, ',', ' ') }} ₽</td>
                        <td align="right" style="padding:10px 12px; border-bottom:1px solid #e5e7eb;">{{ number_format($item->line_total, 0, ',', ' ') }} ₽</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div style="text-align:right; font-size:20px; font-weight:700; margin-bottom:8px;">
            Итого: {{ number_format($order->total_price, 0, ',', ' ') }} ₽
        </div>

        <div style="margin-top:24px; padding-top:16px; border-top:1px solid #e5e7eb; color:#6b7280; font-size:13px;">
            Уведомление с сайта «Пару палок»
        </div>
    </div>
</div>
</body>
</html>
