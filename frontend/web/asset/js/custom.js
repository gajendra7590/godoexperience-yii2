jQuery(document).ready(function() {
    /* home Client Slider*/
    jQuery('.hm__Client--crusel').owlCarousel({
        loop: true,
        nav: false,
        margin: 10,
        autoHeight : true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
                margin: 20
            }
        }
    });
    /* Single Page Slider*/
    jQuery('.sp__Slide--ele').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                margin: 0
            },
            600: {
                items: 2,
                margin: 2,
                dots: true,
            },
            1000: {
                items: 3,
                margin: 2,
                dots: false,
                nav: true
            }
        }
    });
    /*Single Page book now select*/
    jQuery(".booking__Filp").click(function() {
        var id = $(this).data('id');
        jQuery(".booking__Pannel").not('#' + id).hide();
        jQuery("#" + id).slideToggle();
    });
    /*header dropdown menu profile*/
    $('.deshktop_dropdown-user').on('show.bs.dropdown', function(e) {
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown(300);
    });

    $('.deshktop_dropdown-user').on('hide.bs.dropdown', function(e) {
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp(200);
    });

    /* Show Date popup Toggle*/
    jQuery(".guests-shw-toggle").click(function(e){
        jQuery(".guests-shw-menu").slideToggle();
    });
    /*Preloader page */
    jQuery(window).on('load', function() {
        jQuery('.preloader').addClass('preloader-deactivate');
    });

});
