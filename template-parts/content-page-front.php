<?php
/**
 * Template part for displaying page content in page.php
 *
 * @package SPR_Theme
 */

/**
 * Set up fields from Advanced Custom Fields
 */
$use_image_links = get_field( 'spr_front_image_links_use' );
$links_heading   = get_field( 'spr_front_image_links_heading' );

if ( $links_heading ) {
	$links_heading = $links_heading;
} else {
	$links_heading = __( 'Featured Services', 'seq-pac-theme' );
} ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title screen-reader-text">', '</h2>' ); ?>
	</header>
	<div itemprop="articleBody">
		<div class="front-intro-content">
			<?php the_field( 'spr_intro_content_front' ); ?>
		</div>
		<?php
		// Featured listings loop.
		$args = [
			'post_type'     => [ 'listing' ],
			'tag_slug__and' => [ 'featured' ]
		];
		$query = new WP_Query( $args );

		/**
		 * If there is at least one listing marked as featured then
		 * disply the Featured Properties section.
		 */
		if ( $query->have_posts() ) : ?>
		<section class="front-featured-properties">
			<h2><?php _e( 'Featured Properties', 'seq-pac-theme' ); ?></h2>
			<ul>
			<?php while ( $query->have_posts() ) : ?>
				<?php $query->the_post();

				// Get the listing fields.

				?>
				<li>
					<div class="featured-details">
						<div>
							<h4><?php the_title(); ?></h4>
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
					<?php
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
					<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="<?php echo $alt; ?>" /></a>
				</li>
			<?php endwhile; ?>
			</ul>
		</section>
		<?php else :
			/**
			 * If there are no listings marked as featured then
			 * this section will be ignored.
			 */
		endif;
		// Restore original Post Data
		wp_reset_postdata(); ?>

		<?php if ( $use_image_links ) : ?>
		<section class="front-image-links">
			<h2><?php echo $links_heading; ?></h2>
			<div class="front-image-links-message">
				<?php the_field( 'spr_front_image_links_message' ); ?>
			</div>
			<?php if ( have_rows( 'spr_front_image_links' ) ) : ?>
			<ul>
			<?php while ( have_rows( 'spr_front_image_links' ) ) : the_row();

				// Get fields.
				$image = get_sub_field( 'spr_front_image_link_image' );
				$text  = get_sub_field( 'spr_front_image_link_text' );
				$link  = get_sub_field( 'spr_front_image_link_url' );

				// Image variables.
				$url     = $image['url'];
				$title   = $image['title'];
				$alt     = $image['alt'];

				// Check for our custom image size in the companion plugin.
				if ( has_image_size( 'wide-medium' ) ) {
					$size = 'wide-medium';

				// Otherwise use the medium size.
				} else {
					$size = 'medium';
				}

				// Image size attributes.
				$thumb  = $image['sizes'][$size];
				$width  = $image['sizes'][$size . '-width'];
				$height = $image['sizes'][$size . '-height'];
				$srcset = wp_get_attachment_image_srcset( $image['ID'], $size );
				?>
				<li><a href="<?php echo $link; ?>">
					<figure>
						<img src="<?php echo $thumb; ?>" srcset="<?php echo esc_attr( $srcset ); ?>" sizes="(max-width: 640px) 640px, (max-width: 960px) 960px, 640px" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="<?php echo $alt; ?>" />
						<figcaption><?php echo $text; ?></figcaption>
					</figure>
				</a></li>
			<?php endwhile; ?>
			</ul>
			<?php endif; ?>
		</section>
		<?php endif; ?>
	</div>
</article>