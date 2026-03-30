(function ($) {
    'use strict';

    var browserWindow = $(window);

 

    // :: 2.0 Nav Active Code
    if ($.fn.classyNav) {
        $('#creditNav').classyNav();
    } 






    // :: 10.0 Sticky Active Code
    if ($.fn.sticky) {
        $("#sticker").sticky({
            topSpacing: 0
        });
    } 

   



        // :: 3.0 Sliders Active Code
        if ($.fn.owlCarousel) {
            var welcomeSlide = $('.hero-slideshow');
    
            welcomeSlide.owlCarousel({
                items: 1,
                loop: true,
                nav: true,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                dots: true,
                autoplay: true,
                autoplayTimeout: 10000,
                smartSpeed: 500
            });
    
            welcomeSlide.on('translate.owl.carousel', function () {
                var slideLayer = $("[data-animation]");
                slideLayer.each(function () {
                    var anim_name = $(this).data('animation');
                    $(this).removeClass('animated ' + anim_name).css('opacity', '0');
                });
            });
    
            welcomeSlide.on('translated.owl.carousel', function () {
                var slideLayer = welcomeSlide.find('.owl-item.active').find("[data-animation]");
                slideLayer.each(function () {
                    var anim_name = $(this).data('animation');
                    $(this).addClass('animated ' + anim_name).css('opacity', '1');
                });
            });
    
            $("[data-delay]").each(function () {
                var anim_del = $(this).data('delay');
                $(this).css('animation-delay', anim_del);
            });
    
            $("[data-duration]").each(function () {
                var anim_dur = $(this).data('duration');
                $(this).css('animation-duration', anim_dur);
            });
        }
    

  

})(jQuery);