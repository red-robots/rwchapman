<?php
/**
 * The template for displaying all pages.
 *
 * Pages built with subpage flexible content render their layouts. Regular
 * pages get the standard navy title band followed by the page content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bellaworks
 */
get_header();
$flexible_content_internal = get_field('subpage_flexible_content');
?>
<?php if($flexible_content_internal) { ?>

  <div id="primary" class="content-area flexible-content-internal">
    <?php include( locate_template('repeatable-blocks.php') ); ?>
  </div>

<?php } else { ?>
<div id="primary" class="content-area flexible-content-internal generic-layout">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

      <div class="repeatable repeatable_title_band">
        <div class="wrapper">
          <div class="content-inner">
            <h1 class="section-title"><?php the_title(); ?></h1>
          </div>
        </div>
      </div>

      <?php if( trim( get_the_content() ) ) { ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('generic-article'); ?>>
        <div class="wrapper">
          <div class="content-inner">
            <div class="entry-content">
              <?php the_content(); ?>
            </div>
          </div>
        </div>
      </article>
      <?php } ?>

		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->
<?php } ?>

<?php
get_footer();
