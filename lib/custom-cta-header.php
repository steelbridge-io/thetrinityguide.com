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
    
  add_action('genesis_after_header', 'add_fishing_reports');
  
    function add_fishing_reports() {
      if(is_home() || is_front_page()) {
      echo '<div id="guides-reports" class="container-fluid">' .
        '<h2 class="text-center">Fishing Reports From Pro Guide Nathaniel Kyncy</h2>' .
            '<div class="guides-row row">';
      
      $args = array(
        // Arguments for your query.
        'post_type' => 'nathans_report',
      );
      $query = new WP_Query($args);
      if ($query->have_posts()) {
        while ($query->have_posts()) {
          $query->the_post();
          $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
          $alt = get_the_title();
        
          echo '<div class="col-md-3">' .
           
            '<img class="card-img-top" src="' . $featured_img_url . '" alt="' . $alt . '">' .
            '</div>' .
            '<div class="col-md-9">' .
            '<div class="card">' .
            '<div class="card-body">' .
            '<h2 class="card-title"><a href="'. get_the_permalink() .'" title="report-title">' . get_the_title() . '</a></h2>' .
            '<p class="card-text">' . get_the_excerpt() . '</p>' .
            '</div>' .
            '</div>' .
            '</div>';
        
        }
      
      }
    
      // Restore original post data.
      wp_reset_postdata();
    
      echo '</div>' .
        '</div>';
    
    }
  }
  
  
  add_action('genesis_after_header', 'add_shop_section', 10);
  function add_shop_section() {
    if (is_home() || is_front_page()) {
      echo '<div id="ttg-shop" class="fp-shop">';
      dynamic_sidebar('site-shop');
      echo '</div>';
    }
  }
