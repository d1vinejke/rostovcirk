<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Управление контентом
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 space-y-8">

                    @foreach($blocks as $group => $items)
                        <div class="border rounded-lg">
                            <div class="bg-gray-50 px-6 py-4 border-b">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $group }}</h3>
                            </div>
                            <div class="divide-y divide-gray-200">
                                @foreach($items as $block)
                                    <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50">
                                        <div class="space-y-1">
                                            <div class="flex items-center space-x-3">
                                                @switch($block->type)
                                                    @case('text')
                                                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                        </svg>
                                                        @break
                                                    @case('html')
                                                        <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                        @break
                                                    @case('image')
                                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                        @break
                                                @endswitch
                                                <span class="text-gray-900 font-medium">{{ $block->description }}</span>
                                            </div>
                                            <p class="text-sm text-gray-500">{{ $block->key }}</p>
                                        </div>
                                        @if($block->key == 'main_phone' || $block->key == 'main_email' || $block->key == 'main_logo')
                                            <a href="{{ route('admin.content.edit', $block) }}"
                                               class="inline-flex items-center px-4 py-2 bg-gray-400 border border-gray-300 rounded-md font-medium text-gray-100 hover:bg-gray-500" onclick="return false;">
                                                Не активно
                                            </a>
                                        @else
                                            <a href="{{ route('admin.content.edit', $block) }}"
                                               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-medium text-gray-700 hover:bg-gray-50">
                                                Редактировать
                                            </a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
