<?php
//---------------------------------------------------------------------
// This file contains some helper functions that didn't seem to belong in the main script
//---------------------------------------------------------------------

//---------------------------------------------------------------------
// The first time a slider is added to a page, insert the CSS for all three sizes
// 
// It would be preferable to handle this with print_styles somehow, 
//		but we need the css to use the plugin sizes,
// 		and conditional loading of the css based on whether the page has any sliders
//---------------------------------------------------------------------
function sns_print_slider_styles() {
	sns_debug('sns_print_slider_styles', NULL);
	// Retrieve the plugin options
	$options = get_option('easy_nivo_slider_options');
	
?>
	
	<style type="text/css" media="screen">
	.easy-nivo-slider-first { width: <?php echo $options['first_width']; ?>px !important; 
		height: 
		<?php echo ($options['first_height']+(('true'==$options['first_controls_thumbs']) ? 64 : 0)); ?>px !important;
		overflow:hidden !important;
	}
	.easy-nivo-slider-first .nivo-caption { bottom: <?php 
		echo ('true'==$options['first_controls_thumbs']) ? 64 : 0; ?>px; }
		
	.easy-nivo-slider-second { 
		width: <?php echo $options['second_width']; ?>px !important; 
		height: <?php echo ($options['second_height']+(('true'==$options['second_controls_thumbs'])?64:0));?>px !important;
		overflow:hidden !important;
	}
	.easy-nivo-slider-second .nivo-caption { bottom: <?php 
		echo ('true'==$options['second_controls_thumbs']) ? 64 : 0; ?>px; }
		
	.easy-nivo-slider-widget { 
		width: <?php echo $options['widget_width']; ?>px !important; 
		height: <?php echo ($options['widget_height']+(('true'==$options['widget_controls_thumbs'])?64:0)); ?>px !important;
		overflow:hidden !important;
	}
	.easy-nivo-slider-widget .nivo-caption { bottom: <?php 
		echo ('true'==$options['widget_controls_thumbs']) ? 64 : 0; ?>px; }
	</style> 

	<!--			
		.easy-nivo-slider-first .nivo-controlNav { 
			bottom:<?php echo ($options['first_controls_offset'] ? $options['first_controls_offset'] : '0'); ?>px; 	
		} 
		.easy-nivo-slider-second .nivo-controlNav { 
			bottom:<?php echo ($options['second_controls_offset'] ? $options['second_controls_offset'] : '0'); ?>px; 	
		} 
				
		.easy-nivo-slider-widget .nivo-controlNav { 	
			bottom:<?php echo ($options['widget_controls_offset'] ? $options['widget_controls_offset'] : '0'); ?>px; 	
		}  -->
<?php    
}			
//---------------------------------------------------------------------
// Track the number of sliders on a page so each one has a unique ID
//---------------------------------------------------------------------
function sns_set_slider_id( $parms ) {

	global $number_of_sliders_on_page;	
	$number_of_sliders_on_page++;
	
	// The first time a slider is added to a page, insert the CSS the slider sizes
	if (1==$number_of_sliders_on_page) {
		sns_print_slider_styles();			
	}			
	
	$parms['ID'] = $number_of_sliders_on_page;		
	
	sns_debug('sns_set_slider_id', $parms['ID']);
	return $parms;
}			

