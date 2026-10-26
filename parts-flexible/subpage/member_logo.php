<?php if( get_row_layout() == 'member_logo' ) {
  $logo = get_sub_field('logo');
  $logo_url = ( isset($logo['url']) && $logo['url'] ) ? $logo['url'] : '';
  $logo_alt = ( isset($logo['alt']) && $logo['alt'] ) ? $logo['alt'] : '';
  $text = get_sub_field('text');
  if( $logo_url || $text ) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable_<?php echo get_row_layout() ?>_<?php echo $i ?>" class="repeatable repeatable_<?php echo get_row_layout() ?>">
      <div class="wrapper">
        <div class="content-inner">
          <?php if($logo_url) { ?>
            <figure class="member-logo">
              <img src="<?php echo $logo_url ?>" alt="<?php echo esc_attr($logo_alt) ?>">
            </figure>
          <?php } ?>
          <?php if($text) { ?>
            <div class="member-text">
              <?php echo anti_email_spam($text); ?>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>
<?php } ?>
