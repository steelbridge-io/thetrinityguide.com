<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );
include_once( get_stylesheet_directory() . '/lib/custom-cta-header.php' );
include_once( get_stylesheet_directory() . '/lib/fishing-report-cpt.php' );
include_once( get_stylesheet_directory() . '/lib/animate-in.php' );
include_once( get_stylesheet_directory() . '/lib/woocommerce.php');
include_once( get_stylesheet_directory() . '/lib/testimonials.php');

add_action('genesis_header', 'add_featured_image', 20);
function add_featured_image()
{
  
  if (is_page() || is_single() & !is_singular('product')) {
    
    if (has_post_thumbnail()) {
      $featured_image = get_the_post_thumbnail();
      echo ' <div class="site-inner featured-img-wrap">';
      
      echo $featured_image;
      
      echo '</div>';
    }
    
  }
}


add_action('genesis_after_header', 'easingslider_after_header_home', 01);
function easingslider_after_header_home() {
  if ( is_home() ) {
    echo '<div id="hero-header">
  <div class="overlay"></div>
  <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <!--<source src="https://storage.googleapis.com/coverr-main/mp4/Mt_Baker.mp4" type="video/mp4">-->
    <source src="https://storage.googleapis.com/thetrinityguide-boat/08/alex-drif-boat-2.mp4" type="video/mp4">
  </video>
  
  <div class="mt-3618 container h-100 d-flex justify-content-center align-items-center">
    <div class="text-center">
      <div class="w-100 text-white">
        <img class="ttg-logo" src="/wp-content/uploads/2017/06/grey-logo-round.png" alt="The Trinity Guide Logo">
        <div class="hero-h2">
          <h2>Guided Fishing<br>530-338-5734</h2>
          <h3>Booking a date is as easy as giving us a call</h3>
        </div>
      </div>
    </div>
  </div>
</div>';
    }
  }
  
//* Set Localization (do not remove)
load_child_theme_textdomain( 'minimum', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'minimum' ) );

//* Add Image upload and Color select to WordPress Theme Customizer
require_once( get_stylesheet_directory() . '/lib/customize.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Minimum Pro Theme', 'minimum' ) );
define( 'CHILD_THEME_URL', 'https://my.studiopress.com/themes/minimum/' );
define( 'CHILD_THEME_VERSION', '3.2.1' );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Enqueue scripts
add_action( 'wp_enqueue_scripts', 'minimum_enqueue_scripts' );
function minimum_enqueue_scripts() {
  
    wp_enqueue_style ( 'custom-style', get_stylesheet_directory_uri() . '/css/custom.css', array(), null, 'all' );
  
   // wp_register_style('font-awesome', 'https://use.fontawesome.com/releases/v5.2.0/css/all.css');
   // wp_enqueue_style('font-awesome');
  
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'minimum-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto:300,400|Roboto+Slab:300,
	400', array(), CHILD_THEME_VERSION );
	wp_enqueue_style ('mailchimp', '//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css', array(), null, 'all' );
  
    wp_enqueue_script( 'minimum-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
  
    wp_register_script( 'jquery3.2.1', 'https://code.jquery.com/jquery-3.2.1.min.js', array(), '3.2.1', true );
    wp_add_inline_script( 'jquery3.2.1', 'var jQuery3_2_1 = $.noConflict(true);' );
 
	wp_enqueue_script('global-js', get_stylesheet_directory_uri() . '/js/global-custom.js', array(), '1.0.0', true );
  
    wp_enqueue_script('parallax-js', get_stylesheet_directory_uri() . '/parallax/parallaxjs/parallax.min.js', array() , '1.4.2', true );
    
    wp_enqueue_script('gravityform-woo', get_stylesheet_directory_uri() . '/js/gravityforms.js', array(), '', true );
    
    wp_register_script( 'font-awesome-js', 'https://kit.fontawesome.com/76342ff491.js', array(), '', true );
    wp_enqueue_script( 'font-awesome-js');
    
    if( is_home()) {
      wp_enqueue_script('slide-in-js', get_stylesheet_directory_uri() . '/js/slide-in-collapse.js', array(), '1.0.0', true);
      wp_register_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js', array(), '5.0', true );
      wp_enqueue_script( 'bootstrap-js');
    }
}

//* Add new image sizes
add_image_size( 'portfolio', 540, 340, TRUE );
add_image_size( 'grid-thumbnail', 230, 230, TRUE );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 320,
	'height'          => 60,
	'header-selector' => '.site-title a',
	'header-text'     => false
) );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'site-tagline',
	'nav',
	'subnav',
	'home-featured',
	'site-inner',
	'footer-widgets',
	'footer'
) );

//* Unregister layout settings
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Remove site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

