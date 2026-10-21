<?php
/**
 * Team member card with its bio, used by the team_directory layout.
 * Expects $member (WP_Post).
 */
$member_id = $member->ID;
$member_name = get_the_title($member);
$member_first_name = strtok( trim($member_name), ' ' );
$photo = get_field('photo', $member_id);
$photo_url = ($photo) ? $photo['sizes']['medium_large'] : '';
$photo_alt = ($photo && $photo['alt']) ? $photo['alt'] : $member_name;
$job_title = trim( (string) get_field('job_title', $member_id, false) );
$education = trim( (string) get_field('education', $member_id, false) );
$email = get_field('email', $member_id);
$phone = get_field('phone', $member_id);
$mobile_phone = get_field('mobile_phone', $member_id);
$bio = trim($member->post_content);
$initials = '';
foreach( preg_split('/\s+/', preg_replace('/\(.*?\)/', '', $member_name)) as $part ) {
  $initials .= ($part) ? mb_substr($part, 0, 1) : '';
}
$initials = mb_substr($initials, 0, 1) . ( mb_strlen($initials) > 1 ? mb_substr($initials, -1) : '' );
$bio_id = 'team-bio-' . $member->post_name;

ob_start(); ?>
  <figure class="team-photo">
    <?php if($photo_url) { ?>
      <img src="<?php echo esc_url($photo_url) ?>" alt="<?php echo esc_attr($photo_alt) ?>" loading="lazy">
    <?php } else { ?>
      <span class="team-photo-placeholder" aria-hidden="true"><?php echo esc_html($initials) ?></span>
    <?php } ?>
  </figure>
<?php $photo_markup = ob_get_clean(); ?>
<li class="team-card"
  data-team-state="<?php echo esc_attr( bellaworks_team_term_slugs($member_id, 'team-state') ) ?>"
  data-team-group="<?php echo esc_attr( bellaworks_team_term_slugs($member_id, 'team-group') ) ?>"
  data-team-division="<?php echo esc_attr( bellaworks_team_term_slugs($member_id, 'team-division') ) ?>">
  <button type="button" class="team-card-button" data-bio="<?php echo esc_attr($bio_id) ?>" aria-haspopup="dialog">
    <?php echo $photo_markup; ?>
    <span class="team-name"><?php echo esc_html($member_name) ?></span>
    <?php if($job_title) { ?>
      <span class="team-title"><?php echo nl2br( esc_html($job_title) ) ?></span>
    <?php } ?>
    <span class="screen-reader-text">View bio</span>
  </button>

  <template id="<?php echo esc_attr($bio_id) ?>">
    <div class="team-bio">
      <div class="team-bio-photo"><?php echo $photo_markup; ?></div>
      <div class="team-bio-main">
        <h2 class="team-bio-name" id="team-bio-dialog-name"><?php echo esc_html($member_name) ?></h2>
        <?php if($job_title) { ?>
          <p class="team-bio-title"><?php echo esc_html( preg_replace('/\s*\n\s*/', ' ', $job_title) ) ?></p>
        <?php } ?>
        <?php if($bio) { ?>
          <div class="team-bio-text"><?php echo apply_filters('the_content', $bio); ?></div>
        <?php } ?>
      </div>
      <div class="team-bio-details">
        <?php if($education) { ?>
          <div class="team-bio-detail">
            <h3>Education</h3>
            <p><?php echo nl2br( esc_html($education) ) ?></p>
          </div>
        <?php } ?>
        <?php if($email || $phone || $mobile_phone) { ?>
          <div class="team-bio-detail">
            <h3>Connect with <?php echo esc_html($member_first_name) ?></h3>
            <?php if($email) { ?>
              <p><a href="mailto:<?php echo antispambot($email) ?>"><?php echo antispambot($email) ?></a></p>
            <?php } ?>
            <?php if($phone) { ?>
              <p><a href="tel:<?php echo esc_attr( preg_replace('/[^0-9+]/', '', $phone) ) ?>"><?php echo esc_html($phone) ?></a><?php echo ($mobile_phone) ? ' <span class="phone-label">(office)</span>' : ''; ?></p>
            <?php } ?>
            <?php if($mobile_phone) { ?>
              <p><a href="tel:<?php echo esc_attr( preg_replace('/[^0-9+]/', '', $mobile_phone) ) ?>"><?php echo esc_html($mobile_phone) ?></a> <span class="phone-label">(mobile)</span></p>
            <?php } ?>
          </div>
        <?php } ?>
        <div class="team-bio-detail">
          <h3><a href="<?php echo esc_url( bellaworks_team_vcard_url($member_id) ) ?>" class="team-vcard" download>Download vCard</a></h3>
        </div>
      </div>
    </div>
  </template>
</li>
