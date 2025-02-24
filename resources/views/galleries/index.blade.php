<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Управление галереей
            </h2>
            <a href="{{ route('galleries.create') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Добавить изображение
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($galleries as $gallery)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="{{ asset('storage/'.$gallery->image_path) }}"
                             alt="{{ $gallery->title }}"
                             class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-semibold mb-2">{{ $gallery->title }}</h3>
                            <p class="text-sm text-gray-600 mb-4">{{ $gallery->description }}</p>
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('galleries.edit', $gallery) }}"
                                   class="text-indigo-600 hover:text-indigo-900">Изменить</a>
                                <form action="{{ route('galleries.destroy', $gallery) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Удалить изображение?')">
                                        Удалить
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $galleries->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
