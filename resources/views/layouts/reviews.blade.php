<?php

use App\Models\Review;

$reviews = Review::approved()->latest()->take(9)->get();
?>
<div class="reviews-container">
    @foreach($reviews as $review)
        <article class="review-card">
            <div class="review-header">
                <h3 class="user-name">{{ $review->user_name }}</h3>
                <time class="review-date">{{ $review->created_at->translatedFormat('j F Y') }}</time>
            </div>
            <p class="review-content">
                {{ $review->content }}
            </p>
        </article>
    @endforeach
</div>

<div class="reviews-container__form">
    <div class="reviews-decider">
        <div class="review-text">
            Оставьте свой отзыв!
        </div>
        <form class="review-form">
            <h3 class="form-title">Оставить отзыв</h3>

            <div class="form-group">
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-input"
                    placeholder="Ваше имя"
                    required
                >
            </div>

            <div class="form-group">
            <textarea
                id="comment"
                name="content"
                class="form-input"
                rows="4"
                placeholder="Ваш отзыв..."
                minlength="10"
                maxlength="255"
                required
            ></textarea>
            </div>

            <button type="submit" class="submit-btn">
                Отправить отзыв
            </button>
        </form>
    </div>
</div>

<script>
    document.querySelector('.review-form').addEventListener('submit', async function (e) {
        e.preventDefault();

        const form = e.target;

        const formData = {
            name: this.querySelector('#name').value,
            content: this.querySelector('#comment').value,
            date: new Date().toLocaleDateString('ru-RU', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            }),
            _token: '{{ csrf_token() }}'
        };

        const response = await fetch('{{ route("reviews.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(formData)
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || 'Ошибка сервера');
        }

        form.reset();
        alert('Отзыв успешно отправлен!');
    });
</script>
