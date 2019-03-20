<?php
/**
 * Template part for displaying results in search pages
 *
 * @package SPR_Theme
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
			spr_theme_posted_on();
			spr_theme_posted_by();
			?>
		</div>
		<?php endif; ?>
	</header>
	<?php spr_theme_post_thumbnail(); ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
	<footer class="entry-footer">
		<?php spr_theme_entry_footer(); ?>
	</footer><
</article>