<?php
/**
 * Sequoia Pacific Realty functions
 *
 * @package SPR_Theme
 */

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme setup
 */
if ( ! function_exists( 'spr_theme_setup' ) ) :

	function spr_theme_setup() {

		load_theme_textdomain( 'seq-pac-theme', get_theme_file_path( '/languages' ) );

		// RSS feed links support.
		add_theme_support( 'automatic-feed-links' );

		// Browser title tag support.
		add_theme_support( 'title-tag' );

		// Featured image support.
		add_theme_support( 'post-thumbnails' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		register_nav_menus( [
			'main'   => __( 'Main Menu', 'controlled-chaos' ),
			'footer' => __( 'Footer Menu', 'controlled-chaos' )
		] );

		add_theme_support( 'html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gscreenery',
			'gallery',
			'caption',
		] );

		// Customizer widget refresh support.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Default sizes and crop options.
		update_option( 'thumbnail_size_w', 160 );
		update_option( 'thumbnail_size_h', 160 );
		update_option( 'thumbnail_crop', 1 ); // Hard crop
		update_option( 'medium_size_w', 320 );
		update_option( 'medium_size_h', 240 );
		update_option( 'medium_crop', 1 );
		update_option( 'large_size_w', 960 );
		update_option( 'large_size_h', 720 );
		update_option( 'large_crop', 1 );

		// Add logo support.
		add_theme_support( 'custom-logo', [
			'height'      => 240,
			'width'       => 240,
			'flex-width'  => false,
			'flex-height' => false,
		] );

		/**
		 * Custom header for the front page.
		 */
		add_theme_support( 'custom-header', apply_filters( 'spr_custom_header_args', [
			'default-image'      => get_parent_theme_file_uri( '/assets/images/header.jpg' ),
			'width'              => 2048,
			'height'             => 878,
			'flex-height'        => true,
			'video'              => false,
			'wp-head-callback'   => null
		] ) );

		register_default_headers( [
			'default-image' => [
				'url'           => '%s/assets/images/header.jpg',
				'thumbnail_url' => '%s/assets/images/header.jpg',
				'description'   => __( 'Default Header Image', 'seq-pac-theme' ),
			],
		] );

		// Add stylesheet for the content editor.
		add_editor_style( '/assets/css/editor-style.css', [], '', 'screen' );

	}
endif;
add_action( 'after_setup_theme', 'spr_theme_setup' );

/**
 * Content width
 *
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function spr_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'spr_theme_content_width', 1280 );
}
add_action( 'after_setup_theme', 'spr_theme_content_width', 0 );

/**
 * Filter the `sizes` value in the header image markup
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function spr_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'spr_header_image_tag', 10, 3 );

/**
 * Register widget areas
 *
 */
function spr_theme_widgets_init() {

	register_sidebar( [
		'name'          => esc_html__( 'Sidebar', 'seq-pac-theme' ),
		'id'            => 'right-sidebar',
		'description'   => esc_html__( 'Right hand sidebar on templates that support it.', 'seq-pac-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title sidebar-widget-title">',
		'after_title'   => '</h3>',
	] );

	register_sidebar( [
		'name'          => esc_html__( 'Footer One', 'seq-pac-theme' ),
		'id'            => 'footer-one',
		'description'   => esc_html__( 'Left side of the footer.', 'seq-pac-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title footer-widget-title">',
		'after_title'   => '</h3>',
	] );

	register_sidebar( [
		'name'          => esc_html__( 'Footer Two', 'seq-pac-theme' ),
		'id'            => 'footer-two',
		'description'   => esc_html__( 'Right side of the footer.', 'seq-pac-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title footer-widget-title">',
		'after_title'   => '</h3>',
	] );

}
add_action( 'widgets_init', 'spr_theme_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function spr_theme_scripts() {

	// Disable blocks stylesheet.
	wp_dequeue_style( 'wp-block-library' );

	// Enable jQuery.
	wp_enqueue_script( 'jquery' );

	// Google fonts.
	// wp_enqueue_style( 'seq-pac-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i', [], '', 'screen' );

	// Theme sylesheet.
	wp_enqueue_style( 'seq-pac-theme-style', get_theme_file_uri( 'style.css' ), [], '', 'screen' );

	// Navigation toggle.
	wp_enqueue_script( 'seq-pac-theme-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), [], '', true );

	// Screen reader skip navigation.
	wp_enqueue_script( 'seq-pac-theme-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), [], '', true );

	// Comments scripts.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'spr_theme_scripts' );

/**
 * Remove sections and controls from the Customizer
 */
function spr_customizer_remove( $wp_customize ) {

	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'static_front_page' );
}
add_action( 'customize_register', 'spr_customizer_remove' );

/**
 * Theme dependencies
 */
// require get_theme_file_path( '/inc/custom-header.php' );
require get_theme_file_path( '/inc/template-tags.php' );
require get_theme_file_path( '/inc/template-functions.php' );
require get_theme_file_path( '/inc/customizer.php' );