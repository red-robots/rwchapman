<?php if( get_row_layout() == 'news_feed' ) {
  $paged = max(1, get_query_var('paged'));
  $news_query = new WP_Query(array(
    'post_type'   => 'post',
    'post_status' => 'publish',
    'paged'       => $paged,
    'posts_per_page' => bellaworks_news_per_page(),
  ));
  include( locate_template('parts/news-feed.php') );
  wp_reset_postdata();
} ?>
