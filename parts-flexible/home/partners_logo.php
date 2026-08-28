<?php if( get_row_layout() == 'partners_logo' ) {
  // $no_margin_top = get_sub_field('no_margin_top');
  // $no_margin_bottom = get_sub_field('no_margin_bottom');
  // $marginTop = ($no_margin_top) ? ' noMarginTop' : '';
  // $marginBottom = ($no_margin_bottom) ? ' noMarginBottom' : '';
  $section_title = get_sub_field('section_title');    
  $section_background_image = get_sub_field('section_background_image');
  $section_bg_url = ( isset($section_background_image['url']) && $section_background_image['url'] ) ? $section_background_image['url'] : '';
  //$partner_logos = get_sub_field('partner_logos');
  $partner_logos_gallery = get_sub_field('partner_logos_gallery');
  if( $section_title) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable_<?php echo get_row_layout() ?>_<?php echo $i ?>" class="repeatable repeatable_<?php echo get_row_layout() ?>">
      <div class="content-inner">
        <div class="text-wrapper">
          <div class="wrapper">
            <h2><?php echo $section_title ?></h2>
          </div>
        </div>
        <?php if($partner_logos_gallery) { ?>
        <div class="partner-logos">
          <div class="wrapper">
            <button type="button" class="custom-slide-nav custom-slide-previous"><span class="sr-only">Previous</span></button>
            <div class="partner-logos-inner owl-carousel">
              <?php foreach($partner_logos_gallery as $img) { 
                $website = get_field('website_url', $img['ID']); ?>
                <figure class="partner-logo item">
                  <?php if($website) { ?>
                    <a href="<?php echo $website ?>" target="_blank">
                      <img src="<?php echo $img['url'] ?>" alt="<?php echo $img['title'] ?>">
                    </a>
                  <?php } else { ?>
                    <img src="<?php echo $img['url'] ?>" alt="<?php echo $img['title'] ?>">
                  <?php } ?>
                </figure>
              <?php } ?>
            </div>
            <button type="button" class="custom-slide-nav custom-slide-next"><span class="sr-only">Next</span></button>
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
