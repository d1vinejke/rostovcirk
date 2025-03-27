@include('layouts.head')
@include('layouts.menu')

<div class="about-us__container">
    <h3>О цирковом шоу</h3>
    <div class="about-us__content">
        <div class="about-us__content-text">
            {{ content('about_text') }}
        </div>
        <div class="about-us__content-video">
            <iframe src="https://vk.com/video_ext.php?oid=-111636339&id=456239118" class="vk-video" height="240"
                    allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" frameborder="0"
                    allowfullscreen></iframe>
        </div>
    </div>
</div>
@include('layouts.gallery-short')
@include('layouts.footer')
