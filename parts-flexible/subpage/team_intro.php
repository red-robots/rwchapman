<?php if( get_row_layout() == 'team_intro' ) {
  $section_title = get_sub_field('section_title');
  $section_text = get_sub_field('section_text');
  if( $section_title || $section_text ) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable_<?php echo get_row_layout() ?>_<?php echo $i ?>" class="repeatable repeatable_<?php echo get_row_layout() ?>">
      <div class="territory-map">
        <img src="<?php echo get_stylesheet_directory_uri() ?>/images/team-territory-map.svg" alt="" aria-hidden="true">
      </div>
      <div class="wrapper">
        <div class="content-inner">
          <?php if($section_title) { ?>
            <div class="content-title">
              <h2 class="section-title"><?php echo wp_kses_post($section_title); ?></h2>
            </div>
          <?php } ?>
          <?php if($section_text) { ?>
            <div class="section-text">
              <?php echo anti_email_spam($section_text); ?>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>
<?php } ?>
