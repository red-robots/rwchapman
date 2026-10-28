<?php if( get_row_layout() == 'member_logo' ) {
  $member_logo = get_sub_field('logo');
  $member_text = get_sub_field('text');
  /* Directly after a Title Left / Text Right block, it renders inside that block's left column instead */
  $prev_row = ( isset($flexible_rows[$i-2]) ) ? $flexible_rows[$i-2] : [];
  $merged_into_prev = ( isset($prev_row['acf_fc_layout']) && $prev_row['acf_fc_layout'] == 'title_left_text_right' && ( !empty($prev_row['section_title']) || !empty($prev_row['section_text']) ) );
  if( !$merged_into_prev && ( !empty($member_logo['url']) || $member_text ) ) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable_<?php echo get_row_layout() ?>_<?php echo $i ?>" class="repeatable repeatable_<?php echo get_row_layout() ?>">
      <div class="wrapper">
        <div class="content-inner">
          <?php include( locate_template('parts/member-logo.php') ); ?>
        </div>
      </div>
    </div>
  <?php } ?>
<?php } ?>
