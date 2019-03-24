<?php
/**
 * The sidebar containing the main widget area
 *
 * @package SPR_Theme
 */

?>

<aside id="secondary" class="sidebar">
	<?php if ( is_active_sidebar( 'right-sidebar' ) ) { dynamic_sidebar( 'right-sidebar' ); } ?>
</aside>