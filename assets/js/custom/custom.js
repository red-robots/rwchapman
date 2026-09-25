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

	const counterSections = document.querySelectorAll('.repeatable_counters');
	if( counterSections.length ) {
		const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		const counterDuration = 1800;

		// Splits "58K+" or "1,250.5%" into prefix, numeric target and suffix so the
		// markup can keep whatever formatting was entered in the CMS.
		const readCounter = function(text) {
			const match = text.match(/\d[\d.,]*/);
			if( !match ) {
				return null;
			}
			const number = match[0].replace(/,/g, '');
			const decimals = number.split('.')[1];
			return {
				text: text,
				prefix: text.slice(0, match.index),
				suffix: text.slice(match.index + match[0].length),
				target: parseFloat(number),
				decimals: decimals ? decimals.length : 0,
				grouped: match[0].indexOf(',') > -1
			};
		};

		const formatCounter = function(value, counter) {
			const fixed = value.toFixed(counter.decimals);
			const number = counter.grouped ? Number(fixed).toLocaleString('en-US', {
				minimumFractionDigits: counter.decimals,
				maximumFractionDigits: counter.decimals
			}) : fixed;
			return counter.prefix + number + counter.suffix;
		};

		const countUp = function(el) {
			const counter = readCounter(el.textContent.trim());
			if( !counter ) {
				return;
			}
			const startTime = window.performance.now();
			const step = function(now) {
				const progress = Math.min((now - startTime) / counterDuration, 1);
				if( progress < 1 ) {
					el.textContent = formatCounter(counter.target * (1 - Math.pow(1 - progress, 3)), counter);
					window.requestAnimationFrame(step);
				} else {
					el.textContent = counter.text;
				}
			};
			el.textContent = formatCounter(0, counter);
			window.requestAnimationFrame(step);
		};

		counterSections.forEach(function(section) {
			const numbers = section.querySelectorAll('.counter-item-inner h3');
			if( !numbers.length || reducedMotion || !('IntersectionObserver' in window) ) {
				return;
			}
			const observer = new IntersectionObserver(function(entries) {
				entries.forEach(function(entry) {
					// Sections still out of view get the hidden start state, so one that is
					// already on screen when the page loads never flashes.
					entry.target.classList.add('counters-animate');
					if( !entry.isIntersecting ) {
						return;
					}
					observer.unobserve(entry.target);
					entry.target.classList.add('is-in-view');
					numbers.forEach(countUp);
				});
			}, { threshold: 0.3 });
			observer.observe(section);
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

	if( $('.partner-logos-inner.owl-carousel').length ) {
		$('.partner-logos-inner.owl-carousel').owlCarousel({
			items: 5,
			loop: true,
			autoplay: true,
			autoplayTimeout: 4000,
			autoplayHoverPause: true,
			nav: false,
			dots: false,
			margin: 40,
			smartSpeed: 600,
			responsive: {
				0: {
					items: 2,
					margin: 20
				},
				600: {
					items: 3,
					margin: 30
				},
				1000: {
					items: 5,
					margin: 40
				}
			}
		});

		$(document).on('click', '.custom-slide-previous, .custom-slide-next', function(e){
			e.preventDefault();
			const direction = $(this).hasClass('custom-slide-next') ? 'next' : 'prev';
			$(this).closest('.partner-logos').find('.partner-logos-inner.owl-carousel').trigger(direction + '.owl.carousel');
		});
	}

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



	/* News sidebar: show all archive months */
	$(document).on('click', '.archives-toggle', function(){
		var list = $('#' + $(this).attr('aria-controls'));
		var expanded = !list.hasClass('is-expanded');
		list.toggleClass('is-expanded', expanded);
		$(this).attr('aria-expanded', expanded).html(expanded ? 'less' : 'more&hellip;');
	});

	/* News single: share story (native share sheet, falls back to menu) */
	$(document).on('click', '.news-share-toggle', function(){
		var btn = $(this);
		if( navigator.share && window.matchMedia('(pointer: coarse)').matches ) {
			navigator.share({ title: btn.data('title'), url: btn.data('url') }).catch(function(){});
			return;
		}
		var open = btn.attr('aria-expanded') !== 'true';
		btn.attr('aria-expanded', open).closest('.news-share').toggleClass('is-open', open);
	});
	$(document).on('click keyup', function(e){
		if( (e.type === 'click' && !$(e.target).closest('.news-share').length) || e.key === 'Escape' ) {
			$('.news-share.is-open').removeClass('is-open').find('.news-share-toggle').attr('aria-expanded', 'false');
		}
	});

});



