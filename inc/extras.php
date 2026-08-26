<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package bellaworks
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

// $date = new DateTime();
// $date->setTimezone(new DateTimeZone('America/Detroit'));
// $fdate = $date->format('Y-m-d H:i:s');
// define('WP_CURRENT_TIME', $fdate);
// define('THEMEURI',get_template_directory_uri() . '/');
global $portfolio_per_page;
$perpageOption = get_field('portfolio_perpage','option');
$portfolio_per_page = ($perpageOption) ? $perpageOption : '6';


function bellaworks_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
   global $post;
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    if ( is_front_page() || is_home() ) {
        $classes[] = 'homepage';
    } else {
        $classes[] = 'subpage';
    }
    if(is_page() && $post) {
      $classes[] = $post->post_name;
    }

    $browsers = ['is_iphone', 'is_chrome', 'is_safari', 'is_NS4', 'is_opera', 'is_macIE', 'is_winIE', 'is_gecko', 'is_lynx', 'is_IE', 'is_edge'];
    $classes[] = join(' ', array_filter($browsers, function ($browser) {
        return $GLOBALS[$browser];
    }));

    return $classes;
}
add_filter( 'body_class', 'bellaworks_body_classes' );


function add_query_vars_filter( $vars ) {
  $vars[] = "pg";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );


function shortenText($string, $limit, $break=".", $pad="...") {
  // return with no change if string is shorter than $limit
  if(strlen($string) <= $limit) return $string;

  // is $break present between $limit and the end of the string?
  if(false !== ($breakpoint = strpos($string, $break, $limit))) {
    if($breakpoint < strlen($string) - 1) {
      $string = substr($string, 0, $breakpoint) . $pad;
    }
  }

  return $string;
}


add_action('admin_enqueue_scripts', 'bellaworks_admin_style');
function bellaworks_admin_style() {
  wp_enqueue_style('admin-dashicons', get_template_directory_uri().'/css/dashicons.min.css');
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/css/admin.css');
}

function get_page_id_by_template($fileName) {
    $page_id = 0;
    if($fileName) {
        $pages = get_pages(array(
            'post_type' => 'page',
            'meta_key' => '_wp_page_template',
            'meta_value' => $fileName.'.php'
        ));

        if($pages) {
            $row = $pages[0];
            $page_id = $row->ID;
        }
    }
    return $page_id;
}

function string_cleaner($str) {
    if($str) {
        $str = str_replace(' ', '', $str);
        $str = preg_replace('/\s+/', '', $str);
        $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
        $str = strtolower($str);
        $str = trim($str);
        return $str;
    }
}

function format_phone_number($string) {
    if(empty($string)) return '';
    $append = '';
    if (strpos($string, '+') !== false) {
        $append = '+';
    }
    $string = preg_replace("/[^0-9]/", "", $string );
    $string = preg_replace('/\s+/', '', $string);
    return $append.$string;
}

function get_social_media() {
    $options = get_field("social_media","option");
    $icons = social_icons();
    $list = array();
    if($options) {
        foreach($options as $i=>$opt) {
            if( isset($opt['url']) && $opt['url'] ) {
                $url = $opt['url'];
                $parts = parse_url($url);
                $host = ( isset($parts['host']) && $parts['host'] ) ? $parts['host'] : '';
                if($host) {
                    foreach($icons as $type=>$icon) {
                        if (strpos($host, $type) !== false) {
                            $list[$i] = array('url'=>$url,'icon'=>$icon,'type'=>$type);
                        }
                    }
                }
            }
        }
    }

    return ($list) ? $list : '';
}

function social_icons() {
    $social_types = array(
        'facebook'  => 'fab fa-facebook-square',
        'twitter'   => 'fab fa-twitter',
        'linkedin'  => 'fab fa-linkedin',
        'instagram' => 'fab fa-instagram',
        'youtube'   => 'fab fa-youtube',
        'vimeo'  => 'fab fa-vimeo',
    );
    return $social_types;
}

function parse_external_url( $url = '', $internal_class = 'internal-link', $external_class = 'external-link') {

    $url = trim($url);

    // Abort if parameter URL is empty
    if( empty($url) ) {
        return false;
    }

    //$home_url = parse_url( $_SERVER['HTTP_HOST'] );
    $home_url = parse_url( home_url() );  // Works for WordPress

    $target = '_self';
    $class = $internal_class;

    if( $url!='#' ) {
        if (filter_var($url, FILTER_VALIDATE_URL)) {

            $link_url = parse_url( $url );

            // Decide on target
            if( empty($link_url['host']) ) {
                // Is an internal link
                $target = '_self';
                $class = $internal_class;

            } elseif( $link_url['host'] == $home_url['host'] ) {
                // Is an internal link
                $target = '_self';
                $class = $internal_class;

            } else {
                // Is an external link
                $target = '_blank';
                $class = $external_class;
            }
        }
    }

    // Return array
    $output = array(
        'class'     => $class,
        'target'    => $target,
        'url'       => $url
    );

    return $output;
}


