<?php
  
  /**
   * Change number of products that are displayed per page (shop page)
   */
  add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );
  
  function new_loop_shop_per_page( $cols ) {
    // $cols contains the current number of products per page based on the value stored on Options -> Reading
    // Return the number of products you wanna show per page.
    $cols = 9;
    return $cols;
  }
  
  remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title');
  add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_title' );
  
  /**
   * Change number or products per row to 3
   */
  add_filter('loop_shop_columns', 'loop_columns', 999);
  if (!function_exists('loop_columns')) {
    function loop_columns() {
      return 3; // 3 products per row
    }
  }
