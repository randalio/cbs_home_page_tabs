jQuery(document).ready(function($) {
    const initTabbedSlider = function() {
        $('.elementor-tabbed-slider-wrapper').each(function() {
            const $container = $(this);
            const $tabs = $container.find('.tabbed-slider-tab');
            const $slides = $container.find('.tabbed-slider-slide');
            const $sliderContainer = $container.find('.tabbed-slider-container');
            
            let currentSlide = 0;
            let isTransitioning = false;
            let autoRotateTimer = null;
            let $overlay;

            // Initialize transition overlay
            function initOverlay() {
                $overlay = $container.find('.wipe-transition-overlay');
                if (!$overlay.length) {
                    $overlay = $('<div class="wipe-transition-overlay"><div class="wipe-bar-group"></div></div>');
                    $sliderContainer.append($overlay);
                }
                
                // Create wipe bars
                const $barGroup = $overlay.find('.wipe-bar-group').empty();
                [0.33, 0.66, 1, 0.66, 0.33].forEach(opacity => {
                    $barGroup.append($('<div class="wipe-bar">').css('opacity', opacity));
                });
            }

            // Show specific slide
            function showSlide(index, callback) {
                if (index === currentSlide || isTransitioning || index < 0 || index >= $slides.length) {
                    return callback?.(index);
                }

                isTransitioning = true;

                // Update active states
                $tabs.removeClass('active').eq(index).addClass('active');
                
                // Trigger transition
                const $barGroup = $overlay.find('.wipe-bar-group');
                $barGroup.removeClass('animate')[0].offsetWidth; // Force reflow
                $barGroup.addClass('animate');
                $overlay.addClass('active');

                // Switch slides mid-transition
                setTimeout(() => {
                    $slides.removeClass('active')
                        .eq(currentSlide).css({ opacity: 0, visibility: 'hidden' });
                    $slides.eq(index).addClass('active')
                        .css({ opacity: 1, visibility: 'visible' });
                    currentSlide = index;
                }, 750);

                // Complete transition
                setTimeout(() => {
                    $overlay.removeClass('active');
                    isTransitioning = false;
                    callback?.(index);
                }, 1500);
            }

            // Auto-rotation management
            function scheduleNext(fromIndex = currentSlide) {
                clearTimeout(autoRotateTimer);
                autoRotateTimer = setTimeout(() => {
                    const nextIndex = (fromIndex + 1) % $slides.length;
                    showSlide(nextIndex, scheduleNext);
                }, 7000);
            }

            function stopRotation() {
                clearTimeout(autoRotateTimer);
            }

            // Initialize slider
            function init() {
                initOverlay();
                
                // Set initial state
                $slides.removeClass('active').css({ opacity: 0, visibility: 'hidden' });
                $slides.eq(0).addClass('active').css({ opacity: 1, visibility: 'visible' });
                $tabs.removeClass('active').eq(0).addClass('active');
                
                scheduleNext();
            }

            // Event handlers
            $tabs.off('click.tabbedSlider').on('click.tabbedSlider', function(e) {
                e.preventDefault();
                const slideIndex = parseInt($(this).data('slide'));
                if (!isNaN(slideIndex)) {
                    stopRotation();
                    showSlide(slideIndex, scheduleNext);
                }
            });

            // Cleanup
            $container.on('destroy', function() {
                stopRotation();
                $tabs.off('click.tabbedSlider');
            });

            init();
        });
    };

    // Initialize on ready and Elementor frontend init
    initTabbedSlider();
    $(window).on('elementor/frontend/init', function() {
        window.elementorFrontend?.hooks?.addAction('frontend/element_ready/tabbed_slider.default', initTabbedSlider);
    });
});