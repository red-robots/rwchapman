<?php
$is_home_page = ( is_front_page() || is_home() ) ? true : false;
$partsFiles = get_flexible_parts($is_home_page);
$flexible_field_name = ($is_home_page) ? 'flexible_content' : 'subpage_flexible_content';

if( have_rows($flexible_field_name) ) {
  $i=1; while( have_rows($flexible_field_name) ): the_row();
    if($partsFiles) {
      foreach($partsFiles as $filePath) {
        include( locate_template($filePath) );
      }
    }
  $i++; endwhile;
}

?>
<script>
jQuery(document).ready(function($){
  const testimonialSwipers = document.querySelectorAll('.testimonial-swiper');
  if(testimonialSwipers.length) {
    // Loop through each element found
    testimonialSwipers.forEach((el) => {
      new Swiper(el, {
        // Essential for centering the main card
        centeredSlides: true,
        slidesPerView: 1.1,
        spaceBetween: 0,
        loop: true,
        speed: 400,
        effect: 'slide',
				grabCursor: true,
				allowTouchMove: true,
        autoplay: {
          delay: 8000, // Time in ms between slides (3 seconds)
          disableOnInteraction: false, // Keeps sliding after user interacts
        },
        navigation: {
          nextEl: el.querySelector('.testimonial-button-next'),
          prevEl: el.querySelector('.testimonial-button-prev'),
        },
        // Listen for events here
        on: {
          // slideChange: function () {
          //   this.el.classList.add('is-changing');
          // },
          // // When the animation starts
          slideChangeTransitionStart: function () {
            this.el.classList.add('is-changing');
          },
          // // When the animation finishes
          slideChangeTransitionEnd: function () {
            this.el.classList.remove('is-changing');
          },
        },
        // Responsive breakpoints
        breakpoints: {
          640: {
            slidesPerView: 1.5,
          },
          1024: {
            slidesPerView: 2.2, // Shows more cards on larger screens
          },
        },
      });
    });
  }

  moveElementsOnMobile();
  $(window).on('resize', function(){
    moveElementsOnMobile();
  });
  function moveElementsOnMobile() {
    if( $('.repeatable-features_block_icons').length ) {
      $('.repeatable-features_block_icons').each(function(){
        if( $(this).find('div.buttons').length && $(this).find('.iconsBlock').length ) {
          const titleDiv = $(this).find('.titleBlock');
          const buttons = $(this).find('div.buttons');
          const icons = $(this).find('.iconsBlock');
          if( $(window).width() <= 1250 ) {
            buttons.addClass('moved');
            buttons.insertAfter(icons);
          } else {
            if( buttons.hasClass('moved') ) {
              buttons.appendTo(titleDiv);
              buttons.removeClass('moved');
            }
          }
        }
      });
    }
  }


  if( $(".mySwiperCarousel").length ) {
    let swiper;

    // 1. Core initialization function
    function initSwiper() {
      swiper = new Swiper(".mySwiperCarousel", {
          slidesPerView: 3, 
          spaceBetween: 30,
          // Loop is set to true, but we'll dynamically manage it based on filtered content length
          loop: document.querySelectorAll('.swiper-slide:not(.hidden-slide)').length >= 3,
          autoplay: {
              delay: 3000,
              disableOnInteraction: false,
              pauseOnMouseEnter: true,
          },
          navigation: {
              nextEl: ".btn-next",
              prevEl: ".btn-prev",
          },
          breakpoints: {
              0: { slidesPerView: 1, spaceBetween: 10 },
              640: { slidesPerView: 2, spaceBetween: 20 },
              1024: { slidesPerView: 3, spaceBetween: 30 },
          },
      });
    }

    // Run Swiper initial load
    initSwiper();

    // 2. Filter Button Logic
    const filterButtons = document.querySelectorAll('.filter-btn');
    const allSlides = document.querySelectorAll('.mySwiperCarousel .swiper-slide');

    filterButtons.forEach(button => {
      button.addEventListener('click', () => {
          // Change Active Styling of Nav Items
          filterButtons.forEach(btn => btn.classList.remove('active'));
          button.classList.add('active');

          const targetFilter = button.getAttribute('data-filter');
          console.log(targetFilter);
          // Destroy existing Swiper parameters completely before filtering elements
          swiper.destroy(true, true);

          // Show/Hide slides depending on data-category properties
          allSlides.forEach(slide => {
              const slideCategory = slide.getAttribute('data-category');
             
              if (targetFilter === 'all' || slideCategory === targetFilter) {
                  slide.classList.remove('hidden-slide');
              } else {
                  slide.classList.add('hidden-slide');
              }
          });

          // Update Fancybox grouping to only open slides visible on screen
          Fancybox.unbind("[data-fancybox='gallery']");
          Fancybox.bind(".swiper-slide:not(.hidden-slide) [data-fancybox='gallery']", {
              loop: true,
              on: {
                  done: () => { swiper.autoplay.stop(); },
                  close: () => { swiper.autoplay.start(); }
              }
          });

          // Re-build Swiper with the remaining slides
          initSwiper();
      });
    });

    // Initial Fancybox bind for all visible slides
    Fancybox.bind(".swiper-slide:not(.hidden-slide) [data-fancybox='gallery']", {
      loop: true,
      on: {
          done: () => { swiper.autoplay.stop(); },
          close: () => { swiper.autoplay.start(); }
      }
    });
  }

});


function handleResponsiveInfoBlock() {
  const container = document.querySelector('.container'); // Replace with your actual parent class
  const blocks = document.querySelectorAll('.infoBlock');
  const groups = document.querySelectorAll('.infoGroup');
  const isMobile = window.innerWidth <= 960;

  if (isMobile && groups.length === 0) {
    // --- WRAP LOGIC ---
    for (let i = 0; i < blocks.length; i += 2) {
      const wrapper = document.createElement('div');
      wrapper.className = 'infoGroup';

      // Insert wrapper before the first block of the pair
      blocks[i].parentNode.insertBefore(wrapper, blocks[i]);

      // Move the pair into the wrapper
      wrapper.appendChild(blocks[i]);
      if (blocks[i + 1]) {
        wrapper.appendChild(blocks[i + 1]);
      }
    }
  }
  else if (!isMobile && groups.length > 0) {
    // --- UNWRAP LOGIC ---
    groups.forEach(group => {
      // Move all children back to the main container before the group
      while (group.firstChild) {
        group.parentNode.insertBefore(group.firstChild, group);
      }
      // Remove the now-empty wrapper
      group.remove();
    });
  }
}

// Run on load and on every resize
window.addEventListener('resize', handleResponsiveInfoBlock);
window.addEventListener('DOMContentLoaded', handleResponsiveInfoBlock);

</script>
