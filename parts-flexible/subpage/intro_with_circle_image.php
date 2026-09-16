<?php if( get_row_layout() == 'intro_with_circle_image' ) {
  $section_title = get_sub_field('section_title');
  $section_text = get_sub_field('section_text');
  $buttons = get_sub_field('buttons');
  $image = get_sub_field('image');
  $image_url = ( isset($image['url']) && $image['url'] ) ? $image['url'] : '';
  $image_alt = ( isset($image['alt']) && $image['alt'] ) ? $image['alt'] : '';
  if( $section_title || $section_text ) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable_<?php echo get_row_layout() ?>_<?php echo $i ?>" class="repeatable repeatable_<?php echo get_row_layout() ?>">
      <div class="wrapper">
        <div class="content-inner">
          <div class="text-wrapper">
            <?php if($section_title) { ?>
              <h1 class="section-title"><?php echo anti_email_spam($section_title); ?></h1>
            <?php } ?>
            <div class="text-columns">
              <?php if($section_text) { ?>
                <div class="section-text">
                  <?php echo anti_email_spam($section_text); ?>
                </div>
              <?php } ?>
              <?php if($buttons) { ?>
                <div class="buttons align-left">
                  <?php foreach($buttons as $b) {
                    $button = ( isset($b['button']) && $b['button'] ) ? $b['button'] : '';
                    $btnUrl = isset($button['url']) ? $button['url'] : '';
                    $btnTitle = isset($button['title']) ? $button['title'] : '';
                    $btnTarget = isset($button['target']) ? $button['target'] : '_self';
                    if($btnUrl && $btnTitle) { ?>
                      <a href="<?php echo $btnUrl ?>" target="<?php echo $btnTarget ?>" class="button"><?php echo $btnTitle ?></a>
                    <?php } ?>
                  <?php } ?>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <?php if($image_url) { ?>
        <figure class="circle-image">
          <img src="<?php echo $image_url ?>" alt="<?php echo $image_alt ?>">
        </figure>
      <?php } ?>
    </div>
  <?php } ?>
<?php } ?>
