<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Редактирование: {{ $contentBlock->description }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.content.update', $contentBlock) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ $contentBlock->description }}
                                </label>

                                @if($contentBlock->type === 'text')
                                    <input type="text" name="value" value="{{ old('value', $contentBlock->value) }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                                @elseif($contentBlock->type === 'html')
                                    <textarea name="value" rows="8"
                                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('value', $contentBlock->value) }}</textarea>

                                @elseif($contentBlock->type === 'image')
                                    <div class="flex items-center space-x-6">
                                        @if($contentBlock->value)
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('storage/'.$contentBlock->value) }}"
                                                     class="h-32 w-32 rounded-lg object-cover border">
                                            </div>
                                        @endif
                                        <div class="flex-1">
                                            <input type="file" name="value"
                                                   class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                                            <p class="mt-1 text-sm text-gray-500">Загрузите новое изображение</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="flex justify-end space-x-4">
                                <a href="{{ route('admin.content.index') }}"
                                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-medium text-gray-700 hover:bg-gray-50">
                                    Назад
                                </a>
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-medium text-white hover:bg-indigo-700">
                                    Сохранить изменения
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
