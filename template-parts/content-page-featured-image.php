<?php
/**
 * Template part for displaying page content in page.php
 *
 * @package SPR_Theme
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	<?php spr_theme_post_thumbnail(); ?>
	<div itemprop="articleBody">
		<?php the_content();
		wp_link_pages( [
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'seq-pac-theme' ),
			'after'  => '</div>',
		] ); ?>
	</div>
</article>