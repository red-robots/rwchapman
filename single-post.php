<?php
/**
 * Single news post.
 *
 * @package bellaworks
 */
get_header();
$news_page_id = bellaworks_news_page_id();
$news_url = ($news_page_id) ? get_permalink($news_page_id) : home_url('/');
?>

<div id="primary" class="content-area flexible-content-internal single-news">
  <main id="main" class="site-main" role="main">

    <?php bellaworks_render_page_layouts($news_page_id, array('title_band')); ?>

    <?php while ( have_posts() ) : the_post();
      $categories = get_the_category();
      $category = ($categories && $categories[0]->slug != 'uncategorized') ? $categories[0] : '';
      $share_url = rawurlencode( get_permalink() );
      $share_title = rawurlencode( html_entity_decode( get_the_title(), ENT_QUOTES, 'UTF-8' ) );
      ?>
      <div class="news-bar">
        <div class="wrapper">
          <div class="content-inner">
            <a href="<?php echo esc_url($news_url); ?>" class="news-back"><span class="arrow-circle"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i></span>Main News Feed</a>
            <div class="news-share">
              <button type="button" class="news-share-toggle" aria-expanded="false" aria-controls="news-share-menu" data-title="<?php echo esc_attr( get_the_title() ); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>">Share Story<i class="fa-solid fa-share-nodes" aria-hidden="true"></i></button>
              <ul id="news-share-menu" class="news-share-menu">
                <li><a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $share_url; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-linkedin" aria-hidden="true"></i>LinkedIn</a></li>
                <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook" aria-hidden="true"></i>Facebook</a></li>
                <li><a href="https://x.com/intent/post?url=<?php echo $share_url; ?>&amp;text=<?php echo $share_title; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i>X</a></li>
                <li><a href="mailto:?subject=<?php echo $share_title; ?>&amp;body=<?php echo $share_url; ?>"><i class="fa-solid fa-envelope" aria-hidden="true"></i>Email</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <article id="post-<?php the_ID(); ?>" <?php post_class('news-article'); ?>>
        <div class="wrapper">
          <div class="news-article-inner">
            <div class="news-meta">
              <time datetime="<?php echo esc_attr( get_the_date('c') ); ?>"><?php echo esc_html( get_the_date('n.j.y') ); ?></time>
              <?php if($category) { ?>
                <span class="sep" aria-hidden="true">|</span>
                <a href="<?php echo esc_url( get_category_link($category) ); ?>"><?php echo esc_html($category->name); ?></a>
              <?php } ?>
            </div>
            <h1 class="news-title"><?php the_title(); ?></h1>
            <div class="entry-content">
              <?php the_content(); ?>
            </div>
          </div>
        </div>
      </article>
    <?php endwhile; ?>

    <?php bellaworks_render_page_layouts($news_page_id, array('callout_box')); ?>

  </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
