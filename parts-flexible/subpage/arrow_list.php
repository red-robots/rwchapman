<?php if( get_row_layout() == 'arrow_list' ) {
  $section_title = get_sub_field('section_title');
  $list_items = get_sub_field('list_items');
  $button = get_sub_field('button');
  $btnUrl = isset($button['url']) ? $button['url'] : '';
  $btnTitle = isset($button['title']) ? $button['title'] : '';
  $btnTarget = isset($button['target']) ? $button['target'] : '_self';
  if( $section_title || $list_items ) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable_<?php echo get_row_layout() ?>_<?php echo $i ?>" class="repeatable repeatable_<?php echo get_row_layout() ?>">
      <div class="wrapper">
        <div class="content-inner">
          <?php if($section_title) { ?>
            <h2 class="section-title"><?php echo anti_email_spam($section_title); ?></h2>
          <?php } ?>

          <?php if($list_items) { ?>
            <ul class="arrow-list">
              <?php foreach($list_items as $item) {
                $item_text = ( isset($item['item_text']) && $item['item_text'] ) ? $item['item_text'] : '';
                $link = ( isset($item['link']) && $item['link'] ) ? $item['link'] : '';
                $linkUrl = isset($link['url']) ? $link['url'] : '';
                $linkTarget = isset($link['target']) ? $link['target'] : '_self';
                if($item_text) { ?>
                  <li>
                    <?php if($linkUrl) { ?>
                      <a href="<?php echo $linkUrl ?>" target="<?php echo $linkTarget ?>"><i class="fa-solid fa-circle-arrow-right" aria-hidden="true"></i><span><?php echo anti_email_spam($item_text); ?></span></a>
                    <?php } else { ?>
                      <i class="fa-solid fa-circle-arrow-right" aria-hidden="true"></i><span><?php echo anti_email_spam($item_text); ?></span>
                    <?php } ?>
                  </li>
                <?php } ?>
              <?php } ?>
            </ul>
          <?php } ?>

          <?php if($btnUrl && $btnTitle) { ?>
            <div class="buttons align-left">
              <a href="<?php echo $btnUrl ?>" target="<?php echo $btnTarget ?>" class="button"><?php echo $btnTitle ?></a>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>
<?php } ?>
