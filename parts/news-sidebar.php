<?php
$recent_posts = get_posts(array(
  'post_type'      => 'post',
  'post_status'    => 'publish',
  'posts_per_page' => 5,
));
$archives = wp_get_archives(array(
  'type'   => 'monthly',
  'echo'   => 0,
));
$archive_count = substr_count($archives, '<li');
?>
<div class="sidebar-inner">
  <?php if($recent_posts) { ?>
    <div class="sidebar-block sidebar-recent">
      <h3 class="sidebar-title">Recent Posts</h3>
      <ul>
        <?php foreach($recent_posts as $recent) { ?>
          <li><a href="<?php echo esc_url( get_permalink($recent) ); ?>"><?php echo esc_html( get_the_title($recent) ); ?></a></li>
        <?php } ?>
      </ul>
    </div>
  <?php } ?>

  <?php if($archives) { ?>
    <div class="sidebar-block sidebar-archives">
      <h3 class="sidebar-title">Archives</h3>
      <ul id="news-archives-list" class="archives-list"><?php echo $archives; ?></ul>
      <?php if($archive_count > 11) { ?>
        <button type="button" class="archives-toggle" aria-controls="news-archives-list" aria-expanded="false">more&hellip;</button>
      <?php } ?>
    </div>
  <?php } ?>
</div>
