<?php
/* Member logo + text. Expects $member_logo (ACF image array) and $member_text. */
$member_logo_url = ( isset($member_logo['url']) && $member_logo['url'] ) ? $member_logo['url'] : '';
$member_logo_alt = ( isset($member_logo['alt']) && $member_logo['alt'] ) ? $member_logo['alt'] : '';
?>
<?php if($member_logo_url) { ?>
  <figure class="member-logo">
    <img src="<?php echo $member_logo_url ?>" alt="<?php echo esc_attr($member_logo_alt) ?>">
  </figure>
<?php } ?>
<?php if($member_text) { ?>
  <div class="member-text">
    <?php echo anti_email_spam($member_text); ?>
  </div>
<?php } ?>
