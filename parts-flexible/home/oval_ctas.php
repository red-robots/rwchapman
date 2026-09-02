<?php if( get_row_layout() == 'oval_ctas' ) {
  $section_title = get_sub_field('section_title');    
  $section_text = get_sub_field('section_text');
  $ctas = get_sub_field('ctas');
  if( $section_title || $section_text || $ctas ) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable_<?php echo get_row_layout() ?>_<?php echo $i ?>" class="repeatable repeatable_<?php echo get_row_layout() ?>">
      <div class="content-inner">
        <div class="text-wrapper">
          <div class="wrapper">
            <?php if($section_title) { ?>
              <h2 class="section-title center"><?php echo anti_email_spam($section_title); ?></h2>
            <?php } ?>
            <?php if($section_text) { ?>
              <div class="section-text"><?php echo anti_email_spam($section_text); ?></div>
            <?php } ?>
          </div>
        </div>

        <?php if($ctas) { ?>
        <div class="ctas-grid">
          <div class="wrapper">
            <div class="ctas-grid-inner">
              <?php foreach($ctas as $cta) { 
                $image = $cta['image'];
                $imageUrl = isset($image['url']) ? $image['url'] : '';
                //$imageAlt = isset($image['alt']) ? $image['alt'] : '';
                //$imageTitle = isset($image['title']) ? $image['title'] : '';
                $link = $cta['title_and_link'];
                $ctaUrl = isset($link['url']) ? $link['url'] : '';
                $ctaTarget = isset($link['target']) ? $link['target'] : '_self';
                $ctaTitle = isset($link['title']) ? $link['title'] : '';
                if($ctaTitle && $ctaUrl) { ?>
                <div class="cta">
                  <a href="<?php echo $ctaUrl ?>" target="<?php echo $ctaTarget ?>" class="ctaLink">
                    <span class="ctaName"><span><?php echo $ctaTitle ?></span></span>
                    <?php if($imageUrl) { ?>
                    <span class="ctaImage" style="background-image: url('<?php echo $imageUrl ?>');"></span>
                    <?php } ?>
                  </a>
                </div>
                <?php } ?>
              <?php } ?>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  <?php } ?>
<?php } ?>
