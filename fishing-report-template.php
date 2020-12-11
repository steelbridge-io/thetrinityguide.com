<?php
/**
 * Template Name: Fishing Report
 * Template Post Type: post, page, fishing_report
 * Description: Displays a snippet of the most recent fishing reports per category.
 */

remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'fishing_report_loop' ); // Add custom loop

function fishing_report_loop() {
  
  // Intro Text (from page content)
  echo '<div class="page hentry entry">';
  if ( have_posts() ) : while ( have_posts() ) : the_post();
  echo '<h1 class="entry-title">'. get_the_title() .'</h1>';
  echo '<div class="entry-content mb-1618">';
         the_content();
  endwhile;
  echo '</div>';
  endif;
  echo '<div class="entry-content"><hr>';
  $args = array(
    'post_type' => 'fishing_report', // enter your custom post type
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page'=> '12',  // overrides posts per page in theme settings
  );
  $loop = new WP_Query( $args );
  if( $loop->have_posts() ):
    
    while( $loop->have_posts() ): $loop->the_post(); global $post;
      
      echo '<div id="fishing-report-archive">';
      echo '<div class="one-fourth first">';
      echo '<div class="quote-obtuse"><div class="pic">'. get_the_post_thumbnail( $id, array(150,150) ).'</div></div>';
      echo '</div>';
      echo '<div class="three-fourths" style="border-bottom:1px solid #DDD; margin-bottom:1.618em;">';
      echo '<a href="' . get_permalink() . '"><h3>' . get_the_title() . '</h3></a>';
      
      echo '<p>' . get_the_excerpt() . '</p>';
      echo '</div>';
      echo '</div>';
    
    endwhile;
  
  endif;
  
 /* echo '</div><!-- end .entry-content -->';
  echo '</div><!-- end .page .hentry .entry -->';
  echo '<div class="call-to-action" style="text-align:center;margin-bottom:5em;"><h4>Want to get on the water with
 Art? <a href="http://www.artteter.com/contact/">Let him know you are interested!</h4></a></div>'; */
}

/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');

genesis();
