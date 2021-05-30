<?php
  /**
   * Genesis Framework.
   *
   * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
   * Please do all modifications in the form of a child theme.
   *
   * @package Genesis\Header
   * @author  StudioPress
   * @license GPL-2.0-or-later
   * @link    https://my.studiopress.com/themes/genesis/
   */
  
  add_action( 'genesis_doctype', 'genesis_do_doctype' );
  /**
   * Echo the doctype and opening markup.
   *
   * If you are going to replace the doctype with a custom one, you must remember to include the opening <html> and
   * <head> elements too, along with the proper attributes.
   *
   * It would be beneficial to also include the <meta> tag for content type.
   *
   * The default doctype is XHTML v1.0 Transitional, unless HTML support os present in the child theme.
   *
   * @since 1.3.0
   * @since 3.0.0 Removed xhtml logic.
   */
  function genesis_do_doctype() {
    
    genesis_html5_doctype();
    
  }
  
  /**
   * HTML5 doctype markup.
   *
   * @since 2.0.0
   */
  function genesis_html5_doctype() {
    
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes( 'html' ); ?>>
    <head <?php echo genesis_attr( 'head' ); ?>>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <?php // phpcs:ignore Generic.WhiteSpace.ScopeIndent.IncorrectExact -- To keep layout of existing HTML output.
    
  }
  
  add_filter( 'document_title_parts', 'genesis_document_title_parts' );
  /**
   * Filter Document title parts based on context and SEO settings values.
   *
   * @since 2.6.0
   *
   * @param array $parts The document title parts.
   * @return array Return modified array of title parts.
   */
  function genesis_document_title_parts( $parts ) {
    
    $genesis_document_title_parts = new Genesis_SEO_Document_Title_Parts();
    
    return $genesis_document_title_parts->get_parts( $parts );
    
  }
  
  add_filter( 'document_title_separator', 'genesis_document_title_separator' );
  /**
   * Filter Document title parts separator based on SEO setting value.
   *
   * @since 2.6.0
   *
   * @param string $sep The title parts separator.
   * @return string Return modified title parts separator.
   */
  function genesis_document_title_separator( $sep ) {
    
    $sep = genesis_get_seo_option( 'doctitle_sep' );
    
    return $sep ? $sep : '-';
    
  }
  
  add_action( 'get_header', 'genesis_doc_head_control' );
  /**
   * Remove unnecessary code that WordPress puts in the `head`.
   *
   * @since 1.3.0
   */
  function genesis_doc_head_control() {
    
    remove_action( 'wp_head', 'wp_generator' );
    
    if ( ! genesis_get_seo_option( 'head_adjacent_posts_rel_link' ) ) {
      remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
    }
    
    if ( ! genesis_get_seo_option( 'head_wlwmanifest_link' ) ) {
      remove_action( 'wp_head', 'wlwmanifest_link' );
    }
    
    if ( ! genesis_get_seo_option( 'head_shortlink' ) ) {
      remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
    }
    
    if ( is_single() && ! genesis_get_option( 'comments_posts' ) ) {
      remove_action( 'wp_head', 'feed_links_extra', 3 );
    }
    
    if ( is_page() && ! genesis_get_option( 'comments_pages' ) ) {
      remove_action( 'wp_head', 'feed_links_extra', 3 );
    }
    
  }
  
  add_action( 'genesis_meta', 'genesis_seo_meta_description' );
  /**
   * Output the meta description based on contextual criteria.
   *
   * Output nothing if description isn't present.
   *
   * @since 1.2.0
   * @since 2.4.0 Logic moved to `genesis_get_seo_meta_description()`
   *
   * @see genesis_get_seo_meta_description()
   */
  function genesis_seo_meta_description() {
    
    $description = genesis_get_seo_meta_description();
    
    // Add the description if one exists.
    if ( $description ) {
      echo '<meta name="description" content="' . esc_attr( $description ) . '" />' . "\n";
    }
  }
  
  add_action( 'genesis_meta', 'genesis_seo_meta_keywords' );
  /**
   * Output the meta keywords based on contextual criteria.
   *
   * Outputs nothing if keywords are not present.
   *
   * @since 1.2.0
   * @since 2.4.0 Logic moved to `genesis_get_seo_meta_keywords()`
   *
   * @see genesis_get_seo_meta_keywords()
   */
  function genesis_seo_meta_keywords() {
    
    $keywords = genesis_get_seo_meta_keywords();
    
    // Add the keywords if they exist.
    if ( $keywords ) {
      echo '<meta name="keywords" content="' . esc_attr( $keywords ) . '" />' . "\n";
    }
  }
  
  add_action( 'genesis_meta', 'genesis_robots_meta' );
  /**
   * Output the robots meta code in the document `head`.
   *
   * @since 1.0.0
   * @since 2.4.0 Logic moved to `genesis_get_robots_meta_content()`
   *
   * @see genesis_get_robots_meta_content()
   *
   * @return void Return early if blog is not public.
   */
  function genesis_robots_meta() {
    
    // If the blog is private, then following logic is unnecessary as WP will insert noindex and nofollow.
    if ( ! get_option( 'blog_public' ) ) {
      return;
    }
    
    $meta = genesis_get_robots_meta_content();
    
    // Add meta if any exist.
    if ( $meta ) {
      ?>
      <meta name="robots" content="<?php echo esc_attr( $meta ); ?>" />
      <?php
    }
    
  }
  
  add_action( 'genesis_meta', 'genesis_responsive_viewport' );
  /**
   * Outputs the responsive CSS viewport tag.
   *
   * Applies `genesis_viewport_value` filter on content attribute.
   *
   * @since 1.9.0
   * @since 2.7.0 Adds `minimum-scale=1` when AMP URL.
   * @since 3.0 Do not check if theme support `genesis-responsive-viewport`
   *
   * @return void Return early if child theme does not support `genesis-responsive-viewport`.
   */
  function genesis_responsive_viewport() {
    /**
     * Filter the viewport meta tag value.
     *
     * @since 2.3.0
     *
     * @param string $viewport_default Default value of the viewport meta tag.
     */
    $viewport_value = apply_filters( 'genesis_viewport_value', 'width=device-width, initial-scale=1' );
    
    // If the web page is an AMP URL and `minimum-scale` is missing, add it.
    if ( genesis_is_amp() && strpos( $viewport_value, 'minimum-scale' ) === false ) {
      $viewport_value .= ',minimum-scale=1';
    }
    
    printf(
        '<meta name="viewport" content="%s" />' . "\n",
        esc_attr( $viewport_value )
    );
    
  }
  
  add_action( 'wp_head', 'genesis_load_favicon' );
  /**
   * Echo favicon link.
   *
   * @since 1.0.0
   * @since 2.4.0 Logic moved to `genesis_get_favicon_url()`.
   *
   * @see genesis_get_favicon_url()
   *
   * @return void Return early if WP Site Icon is used.
   */
  function genesis_load_favicon() {
    
    // Use WP site icon, if available.
    if ( function_exists( 'has_site_icon' ) && has_site_icon() ) {
      return;
    }
    
    $favicon = genesis_get_favicon_url();
    
    if ( $favicon ) {
      echo '<link rel="icon" href="' . esc_url( $favicon ) . '" />' . "\n";
    }
    
  }
  
  add_action( 'wp_head', 'genesis_do_meta_pingback' );
  /**
   * Adds the pingback meta tag to the head so that other sites can know how to send a pingback to our site.
   *
   * @since 1.3.0
   */
  function genesis_do_meta_pingback() {
    
    if ( 'open' === get_option( 'default_ping_status' ) ) {
      echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '" />' . "\n";
    }
    
  }
  
  add_action( 'wp_head', 'genesis_paged_rel' );
  /**
   * Output rel links in the head to indicate previous and next pages in paginated archives and posts.
   *
   * @link https://webmasters.googleblog.com/2011/09/pagination-with-relnext-and-relprev.html
   *
   * @since 2.2.0
   *
   * @return void Return early if doing a Customizer preview.
   */
  function genesis_paged_rel() {
    
    global $wp_query;
    
    $next = '';
    $prev = $next;
    
    $paged = (int) get_query_var( 'paged' );
    $page  = (int) get_query_var( 'page' );
    
    if ( ! is_singular() ) {
      $prev = $paged > 1 ? get_previous_posts_page_link() : $prev;
      $next = $paged < $wp_query->max_num_pages ? get_next_posts_page_link( $wp_query->max_num_pages ) : $next;
    } else {
      // No need for this on previews.
      if ( is_preview() ) {
        return;
      }
      
      $numpages = substr_count( $wp_query->post->post_content, '<!--nextpage-->' ) + 1;
      
      if ( $numpages && ! $page ) {
        $page = 1;
      }
      
      if ( $page > 1 ) {
        $prev = genesis_paged_post_url( $page - 1 );
      }
      
      if ( $page < $numpages ) {
        $next = genesis_paged_post_url( $page + 1 );
      }
    }
    
    if ( $prev ) {
      printf( '<link rel="prev" href="%s" />' . "\n", esc_url( $prev ) );
    }
    
    if ( $next ) {
      printf( '<link rel="next" href="%s" />' . "\n", esc_url( $next ) );
    }
    
  }
  
  add_action( 'wp_head', 'genesis_meta_name' );
  /**
   * Output meta tag for site name.
   *
   * @since 2.2.0
   *
   * @return void Return early if not HTML5 or not front page.
   */
  function genesis_meta_name() {
    
    if ( ! is_front_page() ) {
      return;
    }
    
    printf( '<meta itemprop="name" content="%s" />' . "\n", esc_html( get_bloginfo( 'name' ) ) );
    
  }
  
  add_action( 'wp_head', 'genesis_meta_url' );
  /**
   * Output meta tag for site URL.
   *
   * @since 2.2.0
   *
   * @return void Return early if not HTML5 or not front page.
   */
  function genesis_meta_url() {
    
    if ( ! is_front_page() ) {
      return;
    }
    
    printf( '<meta itemprop="url" content="%s" />' . "\n", esc_url( trailingslashit( home_url() ) ) );
    
  }
  
  add_action( 'wp_head', 'genesis_canonical', 5 );
  /**
   * Echo custom canonical link tag.
   *
   * Remove the default WordPress canonical tag, and use our custom
   * one. Gives us more flexibility and effectiveness.
   *
   * @since 1.0.0
   */
  function genesis_canonical() {
    
    // Remove the WordPress canonical.
    remove_action( 'wp_head', 'rel_canonical' );
    
    $canonical = genesis_canonical_url();
    
    if ( $canonical ) {
      printf( '<link rel="canonical" href="%s" />' . "\n", esc_url( apply_filters( 'genesis_canonical', $canonical ) ) );
    }
    
  }
  
  add_filter( 'genesis_header_scripts', 'do_shortcode' );
  add_action( 'wp_head', 'genesis_header_scripts' );
  /**
   * Echo header scripts in to wp_head().
   *
   * Allows shortcodes.
   *
   * Applies `genesis_header_scripts` filter on value stored in header_scripts setting.
   *
   * Also echoes scripts from the post's custom field.
   *
   * @since 1.0.0
   */
  function genesis_header_scripts() {
    
    echo apply_filters( 'genesis_header_scripts', genesis_get_option( 'header_scripts' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Need to output scripts.
    
    // If singular, echo scripts from custom field.
    if ( is_singular() ) {
      genesis_custom_field( '_genesis_scripts' );
    }
    
  }
  
  add_action( 'genesis_before', 'genesis_page_specific_body_scripts' );
  /**
   * Output page-specific body scripts if their position is set to 'top'.
   *
   * If the position is 'bottom' or null, output occurs in genesis_footer_scripts() instead.
   *
   * @since 2.5.0
   */
  function genesis_page_specific_body_scripts() {
    
    if ( ! is_singular() ) {
      return;
    }
    
    if ( 'top' === genesis_get_custom_field( '_genesis_scripts_body_position' ) ) {
      genesis_custom_field( '_genesis_scripts_body' );
    }
    
  }
  
  add_action( 'after_setup_theme', 'genesis_custom_header' );
  /**
   * Activate the custom header feature.
   *
   * It gets arguments passed through add_theme_support(), defines the constants, and calls `add_custom_image_header()`.
   *
   * Applies `genesis_custom_header_defaults` filter.
   *
   * @since 1.6.0
   *
   * @return void Return early if `custom-header` or `genesis-custom-header` are not supported in the theme.
   */
  function genesis_custom_header() {
    
    $wp_custom_header = get_theme_support( 'custom-header' );
    
    // If WP custom header is active, no need to continue.
    if ( $wp_custom_header ) {
      return;
    }
    
    $genesis_custom_header = get_theme_support( 'genesis-custom-header' );
    
    // If Genesis custom is not active, do nothing.
    if ( ! $genesis_custom_header ) {
      return;
    }
    
    // Blog title option is obsolete when custom header is active.
    add_filter( 'genesis_pre_get_option_blog_title', '__return_empty_array' );
    
    // Cast, if necessary.
    $genesis_custom_header = isset( $genesis_custom_header[0] ) && is_array( $genesis_custom_header[0] ) ? $genesis_custom_header[0] : array();
    
    // Merge defaults with passed arguments.
    $args = wp_parse_args(
        $genesis_custom_header,
        apply_filters(
            'genesis_custom_header_defaults',
            array(
                'width'                 => 960,
                'height'                => 80,
                'textcolor'             => '333333',
                'no_header_text'        => false,
                'header_image'          => '%s/images/header.png',
                'header_callback'       => '',
                'admin_header_callback' => '',
            )
        )
    );
    
    // Push $args into theme support array.
    add_theme_support(
        'custom-header',
        array(
            'default-image'       => sprintf( $args['header_image'], get_stylesheet_directory_uri() ),
            'header-text'         => $args['no_header_text'] ? false : true,
            'default-text-color'  => $args['textcolor'],
            'width'               => $args['width'],
            'height'              => $args['height'],
            'random-default'      => false,
            'header-selector'     => '.site-header',
            'wp-head-callback'    => $args['header_callback'],
            'admin-head-callback' => $args['admin_header_callback'],
        )
    );
    
  }
  
  add_action( 'wp_head', 'genesis_custom_header_style' );
  /**
   * Custom header callback.
   *
   * It outputs special CSS to the document head, modifying the look of the header based on user input.
   *
   * @since 1.6.0
   *
   * @return void Return early if `custom-header` not supported, user specified own callback, or no options set.
   */
  function genesis_custom_header_style() {
    
    // Do nothing if custom header not supported.
    if ( ! current_theme_supports( 'custom-header' ) ) {
      return;
    }
    
    // Do nothing if user specifies their own callback.
    if ( get_theme_support( 'custom-header', 'wp-head-callback' ) ) {
      return;
    }
    
    $output = '';
    
    $header_image = get_header_image();
    $text_color   = get_header_textcolor();
    
    // If no options set, don't waste the output. Do nothing.
    if ( empty( $header_image ) && ! display_header_text() && get_theme_support( 'custom-header', 'default-text-color' ) === $text_color ) {
      return;
    }
    
    $header_selector = get_theme_support( 'custom-header', 'header-selector' );
    $title_selector  = '.custom-header .site-title';
    $desc_selector   = '.custom-header .site-description';
    
    // Header selector fallback.
    if ( ! $header_selector ) {
      $header_selector = '.custom-header .site-header';
    }
    
    // Header image CSS, if exists.
    if ( $header_image ) {
      $output .= sprintf( '%s { background: url(%s) no-repeat !important; }', $header_selector, esc_url( $header_image ) );
    }
    
    // Header text color CSS, if showing text.
    if ( display_header_text() && get_theme_support( 'custom-header', 'default-text-color' ) !== $text_color ) {
      $output .= sprintf( '%2$s a, %2$s a:hover, %3$s { color: #%1$s !important; }', esc_html( $text_color ), esc_html( $title_selector ), esc_html( $desc_selector ) );
    }
    
    if ( $output ) {
      printf( '<style type="text/css">%s</style>' . "\n", $output ); // phpcs:ignore  WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped.
    }
    
  }
  
  add_action( 'genesis_header', 'genesis_header_markup_open', 5 );
  /**
   * Echo the opening structural markup for the header.
   *
   * @since 1.2.0
   */
  function genesis_header_markup_open() {
    
    genesis_markup(
        array(
            'open'    => '<header %s>',
            'context' => 'site-header',
        )
    );
    
    genesis_structural_wrap( 'header' );
    
  }
  
  add_action( 'genesis_header', 'genesis_header_markup_close', 15 );
  /**
   * Echo the opening structural markup for the header.
   *
   * @since 1.2.0
   */
  /*function genesis_header_markup_close() {
    
    genesis_structural_wrap( 'header', 'close' );
    genesis_markup(
        array(
            'close'   => '</header>',
            'context' => 'site-header',
        )
    );
    
  }*/
  
  add_action( 'genesis_header', 'genesis_do_header' );
  /**
   * Echo the default header, including the #title-area div, along with #title and #description, as well as the .widget-area.
   *
   * Does the `genesis_site_title`, `genesis_site_description` and `genesis_header_right` actions.
   *
   * @since 1.0.2
   *
   * @global $wp_registered_sidebars Holds all of the registered sidebars.
   */
  function genesis_do_header() {
    
    global $wp_registered_sidebars;
    
    genesis_markup(
        array(
            'open'    => '<div class="booom" %s>',
            'context' => 'title-area',
        )
    );
    
    /**
     * Fires inside the title area, before the site description hook.
     *
     * @since 2.6.0
     */
    do_action( 'genesis_site_title' );
    
    /**
     * Fires inside the title area, after the site title hook.
     *
     * @since 1.0.0
     */
    do_action( 'genesis_site_description' );
    
    genesis_markup(
        array(
            'close'   => '</div>',
            'context' => 'title-area',
        )
    );
    
    if ( has_action( 'genesis_header_right' ) || ( isset( $wp_registered_sidebars['header-right'] ) && is_active_sidebar( 'header-right' ) ) ) {
      
      genesis_markup(
          array(
              'open'    => '<div %s>',
              'context' => 'header-widget-area',
          )
      );
      
      /**
       * Fires inside the header widget area wrapping markup, before the Header Right widget area.
       *
       * @since 1.5.0
       */
      do_action( 'genesis_header_right' );
      add_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
      add_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
      dynamic_sidebar( 'header-right' );
      remove_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
      remove_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
      
      genesis_markup(
          array(
              'close'   => '</div>',
              'context' => 'header-widget-area',
          )
      );
      
      genesis_markup(
          array(
              'open'  => '<div id="ttg-cta">',
              'context' => 'header-cta',
          )
      );
      
      genesis_markup(
          array(
              'close' => '</div>',
              'context' => 'header-cta',
          )
      );
      
    }
    
  }
  
  add_action( 'genesis_site_title', 'genesis_seo_site_title' );
  /**
   * Echo the site title into the header.
   *
   * Depending on the SEO option set by the user, this will either be wrapped in an `h1` or `p` element.
   *
   * Applies the `genesis_seo_title` filter before echoing.
   *
   * @since 1.1.0
   */
  function genesis_seo_site_title() {
    
    // Set what goes inside the wrapping tags.
    $inside = wp_kses_post( sprintf( '<a href="%s">%s</a>', trailingslashit( home_url() ), get_bloginfo( 'name' ) ) );
    
    // Determine which wrapping tags to use.
    $wrap = genesis_is_root_page() && 'title' === genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : 'p';
    
    // A little fallback, in case an SEO plugin is active.
    $wrap = genesis_is_root_page() && ! genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : $wrap;
    
    // Wrap homepage site title in p tags if static front page.
    $wrap = is_front_page() && ! is_home() ? 'p' : $wrap;
    
    // And finally, $wrap in h1 if HTML5 & semantic headings enabled.
    $wrap = genesis_get_seo_option( 'semantic_headings' ) ? 'h1' : $wrap;
    
    /**
     * Site title wrapping element
     *
     * The wrapping element for the site title.
     *
     * @since 2.2.3
     *
     * @param string $wrap The wrapping element (h1, h2, p, etc.).
     */
    $wrap = apply_filters( 'genesis_site_title_wrap', $wrap );
    
    // Build the title.
    $title = genesis_markup(
        array(
            'open'    => sprintf( "<{$wrap} %s>", genesis_attr( 'site-title' ) ),
            'close'   => "</{$wrap}>",
            'content' => $inside,
            'context' => 'site-title',
            'echo'    => false,
            'params'  => array(
                'wrap' => $wrap,
            ),
        )
    );
    
    /**
     * The SEO title filter
     *
     * Allows the entire SEO title to be filtered.
     *
     * @since ???
     *
     * @param string $title  The SEO title.
     * @param string $inside The inner portion of the SEO title.
     * @param string $wrap   The html element to wrap the title in.
     */
    $title = apply_filters( 'genesis_seo_title', $title, $inside, $wrap );
    
    echo $title; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- sanitize done prior to filter application
  }
  
  add_action( 'genesis_site_description', 'genesis_seo_site_description' );
  /**
   * Echo the site description into the header.
   *
   * Depending on the SEO option set by the user, this will either be wrapped in an `h1` or `p` element.
   *
   * Applies the `genesis_seo_description` filter before echoing.
   *
   * @since 1.1.0
   */
  function genesis_seo_site_description() {
    
    // Set what goes inside the wrapping tags.
    $inside = esc_html( get_bloginfo( 'description' ) );
    
    // Determine which wrapping tags to use.
    $wrap = genesis_is_root_page() && 'description' === genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : 'p';
    
    // Wrap homepage site description in p tags if static front page.
    $wrap = is_front_page() && ! is_home() ? 'p' : $wrap;
    
    // And finally, $wrap in h2 if HTML5 & semantic headings enabled.
    $wrap = genesis_get_seo_option( 'semantic_headings' ) ? 'h2' : $wrap;
    
    /**
     * Site description wrapping element
     *
     * The wrapping element for the site description.
     *
     * @since 2.2.3
     *
     * @param string $wrap The wrapping element (h1, h2, p, etc.).
     */
    $wrap = apply_filters( 'genesis_site_description_wrap', $wrap );
    
    // Build the description.
    $description = genesis_markup(
        array(
            'open'    => sprintf( "<{$wrap} %s>", genesis_attr( 'site-description' ) ),
            'close'   => "</{$wrap}>",
            'content' => $inside,
            'context' => 'site-description',
            'echo'    => false,
            'params'  => array(
                'wrap' => $wrap,
            ),
        )
    );
    
    // Output (filtered).
    $output = $inside ? apply_filters( 'genesis_seo_description', $description, $inside, $wrap ) : '';
    
    echo $output;
    
  }
  
  /**
   * Sets attributes for the custom menu widget if used in the Header Right widget area.
   *
   * @since 1.9.0
   *
   * @param array $args Navigation menu arguments.
   * @return array $args Arguments for custom menu widget used in Header Right widget area.
   */
  function genesis_header_menu_args( $args ) {
    
    $args['container']   = '';
    $args['link_before'] = $args['link_before'] ? $args['link_before'] : sprintf( '<span %s>', genesis_attr( 'nav-link-wrap' ) );
    $args['link_after']  = $args['link_after'] ? $args['link_after'] : '</span>';
    $args['menu_class'] .= ' genesis-nav-menu';
    $args['menu_class'] .= genesis_superfish_enabled() ? ' js-superfish' : '';
    
    return $args;
    
  }
  
  /**
   * Wrap the header navigation menu in its own nav tags with markup API.
   *
   * @since 2.0.0
   *
   * @param string $menu Menu output.
   * @return string $menu Modified menu output, or original if not HTML5.
   */
  function genesis_header_menu_wrap( $menu ) {
    
    return genesis_markup(
        array(
            'open'    => sprintf( '<nav %s>', genesis_attr( 'nav-header' ) ),
            'close'   => '</nav>',
            'content' => $menu,
            'context' => 'header-nav',
            'echo'    => false,
        )
    );
    
  }
  
  add_action( 'genesis_before_header', 'genesis_skip_links', 5 );
  /**
   * Add skip links for screen readers and keyboard navigation.
   *
   * @since 2.2.0
   *
   * @return void Return early if skip links are not supported.
   */
  function genesis_skip_links() {
    
    if ( ! genesis_a11y( 'skip-links' ) ) {
      return;
    }
    
    // Call function to add IDs to the markup.
    genesis_skiplinks_markup();
    
    // Determine which skip links are needed.
    $links = array();
    
    if ( genesis_nav_menu_supported( 'primary' ) && has_nav_menu( 'primary' ) ) {
      $links['genesis-nav-primary'] = esc_html__( 'Skip to primary navigation', 'genesis' );
    }
    
    $links['genesis-content'] = esc_html__( 'Skip to content', 'genesis' );
    
    if ( 'full-width-content' !== genesis_site_layout() ) {
      $links['genesis-sidebar-primary'] = esc_html__( 'Skip to primary sidebar', 'genesis' );
    }
    
    if ( in_array( genesis_site_layout(), array( 'sidebar-sidebar-content', 'sidebar-content-sidebar', 'content-sidebar-sidebar' ), true ) ) {
      $links['genesis-sidebar-secondary'] = esc_html__( 'Skip to secondary sidebar', 'genesis' );
    }
    
    if ( current_theme_supports( 'genesis-footer-widgets' ) ) {
      $footer_widgets = get_theme_support( 'genesis-footer-widgets' );
      if ( isset( $footer_widgets[0] ) && is_numeric( $footer_widgets[0] ) && is_active_sidebar( 'footer-1' ) ) {
        $links['genesis-footer-widgets'] = esc_html__( 'Skip to footer', 'genesis' );
      }
    }
    
    /**
     * Filter the skip links.
     *
     * @since 2.2.0
     *
     * @param array $links {
     *     Default skiplinks.
     *
     *     @type string HTML ID attribute value to link to.
     *     @type string Anchor text.
     * }
     */
    $links = (array) apply_filters( 'genesis_skip_links_output', $links );
    
    // Write HTML, skiplinks in a list.
    $skiplinks = '<ul class="genesis-skip-link">';
    
    // Add markup for each skiplink.
    foreach ( $links as $key => $value ) {
      $skiplinks .= '<li><a href="' . esc_url( '#' . $key ) . '" class="screen-reader-shortcut"> ' . $value . '</a></li>';
    }
    
    $skiplinks .= '</ul>';
    
    echo $skiplinks;
    
  }

