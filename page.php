<?php
/**
 * The template for displaying all pages
 *
 * @package SPR_Theme
 */

get_header(); ?>

	<div id="primary" class="entry-content">
		<main id="main" class="site-main" itemscope itemprop="mainContentOfPage">

		<?php while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>

		</main>
	</div>

<?php
get_sidebar();
get_footer();