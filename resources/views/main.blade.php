@include('layouts.head')
@include('layouts.menu')
<div class="main-logo-container relative">
    <img src="/images/main-logo.jpg" alt="" class="main-logo absolute z-0">
    <div class="flex flex-col flex-nowrap content-start text-logo-block">
        <span class="logo-text-1 z-10 relative">Ростовский цирк</span>
        <span class="logo-text-2 z-10 relative">Путешествие в мир фантазий</span>
    </div>
</div>
<div class="flex flex-row flex-nowrap relative middle-block justify-between">
    <div class="swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="/images/slider/Img-15596.jpg" loading="lazy" alt="">
                <div class="swiper-lazy-preloader"></div>
            </div>
            <div class="swiper-slide">
                <img src="/images/slider/Img-15642.jpg" loading="lazy" alt="">
                <div class="swiper-lazy-preloader"></div>
            </div>
            <div class="swiper-slide">
                <img src="/images/slider/Img-15761.jpg" loading="lazy" alt="">
                <div class="swiper-lazy-preloader"></div>
            </div>
            <div class="swiper-slide">
                <img src="/images/slider/Img-15985.jpg" loading="lazy" alt="">
                <div class="swiper-lazy-preloader"></div>
            </div>
            <div class="swiper-slide">
                <img src="/images/slider/Img-16026.jpg" loading="lazy" alt="">
                <div class="swiper-lazy-preloader"></div>
            </div>
            <div class="swiper-slide">
                <img src="/images/slider/Img-16117.jpg" loading="lazy" alt="">
                <div class="swiper-lazy-preloader"></div>
            </div>
            <div class="swiper-slide">
                <img src="/images/slider/Img-16199.jpg" loading="lazy" alt="">
                <div class="swiper-lazy-preloader"></div>
            </div>
            <div class="swiper-slide">
                <img src="/images/slider/Img-16293.jpg" loading="lazy" alt="">
                <div class="swiper-lazy-preloader"></div>
            </div>
            <div class="swiper-slide">
                <img src="/images/slider/Img-16317.jpg" loading="lazy" alt="">
                <div class="swiper-lazy-preloader"></div>
            </div>
            <div class="swiper-slide">
                <img src="/images/slider/Img-16419.jpg" loading="lazy" alt="">
                <div class="swiper-lazy-preloader"></div>
            </div>
        </div>
    </div>
    <div class="text-slider">
        Это не просто ЦИРК, это удивительное путешествие по самым разным фантастическим мирам, в которое вы отправитесь
        вместе с нашими героями. Там вас ждут просто невероятные приключения Гринча и Марио, встречи с самыми необычными
        персонажами из “Алисы в стране чудес” и “Холодного сердца”, компьютерных игр и пришельцами из космоса! И
        весёлыми клоунами Зизи и Бимбо. Море впечатлений гарантировано!!!!
    </div>
</div>

<h1 class="anchor">Какие впечатления о цирке?</h1>
@include('layouts.reviews')
@include('layouts.footer')
