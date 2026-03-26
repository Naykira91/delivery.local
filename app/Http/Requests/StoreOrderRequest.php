<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('website')) {
            abort(422);
        }

        $phone = $this->normalizeRussianPhone((string) $this->input('customer_phone', ''));

        $this->merge([
            'customer_phone'   => $phone,
            'customer_name'    => $this->cleanText($this->input('customer_name')),
            'address'          => $this->cleanText($this->input('address')),
            'apartment'        => $this->cleanText($this->input('apartment')),
            'entrance'         => $this->cleanText($this->input('entrance')),
            'floor'            => $this->cleanText($this->input('floor')),
            'intercom'         => $this->cleanText($this->input('intercom')),
            'comment'          => $this->cleanText($this->input('comment')),
            'is_private_house' => $this->boolean('is_private_house'),
        ]);
    }

    public function rules(): array
    {
        return [
            'customer_name'    => [
                'required',
                'string',
                'min:2',
                'max:100',
                'regex:/^[А-Яа-яЁёA-Za-z\s\-]+$/u',
            ],
            'customer_phone'   => [
                'required',
                'string',
                'regex:/^\+7\d{10}$/',
            ],
            'delivery_type'    => ['required', 'in:delivery,pickup'],
            'payment_method'   => ['required', 'in:cash,transfer'],

            'address'          => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[0-9А-Яа-яЁёA-Za-z\s\.,\-\/]+$/u',
                'required_if:delivery_type,delivery',
            ],
            'apartment'        => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[0-9А-Яа-яЁёA-Za-z\-\/]+$/u',
            ],
            'entrance'         => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[0-9А-Яа-яЁёA-Za-z\-\/]+$/u',
            ],
            'floor'            => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[0-9\-]+$/',
            ],
            'intercom'         => [
                'nullable',
                'string',
                'max:50',
                'regex:/^[0-9А-Яа-яЁёA-Za-z\s\-#*]+$/u',
            ],
            'is_private_house' => ['nullable', 'boolean'],
            'comment'          => ['nullable', 'string', 'max:500'],
            'website'          => ['nullable', 'max:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_name.required'    => 'Укажите имя.',
            'customer_name.min'         => 'Имя слишком короткое.',
            'customer_name.regex'       => 'Имя может содержать только буквы, пробел и дефис.',

            'customer_phone.required'   => 'Укажите телефон.',
            'customer_phone.regex'      => 'Введите корректный российский мобильный телефон.',

            'delivery_type.required'    => 'Выберите способ получения.',
            'delivery_type.in'          => 'Некорректный способ получения.',

            'payment_method.required'   => 'Выберите способ оплаты.',
            'payment_method.in'         => 'Некорректный способ оплаты.',

            'address.required_if'       => 'Укажите улицу и дом.',
            'address.regex'             => 'Адрес содержит недопустимые символы.',

            'apartment.regex'           => 'Поле "Квартира" содержит недопустимые символы.',
            'entrance.regex'            => 'Поле "Подъезд" содержит недопустимые символы.',
            'floor.regex'               => 'Поле "Этаж" может содержать только цифры и дефис.',
            'intercom.regex'            => 'Поле "Домофон" содержит недопустимые символы.',
        ];
    }

    public function validatedForOrder(): array
    {
        $validated = $this->validated();

        $isPrivateHouse = (bool) ($validated['is_private_house'] ?? false);
        $deliveryType = $validated['delivery_type'];

        return [
            'customer_name'    => $validated['customer_name'],
            'customer_phone'   => $validated['customer_phone'],
            'delivery_type'    => $deliveryType,
            'payment_method'   => $validated['payment_method'],
            'address'          => $deliveryType === 'delivery'
                ? ($validated['address'] ?? null)
                : null,
            'apartment'        => $deliveryType === 'delivery' && !$isPrivateHouse
                ? ($validated['apartment'] ?? null)
                : null,
            'entrance'         => $deliveryType === 'delivery' && !$isPrivateHouse
                ? ($validated['entrance'] ?? null)
                : null,
            'floor'            => $deliveryType === 'delivery' && !$isPrivateHouse
                ? ($validated['floor'] ?? null)
                : null,
            'intercom'         => $deliveryType === 'delivery' && !$isPrivateHouse
                ? ($validated['intercom'] ?? null)
                : null,
            'is_private_house' => $deliveryType === 'delivery'
                ? $isPrivateHouse
                : false,
            'comment'          => $validated['comment'] ?? null,
        ];
    }

    private function normalizeRussianPhone(string $phone): string
    {
        $digits = preg_replace('/\D+/', '', $phone);

        if (!$digits) {
            return '';
        }

        if (strlen($digits) === 11 && str_starts_with($digits, '8')) {
            $digits = '7' . substr($digits, 1);
        }

        if (strlen($digits) === 11 && str_starts_with($digits, '7')) {
            return '+' . $digits;
        }

        return $phone;
    }

    private function cleanText(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = strip_tags($value);
        $value = preg_replace('/[\x00-\x1F\x7F]/u', '', $value);
        $value = trim($value);

        return $value === '' ? null : $value;
    }
}
