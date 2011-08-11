<?php
class SimpleCustomTypes_Admin_Conversion {
	var $conv_slug = 'simple-customtype-conversion';
	
	/**
	 * Constructor
	 *
	 * @return void
	 * @author Amaury Balmer
	 */
	function simplecustomtypes_admin_conversion() {
		add_action( 'admin_init', array(&$this, 'checkAdminPost') );
		add_action( 'admin_menu', array(&$this, 'addMenu') );
	}
	
	/**
	 * Meta function for load all check functions.
	 *
	 * @return void
	 * @author Amaury Balmer
	 */
	function checkAdminPost() {
		$this->checkConversion(); // Conversion
	}
	
	/**
	 * Add settings menu page
	 *
	 * @return void
	 * @author Amaury Balmer
	 */
	function addMenu() {
		add_management_page( __('Post type conversion', 'simple-customtypes'), __('Post type conversion', 'simple-customtypes'), 'manage_options', $this->conv_slug, array( &$this, 'pageConversion' ) );
	}
	
	/**
	 * Check POST date for convert object on an another custom type.
	 *
	 * @return void
	 * @author Amaury Balmer
	 */
	function checkConversion() {
		if ( isset($_POST['custom-type-convert']) && $_POST['custom-type-convert'] == '1' ) {
			check_admin_referer( 'convert-post_type' );
			
			foreach( (array) $_POST['objects'] as $object_id => $new_post_type ) {
				// Change the post type
				$object = get_post_to_edit( $object_id );
				$object->post_type = $new_post_type;
				wp_update_post( (array) $object );
				
				// Clean object cache
				clean_post_cache($object_id);
			}
			
			return true;
		}
		return false;
	}
	
	/**
	 * Display page for allow conversion between custom types.
	 *
	 * @return void
	 * @author Amaury Balmer
	 */
	function pageConversion() {
		?>
		<div class="wrap">
			<h2><?php _e('Custom type conversion', 'simple-customtypes'); ?></h2>
			<p><?php _e('This page allows to convert the object at present used as post/page in another custom type. If you merge a hierarchy object on non hierarchy custom type, the post parent value will be reset.', 'simple-customtypes'); ?></p>
			
			<form action="<?php echo admin_url( 'tools.php?page='.$this->conv_slug ); ?>" method="post">
				<?php if ( isset($_POST['step']) && $_POST['step'] == '1' && isset($_POST['post_type']) && post_type_exists($_POST['post_type']) ) : ?>
					
					<table class="form-table">
						<thead>
							<tr>
								<th><?php _e('Post title', 'simple-customtypes'); ?></th>
								<th><?php _e('New post type', 'simple-customtypes'); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php
							// make once the loop for cpt
							$select_html = '';
							foreach( get_post_types( array('public' => true, 'show_ui' => true), 'objects' ) as $post_type ) {
								$select_html .= '<option '.selected($post_type->name, $_POST['post_type'], false).' value="'.esc_attr($post_type->name).'"> '.esc_html($post_type->labels->name).' ('.esc_html($post_type->name).')</option>' . "\n";
							}
							
							$_posts = query_posts( 'post_type='.$_POST['post_type'].'&nopaging=true' );
							if ( $_posts == false ) :
								echo '<tr class="form-field form-required"><td colspan="2">'.__('No entries for this custom type.', 'simple-customtypes').'</td></tr>' . "\n";
							else :
								foreach( (array) $_posts as $_post ) :
								?>
								<tr class="form-field form-required">
									<td><label for="object-<?php echo $_post->ID; ?>"><?php esc_html_e($_post->post_title); ?><label></td>
									<td>
										<select name="objects[<?php echo $_post->ID; ?>]" id="object-<?php echo $_post->ID; ?>"><?php echo $select_html; ?></select>
									</td>
								</tr>
								<?php
								endforeach;
							endif;
							?>
						</tbody>
					</table>
					
					<?php if ( $_posts == false ) : ?>
						<br />
						<a class="button-primary" href="<?php echo admin_url('tools.php?page='.$this->conv_slug); ?>"><?php _e('Use an another custom type', 'simple-customtypes'); ?></a>
					<?php else: ?>
						<p class="submit">
							<?php wp_nonce_field( 'convert-post_type' ); ?>
							
							<input type="hidden" name="step" value="1" />
							<input type="hidden" name="post_type" value="<?php esc_attr_e($_POST['post_type']); ?>" />
							
							<input type="hidden" name="custom-type-convert" value="1" />
							<input type="submit" value="<?php _e('Convert custom type', 'simple-customtypes'); ?>" class="button-primary" />
						</p>
					<?php endif; ?>
				
				<?php else : ?>
					
					<p>
						<label for="post_type"><?php _e('Choose a custom type', 'simple-customtypes'); ?></label>
						<select name="post_type" id="post_type">
							<?php
							foreach( get_post_types( array('public' => true, 'show_ui' => true), 'objects' ) as $post_type ) {
								echo '<option value="'.esc_attr($post_type->name).'"> '.esc_html($post_type->labels->name).' ('.esc_html($post_type->name).')</option>' . "\n";
							}
							?>
						</select>
					</p>
					
					<p class="submit">
						<input type="hidden" name="step" value="1" />
						<input type="submit" value="<?php _e('Load objects for this post type', 'simple-customtypes'); ?>" class="button-primary" />
					</p>
				
				<?php endif; ?>
			</form>
		</div>
		<?php
	}
}
?>