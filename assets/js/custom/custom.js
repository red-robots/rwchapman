/**
 *  Custom jQuery Scripts
 *  Developed by: Lisa DeBona
 *  Date Modified: 03.31.2026
 */
jQuery(document).ready(function($) {

	if( $('.repeatable').length ) {
		$('.repeatable').each(function() {
			const groupName = $(this).attr('data-group');
			if( $(this).prev().hasClass('repeatable') ) {
				const prevDataGroup = $(this).prev().attr('data-group');
				$(this).addClass('prev-element-' + prevDataGroup);
			}
			if( $(this).next().hasClass('repeatable') ) {
				const nextDataGroup = $(this).next().attr('data-group');
				$(this).addClass('next-element-' + nextDataGroup);
			}
		});
	}

	if( $('.categories ul li').length ) {
		const countCategories = $('.categories ul li').length;
		if( countCategories > 1 ) {
			var categoriesList = '';
			$('.categories ul li').each(function() {
				const catLink = $(this).find('a').attr('href');
				const termSlug = $(this).find('a').attr('data-term-slug');
				const catText = $(this).text().trim();
				const currentCategory = (params.category!=undefined && params.category!='') ? params.category : '';
				const isCategorySelected = (termSlug==currentCategory) ? ' selected' : '';
				categoriesList += '<option data-category="'+catLink+'" value="' + catLink + '" '+isCategorySelected + '>' + catText + '</option>';
			});
			$('<select id="categories-mobile-select" class="categories-mobile-select">'+categoriesList+'</select>').insertAfter('.categories ul');
			$('.categories-mobile-select').on('change', function() {
				const selectedCategory = $(this).val();
				window.location.href = selectedCategory;
			});
		}
	}

	if( !$('body').hasClass('home') ) {
		if( $('#primary').length ) {
			const firstDiv = $('#primary div').first();
			if( firstDiv.hasClass('repeatable-hero') ) {
				firstDiv.addClass('first-repeatable-hero');
			}
		}
	}

	// if( $('.popup-image').length ) {
	// 	$('.popup-image').fancybox({
	// 		//buttons : ['close','thumbs','fullScreen'],
	// 		buttons : ['fullScreen','close'],
	// 		protect: true,
	// 		loop: false,
	// 		hash : false,
	// 		animationEffect: 'fade'
	// 	});
	// }

	// $('.grid').masonry({
	// 	itemSelector: '.grid-item',
	// 	columnWidth: 200
	// });

	// init Masonry
	// var $grid = $('.grid').masonry({
	// 	itemSelector: '.grid-item',
	// 	percentPosition: true,
	// 	columnWidth: '.grid-sizer'
	// });
	// // layout Masonry after each image loads
	// $grid.imagesLoaded().progress( function() {
	// 	$grid.masonry();
	// });

	// Select the grid element
	// var grid = document.querySelector('.masonry-images');
	// // Initialize Masonry ONLY after images have loaded
	// imagesLoaded(grid, function() {
	// 	var msnry = new Masonry(grid, {
	// 		itemSelector: '.masonry-item',
	// 		columnWidth: '.masonry-item',
	// 		percentPosition: true,
	// 		gutter: 0 // Space between items
	// 	});
	// });

  const swiperElements = document.querySelectorAll('.slideshow');
  if(swiperElements.length) {
    // Loop through each element found
    swiperElements.forEach((el) => {
      new Swiper(el, {
        speed: 400,
        slidesPerView: 1,
        effect: 'fade',
        loop: true,
				grabCursor: true,
				allowTouchMove: true,
        autoplay: {
          delay: 5000, // Time in ms between slides (3 seconds)
          disableOnInteraction: false, // Keeps sliding after user interacts
        },
        navigation: {
          nextEl: el.querySelector('.swiper-button-next'),
          prevEl: el.querySelector('.swiper-button-prev'),
        },
        pagination: {
          el: el.querySelector('.swiper-pagination'),
          clickable: true,
        },
      });
    });
  }

	//OPEN menu toggle
	$(document).on('click', '.menu-toggle', function(e){
		e.preventDefault();
		let isExpanded = $(this).attr('aria-expanded') === 'true';
		$(this).attr('aria-expanded', !isExpanded);
		let ariaControls = $(this).attr('aria-controls');
		if( $(ariaControls).length ) {
			if(isExpanded==false) {
				$(ariaControls).addClass('open');
			} else {
				$(ariaControls).addClass('closed');
				setTimeout(function(){
					$(ariaControls).removeClass('closed open');
				},600);
			}
		}
	});

	//CLOSE menu toggle
	$(document).on('click', '.closeMenuToggle', function(e){
		e.preventDefault();
		$('#primary-navigation').addClass('closed');
		$('.menu-toggle').attr('aria-expanded','false');
		setTimeout(function(){
			$('#primary-navigation').removeClass('open closed');
		},800);
	});

	if( $(window).width() <= 1080 ) {
		$('.main-navigation ul.menu li.menu-item-has-children').each(function(){
			const submenu = $(this).find('ul.sub-menu');
			$('<button class="submenu-toggle" aria-expanded="false"><svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L5 5L9 1" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>').insertBefore(submenu);
		});
	}

	$(document).on('click', '.submenu-toggle', function(e){
		e.preventDefault();
		let isExpanded = $(this).attr('aria-expanded') === 'true';
		$(this).attr('aria-expanded', !isExpanded);
		$(this).parents('.menu-item-has-children').find('ul.sub-menu').slideToggle(300);
	});

	// Smooth scroll to anchor links
	if(window.location.hash){
    var hashUrl = window.location.hash;
    setTimeout(function(){
      scrollToAnchor(hashUrl);
    },500);
  }

	$(document).on('click', 'a[href*="#"]:not([href="#"])', function(e) {
		if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
			if (target.length) {
				e.preventDefault();
				scrollToAnchor(target);
			}
		}
	});

	function scrollToAnchor(anchor) {
		if( anchor && $(anchor).length ) {
      var target = $(anchor);
      $('html, body').animate({
        scrollTop: target.offset().top
      }, 600, function() {
        if ( target.is(":focus") ) {
          return false;
        } else {
          target.attr('tabindex','-1');
        };
      });
    }
	}


});



