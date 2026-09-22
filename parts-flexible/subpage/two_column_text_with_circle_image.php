<?php if( get_row_layout() == 'two_column_text_with_circle_image' ) {
  $column_left = get_sub_field('column_left');
  $column_right = get_sub_field('column_right');
  $button = get_sub_field('button');
  $btnUrl = isset($button['url']) ? $button['url'] : '';
  $btnTitle = isset($button['title']) ? $button['title'] : '';
  $btnTarget = isset($button['target']) ? $button['target'] : '_self';
  $image = get_sub_field('image');
  $image_url = ( isset($image['url']) && $image['url'] ) ? $image['url'] : '';
  $image_alt = ( isset($image['alt']) && $image['alt'] ) ? $image['alt'] : '';
  if( $column_left || $column_right ) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable_<?php echo get_row_layout() ?>_<?php echo $i ?>" class="repeatable repeatable_<?php echo get_row_layout() ?>">
      <div class="wrapper">
        <div class="content-inner">
          <div class="text-columns">
            <?php if($column_left) { ?>
              <div class="column column-left">
                <?php echo anti_email_spam($column_left); ?>
              </div>
            <?php } ?>
            <?php if($column_right || ($btnUrl && $btnTitle)) { ?>
              <div class="column column-right">
                <?php if($column_right) { ?>
                  <?php echo anti_email_spam($column_right); ?>
                <?php } ?>
                <?php if($btnUrl && $btnTitle) { ?>
                  <div class="buttons align-left">
                    <a href="<?php echo $btnUrl ?>" target="<?php echo $btnTarget ?>" class="button"><?php echo $btnTitle ?></a>
                  </div>
                <?php } ?>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php if($image_url) { ?>
        <figure class="circle-image">
          <img src="<?php echo $image_url ?>" alt="<?php echo $image_alt ?>">
        </figure>
      <?php } ?>
    </div>
  <?php } ?>
<?php } ?>
