jQuery(document).ready(function($) {
	var $container = $('.gallery-container');
  	var $grid = $('.masonry-grid');

	$grid.on('layoutComplete', function() {
		$container.addClass('masonry-active');
	});

	// $grid.masonry({
	// 	itemSelector: '.grid-item',
	// 	columnWidth: '.grid-sizer',
	// 	percentPosition: true,
	// 	gutter: 0
	// });

	$grid.imagesLoaded(function() {
		$grid.masonry({
		  itemSelector: '.grid-item',
		  columnWidth: '.grid-sizer',
		  percentPosition: true,
		  stagger: 20,
		  gutter: 0,
		  visibleStyle: { opacity: 1 },
		  hiddenStyle: { opacity: 0 },  
		});
	});


	$('#load-more-btn').click(function(e) {
		e.preventDefault();
		var button = $(this);
		var buttonDefaultLabel = button.attr('data-default-label');
		var data = {
				'action': 'load_more_featured_posts',
				'page': parseInt(gallery_params.current_page) + 1
		};

		$.ajax({
			url: gallery_params.ajaxurl,
			data: data,
			type: 'POST',
			beforeSend: function(xhr) {
					button.text('Loading...');
			},
			success: function(response) {
				if (response) {
					var $items = $(response);
					
					$grid.append($items);
					$grid.masonry('appended', $items);
					$grid.masonry('layout');

					gallery_params.current_page++;
					button.text(buttonDefaultLabel);

					if (gallery_params.current_page == gallery_params.max_page) {
							button.remove();
					}
				} else {
					button.remove();
				}
			},
			error: function(xhr, status, error) {
				console.error("AJAX Error (Status):", status);
				console.error("AJAX Error (Details):", error);
				console.dir(xhr); // Logs the full server response object
				//button.text('Error Loading. Try Again.');
			}
		});
	});


	// 1. Initialize Fancybox
	$('.gallery-container [data-fancybox]').fancybox({
		clickContent: false, 
		buttons: [],         
		smallBtn: true,      
		toolbar: false,
		animationEffect: "fade",
		transitionEffect: "fade",
		loop: false, // Ensure it stops at boundaries instead of looping
		
		// This runs every time a popup item transitions and loads
		afterShow: function(instance, current) {
			var currentIndex = current.index;            // Current item number (starts at 0)
			var totalItems = instance.group.length;       // Total number of items in gallery
			
			// Look for the navigation buttons inside the currently active popup
			var $currentPopup = current.$content;
			var $prevBtn = $currentPopup.find('.prev-btn');
			var $nextBtn = $currentPopup.find('.next-btn');

			// Reset states first
			$prevBtn.prop('disabled', false).css('opacity', '1');
			$nextBtn.prop('disabled', false).css('opacity', '1');

			// If it's the very first item, disable the previous button
			if (currentIndex === 0) {
					$prevBtn.prop('disabled', true).css('opacity', '0.3');
			}

			// If it's the very last item, disable the next button
			if (currentIndex === totalItems - 1) {
					$nextBtn.prop('disabled', true).css('opacity', '0.3');
			}
		}
	});

	// 2. Safe Previous Button Handler
	$(document).on('click', '.prev-btn', function(e) {
		e.preventDefault();
		const prevBtn = $(this);
		const count = $(this).attr('data-count');
		const mainImage = $(this).attr('data-main-image');
		const galleryId = $(this).attr('data-gallery-id');
		const index = $(this).attr('data-index');
		const prevIndex = parseInt(index) - 1;
		var instance = $.fancybox.getInstance();
		if (instance) {
			const popContainerId = `#popup-item-${galleryId}`;
			const popupContainer = $(popContainerId);
			const imageContainer = popupContainer.find('.popup-image-side');
			const nextBtn = popupContainer.find('.next-btn');
			if( instance['group']!=undefined && instance['group'][index]['src']!=undefined ) {
				var imageUrl = instance['group'][index]['src'];
				if(imageUrl==popContainerId) {
					imageUrl = mainImage;
				}
				imageContainer.html(`<img src="${imageUrl}" alt="Gallery Image" class="animated fadeIn" />`);
				prevBtn.attr('data-index', prevIndex);
				if( prevIndex < 0 ) {
					prevBtn.prop('disabled', true).css('opacity', '0.3');
				}
				nextBtn.attr('data-index', parseInt(index) + 1).prop('disabled', false).css('opacity', '1');
			}
		}
	});

	// 3. Safe Next Button Handler
	$(document).on('click', '.next-btn', function(e) {
		e.preventDefault();
		const nextBtn = $(this);
		const count = $(this).attr('data-count');
		const galleryId = $(this).attr('data-gallery-id');
		const index = $(this).attr('data-index');
		const nextIndex = parseInt(index) + 1;
		var instance = $.fancybox.getInstance();
		if (instance) {
			const popupContainer = $(`#popup-item-${galleryId}`);
			const imageContainer = popupContainer.find('.popup-image-side');
			const prevBtn = popupContainer.find('.prev-btn');
			if( instance['group']!=undefined && instance['group'][index]['src']!=undefined ) {
				const imageUrl = instance['group'][index]['src'];
				imageContainer.html(`<img src="${imageUrl}" alt="Gallery Image" class="animated fadeIn" />`);
				nextBtn.attr('data-index', nextIndex);
				if( nextIndex > count ) {
					nextBtn.prop('disabled', true).css('opacity', '0.3');
				}
				prevBtn.attr('data-index', parseInt(index) - 1).prop('disabled', false).css('opacity', '1');
			}
		}
	});
	
});
