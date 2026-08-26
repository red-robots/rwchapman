	</div><!-- #content -->
	
  <?php  
  // $company_group_logo = get_field('company_group_logo', 'option');
  // $company_website = get_field('company_website', 'option');
  // $office_address = get_field('office_address', 'option');
  // $office_phone = get_field('office_phone', 'option');
  // $footer_message = get_field('footer_message', 'option');
  // $restaurant_logos = get_field('restaurant_logos', 'option');
  $social_media = get_field('social_media_links', 'option');
  $footerContactInfo = get_field('footer_contact_information', 'option');
  ?>
  <footer id="colophon" class="site-footer site-footer-v2" role="contentinfo">
    <div class="wrapper">
      <div class="flexwrap">
        <div class="flexcol site-icon"></div>
        
        <div class="flexgroup">
          <?php if($footerContactInfo) { ?> 
            <div class="flexcol footerContact">
              <div class="textwrap">
                <?php echo anti_email_spam($footerContactInfo) ?>
              </div>
            </div>
          <?php } ?>
          
          <div class="flexcol footerQuickLinks">
            <?php if( has_nav_menu('footer') ) { 
              wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu','link_before'=>'<span>','link_after'=>'</span>','items_wrap'=>'<ul id="%1$s" class="%2$s">%3$s</ul>') ); ?>
            <?php } ?> 
          </div>
        </div>
        
        <div class="copyright-container">
          <?php if($social_media) { ?>
            <div class="social-media-links">
              <?php foreach($social_media as $social) {
                if($social['url'] && $social['icon']) { 
                  $socialName = getCleanDomainName($social['url']);
                  $socialName = ucwords($socialName);
                  $socialSlug = strtolower($socialName);
                  ?>
                  <a href="<?php echo $social['url'] ?>" target="_blank" class="social-icon social-icon-<?php echo $socialSlug; ?>">
                    <?php echo $social['icon']; ?>
                    <span class="sr-only">Visit our <?php echo $socialName; ?></span>
                  </a>
                <?php } ?>
              <?php } ?>
            </div>
          <?php } ?>
          <div class="copyright">
            <span>&copy; <?php echo get_bloginfo('name') ?> <?php echo date('Y') ?></span>
          </div>
        </div>
        
      </div>
    </div>
  </footer>

</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
