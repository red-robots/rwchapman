<?php if( get_row_layout() == 'hero' ) {
  $hero_type = get_sub_field('hero_type');
  if( $hero_type=='static' ) { 
    $static = get_sub_field('static');
    $hero_image = ( isset($static['hero_image']) && $static['hero_image'] ) ? $static['hero_image'] : '';
    $hero_image_focal = ( isset($static['hero_image_focal']) && $static['hero_image_focal'] ) ? str_replace('_', ' ', $static['hero_image_focal']) : 'center';
    $hero_text = ( isset($static['hero_text']) && $static['hero_text'] ) ? $static['hero_text'] : '';
    if($hero_image) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?> static-hero">
      <div class="hero-image-inner">
        <div class="heroImage" style="background-image:url('<?php echo $hero_image['url'] ?>');background-position:<?php echo $hero_image_focal ?>"></div>
        <?php if($hero_text) { ?>
        <div class="heroText">
          <div class="text"><?php echo anti_email_spam($hero_text) ?></div>
        </div>
        <?php } ?>
      </div>
    </div>
    <?php } ?>
  <?php } else if($hero_type=='slider') { ?>

    <?php
    $slides = get_sub_field('slider');
    if($slides) { 
    $count = ($slides) ? count($slides) : 0;  ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?> slider-hero">
    <?php if($count==1) { ?>
      <?php foreach($slides as $s) { 
        $image = $s['image'];
        $caption = $s['caption'];
        if($image) { ?>
        <div class="static-hero">  
          <div class="hero-image-inner">
            <div class="heroImage" style="background-image:url('<?php echo $image['url'] ?>');background-position:<?php echo $hero_image_focal ?>"></div>
            <?php if($caption) { ?>
            <div class="heroText">
              <div class="text"><?php echo anti_email_spam($caption) ?></div>
            </div>
            <?php } ?>
          </div>
        </div>
        <?php } ?>  
      <?php } ?>  
    <?php } else { ?>
      <div class="slideshow-wrapper">
        <div class="slideshow swiper swiper-container">
          <div class="swiper-wrapper">
            <?php foreach($slides as $s) { 
              $image = $s['image'];
              $caption = $s['caption'];
              if($image) { ?>
              <div class="swiper-slide slideItem">
                <div class="slideImage" style="background-image:url('<?php echo $image['url'] ?>')"></div>
                <?php if($caption) { ?>
                <div class="slideText">
                  <div class="text"><?php echo anti_email_spam($caption) ?></div>
                </div>
                <?php } ?>
              </div>
              <?php } ?>
            <?php } ?>  
          </div>
          <?php if ($count>1) { ?>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          <?php } ?>
        </div>
      </div>
    <?php } ?>
    </div>
    <?php } ?>

  <?php } ?>
<?php } ?>