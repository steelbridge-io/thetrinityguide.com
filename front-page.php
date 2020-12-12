<?php
  
  //* Minimum custom body class
  function minimum_add_body_class( $classes ) {
    
    $classes[] = 'minimum';
    return $classes;
    
  }
  
  //* Add widget support for homepage if widgets are being used
  add_action( 'genesis_meta', 'minimum_front_page_genesis_meta' );
  function minimum_front_page_genesis_meta() {
    
    if ( is_home() ) {
      
      //* Remove entry meta in entry footer and Genesis loop
      remove_action( 'genesis_loop', 'genesis_do_loop' );
      
      //* Add Genesis grid loop
      add_action( 'genesis_loop', 'minimum_grid_loop_helper' );
      
      //* Remove entry footer functions
      remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
      remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
      remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
      
      //* Force full width content layout
      add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
      
    }
    
    if ( is_active_sidebar( 'home-featured-1' ) || is_active_sidebar( 'home-featured-2' ) || is_active_sidebar( 'home-featured-3' ) || is_active_sidebar( 'home-featured-4' ) ) {
      
      //* Add Home featured Widget areas
      add_action( 'genesis_before_content_sidebar_wrap', 'minimum_home_featured', 15 );
      
    }
  }
  
  //* Add markup for homepage widgets
  function minimum_home_featured() {
    
    printf( '<div %s>', genesis_attr( 'home-featured' ) );
    genesis_structural_wrap( 'home-featured' );
    
    genesis_widget_area( 'home-featured-1', array(
      'before' => '<div class="home-featured-1 widget-area module-three">',
      'after'	 => '</div>',
    ) );
    
    genesis_widget_area( 'home-featured-2', array(
      'before' => '<div class="home-featured-2 widget-area module-four">',
      'after'	 => '</div>',
    ) );
    
    genesis_widget_area( 'home-featured-3', array(
      'before' => '<div class="home-featured-3 widget-area module-five">',
      'after'	 => '</div>',
    ) );
    
    genesis_widget_area( 'home-featured-4', array(
      'before' => '<div class="home-featured-4 widget-area module-six">',
      'after'	 => '</div>',
    ) );
    
    genesis_structural_wrap( 'home-featured', 'close' );
    echo '</div>'; //* end .home-featured
    
  }
  
  //* Genesis grid loop
  function minimum_grid_loop_helper() {
    
    if ( function_exists( 'genesis_grid_loop' ) ) {
      
      genesis_grid_loop( array(
        'features'              => 0,
        'feature_image_size'    => 0,
        'feature_content_limit' => 0,
        'grid_image_size'       => 'grid-thumbnail',
        'grid_content_limit'    => 250,
        'more'                  => __( '[Read more]', 'minimum' ),
      ) );
      
    } else {
      
      genesis_standard_loop();
      
    }
    
  }
  
  genesis();
