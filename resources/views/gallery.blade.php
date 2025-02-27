@php
    $images = \App\Models\Gallery::all(); // Используем пагинацию
@endphp

@include('layouts.head')
@include('layouts.menu')
<h3 class="gallery-h3">Галерея</h3>
<div class="gallery-container">
    @foreach($images as $image)
        @php
            $thumb_path = '/storage/gallery/thumbs/' . basename($image->image_path);
        @endphp
        <div class="gallery-item">
            <img
                src="<?= $thumb_path ?>"
                data-src="{{ '/storage/' . $image->image_path }}"
                alt="{{ basename($image->image_path) }}"
                loading="lazy"
                class="lazyload"
                width="400"
                height="400"
            >
            <div class="item-overlay">
                <span class="overlay-text">{{ $image->title }}</span>
            </div>
        </div>
    @endforeach
</div>

<!-- Лайтбокс -->
<div class="lightbox">
    <span class="close-btn">&times;</span>
    <div class="loader"></div>
    <img src="" alt="Увеличенное изображение" class="lightbox-img">
</div>

<script>
    // Ленивая загрузка изображений
    document.addEventListener("DOMContentLoaded", function() {
        const lazyImages = [].slice.call(document.querySelectorAll("img.lazyload"));

        if ("IntersectionObserver" in window) {
            const lazyImageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const lazyImage = entry.target;
                        lazyImage.src = lazyImage.dataset.src;

                        // Обработка успешной загрузки
                        lazyImage.onload = () => {
                            lazyImage.classList.remove("lazyload");
                        };

                        // Обработка ошибок
                        lazyImage.onerror = () => {
                            console.error('Error loading image:', lazyImage.dataset.src);
                            lazyImage.classList.add('image-error');
                        };

                        lazyImageObserver.unobserve(lazyImage);
                    }
                });
            });

            lazyImages.forEach(lazyImage => {
                lazyImageObserver.observe(lazyImage);
            });
        } else {
            // Fallback для старых браузеров
            lazyImages.forEach(img => {
                img.src = img.dataset.src;
            });
        }
    });

    // Оптимизированный лайтбокс
    const lightbox = {
        currentLightbox: null,

        init: function() {
            document.addEventListener('click', (e) => {
                const galleryItem = e.target.closest('.gallery-item');
                if (galleryItem) {
                    this.openLightbox(galleryItem);
                }
            });
        },

        openLightbox: function(element) {
            // Удаляем существующий лайтбокс
            if (this.currentLightbox) {
                this.removeLightbox();
            }

            const imgSrc = element.querySelector('img').dataset.src;

            // Создаем элементы лайтбокса
            const overlay = document.createElement('div');
            overlay.className = 'lightbox-overlay';

            const content = document.createElement('div');
            content.className = 'lightbox-content';

            const img = new Image();
            img.className = 'lightbox-img';
            img.alt = 'Увеличенное изображение';

            const closeBtn = document.createElement('span');
            closeBtn.className = 'close-btn';
            closeBtn.innerHTML = '&times;';

            // Добавляем прелоадер
            const loader = document.createElement('div');
            loader.className = 'loader';
            content.appendChild(loader);

            // Загрузка изображения
            img.src = imgSrc;
            img.onload = () => {
                content.removeChild(loader);
                content.appendChild(img);
            };
            img.onerror = () => {
                content.removeChild(loader);
                content.innerHTML = 'Ошибка загрузки изображения';
            };

            // Собираем структуру
            content.appendChild(closeBtn);
            overlay.appendChild(content);
            document.body.appendChild(overlay);
            this.currentLightbox = overlay;

            // Обработчики событий
            const handleClose = () => this.removeLightbox();
            closeBtn.addEventListener('click', handleClose);
            overlay.addEventListener('click', (e) => {
                if (e.target === overlay) handleClose();
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') handleClose();
            });
        },

        removeLightbox: function() {
            if (this.currentLightbox) {
                this.currentLightbox.remove();
                this.currentLightbox = null;
            }
        }
    };

    // Инициализация после загрузки контента
    if (document.readyState !== 'loading') {
        lightbox.init();
    } else {
        document.addEventListener('DOMContentLoaded', () => lightbox.init());
    }
</script>
@include('layouts.footer')
