<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Редактирование: {{ $gallery->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Название</label>
                                <input type="text" name="title" value="{{ $gallery->title }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Описание</label>
                                <textarea name="description" rows="3"
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ $gallery->description }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Текущее изображение</label>
                                <img src="{{ asset('storage/'.$gallery->image_path) }}"
                                     alt="{{ $gallery->title }}"
                                     class="mt-2 h-32 object-cover rounded-lg">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Новое изображение (оставьте пустым, чтобы не менять)</label>
                                <input type="file" name="image" accept="image/*"
                                       class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                            </div>

                            <div class="flex justify-end space-x-4">
                                <a href="{{ route('galleries.index') }}"
                                   class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">
                                    Отмена
                                </a>
                                <button type="submit"
                                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                    Обновить
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