/* Remove richtext editor on specific page */
add_action('init', 'hide_editor_by_page_id');
function hide_editor_by_page_id() {
  // Check if we are in the admin area
  if (!is_admin()) return;

  // Get the post ID from the URL
  $post_id = (isset($_GET['post']) && $_GET['post']) ? $_GET['post'] : '';
  if(empty($post_id)) {
    $post_id = (isset($_POST['post']) && $_POST['post']) ? $_POST['post'] : '';
  }
  if (!isset($post_id)) return;

  $homepage_id = get_option('page_on_front');
  // Hide the editor on homepage
  if ( (int) $post_id === (int) $homepage_id ) {
    remove_post_type_support('page', 'editor');
  }
}

// add_action( 'save_post', 'save_post_with_acf');
// function save_post_with_acf( $post_id) {
// 	global $wpdb;
// 	$posttype = get_post_type($post_id);
// 	if ( $posttype=='post' ) {
// 		$val = get_field('featured_story', $post_id);
// 		if($val) {
// 			$query = "SELECT meta.meta_id, meta.post_id FROM ".$wpdb->prefix."postmeta meta WHERE meta.meta_key LIKE '%featured_story%' AND meta.post_id!=" . $post_id;
// 			$result = $wpdb->get_results($query);
// 			if($result) {
// 				foreach($result as $row) {
// 					if($post_id!=$row->post_id) {
// 						delete_post_meta($row->post_id, 'featured_story');
// 						delete_post_meta($row->post_id, '_featured_story');
// 					}
// 				}
// 			}
// 		}
// 	}
// }




// add new buttons
add_filter( 'mce_buttons', 'myplugin_register_buttons' );
function myplugin_register_buttons( $buttons ) {
	array_push( $buttons, 'edbutton1', 'custom_class' );
	return $buttons;
}

// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
add_filter( 'mce_external_plugins', 'myplugin_register_tinymce_javascript' );
function myplugin_register_tinymce_javascript( $plugin_array ) {
  $plugin_array['ctabutton'] = get_stylesheet_directory_uri() . '/assets/js/custom/custom-tinymce.js';
  return $plugin_array;
}

// add_action('rest_api_init', function () {
//     register_rest_route( 'myquery/v1', 'latest-posts',array(
//         'methods'  => 'GET',
//         'callback' => 'get_latest_posts'
//     ));
// });
// function get_latest_posts($request) {
//     $postType = $request['ptype'];
//     $posts_per_page = -1;
//     $args = array(
//         'posts_per_page'  => $posts_per_page,
//         'post_type'       => $postType,
//         'orderby'         => 'date',
//         'order'           => 'desc',
//         'post_status'     => 'publish'
//     );

//     if (empty($postType)) {
//     return new WP_Error( 'post_type', 'No post type indicated', array('status' => 404) );
//     }

//     $posts = get_posts($args);
//     $extractedImages = array();
//     if($posts) {
//         foreach($posts as $row) {
//             $id = $row->ID;
//             $imageUrl = get_the_post_thumbnail_url($id);
//             $row->featured_image = $imageUrl;
//             $content = $row->post_content;
//             // $htmlDom = new DOMDocument;
//             // $htmlDom->loadHTML($content);
//             // $imageTags = $htmlDom->getElementsByTagName('img');
//             // $extractedImages = array();
//             // foreach($imageTags as $imageTag){
//             //     $extractedImages[] = $imageTag->getAttribute('src');
//             // }
//             preg_match_all('~<img.*?src=["\']+(.*?)["\']+~', $content, $urls);
//             $extractedImages = $urls[1];
//             //$extractedImages[] = $urls;

//         }
//     }

//     $res['count'] = ($posts) ? count($posts) : 0;
//     $res['posts'] = $posts;

//     $response = new WP_REST_Response($extractedImages);
//     $response->set_status(200);

//     return $response;
// }


