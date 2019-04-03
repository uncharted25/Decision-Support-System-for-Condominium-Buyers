<?php
/**
* Be Page Theme Customizer
*
* @package Be_Page
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'be_page_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function be_page_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Be Page, use a find and replace
		 * to change 'be-page' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'be-page', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'be_page_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'be-page' ),
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
		/*
		* Enable support for Post Formats.
		* See https://developer.wordpress.org/themes/functionality/post-formats/
		*/
		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'gallery',
			'audio',
			'quote'
		) );
		

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		// Add theme editor style.
		add_editor_style( 'assets/editor-style.css' );
	}
endif;
add_action( 'after_setup_theme', 'be_page_setup' );

if ( ! function_exists( 'be_page_content_width' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function be_page_content_width() {
		// This variable is intended to be overruled from themes.
		// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$GLOBALS['content_width'] = apply_filters( 'be_page_content_width', 640 );
	}
	add_action( 'after_setup_theme', 'be_page_content_width', 0 );
endif;

if ( ! function_exists( 'be_page_widgets_init' ) ) :
	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function be_page_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'be-page' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'be-page' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Footer', 'be-page' ),
			'id'            => 'footer',
			'description'   => esc_html__( 'Add Footer widgets here.', 'be-page' ),
			'before_widget' => '<div id="%1$s" class="col-md-3 col-sm-6 %2$s"><div class="widget">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		) );
		
		
		register_sidebar( array(
			'name'          => esc_html__( 'Static Front Page  Slider', 'be-page' ),
			'id'            => 'front_page_sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'be-page' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title screen-reader-text">',
			'after_title'   => '</h3>',
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Blog Page  Slider', 'be-page' ),
			'id'            => 'blog_page_sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'be-page' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title screen-reader-text">',
			'after_title'   => '</h3>',
		) );
		
	}
	add_action( 'widgets_init', 'be_page_widgets_init' );
endif;


if ( ! function_exists( 'be_page_scripts' ) ) :
	/**
	* Enqueue scripts and styles.
	*/
	function be_page_scripts() {
		
		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Poppins:400,500,600,700|Source+Sans+Pro:300,400|Kaushan+Script|Lora|Playfair+Display:700' );
		
		/* Vendors CSS */
		wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/vendors/bootstrap/css/bootstrap.css' ), '3.3.7' );
		wp_enqueue_style( 'font-awesome', get_theme_file_uri( '/vendors/font-awesome/css/font-awesome.css' ), '4.7.0' );
		wp_enqueue_style( 'owl-carousel', get_theme_file_uri( '/vendors/owlcarousel/assets/owl.carousel.css' ), '2.3.4' );
		wp_enqueue_style( 'magnific-popup', get_theme_file_uri( '/vendors/magnific-popup/magnific-popup.css' ), '1.1.0');
	
		wp_enqueue_style( 'be-page-style', get_stylesheet_uri() );
	
		/* Vendors js */
		wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/vendors/bootstrap/js/bootstrap.js' ), 0, '3.3.7', true );
		wp_enqueue_script( 'owl-carousel', get_theme_file_uri( '/vendors/owlcarousel/owl.carousel.js' ), 0, '2.3.4', true );
		wp_enqueue_script( 'magnific-popup', get_theme_file_uri( '/vendors/magnific-popup/jquery.magnific-popup.js' ), 0, '1.1.0', true );
		
		wp_enqueue_script( 'be-page-js', get_template_directory_uri().'/assets/be-page.js', array('jquery'), '1.0.0', true);
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
	}
	add_action( 'wp_enqueue_scripts', 'be_page_scripts' );
endif;

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function be_page_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'be_page_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function be_page_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'be_page_pingback_header' );
