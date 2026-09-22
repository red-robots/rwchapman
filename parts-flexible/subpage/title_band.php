<?php if( get_row_layout() == 'title_band' ) {
  $section_title = get_sub_field('section_title');
  if( $section_title ) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable_<?php echo get_row_layout() ?>_<?php echo $i ?>" class="repeatable repeatable_<?php echo get_row_layout() ?>">
      <div class="wrapper">
        <div class="content-inner">
          <h1 class="section-title"><?php echo anti_email_spam($section_title); ?></h1>
        </div>
      </div>
    </div>
  <?php } ?>
<?php } ?>
