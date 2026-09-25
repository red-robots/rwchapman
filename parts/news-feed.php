<?php
/**
 * News listing with sidebar. Expects $news_query (WP_Query).
 */
$paged = max(1, get_query_var('paged'));
$max_pages = $news_query->max_num_pages;
?>
<div class="repeatable repeatable_news_feed">
  <div class="wrapper">
    <div class="content-inner">
      <aside class="news-sidebar">
        <?php get_template_part('parts/news-sidebar'); ?>
      </aside>

      <div class="news-feed">
        <?php if( $news_query->have_posts() ) { ?>
          <?php while( $news_query->have_posts() ) : $news_query->the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('news-item'); ?>>
              <h2 class="news-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <div class="news-item-excerpt"><?php the_excerpt(); ?></div>
              <a href="<?php the_permalink(); ?>" class="button" aria-label="<?php echo esc_attr( 'Continue reading ' . get_the_title() ); ?>">Continue Reading</a>
            </article>
          <?php endwhile; ?>

          <?php if( $max_pages > 1 ) {
            $pages = paginate_links(array(
              'total'     => $max_pages,
              'current'   => $paged,
              'prev_next' => false,
              'type'      => 'array',
              'mid_size'  => 2,
            ));
            $prev_link = ($paged > 1) ? get_pagenum_link($paged - 1) : '';
            $next_link = ($paged < $max_pages) ? get_pagenum_link($paged + 1) : '';
            ?>
            <nav class="news-pagination" aria-label="News pages">
              <?php if($prev_link) { ?>
                <a href="<?php echo esc_url($prev_link); ?>" class="page-arrow page-prev" aria-label="Previous page"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i></a>
              <?php } else { ?>
                <span class="page-arrow page-prev disabled" aria-hidden="true"><i class="fa-solid fa-arrow-left"></i></span>
              <?php } ?>
              <div class="page-numbers-list"><?php echo implode('', $pages); ?></div>
              <?php if($next_link) { ?>
                <a href="<?php echo esc_url($next_link); ?>" class="page-arrow page-next" aria-label="Next page"><i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
              <?php } else { ?>
                <span class="page-arrow page-next disabled" aria-hidden="true"><i class="fa-solid fa-arrow-right"></i></span>
              <?php } ?>
            </nav>
          <?php } ?>
        <?php } else { ?>
          <p class="no-posts">There are no news posts yet. Please check back soon.</p>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
