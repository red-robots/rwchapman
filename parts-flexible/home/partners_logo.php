<?php if( get_row_layout() == 'partners_logo' ) {
  // $no_margin_top = get_sub_field('no_margin_top');
  // $no_margin_bottom = get_sub_field('no_margin_bottom');
  // $marginTop = ($no_margin_top) ? ' noMarginTop' : '';
  // $marginBottom = ($no_margin_bottom) ? ' noMarginBottom' : '';
  $section_title = get_sub_field('section_title');    
  $section_background_image = get_sub_field('section_background_image');
  $section_bg_url = ( isset($section_background_image['url']) && $section_background_image['url'] ) ? $section_background_image['url'] : '';
  $partner_logos = get_sub_field('partner_logos');
  if( $section_title) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable_<?php echo get_row_layout() ?>_<?php echo $i ?>" class="repeatable repeatable_<?php echo get_row_layout() ?>">
      <div class="content-inner">
        <div class="text-wrapper">
          <div class="wrapper">
            <h2><?php echo $section_title ?></h2>
          </div>
        </div>
        <?php if($partner_logos) { ?>
        <div class="partner-logos">
          <div class="wrapper">
            <div class="partner-logos-inner">
              <?php foreach($partner_logos as $partner_logo) { 
                $logo = $partner_logo['logo'];
                $website = $partner_logo['url'];
                if($logo) { ?>
                <figure class="partner-logo">
                  <?php if($website) { ?>
                    <a href="<?php echo $website ?>" target="_blank">
                      <img src="<?php echo $logo['url'] ?>" alt="<?php echo $logo['alt'] ?>">
                    </a>
                  <?php } else { ?>
                    <img src="<?php echo $logo['url'] ?>" alt="<?php echo $logo['alt'] ?>">
                  <?php } ?>
                </figure>
                <?php } ?>
              <?php } ?>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <?php if($section_bg_url) { ?>
      <div class="background-image-overlay" style="background-image: url(<?php echo $section_bg_url ?>);"></div>
      <?php } ?>
    </div>
  <?php } ?>
<?php } ?>
