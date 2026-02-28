@extends('layouts.app')

@section('title', 'Меню')

@section('content')
    <div class="flex flex-col gap-6">

        {{-- Категории (якоря) --}}
        <div class="sticky top-[88px] z-40 bg-gray-50/95 backdrop-blur border-b border-gray-100 -mx-4 px-4 py-3">
            <div class="flex gap-2 overflow-auto">
                @foreach($categories as $cat)
                    <a href="#cat-{{ $cat->id }}"
                       class="whitespace-nowrap bg-white border border-gray-100 shadow-sm rounded-full px-4 py-2 text-sm hover:bg-rose-50">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Секции меню --}}
        @foreach($categories as $cat)
            @if($cat->products->count())
                <section id="cat-{{ $cat->id }}" class="scroll-mt-40">
                    <h2 class="text-xl font-semibold mb-4">{{ $cat->name }}</h2>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($cat->products as $product)
                            @include('partials.product-card', ['product' => $product])
                        @endforeach
                    </div>
                </section>
            @endif
        @endforeach

        @if($q && $categories->sum(fn($c) => $c->products->count()) === 0)
            <div class="text-gray-600">Ничего не найдено по запросу “{{ $q }}”.</div>
        @endif
    </div>
@endsection
