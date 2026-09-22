<?php if( get_row_layout() == 'contact_form' ) {
  $intro_text = get_sub_field('intro_text');
  $form_id = (int) get_sub_field('form');
  if( $intro_text || $form_id ) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable_<?php echo get_row_layout() ?>_<?php echo $i ?>" class="repeatable repeatable_<?php echo get_row_layout() ?>">
      <div class="wrapper">
        <div class="content-inner">
          <?php if($intro_text) { ?>
            <div class="intro-text">
              <?php echo anti_email_spam($intro_text); ?>
            </div>
          <?php } ?>
          <?php if( $form_id && function_exists('gravity_form') ) { ?>
            <div class="contact-form-box">
              <?php gravity_form( $form_id, false, false, false, null, true, 0, true, 'gravity-theme' ); ?>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>
<?php } ?>
