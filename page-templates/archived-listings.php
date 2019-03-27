<?php
/**
 * The template for displaying archived listings
 *
 * Template Name: Properties Sold
 * Template Post Type: page
 * Description: Queries the listings post type that are not active.
 *
 * @package SPR_Theme
 */

// Redirect to home if ACF is not active.
if ( ! class_exists( 'acf_pro' ) ) {
	wp_redirect( home_url(), 302 );
}

get_header(); ?>
	<div id="primary" class="entry-content">
		<main id="main" class="site-main" itemscope itemprop="mainContentOfPage">
		<?php
		// Set this page in pagination as 1 rather than 0.
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} else {
			$paged = 1;
		}

		// Query arguments.
		$args  = [
			'post_type'      => [ 'listing' ],
			'nopaging'       => false,
			'paged'          => $paged,
			'posts_per_page' => 2,
			'order'          => 'DESC',
			'orderby'        => 'date',
			'meta_key'		 => 'spl_listing_status',
			'meta_value'	 => 'archived'
		];

		// The query.
		$query = new WP_Query( $args );

		// Access global variables.
		global $wp_query;

		// Get maximum number of pages for pagination links.
		$wp_query->max_num_pages = $query->max_num_pages;

		// The loop.
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				get_template_part( 'template-parts/content', 'listing-archive' );
			}
		?>
			<nav class="posts-pagination">
				<ul>
					<li class="prev-posts"><?php previous_posts_link( '← Previous Page', $query->max_num_pages ); ?></li>
					<li class="next-posts"><?php next_posts_link( 'Next Page →', $query->max_num_pages ); ?></li>
				</ul>
			</nav>
		<?php
		} else {
			get_template_part( 'template-parts/content', 'none' );
		}

		// Restore original post data.
		wp_reset_postdata(); ?>
		</main>
	</div>
<?php
get_sidebar();
get_footer();