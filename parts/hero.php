<?php
$static_hero = get_field('static_hero');
$hero_image = ( isset($static_hero['image']) && $static_hero['image'] ) ? $static_hero['image'] : '';
$hero_text = ( isset($static_hero['text']) && $static_hero['text'] ) ? $static_hero['text'] : '';
if($hero_image) { ?>
<section class="hero-banner">
  <div class="hero static-image">
    <?php if($hero_text) { ?>
    <div class="hero-text">
      <div class="hero-text-inner">
        <?php echo anti_email_spam($hero_text); ?>
      </div>
    </div>
    <?php } ?>
    <div class="hero-image" aria-hidden="true" style="background-image: url(<?php echo $hero_image['url']; ?>);"></div>
  </div>
</section>
<?php } ?>