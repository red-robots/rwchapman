<?php if( get_row_layout() == 'title_left_text_right' ) {
  $section_title = get_sub_field('section_title');
  $section_text = get_sub_field('section_text');
  /* A Member Logo block directly after this one is pulled into the left column, under the title */
  $next_row = ( isset($flexible_rows[$i]) ) ? $flexible_rows[$i] : [];
  $member_logo = ( isset($next_row['acf_fc_layout']) && $next_row['acf_fc_layout'] == 'member_logo' && isset($next_row['logo']) ) ? $next_row['logo'] : '';
  $member_text = ( isset($next_row['acf_fc_layout']) && $next_row['acf_fc_layout'] == 'member_logo' && isset($next_row['text']) ) ? $next_row['text'] : '';
  if( $section_title || $section_text ) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable_<?php echo get_row_layout() ?>_<?php echo $i ?>" class="repeatable repeatable_<?php echo get_row_layout() ?><?php echo ( !empty($member_logo['url']) || $member_text ) ? ' has-member-logo' : '' ?>">
      <div class="wrapper">
        <div class="content-inner">
          <?php if($section_title) { ?>
            <div class="content-title">
              <h2><?php echo anti_email_spam($section_title); ?></h2>
            </div>
          <?php } ?>
          <?php if($section_text) { ?>
            <div class="section-text">
              <?php echo anti_email_spam($section_text); ?>
            </div>
          <?php } ?>
          <?php if( !empty($member_logo['url']) || $member_text ) { ?>
            <div class="member-logo-block">
              <?php include( locate_template('parts/member-logo.php') ); ?>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>
<?php } ?>
