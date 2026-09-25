<?php
/**
 * News archives (category, tag, date, author). Uses the News page's
 * title band and callout box around the listing.
 *
 * @package bellaworks
 */
global $wp_query;
get_header();
$news_page_id = bellaworks_news_page_id();
$news_query = $wp_query;
?>

<div id="primary" class="content-area flexible-content-internal page-news news-archive">
  <main id="main" class="site-main" role="main">

    <?php bellaworks_render_page_layouts($news_page_id, array('title_band')); ?>

    <div class="news-archive-heading">
      <div class="wrapper">
        <div class="content-inner">
          <?php the_archive_title( '<h2 class="archive-title">', '</h2>' ); ?>
        </div>
      </div>
    </div>

    <?php include( locate_template('parts/news-feed.php') ); ?>

    <?php bellaworks_render_page_layouts($news_page_id, array('callout_box')); ?>

  </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
