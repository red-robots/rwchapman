<?php if( get_row_layout() == 'counters' ) {
  $counter_data = get_sub_field('counter_data');    
  $section_background_image = get_sub_field('section_background_image');  
  $bg_image = ( $section_background_image ) ? $section_background_image['url'] : '';
  if( $counter_data ) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable_<?php echo get_row_layout() ?>_<?php echo $i ?>" class="repeatable repeatable_<?php echo get_row_layout() ?>">
      <div class="wrapper">
        <div class="counters-wrapper">
          <?php foreach( $counter_data as $counter ) { 
            $number = $counter['number'];
            $description = $counter['description'];
            if($number) {?>
              <div class="counter-item">
                <div class="counter-item-inner">
                  <h3><?php echo $number; ?></h3>
                  <?php if($description) { ?>
                    <p><?php echo $description; ?></p>
                  <?php } ?>
                </div>
              </div>
            <?php } ?>
          <?php } ?>
        </div>
      </div>
      <?php if( $bg_image ) { ?>
        <div class="background-image-overlay">
          <div class="bg-image" style="background-image: url('<?php echo $bg_image ?>');"></div>
          <div class="bg-color"></div>
        </div>
      <?php } ?>
    </div>
  <?php } ?>
<?php } ?>
