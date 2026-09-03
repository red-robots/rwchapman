	</div><!-- #content -->
	
  <?php  
  $footerLogo = get_field('footer_logo', 'option');
  ?>
  <footer id="colophon" class="site-footer" role="contentinfo">
    <div class="wrapper">
      <?php if($footerLogo) { ?>
        <div class="footer-logo">
          <img src="<?php echo $footerLogo['url']; ?>" alt="<?php echo $footerLogo['alt']; ?>">
        </div>
      <?php } ?>

      <?php
      $office_address = get_field('office_address', 'option');
      $office_phone = get_field('office_phone', 'option');
      $office_email = get_field('office_email', 'option');
      $social_media = get_field('social_media_links', 'option');
      ?>

      <div class="flexwrap">
        <?php if($office_phone) { ?>
          <div class="footer-column footer-column-phone">
            <p><?php echo $office_phone; ?></p>
          </div>
        <?php } ?>
        <?php if($office_address) { ?>
          <div class="footer-column footer-column-address">
            <p><?php echo $office_address; ?></p>
          </div>
        <?php } ?>
        
        <?php if($office_email) { ?>
          <div class="footer-column footer-column-email">
            <p>
              <?php if( filter_var(trim($office_email), FILTER_VALIDATE_EMAIL) ) { ?>  
                <a href="mailto:<?php echo antispambot(trim($office_email),1); ?>"><?php echo antispambot(trim($office_email)); ?></a>
              <?php } ?>
            </p>
          </div>
        <?php } ?>
      </div>

      <div class="footer-social-links">
        <?php if($social_media) { ?>
          <ul>
          <?php foreach($social_media as $social) { ?>
            <?php if( $social['link'] && $social['icon'] ) { ?>
            <li><a href="<?php echo $social['link']; ?>" target="_blank" rel="noopener noreferrer"><?php echo $social['icon']; ?></a></li>
            <?php } ?>
          <?php } ?>
          </ul>
        <?php } ?>
      </div>
    </div>
  </footer>

</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
