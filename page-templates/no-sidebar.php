<?php
/**
 * The template for displaying No Sidebar pages
 *
 * Template Name: No Sidebar
 * Template Post Type: post, page
 * Description: Does not load sidebar widgets.
 *
 * @package SPR_Theme
 */

get_header(); ?>

	<div id="primary" class="entry-content">
		<main id="main" class="site-main" itemscope itemprop="mainContentOfPage">

		<?php while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page-no-sidebar' );

		endwhile; // End of the loop.
		?>

		</main>
	</div>

<?php
get_sidebar();
get_footer();