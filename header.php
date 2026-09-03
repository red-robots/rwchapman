<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if ( is_singular(array('post')) ) {
global $post;
$post_id = $post->ID;
$thumbId = get_post_thumbnail_id($post_id);
$featImg = wp_get_attachment_image_src($thumbId,'full'); ?>
<!-- SOCIAL MEDIA META TAGS -->
<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
<meta property="og:url"   content="<?php echo get_permalink(); ?>" />
<meta property="og:type"  content="article" />
<meta property="og:title" content="<?php echo get_the_title(); ?>" />
<meta property="og:description" content="<?php echo (get_the_excerpt()) ? strip_tags(get_the_excerpt()):''; ?>" />
<?php if ($featImg) { ?>
<meta property="og:image" content="<?php echo $featImg[0] ?>" />
<?php } ?>
<!-- end of SOCIAL MEDIA META TAGS -->
<?php } ?>

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fahkwang:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php bloginfo("template_url") ?>/css/swiper-bundle.min.css">
<link rel="stylesheet" href="<?php bloginfo("template_url") ?>/css/jquery.fancybox.min.css">
<script>
var currentURL = '<?php echo get_permalink();?>';
var params={};location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(s,k,v){params[k]=v});
</script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <div id="page" class="site">
    <a class="skip-link sr" href="#content"><?php esc_html_e( 'Skip to content', 'bellaworks' ); ?></a>

    <header id="masthead" class="site-header">
      <div class="header-inner">
        <span class="site-logo">
          <?php if( get_custom_logo() ) { ?>
            <?php the_custom_logo(); ?>
          <?php } else { ?>
            <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
          <?php } ?>
        </span>

        <button class="menu-toggle" aria-expanded="false" aria-controls="#primary-navigation">
          <span class="sr">Menu Toggle</span>
          <span class="bar"><span></span></span>
        </button>

        <div id="primary-navigation" class="primary-navigation">
          <button class="closeMenuToggle"><span class="sr-only">Close Menu</span></button>
          <nav id="site-navigation" class="main-navigation" role="navigation">
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu','link_before'=>'<span>','link_after'=>'</span>','items_wrap'=>'<ul id="%1$s" class="%2$s">%3$s</ul>') ); ?>
          </nav>
        </div>
      </div>
    </header>

    <?php get_template_part('parts/hero'); ?>
    
    <div id="content" class="site-content">
