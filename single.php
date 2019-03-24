<?php
/**
 * The template for displaying all single posts
 *
 * @package SPR_Theme
 */

get_header(); ?>
	<div id="primary" class="entry-content">
		<main id="main" class="site-main" itemscope itemprop="mainContentOfPage">
		<?php while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', get_post_type() );
			// the_post_navigation();
		endwhile; ?>
		</main>
	</div>
<?php
get_sidebar();
get_footer();