<?php
/**
 * Template part for displaying listings
 *
 * @package SPR_Theme
 */

// Bail if Advanced Custom Fields is not active.
if ( ! class_exists( 'acf' ) ) {
	return;
}

// Get the featured image.
$image = get_field( 'spl_featured_image' );

// Image variables.
$url     = $image['url'];
$title   = $image['title'];
$alt     = $image['alt'];

// Check for our custom image size in the companion plugin.
if ( has_image_size( 'wide-large' ) ) {
	$size = 'wide-large';

// Otherwise use the large size.
} else {
	$size = 'large';
}

// Image size attributes.
$thumb  = $image['sizes'][$size];
$width  = $image['sizes'][$size . '-width'];
$height = $image['sizes'][$size . '-height'];
$srcset = wp_get_attachment_image_srcset( $image['ID'], $size );

// Google map.
$map = get_field( 'spl_google_map' );
?>

<style type="text/css">

.acf-map {
	width: 100%;
	height: 400px;
	border: #ccc solid 1px;
	margin: 20px 0;
}

/* fixes potential theme css conflict */
.acf-map img {
   max-width: inherit !important;
}

</style>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
<script type="text/javascript">
(function($) {

/*
*  new_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

function new_map( $el ) {
	
	// var
	var $markers = $el.find('.marker');
	
	
	// vars
	var args = {
		zoom		: 16,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP
	};
	
	
	// create map	        	
	var map = new google.maps.Map( $el[0], args);
	
	
	// add a markers reference
	map.markers = [];
	
	
	// add markers
	$markers.each(function(){
		
    	add_marker( $(this), map );
		
	});
	
	
	// center map
	center_map( map );
	
	
	// return
	return map;
	
}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/

function add_marker( $marker, map ) {

	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map
	});

	// add to array
	map.markers.push( marker );

	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});

		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {

			infowindow.open( map, marker );

		});
	}

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/

function center_map( map ) {

	// vars
	var bounds = new google.maps.LatLngBounds();

	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	});

	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 16 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}

}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/
// global var
var map = null;

$(document).ready(function(){

	$('.acf-map').each(function(){

		// create map
		map = new_map( $(this) );

	});

});

})(jQuery);
</script>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<h3 class="listing-address">
			<?php the_field( 'spl_street_address' ); ?>
			<?php the_field( 'spl_suite' ); ?>
			<?php the_field( 'spl_post_office' ); ?>
			<?php _e( 'CA' ); ?>
			<?php the_field( 'spl_zip_code' ); ?>
		</h3>
		<p class="listing-type"><?php
		// Get the location(s).
		$locations = get_field( 'spl_listing_type' );
		if ( $locations ) {
			foreach ( $locations as $location ) { echo sprintf( '<span class="location">%1s</span>', $location->name ); };
		} else {
			echo '';
		} ?></p>
		<h3 class="listing-price">$<?php the_field( 'spl_sale_price' ); ?></h3>
		<img class="listing-featured-image" src="<?php echo $thumb; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="<?php echo $alt; ?>" />
	</header>
	<div itemprop="articleBody">
		<div class="listing-description">
			<h2><?php _e( 'Listing Description', 'seq-pac-theme' ); ?></h2>
			<?php the_field( 'spl_description' ); ?>
		</div>
		<div class="listing-details">
			<h2><?php _e( 'Listing Details', 'seq-pac-theme' ); ?></h2>
			<div class="listing-details-list four-wide top">
				<span><strong><?php _e( 'Square Footage:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_square_footage' ); ?></span>
				<span><strong><?php _e( 'Lot Size:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_acreage' ); ?></span>
				<span><strong><?php _e( 'Parcels:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_parcels' ); ?></span>
				<span><strong><?php _e( 'Year Built:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_year_built' ); ?></span>
			</div>
			<div class="listing-details-list four-wide">
				<span><strong><?php _e( 'Stories:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_stories' ); ?></span>
				<span><strong><?php _e( 'Bedrooms:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_bedrooms' ); ?></span>
				<span><strong><?php _e( 'Bathrooms:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_bathrooms' ); ?></span>
				<span><strong><?php _e( 'Garage Spaces:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_garage_spaces' ); ?></span>
			</div>
			<div class="listing-details-list four-wide">
				<span><strong><?php _e( 'Cooling:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_cooling' ); ?></span>
				<span><strong><?php _e( 'Heating:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_heating' ); ?></span>
				<span><strong><?php _e( 'Fireplace:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_fireplace' ); ?></span>
				<span><strong><?php _e( 'Pool:', 'seq-pac-theme' ); ?></strong> <?php the_field( 'spl_pool' ); ?></span>
			</div>
		</div>
		<?php
		// Image gallery.
		$images = get_field( 'spl_image_gallery' );

		if ( $images ) : ?>
		<div class="listing-gallery">
			<h2><?php _e( 'Image Gallery', 'seq-pac-theme' ); ?></h2>
			<ul class="image-gallery">
				<?php foreach( $images as $image ): ?>
					<li>
						<a data-fancybox="images" href="<?php echo $image['url']; ?>">
							<img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
		<?php

if( !empty($map) ):
?>
<div class="listing-map">
	<div class="marker" data-lat="<?php echo $map['lat']; ?>" data-lng="<?php echo $map['lng']; ?>"></div>
</div>
<?php endif; ?>
	</div>
</article>