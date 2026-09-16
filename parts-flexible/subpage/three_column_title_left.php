<?php if( get_row_layout() == 'three_column_title_left' ) {
  $content_title = get_sub_field('content_title');
  $columns = get_sub_field('columns');
  if( $content_title || $columns ) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable_<?php echo get_row_layout() ?>_<?php echo $i ?>" class="repeatable repeatable_<?php echo get_row_layout() ?>">
      <div class="wrapper">
        <div class="content-inner">
          <?php if($content_title) { ?>
            <div class="content-title">
              <h2><?php echo anti_email_spam($content_title); ?></h2>
            </div>
          <?php } ?>

          <?php if($columns) { ?>
            <?php foreach($columns as $col) {
              $column_title = ( isset($col['column_title']) && $col['column_title'] ) ? $col['column_title'] : '';
              $column_text = ( isset($col['column_text']) && $col['column_text'] ) ? $col['column_text'] : '';
              if($column_title || $column_text) { ?>
                <div class="column">
                  <?php if($column_title) { ?>
                    <h3><?php echo anti_email_spam($column_title); ?></h3>
                  <?php } ?>
                  <?php if($column_text) { ?>
                    <?php echo anti_email_spam($column_text); ?>
                  <?php } ?>
                </div>
              <?php } ?>
            <?php } ?>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>
<?php } ?>
