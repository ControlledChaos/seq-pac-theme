<?php
/**
 * The template for displaying the footer
 *
 * @package SPR_Theme
 */

// Get the site name.
$site_name = esc_attr( get_bloginfo( 'name' ) );

// Copyright HTML.
$copyright = sprintf(
	'<p class="copyright-text" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">&copy; <span class="screen-reader-text">%1s</span><span itemprop="copyrightYear">%2s</span> <span itemprop="copyrightHolder">%3s.</span> %4s.</p>',
	esc_html__( 'Copyright ', 'seq-pac-theme' ),
	get_the_time( 'Y' ),
	$site_name,
	esc_html__( 'All rights reserved', 'seq-pac-theme' )
); ?>

	</div>

	<footer id="colophon" class="site-footer">
		<div class="footer-content global-wrapper footer-wrapper">
			<div class="footer-widgets">
				<?php if ( is_active_sidebar( 'footer-one' ) ) { dynamic_sidebar( 'footer-one' ); } ?>
				<?php if ( is_active_sidebar( 'footer-two' ) ) { dynamic_sidebar( 'footer-two' ); } ?>
			</div>
			<?php echo $copyright; ?>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>
<?php
// Add the sticky menu script.
if ( is_front_page() ) :
echo sprintf(
	'<script>%1s</script>',
	'jQuery(document).ready(function(){
		jQuery( ".front-featured-properties ul" ).slick({
			autoplay : true,
			autoplaySpeed : 7500
		});
	  });'
); endif; ?>
</body>
</html>