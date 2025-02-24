@props(['event' => null])
<div class="space-y-6">
    <div>
        <x-input-label for="title" value="Название события"/>
        <input id="title" name="title" type="text" class="mt-1 block w-full"
               value="{{ old('title', $event->title ?? '') }}" required autofocus/>
        <x-input-error for="title" class="mt-2" messages=""/>
    </div>

    <div>
        <x-input-label for="description" value="Описание"/>
        <textarea id="description" name="description"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                  rows="4" required>{{ old('description', $event->description ?? '') }}</textarea>
        <x-input-error for="description" class="mt-2" messages=""/>
    </div>

    <div>
        <x-input-label for="event_date" value="Дата и время"/>
        <input id="event_date" name="event_date" type="datetime-local"
               value="{{ old('event_date', optional($event->event_date ?? '')->format('Y-m-d\TH:i')) }}"
               class="mt-1 block w-full" required/>
        <x-input-error for="event_date" class="mt-2" messages=""/>
    </div>

    <div>
        <x-input-label for="location" value="Место проведения"/>
        <input id="location" name="location" type="text" class="mt-1 block w-full"
               value="{{ old('location', $event->location ?? '') }}" required/>
        <x-input-error for="location" class="mt-2" messages=""/>
    </div>

    <div>
        <x-input-label for="image" value="Изображение"/>
        <input id="image" name="image" type="file" class="mt-1 block w-full"
               accept="image/*" {{ !isset($event) ? 'required' : '' }} />
        <x-input-error for="image" class="mt-2" messages=""/>
        @if(isset($event) && $event->image_path)
            <div class="mt-2">
                <img src="{{ asset('storage/'.$event->image_path) }}"
                     alt="Current image"
                     class="h-32 object-cover rounded">
            </div>
        @endif
    </div>

    <div class="flex items-center">
        <input type="checkbox" id="is_published" name="is_published"
               checked="{{ old('is_published', $event->is_published ?? false) }}"/>
        <x-input-label for="is_published" value="Опубликовать сразу" class="ml-2"/>
    </div>
</div>
