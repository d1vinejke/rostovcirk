@props(['event' => null])

<div class="space-y-6">
    <!-- Название события -->
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Название события</label>
        <input type="text" name="title" id="title"
               value="{{ old('title', $event->title ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
               required>
        @error('title')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Описание -->
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Описание</label>
        <textarea name="description" id="description" rows="4"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                  required>{{ old('description', $event->description ?? '') }}</textarea>
        @error('description')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Дата и время -->
    <div>
        <label for="event_date" class="block text-sm font-medium text-gray-700">Дата и время</label>
        <input type="datetime-local" name="event_date" id="event_date"
               value="{{ old('event_date', isset($event) ? $event->event_date->format('Y-m-d\TH:i') : '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
               required>
        @error('event_date')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Место проведения -->
    <div>
        <label for="location" class="block text-sm font-medium text-gray-700">Место проведения</label>
        <input type="text" name="location" id="location"
               value="{{ old('location', $event->location ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
               required>
        @error('location')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Изображение -->
    <div>
        <label for="image" class="block text-sm font-medium text-gray-700">
            Изображение {{ $event ? '(оставьте пустым, чтобы не изменять)' : '' }}
        </label>
        <input type="file" name="image" id="image"
               class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none"
               accept="image/*" {{ !$event ? 'required' : '' }}>
        @error('image')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
        @if($event?->image_path)
            <div class="mt-4">
                <img src="{{ asset('storage/'.$event->image_path) }}"
                     alt="Current image"
                     class="h-32 object-cover rounded-lg">
            </div>
        @endif
    </div>

    <!-- Статус публикации -->
    <div class="flex items-center">
        <input type="checkbox" name="is_published" id="is_published"
               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            {{ old('is_published', $event->is_published ?? false) ? 'checked' : '' }}>
        <label for="is_published" class="ml-2 block text-sm text-gray-900">Опубликовать сразу</label>
    </div>
</div>
