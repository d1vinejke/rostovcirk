<?php
    $images = \App\Models\Gallery::latest()->take(12)->get();
?>

<h3 class="gallery-h3">Галерея</h3>
<div class="gallery-container">
    @foreach($images as $image)
        <div class="gallery-item">
            <img src="{{ '/storage/' . $image->image_path }}" alt="{{ $image->title }}">
            <div class="item-overlay">{{ $image->title }}</div>
        </div>
    @endforeach
</div>

<div class="btn-more">
    <button class="more">Больше</button>
</div>

<!-- Лайтбокс -->
<div class="lightbox">
    <span class="close-btn">&times;</span>
    <div class="loader"></div>
    <img src="" alt="Увеличенное изображение" class="lightbox-img">
</div>

<script>
    const galleryItems = document.querySelectorAll('.gallery-item');
    const lightbox = document.querySelector('.lightbox');
    const lightboxImg = document.querySelector('.lightbox-img');
    const closeBtn = document.querySelector('.close-btn');
    const moveToGallery = document.querySelector('.more');

    galleryItems.forEach(item => {
        item.addEventListener('click', () => {
            const imgSrc = item.querySelector('img').src;
            lightbox.classList.add('active');
            lightboxImg.src = imgSrc.replace('/400/400', '/800/800');

            lightboxImg.onload = () => {
                lightboxImg.classList.add('loaded');
                lightbox.querySelector('.loader').style.display = 'none';
            }
        });
    });

    function closeLightbox() {
        lightbox.classList.remove('active');
        lightboxImg.classList.remove('loaded');
        lightbox.querySelector('.loader').style.display = 'block';
    }

    closeBtn.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) closeLightbox();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeLightbox();
    });

    moveToGallery.addEventListener('click', () => {
        window.location.href = '/gallery';
    })
</script>

