<?php
$taxonomy = 'portfolio-categories';
$terms = get_the_terms( get_the_ID(), $taxonomy );
$termName = ($terms) ? $terms[0]->name : '';
$projectName = get_the_title();
$client = get_field('client');
$location = get_field('location');
$description = get_field('description');
$gallery = get_field('gallery');
$countGallery = ($gallery) ? count($gallery) : 0;
$postId = get_the_ID();
$has_gallery = ($gallery) ? ' data-fancybox="gallery-'.$postId.'" ' : ' data-fancybox="gallery"';
$imageImage = $imageUrl;
?>
<div id="post-item-<?php echo $postId; ?>" data-label="<?php the_title_attribute(); ?>" class="grid-item">
  <figure class="post-thumbnail post-thumbnail-<?php echo $postId?>">
    <a href="javascript:;" class="open-btn" data-src="#popup-item-<?php the_ID(); ?>"<?php echo $has_gallery ?>>
      <img src="<?php echo $imageImage?>" alt="<?php echo get_the_title() ?>">
    </a>
  </figure>
  <?php if ($gallery) { ?>
  <div class="gallery-hidden" style="display:none">
    <?php foreach ($gallery as $img) { ?>
      <a href="<?php echo $img['url'] ?>" class="popup-gallery" role="presentation"<?php echo $has_gallery ?><?php echo $popup_caption ?>>
        <span class="sr-only">Image Gallery Item ID: <?php echo $img['ID']?></span>
      </a>
    <?php } ?>
  </div>  
  <?php } ?>
</div>

<div id="popup-item-<?php the_ID(); ?>" class="custom-fancybox-popup" style="display: none;">
  <div class="popup-container">
    <div class="popup-image-side">
      <img src="<?php echo $imageUrl?>" alt="<?php echo get_the_title() ?>">
    </div>
    <div class="popup-info-side">
      <?php if( $termName || get_the_content() ) { ?>
        <div class="info-box">
          <?php if( $termName ) { ?>
            <div class="category"><?php echo $projectName?></div>
          <?php } ?>
          <?php if($client) { ?>
            <div class="allcap client"><?php echo anti_email_spam($client)?></div>
          <?php } ?>
          <?php if($location) { ?>
            <div class="allcap location"><?php echo anti_email_spam($location)?></div>
          <?php } ?>
          <?php if($description) { ?>
            <div class="description"><?php echo anti_email_spam($description)?></div>
          <?php } ?>
        </div>
      <?php } ?>

      <?php if ($gallery) { ?>
      <div class="custom-nav-wrapper">
        <div class="custom-nav">
            <button class="nav-btn prev-btn" data-main-image="<?php echo $imageImage?>" data-count="<?php echo $countGallery?>" data-index="0" data-gallery-id="<?php echo $postId?>"><span class="sr-only">Previous</span></button>
            <button class="nav-btn next-btn" data-main-image="<?php echo $imageImage?>" data-count="<?php echo $countGallery?>" data-index="1" data-gallery-id="<?php echo $postId?>"><span class="sr-only">Next</span></button>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>