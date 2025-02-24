<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Добавить новое изображение
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Название</label>
                                <input type="text" name="title" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Описание</label>
                                <textarea name="description" rows="3"
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Изображение</label>
                                <input type="file" name="image" required accept="image/*"
                                       class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                    Сохранить
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
