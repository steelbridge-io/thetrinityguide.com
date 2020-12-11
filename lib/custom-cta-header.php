<?php
  
  genesis_register_sidebar( array(
      'id'              		=> 'header-cta',
      'name'         	 	=> __( 'Header CTA', 'wpsites' ),
      'description'  	=> __( 'Text area for the Header', 'wpsites' ),
  ) );
  
  add_action( 'genesis_header', 'ttg_header_cta', 11 );
  function ttg_header_cta() {
    if (is_active_sidebar( 'header-cta' ) ) {
      genesis_widget_area( 'header-cta', array(
          'before' => '<div class="header-ttg-cta top">',
          'after'  => '</div>',
      ) );
    }}