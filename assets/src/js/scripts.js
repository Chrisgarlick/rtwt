// import $ from 'jquery';
// import 'slick-carousel';

// window.jQuery = window.$ = $; 

$(document).ready(function() {

    // Tabs Section
    $('.m__tabs__wrapper__content__js:first').addClass('active');
    $('.m__tabs__wrapper__headers--title h3:first').addClass('active');

    $('.m__tabs__wrapper__headers--title h3').on('click', function() {
        $('.m__tabs__wrapper__headers--title h3').removeClass('active'); // Remove "active" class from all titles
        $(this).addClass('active'); // Add "active" class to the clicked title
        
        let tabName = $(this).text();
        
        $('.m__tabs__wrapper__content__js').each(function() {

            let dataName = $(this).data('tabs');
            
            if (tabName === dataName) {
                $(this).addClass('active');
            } else {
                $(this).removeClass('active');
            }

        });
    });


    // Accordion 

    $('.m__accordion__wrap__individual').on('click', function() {
        $(this).siblings().children().removeClass('active');
        $(this).find('.m__accordion__wrap__individual--header').toggleClass('active');
        $(this).find('.m__accordion__wrap__individual--content').toggleClass('active');

    });

    // FAQs

    $('.m__accordion__faq--item').on('click', function() {
      $(this).siblings().children().removeClass('active');
      $(this).find('.m__accordion__faq--item__heading').toggleClass('active');
      $(this).find('.m__accordion__faq--item__body').toggleClass('active');
      $(this).find('.m__accordion__faq--item__cross').toggleClass('active');

  });

    // Newsletter ARIA Label

    let label = $('.m__newsletter form label').text();
    if (label !== '') {
        $('.m__newsletter form .wpcf7-email').attr('aria-label', label);
    }
    
    /* Full Width Image Carousel */

    $('#myCarousel .m__full_width_carousel__wrap__image').slick({
      // Slick Carousel options and settings
      arrows: true,
      dots: true,
      prevArrow: $('.m__full_width_carousel__buttons .prev-btn'),
      nextArrow: $('.m__full_width_carousel__buttons .next-btn')
      // Add other options as needed
    });

    $('#myCarousel .m__full_width_carousel__wrap__video').slick({
      // Slick Carousel options and settings
      arrows: true,
      dots: true,
      prevArrow: $('.m__full_width_carousel__buttons .prev-btn'),
      nextArrow: $('.m__full_width_carousel__buttons .next-btn')
      // Add other options as needed
    });
    $('.m__full_width_carousel__wrap .slick-dots li').text('');
    $('.m__full_width_carousel__wrap__video--holder').unwrap();
    $('.m__full_width_carousel__wrap__image--holder').unwrap();


    function mobileOnlySlider($slidername, $dots, $arrows, $breakpoint) {
        var slider = $($slidername);
        var settings = {
          mobileFirst: true,
          dots: $dots,
          arrows: $arrows,
          centerMode: true,
          infinite: false,
          responsive: [
            {
              breakpoint: $breakpoint,
              settings: "unslick"
            }
          ]
        };
      
        slider.slick(settings);
        
        $(`${$slidername} .slick-dots li button`).text('');

        $(window).on("resize", function () {
          if ($(window).width() > $breakpoint) {
            return;
          }
          if (!slider.hasClass("slick-initialized")) {
            return slider.slick(settings);
          }
        });
      } // Mobile Only Slider

      mobileOnlySlider(".selected__news", true, false, 767);

    // Navigation
    $(".hamburger").on('click', function() {
      $('.m__nav#nav-main').toggleClass('hidden');
      $('.g__header__nav .hamburger .line').toggleClass('active');
    });
    $(".m__nav__item-sub").on('click', function(event) {
      if ($(this).siblings().hasClass('subnav')) {
        console.log('parent nav wrap');
        event.preventDefault();
        let subnav = $(this).siblings()
        subnav = subnav.eq(1)
        subnav.toggleClass('hidden')
        $('#site-content').toggleClass('expanded-nav')
      } else {
        console.log('parent-no-nav-wrap')
        let subnav = $(this).find('.subnav')
        subnav.toggleClass('hidden')
        $('#site-content').toggleClass('expanded-nav')
      }
    });    
    $('.subnav .subnav__back').on('click', function() {
      $(this).parent().addClass('hidden');
    });
    // $(".m__nav__item").on('mouseout', function() {
    //   let subnav = $(this).find('.subnav')
    //   subnav.addClass('hidden')
    // });

    // Related Testimonials Slider 
    function manageSliders() {
      $('.m__related_testimonials').each(function() {
        var slider = $(this).find('.m__related_testimonials__wrapper.add_slider');
        var settings = {
          dots: true,
          arrows: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          prevArrow: $(this).find('.prev-btn'),
          nextArrow: $(this).find('.next-btn')
        };
        slider.slick(settings);
      }); 
     $('.m__related_testimonials__wrapper.add_slider .slick-dots li button').text('');
    }
    manageSliders();
});