<h3><?php _e( 'Search','seq-pac-theme' ); ?></h3>
<form class="search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="search" class="screen-reader-text"><?php _e( 'Search for:','seq-pac-theme' ); ?></label>
	<input type="search" class="search" id="search" name="s" value="" placeholder="<?php _e( 'Search','seq-pac-theme' ); ?>" />
	<input type="submit" value="<?php _e( 'Search','seq-pac-theme' ); ?>" class="search-submit" id="search-submit" />
</form>