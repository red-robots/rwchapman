<?php
/**
 * Template Name: Contact
 *
 * @package bellaworks
 */
get_header();
$flexible_content_internal = get_field('subpage_flexible_content');
?>

<div id="primary" class="content-area flexible-content-internal page-contact">
  <main id="main" class="site-main" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

      <?php if ($flexible_content_internal) { ?>
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

<?php
get_footer();
