<?php if( get_row_layout() == 'team_directory' ) {
  $filter_title = get_sub_field('filter_title');
  $team_groups = bellaworks_team_groups();
  $team_filters = array(
    'team-state'    => 'State',
    'team-group'    => 'Team',
    'team-division' => 'Division',
  );
  if( $team_groups ) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable_<?php echo get_row_layout() ?>_<?php echo $i ?>" class="repeatable repeatable_<?php echo get_row_layout() ?>">

      <div class="wrapper">
        <form class="team-filter" aria-labelledby="team-filter-title-<?php echo $i ?>">
          <h2 class="team-filter-title" id="team-filter-title-<?php echo $i ?>"><?php echo esc_html( $filter_title ? $filter_title : 'Select details to find your rep' ); ?></h2>
          <div class="team-filter-fields">
            <?php foreach($team_filters as $taxonomy => $label) {
              $terms = get_terms(array('taxonomy' => $taxonomy, 'hide_empty' => true));
              if( is_wp_error($terms) || !$terms ) continue; ?>
              <div class="team-filter-field">
                <label class="screen-reader-text" for="team-filter-<?php echo esc_attr($taxonomy) ?>"><?php echo esc_html($label) ?></label>
                <select id="team-filter-<?php echo esc_attr($taxonomy) ?>" name="<?php echo esc_attr($taxonomy) ?>" data-filter="<?php echo esc_attr($taxonomy) ?>">
                  <option value=""><?php echo esc_html($label) ?></option>
                  <?php foreach($terms as $term) { ?>
                    <option value="<?php echo esc_attr($term->slug) ?>"><?php echo esc_html($term->name) ?></option>
                  <?php } ?>
                </select>
              </div>
            <?php } ?>
          </div>
          <button type="reset" class="team-filter-reset" hidden>Clear filters</button>
        </form>
      </div>

      <p class="team-results-status screen-reader-text" role="status" aria-live="polite"></p>

      <?php foreach($team_groups as $group) { ?>
        <section class="team-group" data-group="<?php echo esc_attr($group['term']->slug) ?>" aria-labelledby="team-group-<?php echo esc_attr($group['term']->slug) ?>">
          <div class="wrapper">
            <h2 class="section-title center" id="team-group-<?php echo esc_attr($group['term']->slug) ?>"><?php echo esc_html($group['term']->name) ?> Team</h2>
            <ul class="team-grid">
              <?php foreach($group['members'] as $member) {
                include( locate_template('parts/team-card.php') );
              } ?>
            </ul>
          </div>
        </section>
      <?php } ?>

      <div class="wrapper team-no-results" hidden>
        <p>No team members match those details. <button type="button" class="team-filter-clear">Clear filters</button></p>
      </div>

      <dialog class="team-bio-dialog" aria-labelledby="team-bio-dialog-name">
        <div class="team-bio-dialog-inner">
          <button type="button" class="team-bio-close" aria-label="Close bio">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="team-bio-dialog-content"></div>
        </div>
      </dialog>

    </div>
  <?php } ?>
<?php } ?>
