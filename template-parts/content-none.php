<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package SPR_Theme
 */

?>
<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'seq-pac-theme' ); ?></h1>
	</header>
	<div class="page-content" itemprop="articleBody">
		<?php if ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'seq-pac-theme' ); ?></p>
			<?php
			get_search_form();

		elseif ( is_post_type_archive( 'listing' ) ) : ?>

			<p><?php esc_html_e( 'There are currently no listings available for viewing. Please check back soon.', 'seq-pac-theme' ); ?></p>

		<?php elseif ( is_post_type_archive( 'rental' ) ) : ?>

			<p><?php esc_html_e( 'There are currently no rental properties available. Please check back.', 'seq-pac-theme' ); ?></p>

		<?php else : ?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'seq-pac-theme' ); ?></p>
		<?php endif; ?>
	</div>
</section>
