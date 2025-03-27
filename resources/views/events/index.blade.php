<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Управление афишей
            </h2>
            <a href="{{ route('events.create') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Добавить событие
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 font-medium">Название</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 font-medium">Дата</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 font-medium">Статус</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                                        {{ $event->title }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                                        {{ $event->event_date->translatedFormat('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $event->is_published ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $event->is_published ? 'Опубликовано' : 'Черновик' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 text-right text-sm font-medium">
                                        <a href="{{ route('events.edit', $event) }}" class="text-indigo-600 hover:text-indigo-900">Редактировать</a>
                                        <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-900 ml-2"
                                                    onclick="return confirm('Удалить событие?')">
                                                Удалить
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="links" style="margin-top: 15px;">{{ $events->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
