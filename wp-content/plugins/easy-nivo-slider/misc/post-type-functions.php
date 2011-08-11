<?php

//---------------------------------------------------------------------
// IMAGE SELECTION FORM - POST_TYPE, TAXONOMY, TERM
//---------------------------------------------------------------------
function sns_form_image_selection ($id_base, $name_base, $defaults, $taxonomies=NULL) { ?>

	<?php
		if (!$taxonomies) {
			$taxonomies = easy_nivo_slider_post_types();
		}
	
		$default_post_type = $defaults['post_type'];
		$default_taxonomy = $defaults['taxonomy'];
		$default_term = $defaults['term'];	
	?>

	<fieldset class="nivo-slider-fieldset">
       	<legend><?php _e('Image Selection'); ?>:</legend>
		<table>

     		<tr valign="top">
				<th scope="row"><label for="<?php echo $id_base; ?>post_type"><?php _e('Post Type'); ?>:</label></th>
		        <td><select id="<?php echo $id_base; ?>post_type" name="<?php echo $name_base; ?>[post_type]"
               		class="nivo_listbox">
		   			<?php
						foreach ($taxonomies['arr_post_types'] as $post_type => $label ) {
							echo nivo_form_option ($default_post_type, $label, $post_type);
						}
					?>                
					</select>
				</td>
			</tr>

     		<tr valign="top">
				<th scope="row"><label for="<?php echo $id_base; ?>taxonomy"><?php _e('Taxonomy'); ?>:</label></th>
		        <td><select id="<?php echo $id_base; ?>taxonomy" name="<?php echo $name_base; ?>[taxonomy]"
               		class="nivo_listbox">
		   			<?php						
						foreach ($taxonomies['arr_post_types'] as $post_type => $label ) {
		
							if ($taxonomies['arr_post_types_taxonomies'][$post_type]) {
								foreach ($taxonomies['arr_post_types_taxonomies'][$post_type] as $taxonomy) {
									
									echo nivo_form_option ($default_taxonomy,
										$taxonomies['arr_taxonomies'][$taxonomy], $taxonomy,
										'taxonomy post_type_'.$post_type, $default_post_type==$post_type
										);	
								}
							}
						}
					?>                
					</select>
				</td>
			</tr>

     		<tr valign="top">
				<th scope="row"><label for="<?php echo $id_base; ?>term"><?php _e('Term'); ?>:</label></th>
		        <td><select id="<?php echo $id_base; ?>term" name="<?php echo $name_base; ?>[term]"
               		class="nivo_listbox">
		   			<?php			
					
						foreach ($taxonomies['arr_taxonomies'] as $taxonomy=>$taxonomy_label ) {
							if ($taxonomies['arr_terms'][$taxonomy]) {
								echo nivo_form_option ($default_term, 'Include all '.$taxonomy_label, 'all', 'all_terms term taxonomy_'.$taxonomy );
								foreach ($taxonomies['arr_terms'][$taxonomy] as $term=>$term_label) {	
			
									echo nivo_form_option ($default_term, $term_label, $term, 'term taxonomy_'.$taxonomy);			
								}
							}
						}
					
						echo nivo_form_option ($default_term, 'Include all terms', 'all', 'term taxonomy_'.$taxonomy );
					?>                
					</select>
				</td>
			</tr>
            
            
            
            
        
			<tr valign="top">
				<th scope="row"><label for="<?php echo $id_base; ?>number"><?php _e('Number of images'); ?>:</label></th>
		        <td><input id="<?php echo $id_base; ?>number" name="<?php echo $name_base; ?>[number]" 
					value="<?php echo $defaults['number']; ?>" 
					type="text" class="nivo_numeric_field" size="4" />
   	          	</td>
			</tr>
		</table>
    </fieldset>
    
<?php }


//---------------------------------------------------------------------
// GENERATE TAXONOMY STRUCTURE
//---------------------------------------------------------------------
function easy_nivo_slider_post_types () {	
	
	$post_types = get_post_types(null, 'objects');
	$arr_post_types = array();
	$arr_post_types_taxonomies = array();
	$arr_taxonomies = array();
	$arr_terms = array();
	$nivo_tax = array();
	
		
	foreach( $post_types as $post_type => $obj ) {
		if(!$obj->_builtin || $post_type=='post') {
			$posttypes_opt[$post_type] = $obj->labels->name;
			$arr_post_types [$post_type] = $obj->labels->name;
			
			
			$taxonomies = get_object_taxonomies($post_type, 'objects' );
			
			foreach ($taxonomies as $taxonomy ) {
				if ($taxonomy->name != 'post_tag' && $taxonomy->name != 'post_format') {
					$arr_taxonomies [$taxonomy->name] = $taxonomy->label;					
					$arr_post_types_taxonomies[$post_type][$i++] = $taxonomy->name;
				}
			}
		}
	}
	foreach ($arr_taxonomies as $taxonomy => $label ) {	
		$terms = get_terms($taxonomy); 
		foreach ($terms as $term) {
			$arr_terms[$taxonomy][$term->slug] = $term->name;
		}
	}
	
	$nivo_tax['arr_post_types'] = $arr_post_types;
	$nivo_tax['arr_post_types_taxonomies'] = $arr_post_types_taxonomies;
	$nivo_tax['arr_taxonomies'] = $arr_taxonomies;
	$nivo_tax['arr_terms'] = $arr_terms;
	
	return $nivo_tax;    
} 
             
?>