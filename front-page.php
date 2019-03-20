<?php
/**
 * The template for displaying all pages
 *
 * @package SPR_Theme
 */

get_header( 'front' ); ?>
	<div id="primary" class="entry-content">
		<main id="main" class="site-main" itemscope itemprop="mainContentOfPage">
		<?php while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'page-front' );
		endwhile; ?>
		</main>
	</div>
<?php get_footer();