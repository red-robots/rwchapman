<?php
$partners = get_field('restaurant_logos', 'option');
if($partners) { ?>
<div class="partners">
  <?php foreach ($partners as $p) { 
    $img = $p['logo_darker'];
    $url = $p['website'];
    $logo_url = (isset($url['url']) && $url['url']) ? $url['url'] : '';
    $logo_text = (isset($url['title']) && $url['title']) ? $url['title'] : '';
    $logo_target = (isset($url['target']) && $url['target']) ? $url['target'] : '_self';
    if($img) { ?>
    <span class="partner">
      <?php if ($logo_url) { ?>
      <a href="<?php echo $logo_url ?>" target="<?php echo $logo_target ?>">
        <img src="<?php echo $img['url'] ?>" alt="<?php echo $img['title'] ?>" />
      </a>
      <?php } else { ?> 
        <img src="<?php echo $img['url'] ?>" alt="<?php echo $img['title'] ?>" />
      <?php } ?>
    </span>
    <?php } ?>
  <?php } ?> 
</div>
<?php } ?>