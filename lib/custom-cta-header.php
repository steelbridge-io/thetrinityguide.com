<?php
  
  genesis_register_sidebar( array(
      'id'              		=> 'header-cta',
      'name'         	 	=> __( 'Header CTA', 'wpsites' ),
      'description'  	=> __( 'Text area for the Header', 'wpsites' ),
  ) );
  
  genesis_register_sidebar( array(
    'id'          => 'site-shop',
    'name'        => __( 'Front Page Shop', 'minimum' ),
    'description' => __( 'Front Page Shop.', 'minimum' ),
  ) );
  
  add_action( 'genesis_header', 'ttg_header_cta', 11 );
  function ttg_header_cta() {
    if (is_active_sidebar( 'header-cta' ) ) {
      genesis_widget_area( 'header-cta', array(
          'before' => '<div class="header-ttg-cta top">',
          'after'  => '</div>',
      ) );
    }}
  
  
  add_action('genesis_after_header', 'add_shop_section', 10);
  function add_shop_section() {
    if (is_home() || is_front_page()) {
      echo '<div id="ttg-shop" class="fp-shop">';
      dynamic_sidebar('site-shop');
      echo '</div>';
    }
  }
