<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package SPR_Theme
 */

?>
<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'No Content Available', 'seq-pac-theme' ); ?></h1>
	</header>
	<div class="page-content" itemprop="articleBody">
		<?php echo sprintf(
			'<p>%1s <a href="%2s" target="_blank">%3s</a> %4s</p>',
			__( 'This page\'s content cannot be loaded because it requires the', 'seq-pac-theme' ),
			esc_attr( esc_url( 'https://www.advancedcustomfields.com/pro' ) ),
			'Advanced Custom Fields Pro',
			__( 'plugin to be installed and activated.', 'seq-pac-theme' )
		); ?>
	</div>
</section>
