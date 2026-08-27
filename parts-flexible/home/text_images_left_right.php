<?php if( get_row_layout() == 'text_images_left_right' ) {
  // $no_margin_top = get_sub_field('no_margin_top');
  // $no_margin_bottom = get_sub_field('no_margin_bottom');
  // $marginTop = ($no_margin_top) ? ' noMarginTop' : '';
  // $marginBottom = ($no_margin_bottom) ? ' noMarginBottom' : '';
  $text_content = get_sub_field('text_content');    
  $images = get_sub_field('images');
  $image_left = ( isset($images['image_left']) && $images['image_left'] ) ? $images['image_left'] : '';
  $image_right = ( isset($images['image_right']) && $images['image_right'] ) ? $images['image_right'] : '';
  if( $text_content) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable_<?php echo get_row_layout() ?>_<?php echo $i ?>" class="repeatable repeatable_<?php echo get_row_layout() ?>">
      <div class="content-inner">
        <?php if( $image_left ) { ?>
          <figure class="feat-image image-left">
            <img src="<?php echo $image_left['url']; ?>" alt="<?php echo $image_left['alt']; ?>">
          </figure>
        <?php } ?>

        <div class="text-wrapper">
          <?php echo anti_email_spam($text_content); ?>
        </div>
        
        <?php if( $image_right ) { ?>
          <figure class="feat-image image-right">
            <img src="<?php echo $image_right['url']; ?>" alt="<?php echo $image_right['alt']; ?>">
          </figure>
        <?php } ?>
      </div>
    </div>
  <?php } ?>
<?php } ?>
