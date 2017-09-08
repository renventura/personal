<?php
/**
 * Personal Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Personal Theme
 */

if ( ! function_exists( 'personaltheme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function personaltheme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Personal Theme, use a find and replace
	 * to change 'personaltheme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'personaltheme', get_template_directory() . '/languages' );

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
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'personaltheme' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'personaltheme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'personaltheme_setup' );
endif;



if ( ! function_exists( 'personaltheme_content_width' ) ) :
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function personaltheme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'personaltheme_content_width', 640 );
}
add_action( 'after_setup_theme', 'personaltheme_content_width', 0 );
endif;



if ( ! function_exists( 'personaltheme_widgets_init' ) ) :
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function personaltheme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'personaltheme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'personaltheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'personaltheme_widgets_init' );
endif;



if ( ! function_exists( 'personaltheme_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function personaltheme_scripts() {

	// Theme
	wp_enqueue_style( 'personaltheme', get_stylesheet_directory_uri() . '/css/main.min.css' );
	wp_enqueue_script( 'personaltheme', get_template_directory_uri() . '/js/scripts.min.js', array( 'jquery' ), '20170313', true );

	// Fonts
	wp_enqueue_style( 'droid-sans', '//fonts.googleapis.com/css?family=Droid+Sans' );
	wp_enqueue_style( 'lato', '//fonts.googleapis.com/css?family=Lato' );
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' );

	// wp_enqueue_script( 'popupoverlay', '//cdn.rawgit.com/vast-engineering/jquery-popup-overlay/1.7.13/jquery.popupoverlay.js', array('jquery'), '1.7.13', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_front_page() ) {
		wp_enqueue_style( 'front-page', get_stylesheet_directory_uri() . '/css/front-page.min.css' );
		wp_enqueue_script( 'typeit', '//cdn.jsdelivr.net/jquery.typeit/4.4.0/typeit.min.js', array('jquery'), '4.4.0', true );
	}
}
add_action( 'wp_enqueue_scripts', 'personaltheme_scripts' );
endif;



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Meta boxes.
 */
require get_template_directory() . '/inc/meta-boxes.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