//---------------------------------------------------------------------
// 
//---------------------------------------------------------------------
function sns_set_empty_parms_to_defaults( $parms ) {
	
	// Retrieve the plugin options
	$options = get_option('easy_nivo_slider_options');
		
	// Support three sliders sizes:  first, second, and widget
	if ('second'!=$parms['size'] && 'widget'!=$parms['size']) $parms['size'] = 'first';
	$size = $parms['size'];
		
	// Set the slider parameters to the values for this size
	$parms['width'] 			= $options[ $size.'_width' ];
	$parms['height'] 	 		= $options[ $size.'_height' ];
	$parms['linking'] 			= $options[ $size.'_linking' ];
	$parms['slices'] 			= $options[ $size.'_slices' ];
	$parms['caption'] 			= $options[ $size.'_caption' ];
	$parms['captionOpacity'] 	= $options[ $size.'_captionOpacity' ];
	
	// Set the slider defaults to the values for this size 
	if (NULL==$parms['effect'])  			$parms['effect'] = $options[ $size.'_effect'];
	if (NULL==$parms['speed'])  			$parms['speed'] = $options[ $size.'_speed'];
	if (NULL==$parms['pause'])  			$parms['pause'] = $options[ $size.'_pause'];
	if (NULL==$parms['pause_on_hover']) 	$parms['pause_on_hover'] = $options[ $size.'_pause_on_hover'];
	if (NULL==$parms['arrows'])  			$parms['arrows'] = $options[ $size.'_arrows'];
	if (NULL==$parms['hide_arrows'])  		$parms['hide_arrows'] = $options[ $size.'_hide_arrows'];
	if (NULL==$parms['controls_buttons'])  	$parms['controls_buttons'] = $options[ $size.'_controls_buttons'];
	if (NULL==$parms['controls_numbers'])  	$parms['controls_numbers'] = $options[ $size.'_controls_numbers'];
	if (NULL==$parms['controls_thumbs'])  	$parms['controls_thumbs'] = $options[ $size.'_controls_thumbs'];
	if (NULL==$parms['controls_offset'])	$parms['controls_offset'] = $options[ $size.'_controls_offset'];

	// Handle button vs number navigation
	$parms['controls'] = 'false';
	$parms['class'] = '';
	if ('true'==$parms['controls_buttons']) {
		$parms['class'] = ' easy-nivo-slider-controls-buttons';
		$parms['controls'] = 'true';
	} else if ('true'==$parms['controls_numbers']) {
		$parms['class'] = ' easy-nivo-slider-controls-numbers';
		$parms['controls'] = 'true';
	} else if ('true'==$parms['controls_thumbs']) {
		$parms['class'] = ' easy-nivo-slider-controls-thumbs';
		$parms['controls'] = 'true';
	}
	
	// Handle number of pictures
	if (NULL==$parms['number'])			$parms['number'] = 10;
	if ('all'==$parms['number'])		$parms['number'] = 999;
	
	// Debugging is fun
	sns_debug('Prepared parms', $parms);

	return $parms;		
}

//---------------------------------------------------------------------
// Create and start the slider
//---------------------------------------------------------------------
function sns_print_script_for_slider( $parms ) {
?>
	
	<script language="JavaScript" type="text/javascript">
		jQuery(document).ready(function($) {
			$("#slider-<?php echo $parms['ID']; ?>").nivoSlider({
				<?php				
					if ($parms['effect']) 					echo 'effect:"'.$parms['effect'].'",'; 
					if ($parms['speed'])					echo 'animSpeed:'.$parms['speed'].','; 
					if ($parms['pause']) 					echo 'pauseTime:'.$parms['pause'].',';
					if ($parms['arrows']) 					echo 'directionNav:'.$parms['arrows'].','; 
					if ($parms['hide_arrows']) 				echo 'directionNavHide:'.$parms['hide_arrows'].','; 
				    if ($parms['controls']) 				echo 'controlNav:'.$parms['controls'].','; 
				    if ($parms['pause_on_hover']) 			echo 'pauseOnHover:'.$parms['pause_on_hover'].','; 							
					if ($parms['slices']) 					echo 'slices:'.$parms['slices'].',';
					if ($parms['captionOpacity']) 			echo 'captionOpacity:'.$parms['captionOpacity'].',';
					if ('true'==$parms['controls_thumbs']) 	echo 'controlNavThumbs:true, controlNavThumbsFromRel:true,';
				?>			
				startSlide:0 // Avoid a trailing comma
			}); 
		}); 
	</script>
<?php    
}
			
//---------------------------------------------------------------------
// Print a debug message in case things go wonky
//---------------------------------------------------------------------
function sns_debug( $label, $var ) {

	$options = get_option('easy_nivo_slider_options');

	if ($options['debug']) { 
		echo '<p><strong>'.$label.'</strong>:<br/>'; 
		if (is_array($var)) 
			var_dump($var); 
		else echo $var;
		echo '</p>'; 
	}
}


?>