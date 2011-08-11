<?php
// ------------------------
// PRINT A NIVO SLIDER using the ATTACHED IMAGES for the CURRENT POST
// ------------------------
function easy_nivo_slider_for_current_post ($parms=NULL) {
	echo get_easy_nivo_slider_for_current_post ($parms);	
}

// ------------------------
// GENERATE A NIVO SLIDER using the ATTACHED IMAGES for the CURRENT POST
// ------------------------
function get_easy_nivo_slider_for_current_post ($parms=NULL) {
	// Start an output buffer to capture any output
	ob_start();	
	$options = get_option('easy_nivo_slider_options'); 
	
	sns_debug('get_easy_nivo_slider_for_current_post', $parms);
	
	if (!$parms) return ob_get_clean(); ;
		
	$qry = array(
		'post_parent'   	=> get_the_ID(),
		'post_type'     	=> 'attachment',
		'posts_per_page'	=> -1, 
		'post_mime_type'	=> 'image',
        'orderby'       	=> 'menu_order',
        'order'         	=> 'ASC',
		'nopaging' 			=> true
	);		
			
	//echo 'THE ID : '.get_the_ID().'<br>';	
	// Fetch the posts with the passed query
	sns_debug('WP_Query', $qry);
	
							
	$images = get_children($qry);
		
						
	if ( $images ) {
			
					
		// Track the number of sliders on a page so each one has a unique ID
		$parms = sns_set_slider_id( $parms );
					
							
		// Initialize the parms so everything has a value		
		$parms = sns_set_empty_parms_to_defaults( $parms );		
		// Limit the number of images in slider
		$number_of_images = 0;
	
		// Perform the loop and build the slider
		
		//if (!$options['debug']) 
			echo '<div class="easy-nivo-slider easy-nivo-slider-'.$parms['size'].' '.$parms['class'].'" id="slider-'.$parms['ID'].'">';
		
		// Initialize some loop variabls
		$thumbnail = '';
		
		foreach ( $images as $id => $image ) {
			
			if ('true'==$parms['linking']) 
			 	echo '<a href="'.wp_get_attachment_url($id).'" title="'.get_the_title($id).'">';
			
			$arr_image = wp_get_attachment_image_src( $id, $parms['width'].'x'.$parms['height'] );

			// For thumbnail navigation, generate a thumnail and build the image code manually
			if ('true' == $parms['controls_thumbs']) {
				$arr_thumb = wp_get_attachment_image_src( $id, '60x60' );
				$thumbnail = ' rel="'.$arr_thumb[0].'"';
			}
			
			echo '<img src="'.$arr_image[0].'" '.
				(('true' == $parms['caption']) ? ' title="'.get_the_title($id).'"' : '').
				$thumbnail.'/>';
			
			// Without thumbnail navigation, we can just print the image
			//} else {										
			//	echo wp_get_attachment_image( $id, $parms['width'].'x'.$parms['height'] ); 		
			//}
				
			if ('true'==$parms['linking'])  echo '</a>';           
				
			$number_of_images++;
			if ($number_of_images >= $parms['number']) break; 
			
		}  // foreach
		
		// If the slider has any pictures, add the javascript to start it
	    if ($number_of_images > 0) sns_print_script_for_slider($parms);	

		//if (!$options['debug']) 	
			echo '</div>';
	}
		echo 'debug='.$options['debug'] .'<br>';
	
	if (0 == $number_of_images) 	
		echo '<p>No images found.</p>';
	
	//return the current buffer and clear it
	return ob_get_clean(); 
}	
?>