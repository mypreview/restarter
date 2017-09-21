/**
 * Restarter Theme
 *
 * @author      Mahdi Yazdani
 * @package     Restarter
 * @since       1.0.0
 */
(function(window, $, undefined) {
	'use strict';

	// Disable default link behavior for dummy links that have href='#'
	var $emptyLink = $('a[href=#]');
	$emptyLink.on('click', function(e) {
	    e.preventDefault();
	});

	// Animated Scroll to Top Button
	var $scrollTop = $('.scroll-to-top-btn');
	if ($scrollTop.length > 0) {
	    $(window).on('scroll', function() {
	        if ($(window).scrollTop() > 600) {
	            $scrollTop.addClass('visible');
	        } else {
	            $scrollTop.removeClass('visible');
	        }
	    });
	    $scrollTop.on('click', function(e) {
	        e.preventDefault();
	        $('html').velocity("scroll", {
	            offset: 0,
	            duration: 1000,
	            easing: 'easeOutExpo',
	            mobileHA: false
	        });
	    });
	};

	// Smooth scroll to element
	var $scrollTo = $('.scroll-to');
	$scrollTo.on('click', function(event) {
	    var $elemOffsetTop = $(this).data('offset-top');
	    $('html').velocity("scroll", {
	        offset: $(this.hash).offset().top - $elemOffsetTop,
	        duration: 1000,
	        easing: 'easeOutExpo',
	        mobileHA: false
	    });
	    event.preventDefault();
	});

	// Setting background of sections
	$('.data-background').each(function() {
        if ($(this).attr('data-background')) {
            $(this).css('background-image', 'url(' + $(this).attr('data-background') + ')');
        }
    });

	// On window load functions
	$( window ).on( 'load', function () {

		/** Background Parallax **/
		// For all IE versions
		var ua = window.navigator.userAgent,
		    msie = ua.indexOf('MSIE '),
		    trident = ua.indexOf('Trident/'),
		    edge = ua.indexOf('Edge/');
		if (msie > 0 || trident > 0 || edge > 0) {
		    if ($("body.parallax").length > 0) {
		        $("body.parallax").stellar({
		            scrollProperty: 'scroll',
		            verticalOffset: 0,
		            horizontalOffset: 0,
		            horizontalScrolling: false,
		            responsive: true
		        });
		    }
		}

		// For other browsers
		else {
		    if (!Modernizr.touch) {
		        if ($("body.parallax").length > 0) {
		            $("body.parallax").stellar({
		                scrollProperty: 'scroll',
		                verticalOffset: 50,
		                horizontalOffset: 0,
		                horizontalScrolling: false,
		                responsive: true
		            });
		        }
		    }
		}
	});

	// Submenu Dropdown
	var $dropdown = $('.menu-item-has-children');
	$dropdown.on('mouseover', function() {
	    $(this).addClass('active');
	});
	$dropdown.on('mouseout', function() {
	    $(this).removeClass('active');
	});

	// Mobile Submenu
	var $hasSubmenu = $('.menu-item-has-children > a', '.main-navigation');
	$hasSubmenu.on('click', function() {
	    $(this).parent().toggleClass('open').find('.sub-menu').toggleClass('expanded');
	});

	// Toggle Mobile Navigation
	var $navToggle = $('.nav-toggle', '.navbar');
	$navToggle.on('click', function() {
	    $(this).toggleClass('active').parents('.navbar').find('.mobile-dropdown').toggleClass('expanded');
	});

	// Search form expand (Navbar)
	var $searchToggle = $('.search-btn > i');
	$searchToggle.on('click', function() {
	    $(this).parent().find('.search-box').addClass('open');
	});
	$('.search-btn').on('click', function(e) {
	    e.stopPropagation();
	});
	$(document).on('click', function(e) {
	    $('.search-box').removeClass('open');
	});

	// Sharing expand (Navbar)
	var $shareToggleI = $('.share-btn > i'),
	    $shareToggle = $('.share-btn, .navbar');
	$shareToggleI.on('click', function() {
	    $(this).parent().toggleClass('active').find('.dropdown').toggleClass('expanded');
	});
	$shareToggle.on('click', function(e) {
	    e.stopPropagation();
	});
	$(document).on('click', function(e) {
	    $shareToggle.removeClass('active').find('.dropdown').removeClass('expanded');
	});

	// Tabs Prev/Next Controls
	var $bulletTabs = $('.custom-controls .bullets li');
	$('.custom-controls .prev-btn').on('click', function() {
	    $bulletTabs.filter('.active').prev('li').find('a[data-toggle="tab"]').tab('show');
	});

	$('.custom-controls .next-btn').on('click', function() {
	    $bulletTabs.filter('.active').next('li').find('a[data-toggle="tab"]').tab('show');
	});

	// Tooltips
	var $tooltip = $('[data-toggle="tooltip"]');
	if ($tooltip.length > 0) {
	    $tooltip.tooltip();
	}

	// Custom checkboxes and radios
	var $checkbox = $('input[type="checkbox"], input[type="radio"]');
	if($checkbox.length) {
		$('input').iCheck();
	}

	// Fluid width video embeds.
	if($('iframe[src*="youtube"]').length > 0 || $('iframe[src*="vimeo"]').length > 0) {
		$('iframe[src*="youtube"], iframe[src*="vimeo"]').parent().fitVids();
	}

	// Image Carousel
	var $galleryPostFormat = $('.format-gallery .post-thumb .gallery');
	if ($galleryPostFormat.length > 0) {
		$galleryPostFormat.each( function () {
			var dataLoop   = (restarter_vars.gallery_loop === '1') ? true : false,
				autoPlay   = (restarter_vars.gallery_autoplay === '1') ? true : false,
				timeOut    = parseInt(restarter_vars.gallery_timeout),
				autoheight = (restarter_vars.gallery_auto_height === '1') ? true : false,
				dataDots   = (restarter_vars.gallery_dots === '1') ? true : false;
			$(this).owlCarousel( {
				items: 1,
				loop: dataLoop,
				margin: 0,
				nav: true,
				dots: dataDots,
				navText: [ , ],
				autoplay: autoPlay,
				autoplayTimeout: timeOut,
				autoHeight: autoheight
			} );
		} );
	}

	// if adminbar exist (should check for visible?) then add margin to our navbar
    $(window).on('load resize scroll', function() {
    	var navbar = $('header.navbar'),
        	width = Math.max($(window).width(), window.innerWidth),
        	topScroll = $(window).scrollTop(),
        	$wpAdminBar = $('#wpadminbar');
        if ($wpAdminBar.length) {
            if (width > 600) {
                navbar.css('top', $wpAdminBar.height() + 'px');
            } else if (width <= 600 && topScroll >= 5) {
                navbar.css('top', '0');
            } else if (width <= 600 && topScroll <= 5) {
                navbar.css('top', $wpAdminBar.height() + 'px');
            }
        }
    });

})(this, jQuery);

/*Back Function: Manipulating the browser history
*************************************************/
function restarterGoBack() {
	window.history.back()
}