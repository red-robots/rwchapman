<?php if( get_row_layout() == 'callout_box' ) {
  $title = get_sub_field('title');    
  $button = get_sub_field('button');
  $btnUrl = isset($button['url']) ? $button['url'] : '';
  $btnTitle = isset($button['title']) ? $button['title'] : '';
  $btnTarget = isset($button['target']) ? $button['target'] : '_self';
  $section_background_image = get_sub_field('section_background_image');
  $section_background_image_url = isset($section_background_image['url']) ? $section_background_image['url'] : '';
  $section_background_image_alt = isset($section_background_image['alt']) ? $section_background_image['alt'] : '';
  $section_background_image_title = isset($section_background_image['title']) ? $section_background_image['title'] : '';
  if( $title || $button ) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable_<?php echo get_row_layout() ?>_<?php echo $i ?>" class="repeatable repeatable_<?php echo get_row_layout() ?>">
      <div class="callout-box-inner">
        <div class="wrapper">
          <div class="text-wrapper">
            <?php if($title) { ?>
              <h2 class="section-title"><?php echo $title ?></h2>
            <?php } ?>
            <?php if($btnUrl && $btnTitle) { ?>
              <a href="<?php echo $btnUrl ?>" target="<?php echo $btnTarget ?>" class="button"><?php echo $btnTitle ?></a>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php if($section_background_image_url) { ?>
        <div class="background-image-overlay" style="background-image: url(<?php echo $section_background_image_url ?>);"></div>
      <?php } ?>
    </div>
  <?php } ?>
<?php } ?>
