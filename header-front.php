<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package SPR_Theme
 */

// Cannonical links.
if ( is_home() && ! is_front_page() ) {
    $canonical = get_permalink( get_option( 'page_for_posts' ) );
} elseif ( is_archive() ) {
    $canonical = get_permalink( get_option( 'page_for_posts' ) );
} else {
    $canonical = get_permalink();
}

// Custom fields, if ACF is active.
if ( class_exists( 'acf' ) ) {
	$overlay = get_field( 'spr_hero_overlay' );
	$message = get_field( 'spr_hero_message' );
	$logo   = get_field( 'spr_hero_logo' );

	if ( $overlay ) {
		$overlay = $overlay;
	} else {
		$overlay = 0;
	}

	if ( $message ) {
		$message = $message;
	} else {
		$message = sprintf(
			'<p>%1s</p>',
			__( 'Three Rivers, Exeter, Porterville, Visalia, and Tulare County, California', 'seq-pac-theme' )
		);
	}

	if ( $logo ) {

		// Image variables.
		$url     = $logo['url'];
		$title   = $logo['title'];
		$alt     = $logo['alt'];

		// Image size attributes.
		$width  = $logo['sizes'][$size . '-width'];
		$height = $logo['sizes'][$size . '-height'];
		$srcset = wp_get_attachment_image_srcset( $logo['ID'], $size );

		$logo  = sprintf(
			'<img class="hero-logo" src="%1s" srcset="%2s" sizes="(max-width: 640px) 640px, (max-width: 960px) 960px, 640px" width="%3s" height="%4s" alt="%5s" />',
			esc_attr( $url ),
			esc_attr( $srcset ),
			esc_attr( $width ),
			esc_attr( $height ),
			esc_attr( $alt )
		);
	} else {
		$logo = null;
	}

// If ACF is not active.
} else {
	$overlay = 35;
	$message = sprintf(
		'<p>%1s</p>',
		__( 'Three Rivers, Exeter, Porterville, Visalia, and Tulare County, California', 'seq-pac-theme' )
	);
	$logo = null;
}

$hero = 'http://localhost/realty/wp-content/themes/seq-pac-theme/assets/images/kaweah-country-banner.jpg';

?>
<!doctype html>
<?php do_action( 'before_html' ); ?>
<html <?php language_attributes(); ?> class="no-js">
<head id="<?php echo get_bloginfo( 'wpurl' ); ?>" data-template-set="<?php echo get_template(); ?>">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open() ) {
		echo sprintf( '<link rel="pingback" href="%s" />', get_bloginfo( 'pingback_url' ) );
	} ?>
	<link href="<?php echo $canonical; ?>" rel="canonical" />
	<?php if ( is_search() ) { echo '<meta name="robots" content="noindex,nofollow" />'; } ?>

	<!-- Prefetch font URLs -->
	<link rel='dns-prefetch' href='//fonts.adobe.com'/>
	<link rel='dns-prefetch' href='//fonts.google.com'/>

	<?php wp_head(); ?>
	<style>.custom-header-media:before { background: rgba(0, 0, 0, 0.<?php echo $overlay; ?>);}</style>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site" itemscope="itemscope" itemtype="<?php spr_site_schema(); ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'seq-pac-theme' ); ?></a>

	<header id="masthead" class="site-header global-wrapper" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">
		<div class="site-branding">
			<div class="site-title-logo">
				<?php the_custom_logo(); ?>
			</div>
			<div class="site-title-description">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php  $spr_theme_description = get_bloginfo( 'description', 'display' );
				if ( $spr_theme_description || is_customize_preview() ) : ?>
				<p class="site-description"><span class="screen-reader-text"><?php echo $spr_theme_description; ?></span></p>
				<?php endif; ?>
			</div>
		</div>
		<div class="site-header-contact">
			<?php echo sprintf( '<p><a href="tel:%1s">%2s %3s</a></p>', '15595612200', esc_html__( 'Phone:', 'seq-pac-theme' ), '559.561.2200' ); ?>
			<?php echo sprintf( '<p><a href="mailto:%1s">%2s</a></p>', esc_attr( 'info@sequoiapacificrealty.com' ), 'info@sequoiapacificrealty.com' ); ?>
		</div>
	</header>
	<nav id="site-navigation" class="main-navigation" role="directory" itemscope itemtype="http://schema.org/SiteNavigationElement">
		<button class="menu-toggle" aria-controls="main-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'seq-pac-theme' ); ?></button>
		<?php
		wp_nav_menu( [
			'theme_location'  => 'main',
			'menu_id'         => 'main-menu',
			'container_class' => 'global-wrapper'
		] ); ?>
	</nav>
	<div class="front-page-hero">
		<div class="front-page-hero-media custom-header-media">
			<?php the_custom_header_markup(); ?>
		</div>
		<div class="front-page-hero-content">
			<div class="global-wrapper">
				<?php echo $logo; ?>
				<?php $spr_theme_description = get_bloginfo( 'description', 'display' );
				if ( $spr_theme_description || is_customize_preview() ) : ?>
				<h3 class="site-description"><?php echo $spr_theme_description; ?></h3>
				<?php echo $message; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div id="content" class="site-content global-wrapper">
