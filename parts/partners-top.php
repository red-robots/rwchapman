<?php
$partners = get_field('restaurant_logos', 'option');
if($partners) { ?>
<div class="partners top--partners">
  <?php foreach ($partners as $p) {
    $img = $p['logo'];
    $url = $p['website'];
    $logo_url = (isset($url['url']) && $url['url']) ? $url['url'] : '';
    $logo_text = (isset($url['title']) && $url['title']) ? $url['title'] : '';
    $logo_target = (isset($url['target']) && $url['target']) ? $url['target'] : '_self';
    if($img) { ?>
    <span class="partner">
      <img src="<?php echo $img['url'] ?>" alt="<?php echo $img['title'] ?>" />
    </span>
    <?php } ?>
  <?php } ?>
</div>
<?php } ?>
