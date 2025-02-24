<?php
$reviews = \App\Models\Review::unapproved()->latest()->get();
?>

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <div class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Отзывы') }}</div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="space-y-6">
                        @forelse($reviews as $review)
                            <div class="review-item bg-gray-50 p-4 rounded-lg" data-id="{{ $review->id }}">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h4 class="font-semibold">{{ $review->user_name }}</h4>
                                        <time class="text-sm text-gray-500">
                                            {{ $review->created_at->translatedFormat('d F Y H:i') }}
                                        </time>
                                    </div>
                                    <div class="flex gap-2">
                                        <button
                                            class="approve-btn px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition"
                                            data-id="{{ $review->id }}"
                                        >
                                            Одобрить
                                        </button>
                                        <button
                                            class="reject-btn px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition"
                                            data-id="{{ $review->id }}"
                                        >
                                            Отклонить
                                        </button>
                                    </div>
                                </div>
                                <p class="text-gray-700">{{ $review->content }}</p>
                            </div>
                        @empty
                            <p class="text-center text-gray-500">Нет отзывов для модерации</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.review-item').forEach(item => {
            const reviewId = item.dataset.id;
            console.log(reviewId);
            // Обработка одобрения
            item.querySelector('.approve-btn').addEventListener('click', async () => {
                try {
                    const response = await fetch(`/admin/reviews/${reviewId}/approve`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) throw new Error('Ошибка сервера');

                    item.remove();
                    showNotification('Отзыв успешно одобрен', 'success');

                } catch (error) {
                    showNotification(error.message, 'error');
                }
            });

            // Обработка отклонения
            item.querySelector('.reject-btn').addEventListener('click', async () => {
                if (!confirm('Вы уверены, что хотите удалить отзыв?')) return;

                try {
                    const response = await fetch(`/admin/reviews/${reviewId}/reject`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) throw new Error('Ошибка сервера');

                    item.remove();
                    showNotification('Отзыв отклонен', 'success');

                } catch (error) {
                    showNotification(error.message, 'error');
                }
            });
        });

        function showNotification(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg text-white ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            }`;
            toast.textContent = message;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
    </script>
</x-app-layout>
