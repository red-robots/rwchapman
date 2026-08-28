<?php if( get_row_layout() == 'three_column_title_middle' ) {
  $content_left = get_sub_field('content_left');    
  $content_title = get_sub_field('content_title');  
  $content_right = get_sub_field('content_right');  
  if( $content_left || $content_title || $content_right) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable_<?php echo get_row_layout() ?>_<?php echo $i ?>" class="repeatable repeatable_<?php echo get_row_layout() ?>">
      <div class="wrapper">
        <?php if( $content_title ) { ?>
          <div class="content-title">
            <h2><?php echo anti_email_spam($content_title); ?></h2>
          </div>
        <?php } ?>

        <?php if( $content_left ) { ?>
          <div class="content-left">
            <?php echo anti_email_spam($content_left); ?>
          </div>
        <?php } ?>
        
        <?php if( $content_right ) { ?>
          <div class="content-right">
            <?php echo anti_email_spam($content_right); ?>
          </div>
        <?php } ?>
      </div>
    </div>
  <?php } ?>
<?php } ?>
