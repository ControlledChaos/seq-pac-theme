<?php
/**
 * The template for displaying Featured Image, No Sidebar pages
 *
 * Template Name: Featured Image, No Sidebar
 * Template Post Type: post, page
 * Description: Adds the featured image to the top of the page and does not load sidebar widgets.
 *
 * @package SPR_Theme
 */

get_header(); ?>
	<div id="primary" class="entry-content">
		<main id="main" class="site-main" itemscope itemprop="mainContentOfPage">

		<?php while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page-featured-image-no-sidebar' );

		endwhile; // End of the loop.
		?>

		</main>
	</div>

<?php
get_footer();