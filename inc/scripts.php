<?php
/**
 * Enqueue scripts and styles.
 */
global $portfolio_per_page;
$portfolio_per_page = 3;

function bellaworks_scripts() {
  global $portfolio_per_page;
  wp_enqueue_script('masonry');
	//wp_enqueue_style( 'bellaworks-style', get_stylesheet_uri() );

  wp_enqueue_style( 'swiper-style', 'https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css' );
  wp_enqueue_style('bellaworks-style', get_stylesheet_directory_uri() .'/style.min.css', array(), '2.3' );

  wp_deregister_script('jquery');
  wp_register_script('jquery', get_stylesheet_directory_uri() . '/assets/js/jquery.min.js', false, '3.7.1', false);
  wp_enqueue_script('jquery');

	 wp_enqueue_script(
			'jquery-migrate','https://code.jquery.com/jquery-migrate-1.4.1.min.js',
			array(), '20200713',
			false
		);

  wp_enqueue_script(
    'vimeo-player',
    'https://player.vimeo.com/api/player.js',
    array(), '2.12.2', true
  );

  wp_enqueue_script(
    'bellaworks-swiper',
    get_template_directory_uri() . '/assets/js/vendor/swiper-bundle.min.js',
    array(), '06172026', true
  );
  wp_enqueue_script(
    'bellaworks-fancybox',
    get_template_directory_uri() . '/assets/js/vendor/fancybox.umd.js',
    array(), '06172026', true
  );

  // wp_enqueue_script(
  //   'bellaworks-cplugin',
  //   get_template_directory_uri() . '/assets/js/vendor.js',
  //   array(), '20220202', true
  // );

	wp_enqueue_script(
    'bellaworks-masonry',
    get_template_directory_uri() . '/assets/js/vendor/masonry.min.js',
    array(), '4.2.2', true
  );
	// wp_enqueue_script(
  //   'bellaworks-lazyload',
  //   get_template_directory_uri() . '/assets/js/vendor/imagesloaded.min.js',
  //   array(), '5.0.0', true
  // );

  wp_enqueue_script(
    'fancybox',
    'https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js',
    array(), '3.5.7', true
  );

  wp_enqueue_script(
    'bellaworks-custom',
    get_template_directory_uri() . '/assets/js/custom/custom.js',
    array(), '20260218', true
  );

	wp_localize_script( 'bellaworks-custom', 'frontajax', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	));


	wp_enqueue_script(
		'font-awesome',
		'https://use.fontawesome.com/8f931eabc1.js',
		array(), '20180424',
		true
	);



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bellaworks_scripts' );


function bellaworks_load_custom_admin_script() {
  wp_enqueue_script(
    'bellaworks-custom-tinymce',
    get_template_directory_uri() . '/assets/js/custom/custom-tinymce.js',
    array(), '07152026', true
  );
  
}
add_action('admin_enqueue_scripts', 'bellaworks_load_custom_admin_script');

