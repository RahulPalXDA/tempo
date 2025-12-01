<?php
/**
 * Red Graphic Cambridge functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Red_Graphic_Cambridge
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function red_graphic_cambridge_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Red Graphic Cambridge, use a find and replace
		* to change 'red-graphic-cambridge' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'red-graphic-cambridge', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Header Menu', 'red-graphic-cambridge' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'red_graphic_cambridge_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'red_graphic_cambridge_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function red_graphic_cambridge_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'red_graphic_cambridge_content_width', 640 );
}
add_action( 'after_setup_theme', 'red_graphic_cambridge_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function red_graphic_cambridge_scripts() {

    wp_enqueue_style('font-awesome','//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',array(),'6.5.0');
    wp_enqueue_style('bootstrap-css',get_template_directory_uri().'/assets/css/bootstrap.min.css',array(),null);
    wp_enqueue_style('owl-carousel-css',get_template_directory_uri().'/assets/css/owl.carousel.min.css',array(),null);
    wp_enqueue_style('red-graphic-cambridge-style',get_template_directory_uri().'/assets/css/style.css',array(),_S_VERSION);
    wp_enqueue_style('responsive-css',get_template_directory_uri().'/assets/css/responsive.css',array(),null);
    wp_style_add_data('red-graphic-cambridge-style','rtl','replace');

    // wp_enqueue_script('red-graphic-cambridge-navigation',get_template_directory_uri().'/js/navigation.js',array(),_S_VERSION,true);
    wp_enqueue_script('popper-js',get_template_directory_uri().'/assets/js/popper.min.js',array(),null,true);
    wp_enqueue_script('bootstrap-js',get_template_directory_uri().'/assets/js/bootstrap.min.js',array('popper-js'),null,true);
    wp_enqueue_script('owl-carousel-js',get_template_directory_uri().'/assets/js/owl.carousel.min.js',array('jquery'),null,true);
    wp_enqueue_script('custom-js',get_template_directory_uri().'/assets/js/custom.js',array('jquery'),null,true);

    // if (is_singular() && comments_open() && get_option('thread_comments')) wp_enqueue_script('comment-reply');
}
add_action('wp_enqueue_scripts','red_graphic_cambridge_scripts');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Flexible button renderer (wrapper only if provided)
 * Example wrapper: '<span>' or '<strong>' or '<div class="inner">'
 */
function red_graphic_cambridge_get_link_button( $args = [] ) {

    // Default values
    $defaults = [
        'url'     => '',
        'text'    => '',
        'target'  => '_self',
        'class'   => '',
        'wrapper' => '',
        'acf'     => [], // NEW: pass full ACF link array
    ];

    $args = wp_parse_args( $args, $defaults );

    // If ACF link field is provided, use its values
    if ( !empty($args['acf']) && is_array($args['acf']) ) {
        $acf = $args['acf'];
        $args['url']    = $acf['url']    ?? '';
        $args['text']   = $acf['title']  ?? '';
        $args['target'] = $acf['target'] ?? '_self';
    }

    // Sanitize
    $url     = esc_url( $args['url'] );
    $text    = esc_html( $args['text'] );
    $class   = esc_attr( $args['class'] );
    $target  = esc_attr( $args['target'] );
    $wrapper = $args['wrapper'];

    if ( empty($text) ) return '';

    // Build output
    $output = '<a href="' . $url . '" class="' . $class . '" target="' . $target . '">';

    if ( ! empty($wrapper) ) {
        if ( preg_match('/<([a-zA-Z0-9]+)(.*?)>/', $wrapper, $matches) ) {
            $tag = $matches[1];
            $output .= $wrapper . $text . "</{$tag}>";
        } else {
            $output .= $text;
        }
    } else {
        $output .= $text;
    }

    $output .= '</a>';

    return $output;
}

/**
 * Extend WordPress Search to include Custom Fields (ACF)
 */

