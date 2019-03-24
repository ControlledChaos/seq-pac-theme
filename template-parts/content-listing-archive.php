<?php
/**
 * Template part for displaying listings archives
 *
 * @package SPR_Theme
 */

// Bail if Advanced Custom Fields is not active.
if ( ! class_exists( 'acf' ) ) {
	return;
}

// Get the featured image.
$image = get_field( 'spl_featured_image' );

// Image variables.
$url     = $image['url'];
$title   = $image['title'];
$alt     = $image['alt'];

// Check for our custom image size in the companion plugin.
if ( has_image_size( 'wide-large' ) ) {
	$size = 'wide-large';

// Otherwise use the large size.
} else {
	$size = 'large';
}

// Image size attributes.
$thumb  = $image['sizes'][$size];
$width  = $image['sizes'][$size . '-width'];
$height = $image['sizes'][$size . '-height'];
$srcset = wp_get_attachment_image_srcset( $image['ID'], $size );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'listing-archives-content' ); ?> role="article">
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header>
	<div itemprop="articleBody">
		<div class="featured-details">
			<div>
				<p class="featured-price">$<?php the_field( 'spl_sale_price' ); ?></p>
				<p class="featured-location"><?php
				// Get the location(s).
				$locations = get_field( 'spl_location' );
				if ( $locations ) {
					foreach ( $locations as $location ) { echo sprintf( '<span class="location">%1s</span>', $location->name ); };
				} else {
					echo sprintf( '<span class="location">%1s</span>', get_field( 'spl_post_office' ) );
				} ?></p>
			</div>
			<div>
				<p class="featured-details-link"><a href="<?php the_permalink(); ?>"><?php _e( 'View Details', 'seq-pac-theme' ); ?></a></p>
			</div>
		</div>
		<p><?php the_field( 'spl_summary' ); ?></p>
		<a href="<?php echo esc_url( get_permalink() ); ?>"><img class="listing-featured-image" src="<?php echo $thumb; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="<?php echo $alt; ?>" /></a>
	</div>
</article>