jQuery(document).ready(function() {
"use strict";


//Primary Nav in both scene

	var windowWidth = jQuery(window).width();
	var nav = ".main-nav";
	//    for sub menu arrow

	//    for sub menu arrow
	jQuery('.main-nav >li:has("ul")>a').each(function() {
		jQuery(this).addClass('below');
	});
	jQuery('ul:not(.main-nav)>li:has("ul")>a').each(function() {
		jQuery(this).addClass('side');
	});
	if (windowWidth > 991) {

		jQuery('#showbutton').off('click');
		jQuery('.im-hiding').css('display', 'block');
		jQuery(nav).off('mouseenter', 'li');
		jQuery(nav).off('mouseleave', 'li');
		jQuery(nav).off('click', 'li');
		jQuery(nav).off('click', 'a');
		jQuery(nav).on('mouseenter', 'li', function() {
			jQuery(this).children('ul').stop().hide();
			jQuery(this).children('ul').slideDown(400);
		});
		jQuery(nav).on('mouseleave', 'li', function() {
			jQuery(this).children('ul').stop().slideUp(350);
		});
	} else {

		//jQuery('#showbutton').off('click');
		jQuery('.im-hiding').css('display', 'none');
		//jQuery(nav).off('mouseenter', 'li');
		//jQuery(nav).off('mouseleave', 'li');
		//jQuery(nav).off('click', 'li');
		//jQuery(nav).off('click', 'a');
		jQuery(nav).on('click', 'a', function(e) {
			jQuery(this).next('ul').attr('style=""');
			//jQuery(this).next('ul').slideToggle();
			if (jQuery(this).next('ul').length !== 0) {
			//	e.preventDefault();
			}
		});
		// for hide menu
		jQuery('#showbutton').on('click', function() {

			jQuery('.im-hiding').slideToggle();
		});
	}



	jQuery(window).resize(function() {
		windowWidth = jQuery(window).width();
		jQuery(nav + ' ul').each(function() {
			jQuery(this).attr('style', '" "');
		});
		if (windowWidth > 991) {
			jQuery('#showbutton').off('click');
			jQuery('.im-hiding').css('display', 'block');
			jQuery(nav).off('mouseenter', 'li');
			jQuery(nav).off('mouseleave', 'li');
			jQuery(nav).off('click', 'li');
			jQuery(nav).off('click', 'a');
			jQuery(nav).on('mouseenter', 'li', function() {
				jQuery(this).children('ul').stop().hide();
				jQuery(this).children('ul').slideDown(400);
			});
			jQuery(nav).on('mouseleave', 'li', function() {
				jQuery(this).children('ul').stop().slideUp(350);
			});
		} else {
			jQuery('#showbutton').off('click');
			jQuery('.im-hiding').css('display', 'none');
			jQuery(nav).off('mouseenter', 'li');
			jQuery(nav).off('mouseleave', 'li');
			jQuery(nav).off('click', 'li');
			jQuery(nav).off('click', 'a');
			jQuery(nav).on('click', 'a', function(e) {
				jQuery(this).next('ul').attr('style=""');
				jQuery(this).next('ul').slideToggle();
				if (jQuery(this).next('ul').length !== 0) {
					e.preventDefault();
				}
			});
			// for hide menu
			jQuery('#showbutton').on('click', function() {

				jQuery('.im-hiding').slideToggle();
			});
		}
	});



  // jQuery(".main-slider").owlCarousel({

  //    	items:1,
  //   	loop:true,
  //  	 	margin:10,
  //   	 autoplay:true,
  //  		 autoplayTimeout:8000,
  //  		 dots:true,
	 //     nav: true,
  // });
	jQuery(".main-slider").slick({
		slidesToShow:1,

		slidesToScroll:1,
		adaptiveHeight: true,

		

		dots:true,
		arrows:true,
		infinite: true,

		// autoplay: true,
		// autoplaySpeed: 1500,
 });

	jQuery(".feature-slider").slick({
		slidesToShow:2,

		slidesToScroll:1,

		arrows: false,

		dots:false,

		adaptiveHeight: true,

		vertical: true,


		autoplay: true,
		autoplaySpeed: 3000,
 });
	/******************************************
 wow js active
******************************************/
	new WOW().init();


/******************************************
   All slider
******************************************/

jQuery("#all-slider .slider-items").show().owlCarousel({
		items:2,

		itemsDesktopSmall: [980, 2],
		itemsTablet: [640, 2],
		itemsMobile: [390, 1],
		navigation: !0,
		navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
		slideSpeed: 500,
		pagination:!1,
		autoPlay:true
	}),




	jQuery(".slider-items-wrapper").owlCarousel({

     items:1,
    loop:true,
    margin:10,
    dots:true,
    autoplay:true,
    autoplayTimeout:4000,



  }),

jQuery("#latest-news-slider .slider-items").owlCarousel({
    loop:true,
    margin:10,
    autoplay:true,
    autoplayTimeout:3000,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
}),

/******************************************
feature slider
******************************************/

jQuery("#best-selling-slider .slider-items").owlCarousel({
 	items: 3,
	loop:true,
	margin:10,
	autoplay:false,
	autoplayTimeout:3000,
	dots:false,
	nav: true,
	responsive:{
 0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }

 	}),

/******************************************
	Related posts
******************************************/

	jQuery("#related-posts .slider-items").owlCarousel({
		items: 3,
		itemsDesktop: [1024, 3],
		itemsDesktopSmall: [900, 3],
		itemsTablet: [640, 2],
		itemsMobile: [390, 1],
		navigation: !0,
		navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
		slideSpeed: 500,
		pagination: !1,
		autoPlay: true
	}),



	jQuery(function() {
		jQuery(".category-sidebar ul > li.cat-item.cat-parent > ul").hide();
		jQuery(".category-sidebar ul > li.cat-item.cat-parent.current-cat-parent > ul").show();
		jQuery(".category-sidebar ul > li.cat-item.cat-parent.current-cat.cat-parent > ul").show();
		jQuery(".category-sidebar ul > li.cat-item.cat-parent").on("click", function() {
			if (jQuery(this).hasClass('current-cat-parent')) {
				var li = jQuery(this).closest('li');
				li.find(' > ul').slideToggle('fast');
				jQuery(this).toggleClass("close-cat");
			} else {
				var li = jQuery(this).closest('li');
				li.find(' > ul').slideToggle('fast');
				jQuery(this).toggleClass("cat-item.cat-parent open-cat");
			}
		});
		jQuery(".category-sidebar ul.children li.cat-item,ul.children li.cat-item > a").on("click", function(e) {
			e.stopPropagation();
		});
	});



/******************************************
    colosebut
******************************************/

jQuery("#colosebut1").on("click", function() {
	jQuery("#div1").fadeOut("slow");
});
jQuery("#colosebut2").on("click", function() {
	jQuery("#div2").fadeOut("slow");
});
jQuery("#colosebut3").on("click", function() {
	jQuery("#div3").fadeOut("slow");
});
jQuery("#colosebut4").on("click", function() {
	jQuery("#div4").fadeOut("slow");
});

	/*==================================
         Responsive menu
         ==================================*/

	if (windowWidth < 768) {
		jQuery('.main-nav li.menu-item-has-children,.main-nav li.page_item_has_children').append('<span class="dropdown-icon"><i class="fa fa-caret-down" aria-hidden="true"></i></span>');

		jQuery('.main-nav li.menu-item-has-children span.dropdown-icon,.main-nav li.page_item_has_children span.dropdown-icon').on('click', function (e) {
			e.preventDefault();
			console.log('click');
			jQuery(this).siblings('.main-nav li.menu-item-has-children ul.sub-menu,.main-nav li.page_item_has_children ul.children').slideToggle(300);
		});

	} else {
		jQuery('.main-nav li.menu-item-has-children, .main-nav li.page_item_has_children').find('span').css('display', 'none');
	};

if (windowWidth < 768) {
		jQuery('.menu.category .accordion-body .list-unstyled li ul.children').append('<span class="dropdown-icon"><i class="fa fa-caret-down" aria-hidden="true"></i></span>');

		jQuery('span.dropdown-icon').on('click', function (e) {
			e.preventDefault();
			console.log('click');
			jQuery(this).siblings('.menu.category .accordion-body .list-unstyled li ').slideToggle(300);
		});

	} else {
		jQuery('.menu.category .accordion-body .list-unstyled li span.dropdown-icon').find('span').css('display', 'none');
	};

if (windowWidth < 768) {
		jQuery('.menu.category .all-category-list-item .menu-item-has-children').append('<span class="dropdown-icon"><i class="fa fa-caret-down" aria-hidden="true"></i></span>');

		jQuery('span.dropdown-icon').on('click', function (e) {
			e.preventDefault();
			console.log('click');
			jQuery(this).siblings('.menu.category .all-category-list-item .menu-item-has-children ul.sub-menu').slideToggle(300);
		});

	} else {
		jQuery('.menu.category .all-category-list-item .menu-item-has-children span.dropdown-icon').find('span').css('display', 'none');
	};

/*AFTER LAST MENU CLOSED */
jQuery('.last-menu').focusout(function (e) {
jQuery(".navbar-collapse.collapse.in").collapse('hide');
e.preventDefault();
})
/*AFTER LAST MENU CLOSED */
jQuery('.all-category-nav .last-menu').focusout(function (e) {
jQuery('ul#myDropdown').hide();
e.preventDefault();
})
//sticky sidebar
	var at_body = jQuery("body");
	var at_window = jQuery(window);

	if(at_body.hasClass('at-sticky-sidebar')){
		if(at_body.hasClass('sidebar-right')){
			jQuery('#secondary, #primary').theiaStickySidebar();
		}
		else{
			jQuery('#secondary, #primary').theiaStickySidebar();
		}
	}
	// dropmenu

/******************************************
    tooltip
******************************************/
/*add class tocategories child*/

jQuery("ul.children li").addClass("has-child");


	/* scroll to top */
	jQuery(window).scroll(function () {
		if (jQuery(this).scrollTop() > 600) {
			jQuery('.scrollup').fadeIn();
		} else {
			jQuery('.scrollup').fadeOut();
		}
	});

	jQuery('.scrollup').click(function () {
		jQuery("html, body").animate({
			scrollTop: 0
		}, 1400);
		return false;
	});

	/* .side-details to top */
	jQuery(window).scroll(function () {
		if (jQuery(this).scrollTop() > 400) {
			jQuery('.side-details').fadeIn();
		} else {
			jQuery('.side-details').fadeOut();
		}
	});


});

function myFunction() {
  document.getElementById("myDropdown").classList.toggle("whr-drop-hide");
}

window.onclick = function(event) {
  if (!event.target.matches('.all-navigator')) {

    var dropdowns = document.getElementsByClassName("all-category-list");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('whr-drop-hide')) {
        openDropdown.classList.remove('whr-drop-hide');
      }
    }
  }
}