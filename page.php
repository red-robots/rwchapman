<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bellaworks
 */
get_header();
$repeatable_blocks = get_field('flexible_content');
$flexible_content_internal = get_field('subpage_flexible_content');
?>
<?php if($flexible_content_internal) { ?>

  <div id="primary" class="content-area flexible-content-internal">
    <?php include( locate_template('repeatable-blocks.php') ); ?>
  </div>

<?php } else { ?>
<div id="primary" class="content-area-full generic-layout">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

      <?php if ($repeatable_blocks) { ?>
        <?php include( locate_template('repeatable-blocks.php') ); ?>
      <?php } else { ?>
        <h1 class="page-title"><span><?php the_title(); ?></span></h1>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
      <?php } ?>

		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->
<?php } ?>

<?php
get_footer();
