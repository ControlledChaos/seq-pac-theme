<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package SPR_Theme
 */

if ( is_home() && ! is_front_page() ) {
    $canonical = get_permalink( get_option( 'page_for_posts' ) );
} elseif ( is_archive() ) {
    $canonical = get_permalink( get_option( 'page_for_posts' ) );
} else {
    $canonical = get_permalink();
}

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
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php $spr_theme_description = get_bloginfo( 'description', 'display' );
				if ( $spr_theme_description || is_customize_preview() ) : ?>
				<p class="site-description"><span class="screen-reader-text"><?php echo $spr_theme_description; ?></span></p><?php endif; ?>
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
	<div id="content" class="site-content global-wrapper">
