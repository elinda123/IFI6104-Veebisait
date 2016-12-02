<?php
/**
 * Deadline functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Deadline
 */

if ( ! function_exists( 'deadline_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function deadline_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Deadline, use a find and replace
	 * to change 'deadline' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'deadline', get_template_directory() . '/languages' );

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

	set_post_thumbnail_size( 340, 240, true );
	
	// Featured Post Main Thumbnail on the front page & single page template
	add_image_size( 'deadline-large-thumbnail', 800, 500, true );
	add_image_size( 'deadline-small-thumbnail', 230, 170, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary'	=> esc_html__( 'Primary Menu', 'deadline' ),
		'secondary'	=> esc_html__( 'Secondary Menu', 'deadline' ),
		'footer'	=> esc_html__( 'Footer Menu', 'deadline' ),
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
     * JetPack Infinite Scroll
     */
    add_theme_support( 'infinite-scroll', array(
        'container' => 'recent-posts',
        'type' => 'click',
		'wrapper' => false,
		'render' => 'deadline_infinite_scroll_render',
        'footer' => false,
    ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', deadline_fonts_url() ) );

}
endif; // deadline_setup
add_action( 'after_setup_theme', 'deadline_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function deadline_content_width() {
	
	$GLOBALS['content_width'] = apply_filters( 'deadline_content_width', 720 );

}
add_action( 'after_setup_theme', 'deadline_content_width', 0 );

/* Custom Excerpt Length
==================================== */

function deadline_new_excerpt_length($length) {
	return 30;
}
add_filter('excerpt_length', 'deadline_new_excerpt_length');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function deadline_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'deadline' ),
		'id'            => 'sidebar-main',
		'description'   => esc_html__( 'This is the main sidebar area that appears on all pages', 'deadline' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	) );
}
add_action( 'widgets_init', 'deadline_widgets_init' );


if ( ! function_exists( 'deadline_fonts_url' ) ) :
/**
 * Register Google fonts for Deadline.
 *
 * Create your own deadline_fonts_url() function to override in a child theme.
 *
 * @since Deadline 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function deadline_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'deadline' ) ) {
		$fonts[] = 'Roboto:300,400,500,700';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto Condensed font: on or off', 'deadline' ) ) {
		$fonts[] = 'Roboto+Condensed:300,400,700';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 */
function deadline_scripts() {

	wp_enqueue_style( 'deadline-style', get_stylesheet_uri() );

	// Add Genericons font.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.3.1' );

	wp_enqueue_script(
		'mmenu',
		get_template_directory_uri() . '/js/jquery.mmenu.all.min.js',
		array('jquery'),
		null
	);

	wp_enqueue_script(
		'superfish',
		get_template_directory_uri() . '/js/superfish.min.js',
		array('jquery'),
		null
	);

	wp_enqueue_script( 'deadline-script', get_template_directory_uri() . '/js/deadline.js', array( 'jquery' ), '20150825', true );

	// Loads our default Google Webfont
	wp_enqueue_style( 'deadline-webfonts', '//fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Condensed:300,400,700', array(), null, null );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'deadline_scripts' );

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
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load plugin enhancement file to display admin notices.
 */
require get_template_directory() . '/inc/plugin-enhancements.php';

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Deadline 1.0
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function deadline_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'deadline_widget_tag_cloud_args' );