// Join the postmeta table
function red_graphic_cambridge_search_join( $join ) {
    global $wpdb;

    if ( is_search() || ( defined('DOING_AJAX') && DOING_AJAX && isset($_POST['action']) && $_POST['action'] == 'live_search' ) ) {
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }

    return $join;
}
add_filter('posts_join', 'red_graphic_cambridge_search_join' );

// Modify the WHERE clause
function red_graphic_cambridge_search_where( $where ) {
    global $wpdb;

    if ( is_search() || ( defined('DOING_AJAX') && DOING_AJAX && isset($_POST['action']) && $_POST['action'] == 'live_search' ) ) {
        if ( isset( $_POST['keyword'] ) ) {
            $keyword = $_POST['keyword']; // For AJAX
        } else {
            $keyword = get_search_query(); // For standard search
        }
        
        $keyword = esc_sql( $wpdb->esc_like( $keyword ) );

        if( !empty($keyword) ){
            $where = preg_replace(
                "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
                "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
        }
    }

    return $where;
}
add_filter( 'posts_where', 'red_graphic_cambridge_search_where' );

// Prevent duplicates
function red_graphic_cambridge_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() || ( defined('DOING_AJAX') && DOING_AJAX && isset($_POST['action']) && $_POST['action'] == 'live_search' ) ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'red_graphic_cambridge_search_distinct' );

/**
 * Helper to get a snippet of text surrounding the keyword
 * Checks Post Content first, then Custom Fields (ACF)
 */
function red_graphic_cambridge_get_search_snippet( $post_id, $keyword ) {
    // 1. Try Main Content
    $content = get_post_field( 'post_content', $post_id );
    $content = strip_shortcodes( $content );
    $content = wp_strip_all_tags( $content );
    
    $snippet = red_graphic_cambridge_extract_snippet( $content, $keyword );
    
    if ( $snippet ) {
        return $snippet;
    }

    // 2. Try Custom Fields (ACF) if not found in content
    $all_meta = get_post_meta( $post_id );
    
    foreach ( $all_meta as $key => $values ) {
        // Skip hidden/protected meta keys (starting with _)
        if ( substr( $key, 0, 1 ) === '_' ) continue;

        foreach ( $values as $value ) {
            // Only check string values (skip arrays/objects)
            if ( is_string( $value ) ) {
                $value = wp_strip_all_tags( $value );
                $meta_snippet = red_graphic_cambridge_extract_snippet( $value, $keyword );
                if ( $meta_snippet ) {
                    return $meta_snippet;
                }
            }
        }
    }

    // 3. Fallback: Return start of main content
    return mb_substr( $content, 0, 100 ) . '...';
}

/**
 * Internal helper to extract text around a keyword
 */
function red_graphic_cambridge_extract_snippet( $text, $keyword ) {
    $text_lower = mb_strtolower( $text );
    $keyword_lower = mb_strtolower( $keyword );
    
    $pos = mb_strpos( $text_lower, $keyword_lower );
    
    if ( $pos === false ) {
        return false;
    }
    
    // Extract context
    $start = max( 0, $pos - 40 );
    $length = 100; // Total length of snippet
    
    $snippet = mb_substr( $text, $start, $length );
    
    // Add ellipsis
    if ( $start > 0 ) $snippet = '...' . $snippet;
    if ( ($start + $length) < mb_strlen( $text ) ) $snippet .= '...';
    
    // Highlight keyword
    $snippet = preg_replace( '/(' . preg_quote( $keyword, '/' ) . ')/i', '<strong class="search-highlight">$1</strong>', $snippet );
    
    return $snippet;
}

/**
 * Reusable function to render an ACF image array
 */
