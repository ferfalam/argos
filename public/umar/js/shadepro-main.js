(function ($) {
    "use strict";




    $(document).ready(function () {
        if ($.fn.niceSelect) {
            $('select').niceSelect();

            $('.product select, .woocommerce-account select').niceSelect('destroy')
        }
       
        if ($.fn.select2) {

            $('.product select').select2();
        }

        $(".menu-item-has-children > a").append('<span class="dropdownToggle"><i class="fas fa-angle-down"></i></span>');
        $('#wp-calendar td a').parent('td').addClass('has-calendar-link');

        $('.shadepro-header-area.sticky-header').wrap('<div class="sticky-wrapper"></div>');
        var headerHeight = $('.sticky-wrapper').height(),
            stickyWrapper = $('.sticky-wrapper');
        stickyWrapper.css('height', headerHeight + "px")
        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {

            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                stickyWrapper.addClass("is-sticky");
            } else {
                stickyWrapper.removeClass("is-sticky");
            }
            if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                $(".is-sticky .sticky-header").addClass("reveal-header");
            } else {
                $(".is-sticky .sticky-header").removeClass("reveal-header");
            }
        }

        // comment load more button click event
        $('.shadepro-comment-loadmore-btn').on('click', function () {
            var button = $(this);

            // decrease the current comment page value
            shadepro_comment_loadmore.cpage--;
            $.ajax({
                url: shadepro_comment_loadmore.ajaxurl, // AJAX handler, declared before
                data: {
                    'action': 'cloadmore', // wp_ajax_cloadmore
                    'post_id': shadepro_comment_loadmore.parent_post_id, // the current post
                    'cpage': shadepro_comment_loadmore.cpage, // current comment page
                },
                type: 'POST',
                beforeSend: function (xhr) {
                    button.text('Loading...'); // preloader here
                },
                success: function (data) {
                    if (data) {
                        $('ol.comment-list').append(data);
                        button.text('More comments');
                        // if the last page, remove the button
                        if (shadepro_comment_loadmore.cpage == 1)
                            button.remove();
                    } else {
                        button.remove();
                    }
                }
            });
            return false;
        });

    })
    
    $(window).load(function () {
        if ($.fn.masonry) {
            $('.blog-content-row .posts-row').masonry({
                // options
                itemSelector: '.posts-row>div',

            });
        }

        setTimeout(function () {
            jQuery(".shadepro-preloader-wrap").fadeOut(500);
          }, 500);
          setTimeout(function () {
            jQuery(".shadepro-preloader-wrap").remove();
          }, 2000);

             navMenu();

            $(window).on('resize', function(){
                if ($(window).width() > 960) {
                    $(".main-navigation ul.navbar-nav li.menu-item-has-children>a").unbind('click');
                }
            })
            
   
                if ($(window).width() > 960) {
                    $(".main-navigation ul.navbar-nav li.menu-item-has-children>a").unbind('click');
                }
            
 
    })

    function shadeCartQtyBtn() {
        $(".woocommerce .quantity").append('<span class="shade-qty-dec-btn shade-qty-counter">-</span><span class="shade-qty-inc-btn shade-qty-counter">+</span>');
        $(".woocommerce .quantity .shade-qty-counter").on("click", function () {
            var $button = $(this);
            var oldValue = $button.parent('.quantity').find("input").val();
            oldValue = oldValue ? oldValue : 0;
            if ($button.hasClass("shade-qty-inc-btn")) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }
            $button.parent('.quantity').find("input").val(newVal);
            $('.woocommerce div.quantity input.qty').change();
        });
    }
    shadeCartQtyBtn();

    $(document).ajaxComplete(function (event, request, settings) {
        if ($('.woocomerce-cart-form .quantity .shade-qty-counter')) {
            $(".woocommerce .quantity .shade-qty-counter").remove();
            shadeCartQtyBtn();
        }

    });

    function navMenu() {
        
            // main menu toggleer icon (Mobile site only)
            $('[data-toggle="navbarToggler"]').on("click", function (e) {
                $('.navbar').toggleClass('active');
                $('.navbar-toggler-icon').toggleClass('active');
                $('body').toggleClass('offcanvas--open');
                e.stopPropagation();
                e.preventDefault();

            });
            $('.navbar-inner').on("click", function (e) {
                e.stopPropagation();
            });
    
            // Remove class when click on body
            $('body').on("click", function () {
                $('.navbar').removeClass('active');
                $('.navbar-toggler-icon').removeClass('active');
                $('body').removeClass('offcanvas--open');
            });
            
            $('.main-navigation ul.navbar-nav li.menu-item-has-children>a').on("click", function (e) {
                e.preventDefault();
                $(this).siblings('.sub-menu').toggle();
                $(this).parent('li').toggleClass('dropdown-active');
            })
    

            $(".shadepro-mega-menu> ul.sub-menu > li > a").unbind('click');

        
    }

    
})(jQuery);
/*This file was exported by "Export WP Page to Static HTML" plugin which created by ReCorp (https://myrecorp.com) */