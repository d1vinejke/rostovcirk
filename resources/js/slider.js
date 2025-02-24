import Swiper from 'swiper/bundle';

import 'swiper/css/bundle';

const swiper = new Swiper('.swiper', {
    direction: 'horizontal',
    autoplay: true,
    loop: true,
    slidesPerView: 'auto'
});
