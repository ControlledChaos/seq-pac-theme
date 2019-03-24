<?php
/**
 * The template for displaying archive pages
 *
 * @package SPR_Theme
 */

get_header(); ?>
	<div id="primary" class="entry-content">
		<main id="main" class="site-main" itemscope itemprop="mainContentOfPage">
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
			</header>
			<?php while ( have_posts() ) :
				the_post();
				if ( is_post_type_archive( [ 'listing', 'rental' ] ) || is_tax( [ 'location', 'type' ] ) ) {
					get_template_part( 'template-parts/content', 'listing-archive' );
				} else {
					get_template_part( 'template-parts/content', get_post_type() );
				}
			endwhile;
			the_posts_navigation();
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif; ?>
		</main>
	</div>
<?php
get_sidebar();
get_footer();