function red_graphic_cambridge_get_acf_image( $args = [] ) {

    // Default values
    $defaults = [
        'acf'           => [],     // Full ACF image array
        'class'         => '',
        'size'          => 'full',
        'alt_fallback'  => '',
        'wrapper_start' => '',
        'wrapper_end'   => '',
    ];

    $args = wp_parse_args( $args, $defaults );

    // Validate ACF array
    if ( empty($args['acf']) || !is_array($args['acf']) ) {
        return '';
    }

    $acf  = $args['acf'];
    $size = $args['size'];

    // Determine image URL
    $url = $acf['sizes'][$size] ?? $acf['url'] ?? '';

    // Determine alt text
    $alt = $acf['alt'] ?? $args['alt_fallback'];

    // Sanitize
    $url   = esc_url($url);
    $alt   = esc_attr($alt);
    $class = esc_attr($args['class']);

    if ( empty($url) ) return '';

    // Build <img>
    $img_html = '<img src="' . $url . '" alt="' . $alt . '" class="' . $class . '">';

    // Wrap if wrapper is defined
    return $args['wrapper_start'] . $img_html . $args['wrapper_end'];
}

/**
 * Reusable function to render social link
 */
function render_social_links( $rows = [] ) {

    if ( empty($rows) || !is_array($rows) ) return;

    foreach ( $rows as $row ) {

        // ACF link field
        $link = $row['link'] ?? null;
        if ( empty($link) ) continue;

        $url     = esc_url( $link['url'] ?? '#' );
        $target  = esc_attr( $link['target'] ?? '_self' );

        // ICON CLASS comes from link TITLE
        $icon    = esc_attr( $link['title'] ?? '' );

        // Skip if no icon class provided
        if ( empty($icon) ) continue;

        echo '<li><a href="'. $url .'" target="'. $target .'"><i class="fa-brands '. $icon .'"></i></a></li>';
    }
}

/**
 * Header menu nav walker
 */
class Custom_Menu_Walker extends Walker_Nav_Menu {

    // Sub-menu UL
    function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu shadow\">\n";
    }

    // Menu item
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {

        $indent = str_repeat("\t", $depth);

        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);

        // <li class="nav-item dropdown"> or <li>
        $li_class = ($depth === 0) ? 'nav-item' : '';
        if ($has_children && $depth === 0) {
            $li_class .= ' dropdown';
        }

        $output .= $indent . '<li class="' . trim($li_class) . '">';

        // --------------------------
        // TOP-LEVEL ITEMS (depth 0)
        // --------------------------
        if ($depth === 0) {

            // FIRST link (main link)
            $output .= '<a class="nav-link" href="' . esc_url($item->url) . '">';
            $output .= esc_html($item->title);
            $output .= '</a>';

            // SECOND link (dropdown toggle)
            if ($has_children) {
                $output .= '<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">';
                $output .= '<i class="fa-solid fa-angle-down"></i>';
                $output .= '</a>';
            }

        } else {

            // --------------------------
            // CHILD ITEMS (depth > 0)
            // --------------------------
            // Add dropdown-item class
            $output .= '<a class="dropdown-item" href="' . esc_url($item->url) . '">';
            $output .= esc_html($item->title);
            $output .= '</a>';
        }
    }

    // End <li>
    function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= "</li>\n";
    }
}

// AJAX live search
add_action('wp_ajax_live_search', 'live_search');
add_action('wp_ajax_nopriv_live_search', 'live_search');

function live_search(){
    $keyword = sanitize_text_field($_POST['keyword']);

    $args = array(
        'post_type' => array('page', 'post'),
        's'         => $keyword,
        'posts_per_page' => 5,
    );

    $query = new WP_Query($args);

    if($query->have_posts()):
        echo '<ul>';

        while($query->have_posts()): $query->the_post();
            $snippet = red_graphic_cambridge_get_search_snippet( get_the_ID(), $keyword );
            echo '<li class="search-suggestion-item" data-link="'.get_permalink().'">';
            echo '<span class="suggestion-title">' . get_the_title() . '</span>';
            if ( $snippet ) {
                echo '<span class="suggestion-snippet">' . $snippet . '</span>';
            }
            echo '</li>';
        endwhile;

        echo '</ul>';
    else:
        echo '<div class="no_data">No results found</div>';
    endif;

    wp_die();
}
