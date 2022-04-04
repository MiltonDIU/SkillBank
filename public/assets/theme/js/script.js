$(document).ready(function(){
    var swiper2 = new Swiper(".banner_swiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        autoplay: {
            delay: 5000,
        },
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            renderBullet: function (index, className) {
              return '<span class="' + className + '">' + "0" + (index + 1) + "</span>";
            },
        },
    });
});


$(document).ready(function(){
    var swiper = new Swiper(".service_swiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        breakpoints: {
            
            320: {
              slidesPerView: 1,
              spaceBetween: 30
            },

            576: {
                slidesPerView: 1,
                spaceBetween: 30
            },

            768: {
                slidesPerView: 1,
                spaceBetween: 30
            },

            992: {
                slidesPerView: 3,
                spaceBetween: 30
            }
        }
    });
});


$(document).ready(function(){
    var swiper = new Swiper(".partner_swiper", {
        slidesPerView: 6,
        spaceBetween: 30,
        autoplay: {
            delay: 3000,
        },
        loop: true,

        breakpoints: {
            
            320: {
              slidesPerView: 3,
              spaceBetween: 30
            },

            576: {
                slidesPerView: 3,
                spaceBetween: 30
            },

            768: {
                slidesPerView: 4,
                spaceBetween: 30
            },

            992: {
                slidesPerView: 5,
                spaceBetween: 30
            },

            1200: {
                slidesPerView: 6,
                spaceBetween: 30
            }
        }
    });
});


AOS.init({
    offset: 30,
    once: true,
    duration: 1000,
});


