<?php	

//---------------------------------------------------------------------
// IMAGE SELECTION FORM - POST_TYPE, TAXONOMY, TERM
//---------------------------------------------------------------------
function sns_form_widget_title ($id_base, $name_base, $defaults) { ?>
	<table class="nivo-slider-widget-table">
    	<tr valign="top">	
			<th scope="row">	
				<label for="<?php echo $id_base; ?>title"><?php _e('Widget&nbsp;Title'); ?>:</label></th>
        	<td>
        	    <input id="<?php echo $id_base; ?>title" type="text" 
   	    		name="<?php echo $name_base; ?>[title]" value="<?php echo $defaults['title']; ?>" />
			</td>
		</tr>
    </table>
<?php }


//---------------------------------------------------------------------
// SLIDER SETTINGS FORM - TRANSITION, ANIMATION SPEED, PAUSE, ETC
//---------------------------------------------------------------------
function sns_form_slider_settings($id_base, $name_base, $defaults) { ?>

    <fieldset class="nivo-slider-fieldset">
       	<legend><?php _e('Slider Settings'); ?>:</legend>
        <table>
			<?php if ($defaults['hide-size']) { ?>
	            <input type="hidden" value="<?php echo $defaults['size']; ?>" id="<?php echo $id_base; ?>size" name="<?php echo $name_base; ?>[size]">
            <?php } else { ?>
     		<tr valign="top">
				<th scope="row"><label for="<?php echo $id_base; ?>size"><?php _e('Slider Size'); ?>:</label></th>
		        <td><select id="<?php echo $id_base; ?>size" name="<?php echo $name_base; ?>[size]">
		   			<?php
						$default = $defaults['size'];
				        echo nivo_form_option ($default, 'First Slider',  'first');
				        echo nivo_form_option ($default, 'Second Slider', 'second');
		    		    echo nivo_form_option ($default, 'Widget Slider', 'widget');
					?>                
					</select>
				</td>
			</tr>
            <?php } ?>

			<tr valign="top">
				<th scope="row"><label for="<?php echo $id_base; ?>effect"><?php _e('Transition'); ?>:</label></th>
		        <td><select id="<?php echo $id_base; ?>effect" name="<?php echo $name_base; ?>[effect]">
			    	<?php
						$default = $defaults['effect'];
				        echo nivo_form_option ($default, 'random');
				        echo nivo_form_option ($default, 'sliceDown');
	    			    echo nivo_form_option ($default, 'sliceDownLeft');
	       				echo nivo_form_option ($default, 'sliceUp');
		            	echo nivo_form_option ($default, 'sliceUpLeft');
				        echo nivo_form_option ($default, 'sliceUpDown');
				        echo nivo_form_option ($default, 'sliceUpDownLeft');
				        echo nivo_form_option ($default, 'fold');
	    			    echo nivo_form_option ($default, 'fade');
		        		echo nivo_form_option ($default, 'slideInRight');
		            	echo nivo_form_option ($default, 'slideInLeft');
		            	echo nivo_form_option ($default, 'boxRandom');
		            	echo nivo_form_option ($default, 'boxRain');
		            	echo nivo_form_option ($default, 'boxRainReverse');
					?>                
					</select>
				</td>
			</tr>
              
			<tr valign="top">
				<th scope="row"><label for="<?php echo $id_base; ?>speed"><?php _e('Speed'); ?>:</label></th>
		        <td><input id="<?php echo $id_base; ?>speed" name="<?php echo $name_base; ?>[speed]" 
					value="<?php echo $defaults['speed']; ?>" 
					type="text" class="nivo_numeric_field" size="7" /> ms
                </td>
		    </tr>
    
		    <tr valign="top">
				<th scope="row"><label for="<?php echo $id_base; ?>pause"><?php _e('Pause'); ?>:</label></th>
		        <td><input id="<?php echo $id_base; ?>pause" name="<?php echo $name_base; ?>[pause]" 
					value="<?php echo $defaults['pause']; ?>" 
					type="text" class="nivo_numeric_field" size="7" /> ms
                </td>
		    </tr>
		</table>
    </fieldset>
    
<?php }
		
//---------------------------------------------------------------------
// ADD AN OPTION TO A FORM SELECTION FIELD
//---------------------------------------------------------------------
function nivo_form_option ($current, $label, $value=false, $class=false, $second_test=true) { 

	if (!$value) $value=$label;

	return '<option value="'.$value.'" '.
		(($current==$value && $second_test) ? 'selected="selected"' : '').
		(($class) ? 'class="'.$class.'"' : '').
		'>'.$label.'</option>';
 
} 


?>