function bella_acf_input_admin_footer() { ?>
<script type="text/javascript">
(function($) {
  acf.add_filter('color_picker_args', function( args, $field ){
    // do something to args
    args.palettes = ['#3D5588','#F26522','#81C674','#FEBC11','#FAF1DB','#32845C','#00B2CD']
    return args;
  });
})(jQuery);
</script>
<?php
}
add_action('acf/input/admin_footer', 'bella_acf_input_admin_footer');


add_filter( 'gform_display_add_form_button', 'display_form_button_on_specific_page' );
function display_form_button_on_specific_page( $display_add_form_button ) {
  if ( isset( $_GET['post'] ) && get_field('repeatable_blocks', $_GET['post']) ) {
    return true;
  }
  return $display_add_form_button;
}

function get_flexible_parts($isHome=false) {
	$dir = get_stylesheet_directory() . '/parts-flexible/';
  if($isHome) {
    $dir .= 'home/';
  } else {
    $dir .= 'subpage/';
  }
	$partsFiles = [];
	if (is_dir($dir)) {
		$files = scandir($dir);
		foreach ($files as $file) {
			$pathinfo = pathinfo($file);
			if( isset($pathinfo['extension']) && strtolower($pathinfo['extension']) =='php' ) {
				if (!preg_match('/-copy| copy|-bak|-backup/i', strtolower($file))) {
					// $partsFiles[] = $file;
          if($isHome) {
            $partsFiles[] = 'parts-flexible/home/' . $file;
          } else {
            $partsFiles[] = 'parts-flexible/subpage/' . $file;
          }
				}
			}
		}
	}
	return $partsFiles;
}

function theme_enqueue_masonry_load_more() {
	global $portfolio_per_page;
	// Enqueue Masonry (WordPress includes this by default)
	wp_enqueue_script('masonry');

	// Register and enqueue your custom gallery script
	wp_enqueue_script('gallery-load-more', get_template_directory_uri() . '/assets/js/gallery.js', array('jquery', 'masonry'), '1.0', true);

	// Initial query to find total pages (for the same featured image query)
	$initial_query = new WP_Query(array(
		'post_type'      => 'portfolio',
		'posts_per_page' => $portfolio_per_page, // Match your initial display count
		'post_status'    => 'publish',
		'meta_query'     => array(
				array('key' => '_thumbnail_id', 'compare' => 'EXISTS')
		)
	));

	//Send variables to gallery.js
	wp_localize_script('gallery-load-more', 'gallery_params', array(
		'ajaxurl'      => admin_url('admin-ajax.php'),
		'current_page' => 1,
		'max_page'     => $initial_query->max_num_pages
	));
}
add_action('wp_enqueue_scripts', 'theme_enqueue_masonry_load_more');


function load_more_featured_posts() {
    global $portfolio_per_page;
		$result = '';
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;

    $args = array(
			'post_type'      => 'portfolio',         // Fetch standard posts (change to 'any' or custom post type if needed)
			'posts_per_page' => $portfolio_per_page,          
			'paged'          => $page,   // Number of posts to display
			'post_status'    => 'publish',      // Only get published posts
			'meta_query'     => array(
				array(
					'key'     => '_thumbnail_id', // This key only exists if a featured image is set
					'compare' => 'EXISTS',        // Ensures the key is present in the database
				),
			),
    );

    $query = new WP_Query($args);
		ob_start();
    if ($query->have_posts()) {
			while ($query->have_posts()) { $query->the_post(); 
				$imageUrl = get_the_post_thumbnail_url(get_the_ID());
				include( locate_template('parts/gallery-item.php') );
			}
			wp_reset_postdata();
    }
		$result = ob_get_contents();
		ob_get_clean();
		ob_end_flush();

		echo $result;
    wp_die(); // Required to terminate immediately and return a proper response
}
add_action('wp_ajax_load_more_featured_posts', 'load_more_featured_posts');
add_action('wp_ajax_nopriv_load_more_featured_posts', 'load_more_featured_posts');


function getCleanDomainName($url) {
  // 1. Extract the host (e.g., "www.instagram.com")
  $host = parse_url($url, PHP_URL_HOST);
  if (!$host) {
      $host = parse_url('http://' . $url, PHP_URL_HOST);
  }

  // 2. Remove "www." if present
  $host = preg_replace('/^www\./', '', $host);

  // 3. Remove the extension (.com, .net, etc.)
  // This finds the last dot and grabs everything before it
  $lastDotPos = strrpos($host, '.');
  if ($lastDotPos !== false) {
      $host = substr($host, 0, $lastDotPos);
  }

  return $host;
}