//* Rename primary and secondary navigation menus
add_theme_support ( 'genesis-menus' , array ( 'primary' => __( 'After Header Menu', 'minimum' ), 'secondary' => __( 'Footer Menu', 'minimum' ) ) );

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_after_header', 'genesis_do_nav', 15 );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 7 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'minimum_secondary_menu_args' );
function minimum_secondary_menu_args( $args ){

	if( 'secondary' != $args['theme_location'] )
	return $args;

	$args['depth'] = 1;
	return $args;
	
}

// Inserts Instafeed
  add_action('genesis_after_header', 'instafeed_the_trinity_guide', 15);
  function instafeed_the_trinity_guide() {
  if (is_home()) {
    echo  '<div id="insta-cont" class="container-fluid">' .
          '<h2 class="insta-title">Instagram Feed&nbsp;<i class="fab fa-instagram"></i>&nbsp;@thetrinityguide</h2>' .
          '<div class="row" id="instafeed">'. do_shortcode('[elfsight_instagram_feed id="1"]') .'</div>' .
          '</div>' .
          '<div class="container-fluid accomodations">' .
            '<h2><a href="/trinity-river-lodging/" title="Accomodations">Need Accomodations? Go To Our Local Accomodations Page <i class="fas fa-hand-point-right"></i></a></h2>' .
          '</div>'
    ;
    }
  }
// Inserts Contact The Trinity Guide
add_action('genesis_after_header', 'contact_the_trinity_guide', 20);
function contact_the_trinity_guide() {
  if (is_home()) {
    echo  '<button id="atag" type="button" class="collapsible align-middle"><span class="h2 no-margin">Open to select your river or lake and book your trip: Click&nbsp;</span><i class="fas fa-2x fa-chevron-circle-right"></i></button>' .
          '<div id="contact-trinity-guide" class="container-fluid contentbook">' .
          '<div class="row flex-wrap-grid align-items-center">' .
      
          '<div class="two-sixths">' .
          '<div class="wrap">' .
          '<h2>Contact The Trinity Guide</h2>' .
          '<p>Select an option and date and I will reply to your email with availability within 24 hours.</p>' .
          '</div>' .
          '</div>' .
      
          '<div class="three-sixths">' .
          '<div class="wrap">' . do_shortcode('[gravityform id=5 title=false description=false ajax=true
          tabindex=49]') . '</div>' .
          '</div>' .
      
          '</div>' .
          '</div>';
  }
}

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'minimum_author_box_gravatar' );
function minimum_author_box_gravatar( $size ) {

	return 144;

}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'minimum_comments_gravatar' );
function minimum_comments_gravatar( $args ) {

	$args['avatar_size'] = 96;
	return $args;

}

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Relocate after entry widget
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );

