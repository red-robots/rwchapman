<?php
/**
 * The template for displaying all pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bellaworks
 */

global $post;
$postType = get_post_type();
get_header(); ?>
<div id="primary" class="content-area page-default-template post-type-<?php echo $postType ?>">
  <main id="main" class="site-main wrapper" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
        <h1 class="page-title"><?php the_title(); ?></h1>
        <?php if ( get_the_content() ) { ?>
        <div class="entry-content padtop">
          <?php the_content(); ?>
        </div>
        <?php } ?>
		<?php endwhile; ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php get_footer();
