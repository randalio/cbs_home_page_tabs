class CBS_TabbedSlider {

    constructor() {
        this.init();
    }

    init() {
        // Wait until DOM is ready
        document.addEventListener("DOMContentLoaded", () => {
            console.log("DOM loaded");

            var swiper = new Swiper(".tabbedSwiperTabs", {
              loop: true,
              spaceBetween: 0,
              slidesPerView: 4,
              freeMode: true,
              watchSlidesProgress: true,
              breakpoints: {
                768: {
                  direction: 'horizontal',
                }
              },
              // Default settings (mobile-first)
              direction: 'vertical',
            });

            var swiper2 = new Swiper(".tabbedSwiper", {
              loop: true,
              spaceBetween: 0,
              navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
              },
              thumbs: {
                swiper: swiper,
              },
            });

            // Initialize the Swiper with proper configuration to avoid scroll conflicts
            // var tabbedSwiper = new Swiper(".tabbedSwiper", {
            //     slidesPerView: 1,
            //     pagination: {
            //       el: ".swiper-pagination",
            //       clickable: true,

            //       renderBullet: function (index, className) {
            //         return '<span class="' + className + '">' + (index + 1) + "</span>";
            //       },

            //     },
            //   });

        });
    }
}

new CBS_TabbedSlider();