//* Register widget areas
genesis_register_sidebar( array(
	'id'		  => 'site-logo-text',
	'name'		  => __( 'Site Logo And Text', 'minimum' ),
	'description' => __( 'Adds logo and text to front page hero image', 'minimum' ),
) );
genesis_register_sidebar( array(
	'id'          => 'site-tagline-right',
	'name'        => __( 'Front Page Testimonial And Info', 'minimum' ),
	'description' => __( 'This is the site tagline right section.', 'minimum' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-featured-1',
	'name'        => __( 'Home Featured 1', 'minimum' ),
	'description' => __( 'This is the home featured 1 section.', 'minimum' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-featured-2',
	'name'        => __( 'Home Featured 2', 'minimum' ),
	'description' => __( 'This is the home featured 2 section.', 'minimum' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-featured-3',
	'name'        => __( 'Home Featured 3', 'minimum' ),
	'description' => __( 'This is the home featured 3 section.', 'minimum' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-featured-4',
	'name'        => __( 'Home Featured 4', 'minimum' ),
	'description' => __( 'This is the home featured 4 section.', 'minimum' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-testimonial-2',
	'name'        => __( 'Front Page Testimonial 2', 'minimum' ),
	'description' => __( 'Add a second widget area above the loop', 'minimum' ),
) );
genesis_register_sidebar( array(
    'id'          => 'top-parallax-cta',
    'name'        => __('Top Parallax CTA', 'minimum'),
    'description' => __('Adds text area option for top parallax section', 'minimum')
));
genesis_register_sidebar( array(
	'id'				=> 'sponsors-section',
	'name'				=> __('Sponsors', 'minimum'),
	'description'		=> __('Add a section for sponsors', 'minimum'),
	'before_widget'		=> '<div class="vance-box">',
	'after_widget'		=> '</div>'
));
genesis_register_sidebar( array(
	'id'          => 'cta-parallax',
	'name'        => __( 'Call To Action', 'minimum' ),
	'description' => __( 'Located above the footer with a background image.', 'minimum' ),
) );

//add_action( 'genesis_after_header', 'add_logo_text_header', 0 );
function add_logo_text_header(){
	if (is_home() || is_front_page()) {
		echo '<div class="ttg-logo">';
		dynamic_sidebar ( 'site-logo-text' );
		echo '</div>';
	}
}

// Adds sponsors widget to front page
add_action('genesis_after_content', 'sponsors_section', 15);
function sponsors_section() {
	if (is_home() || is_front_page()) {
		
		dynamic_sidebar ('sponsors-section');
		
	}
}

// TOP PARRALAX
add_action('genesis_before_loop', 'top_para_img', 10);
function top_para_img() {
  if(is_home() || is_front_page()) {
    
    ob_start();
    
    echo '</main>','</div>','</div>','</div>','</div>', '<div id="top-parallax-cta" class=cta-box>','<div
      class="cta">','<div class="cta-container module-seven">';
    
    dynamic_sidebar('top-parallax-cta');
    
    echo '</div>','</div>','<div style=z-index:200; id="topparallax" class="parallax-window" data-parallax=scroll data-image-src=/wp-content/uploads/2019/07/IMG_20190726_123758_720.jpg></div>','</div>','<div class=site-container>','<div class=site-inner>','<div class=wrap>','<div class=content-sidebar-wrap>','<main class=content>';
  
    ob_end_flush();
  }
}

// BOTTOM PARALLAX
add_action( 'genesis_after_content_sidebar_wrap', 'after_content_img', 20 );
function after_content_img() {
	if (is_home() || is_front_page()) {
    
    ob_start();
	  
		echo '</div>', '</div>', '</div>', '<div id="bottom-parallax-cta" class="cta-box">', '<div class="cta">', '<div class="cta-container">';
		dynamic_sidebar ('cta-parallax');
		echo '</div>', '</div>', '<div style="z-index:200;" class="parallax-window" data-parallax="scroll" data-image-src="/wp-content/uploads/2017/06/backstretch-fall.jpg">', '</div>', '</div>';
    
    ob_end_flush();
		
	}
}


// Adds second testimonial section
add_action( 'genesis_before_content', 'front_page_testimonial_two', 15);
function front_page_testimonial_two() {
	if (is_home() || is_front_page()) {
		echo '<div class="fp-testimonial-two">';
		dynamic_sidebar ('front-page-testimonial-2');
		echo '</div>';
	}
}

// Customise the post-info function
add_filter( 'genesis_post_info', 'genesischild_post_info' );
function genesischild_post_info($post_info) {
 if (!is_page()) {
 $post_info = 'Posted on [post_date] [post_edit]';
 return $post_info;
 }
}

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');

// Remove fishing reports from home-page loop
add_action( 'pre_get_posts', 'exclude_category_from_blog' );
function exclude_category_from_blog( $query ) {

    if( $query->is_main_query() && $query->is_home() ) {
        $query->set( 'cat', '-8' );
    }
}

// Add Read More
// Changing excerpt more
function new_excerpt_more($more) {
  global $post;
  return '… <a href="'. get_permalink($post->ID) . '">' . 'Read More &raquo;' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

//* Add the site tagline section. This is the Top area, below hero image.
add_action( 'genesis_after_header', 'minimum_site_tagline');
function minimum_site_tagline() {
  
  printf( '<div %s>', genesis_attr( 'site-tagline' ) );
  genesis_structural_wrap( 'site-tagline' );
  
  printf( '<div %s>', genesis_attr( 'site-tagline-left' ));
  printf( '<p %s>%s</p>', genesis_attr( 'site-description' ), esc_html( get_bloginfo( 'description' ) ) );
  echo '</div>';
  
  if(is_front_page()) {
    printf('<div %s>', genesis_attr('site-tagline-right'));
    genesis_widget_area('site-tagline-right');
    echo '</div>';
  
    genesis_structural_wrap('site-tagline', 'close');
    echo '</div>';
  }
  
}
add_action('wp_body_open', 'custom_content_after_body_open_tag');
function custom_content_after_body_open_tag() {
  ?>
  <div id="wptime-plugin-preloader"></div>
  <?php
}

  function my_custom_css() {
    if (function_exists('is_shop') && is_shop()) {
      echo "<style type='text/css'>.entry-content .woocommerce{display:none;}</style>";
    }
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

 // add_action('wp_head', 'my_custom_css' );
  
  // Find and change Due Date to Pay Guide
 /* $time = 1;
  $path_to_file  	= ABSPATH . 'wp-content/plugins/deposits-for-woocommerce/includes/functions.php';
  $file_content	= file_get_contents($path_to_file);
  $file_contents	=	str_replace("Due Payment", "Pay Guide", $file_content, $time );
  
   file_put_contents($path_to_file, $file_contents); */
