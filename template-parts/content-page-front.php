<?php
/**
 * Template part for displaying page content in page.php
 *
 * @package SPR_Theme
 */

if ( class_exists( 'acf' ) ) {
	$intro         = get_field( 'spr_intro_content_front' );
	$links_heading = get_field( 'spr_front_image_links_heading' );
} else {
	$intro         = null;
	$links_heading = null;
} ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title screen-reader-text">', '</h2>' ); ?>
	</header>
	<div class="entry-content" itemprop="articleBody">
		<div class="front-intro-content">
			<?php echo $intro; ?>
		</div>
		<div class="front-featured-properties">
			<h2><?php _e( 'Featured Properties', 'seq-pac-theme' ); ?></h2>
		</div>
		<div class="front-image-links">
			<h2><?php echo $links_heading; ?></h2>
		</div>
	</div>
</article>