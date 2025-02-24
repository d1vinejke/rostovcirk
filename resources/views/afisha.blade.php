<?php
    $events = \App\Models\Event::published()->latest()->get();
?>

@include('layouts.head')
@include('layouts.menu')
<h3 class="h3">Афиша</h3>

<div class="afisha-container">
    @foreach($events as $event)
        <article class="event-card">
            <div class="event-title">{{ $event->title  }}</div>
            <div class="event-date">{{ $event->event_date->translatedFormat('j F Y H:i') }}</div>
            <img src="{{ '/storage/' . $event->image_path }}" alt="Концерт" class="event-image">
            <div class="event-info">
                <p class="event-location">
                    {{ $event->location }}
                </p>
                <a href="{{ route('detailed-afisha', $event->id) }}" class="details-btn">Подробнее</a>
            </div>
        </article>
    @endforeach
</div>

@include('layouts.footer')
