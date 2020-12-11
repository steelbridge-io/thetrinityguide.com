<?php

if ( ! function_exists('fishing_report_cpt') ) {

// Register Custom Post Type
  function fishing_report_cpt() {
    
    $labels = array(
      'name'                  => _x( 'Fishing Reports', 'Post Type General Name', 'thetrinityguide' ),
      'singular_name'         => _x( 'Fishing Report', 'Post Type Singular Name', 'thetrinityguide' ),
      'menu_name'             => __( 'Fishing Report', 'thetrinityguide' ),
      'name_admin_bar'        => __( 'Fishing Report', 'thetrinityguide' ),
      'archives'              => __( 'Fishing Report Archives', 'thetrinityguide' ),
      'attributes'            => __( 'Item Attributes', 'thetrinityguide' ),
      'parent_item_colon'     => __( 'Parent Item:', 'thetrinityguide' ),
      'all_items'             => __( 'All Items', 'thetrinityguide' ),
      'add_new_item'          => __( 'Add New Item', 'thetrinityguide' ),
      'add_new'               => __( 'Add New', 'thetrinityguide' ),
      'new_item'              => __( 'New Item', 'thetrinityguide' ),
      'edit_item'             => __( 'Edit Item', 'thetrinityguide' ),
      'update_item'           => __( 'Update Item', 'thetrinityguide' ),
      'view_item'             => __( 'View Item', 'thetrinityguide' ),
      'view_items'            => __( 'View Items', 'thetrinityguide' ),
      'search_items'          => __( 'Search Item', 'thetrinityguide' ),
      'not_found'             => __( 'Not found', 'thetrinityguide' ),
      'not_found_in_trash'    => __( 'Not found in Trash', 'thetrinityguide' ),
      'featured_image'        => __( 'Featured Image', 'thetrinityguide' ),
      'set_featured_image'    => __( 'Set featured image', 'thetrinityguide' ),
      'remove_featured_image' => __( 'Remove featured image', 'thetrinityguide' ),
      'use_featured_image'    => __( 'Use as featured image', 'thetrinityguide' ),
      'insert_into_item'      => __( 'Insert into item', 'thetrinityguide' ),
      'uploaded_to_this_item' => __( 'Uploaded to this item', 'thetrinityguide' ),
      'items_list'            => __( 'Items list', 'thetrinityguide' ),
      'items_list_navigation' => __( 'Items list navigation', 'thetrinityguide' ),
      'filter_items_list'     => __( 'Filter items list', 'thetrinityguide' ),
    );
    $rewrite = array(
      'slug'                  => 'fishing-report',
      'with_front'            => true,
      'pages'                 => true,
      'feeds'                 => true,
    );
    $args = array(
      'label'                 => __( 'Fishing Report', 'thetrinityguide' ),
      'description'           => __( 'Fishing Reports', 'thetrinityguide' ),
      'labels'                => $labels,
      'supports'              => array( 'author', 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats' ),
      'taxonomies'            => array( 'post_tag', 'category' ),
      'hierarchical'          => false,
      'public'                => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 5,
      'menu_icon'             => 'dashicons-admin-post',
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'can_export'            => true,
      'has_archive'           => 'fishing-reports',
      'exclude_from_search'   => false,
      'publicly_queryable'    => true,
      'rewrite'               => $rewrite,
      'capability_type'       => 'page',
      'show_in_rest'          => true,
    );
    register_post_type( 'fishing_report', $args );
    
  }
  add_action( 'init', 'fishing_report_cpt', 0 );
  
}

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_topics_hierarchical_taxonomy', 0 );

//create a custom taxonomy name it topics for your posts

function create_topics_hierarchical_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
  
  $labels = array(
    'name' => _x( 'Report Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Report Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Reports Categories' ),
    'all_items' => __( 'All Reports Categories' ),
    'parent_item' => __( 'Parent Report Categories' ),
    'parent_item_colon' => __( 'Parent Report Category:' ),
    'edit_item' => __( 'Edit Report Category' ),
    'update_item' => __( 'Update Report Category' ),
    'add_new_item' => __( 'Add New Report Category' ),
    'new_item_name' => __( 'New Report Category Name' ),
    'menu_name' => __( 'Fishing Report Category' ),
  );

// Now register the taxonomy
  
  register_taxonomy('report_categories',array('fishing_report'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'fishing-news' ),
    'show_in_rest'          => true
  ));
  
}