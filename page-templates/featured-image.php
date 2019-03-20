<?php
/**
 * The template for displaying Featured Image pages
 *
 * Template Name: Featured Image
 * Template Post Type: page
 * Description: Adds the featured image to the top of the page.
 *
 * @package SPR_Theme
 */

get_header(); ?>

	<div id="primary" class="entry-content">
		<main id="main" class="site-main" itemscope itemprop="mainContentOfPage">

		<?php while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page-featured-image' );

		endwhile; // End of the loop.
		?>

		</main>
	</div>

<?php
get_sidebar();
get_footer();
