<?php
    $event = \App\Models\Event::GetById($event_id);
    $relatedEvents = \App\Models\Event::GetAllWithExcept($event_id);
?>

@include('layouts.head')
@include('layouts.menu')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8 text-center">
        <time class="text-gray-500 text-lg">{{ $event->event_date->translatedFormat('d F Y') }}</time>
        <h1 class="mt-2 text-4xl font-bold text-gray-900">{{ $event->title }}</h1>
        <div class="mt-4 flex items-center justify-center space-x-2">
            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span class="text-xl text-gray-700">{{ $event->location }}</span>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-12">
        <div class="lg:col-span-2">
            <div class="aspect-w-16 aspect-h-9 bg-gray-100 rounded-xl overflow-hidden shadow-lg">
                <img src="{{ asset('storage/'.$event->image_path) }}"
                     alt="{{ $event->title }}"
                     class="object-cover w-full h-full">
            </div>
        </div>

        <div class="space-y-8">
            <div class="prose max-w-none">
                <h3 class="text-2xl font-semibold text-gray-900 mb-4">Описание события</h3>
                <p class="text-gray-600 leading-relaxed">{{ $event->description }}</p>
            </div>

            <div class="bg-gray-50 rounded-xl p-6 space-y-6">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900">Время начала</h4>
                        <p class="text-gray-600 mt-1">{{ $event->event_date->format('H:i') }}</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900">Адрес</h4>
                        <address class="not-italic text-gray-600 mt-1">{{ $event->location }}</address>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900">Стоимость</h4>
                        <p class="text-gray-600 mt-1">От 1500 ₽</p>
                    </div>
                </div>

                <button class="w-full bg-purple-600 hover:bg-purple-700 text-white py-4 px-6 rounded-lg font-medium transition-colors">
                    <a href="https://rostovcircus.ticketscloud.org/">Купить билет</a>
                </button>
            </div>
        </div>
    </div>
    <!-- Похожие события -->
    <div class="mt-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Другие события</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($relatedEvents as $event)
                <article class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <img src="{{ asset('storage/'.$event->image_path) }}"
                         alt="{{ $event->title }}"
                         class="w-full h-48 object-cover rounded-t-xl">
                    <div class="p-6">
                        <time class="text-sm text-gray-500">{{ $event->event_date->translatedFormat('d M Y') }}</time>
                        <h3 class="text-xl font-semibold mt-2">{{ $event->title }}</h3>
                        <p class="text-gray-600 mt-2">{{ Str::limit($event->description, 100) }}</p>
                        <a href="{{ route('detailed-afisha', $event) }}"
                           class="inline-block mt-4 text-purple-600 font-medium hover:text-purple-700">
                            Подробнее →
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@include('layouts.footer')
