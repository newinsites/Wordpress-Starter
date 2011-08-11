<?php
//---------------------------------------------------------------------
// RETRIEVE A LIST OF NEXTGEN GALLERIES
//---------------------------------------------------------------------
function sns_get_nextgen_galleries() {

	global $wpdb;
	$galleries = $wpdb->get_results("SELECT * FROM $wpdb->nggallery ORDER BY name ASC");
	
	if (is_array($galleries) && count($galleries) > 0) { 
		$nextgen = array();
		$nextgen[''] = 'All images';
		foreach ($galleries as $gallery) { 
			$nextgen[$gallery->gid] = $gallery->title;
			
			//echo 'gid='.$gallery->gid.', name='.$gallery->title.'<br>';
		}		    
		return $nextgen;
	}
	
	return NULL;	
}

//---------------------------------------------------------------------
// CREATE A FORM SELECTION BOX FOR NEXTGEN GALLERIES
//---------------------------------------------------------------------
function sns_print_nextgen_gallery_form ($id_base, $name_base, $defaults, $nextgen) { 
?>
	<fieldset class="nivo-slider-fieldset">
       	<legend><?php _e('Image Selection'); ?>:</legend>
		<table>
     		<tr valign="top">
				<th scope="row"><label for="<?php echo $id_base; ?>post_type"><?php _e('NextGen Gallery'); ?>:</label></th>
		        <td> 
					<?php
		    			if ($nextgen && is_array($nextgen)) {
							echo '<select id="'.$id_base.'gallery" name="'.$name_base.'[gallery]">';
							foreach ($nextgen as $key=>$value) {   
				        		echo '<option value="'.$key.'"'.
									($defaults['gallery']==$key ? ' selected="selected"' : '').'>'.
									$value.'</option>';
        					}					
							echo '</select>';	
						} else {
							_e('No galleries found');
						}
					?>
				</td>
			</tr>
		</table>
    </fieldset>
<?php
}

?>