<?php
/**
 * The template for Homepage.
 *
 */
get_header(); 
$repeatable_blocks = get_field('flexible_content');
?>

<div id="primary" class="content-area-full generic-layout">
  <main id="main" class="site-main" role="main">

    <?php while ( have_posts() ) : the_post(); ?>
    <?php endwhile; ?>

    <?php if ($repeatable_blocks) { ?>
      <?php include( locate_template('repeatable-blocks.php') ); ?>
    <?php } ?>

  </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
