<?php
// -------------------------------
// Set up the admin menu
// -------------------------------
add_action('admin_menu', 'easy_nivo_slider_add_options_page');
function easy_nivo_slider_add_options_page() {
	add_options_page('Easy Nivo Slider Settings','<img class="menu_pto" src="'.plugins_url('/images/menu-icon.png', __FILE__).'" height="12" width="12" alt="" /> Nivo Slider ','manage_options',
		'easy_nivo_slider_settings_page','easy_nivo_slider_settings_page');
	
	//call register settings function
	add_action( 'admin_init', 'easy_nivo_slider_register_settings' );
}

// -------------------------------
// LOAD THE SCRIPTS THAT WE ONLY NEED ON THE SETTINGS PANEL
// -------------------------------
add_action('admin_print_scripts-settings_page_easy_nivo_slider_settings_page', 'easy_nivo_slider_add_scripts');

function easy_nivo_slider_add_scripts() {
	
	if ('true' == get_easy_nivo_slider_option( 'load_nivo' )) {
		wp_enqueue_script('nivo-slider',plugins_url('/3rd-party/jquery.nivo.slider.js',__FILE__),array('jquery'),EASY_NIVO_SLIDER_NIVO_VERSION);
		//wp_enqueue_script('nivo-slider',plugins_url('/3rd-party/jquery.nivo.slider.pack.js',__FILE__),array('jquery'),EASY_NIVO_SLIDER_NIVO_VERSION);
	}		

    wp_enqueue_script('easy_nivo_slider_script', plugins_url('/js/settings.js', __FILE__), array('jquery'));

}
// -------------------------------
// Load the styles for just our admin panel
// -------------------------------
add_action('admin_print_styles-settings_page_easy_nivo_slider_settings_page', 'easy_nivo_slider_add_styles');

function easy_nivo_slider_add_styles() {
	if ('true' == get_easy_nivo_slider_option( 'load_nivo' )) {
		wp_register_style( 'nivo-slider',plugins_url('/3rd-party/nivo-slider.css', __FILE__),array(),EASY_NIVO_SLIDER_NIVO_VERSION);
		wp_enqueue_style( 'nivo-slider' );
	}		
	wp_register_style( 'easy-nivo-slider',plugins_url('/css/easy-nivo-slider.css', __FILE__),array(),EASY_NIVO_SLIDER_VERSION);
	wp_register_style( 'easy-nivo-slider-admin',plugins_url('/css/admin.css', __FILE__),array(), EASY_NIVO_SLIDER_VERSION);
	
	wp_enqueue_style( 'easy-nivo-slider' );
	wp_enqueue_style( 'easy-nivo-slider-admin' );	
}

// -------------------------------
// The awesome admin panel
// -------------------------------
function easy_nivo_slider_settings_page() { ?>


	<div class="wrap"> 
		<?php screen_icon('tools'); ?>
		<h2>Easy Nivo Slider Settings</h2>  
        
		<div id="poststuff" class="metabox-holder has-right-sidebar">
			
        
		<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
        <!-- ABOUT THE PLUGIN 																			-->
		<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
        <div id="side-info-column" class="inner-sidebar">
			<div class="meta-box-sortables"> 
				<div id="about" class="postbox ">  
			
					<div class="handlediv" title="<?php _e('Click to toggle'); ?>"><br/></div>
					<h3 class="hndle" id="about-sidebar"><?php _e('About the plugin') ?></h3>
					<div class="inside">
                       	<p>Easy Nivo Slider<br />Version: <?php echo EASY_NIVO_SLIDER_VERSION; ?></p>
						<p>Visit the <a href="http://www.theemeraldcurtain.com/wordpress-plugin/easy-nivo-slider/">
                       	plugin homepage</a> for further information or to get the latest version.</p>

						<p>Feedback and <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=QG7JF2QUHGF6A" target="_blank">donations</a> are welcome.</p>
                        <p><strong>Acknowledgements:</strong></p>
							
                        <p>This plugin would not be possible without 
                        <a href="http://nivo.dev7studios.com/" target="_blank">Nivo Slider</a>, 
                        the world's most awesome jQuery slider.  </p>
                            
                        <p>And it's vastly improved by the Filosofo 
                        <a href="http://austinmatzko.com/wordpress-plugins/filosofo-custom-image-sizes/"
                        target="_blank">Custom Image Sizes</a> plugin, which is also completely awesome.</p>
                        
						<p><span style="float: right;">
						&copy; Copyright 2011 - <?php echo date('Y'); ?> 
                        <a href="http://theemeraldcurtain.com">Phillip Bryan</a></p>
					</div> <!-- inside -->
				</div> <!-- about -->
			</div> <!-- meta-box-sortables -->
		</div> <!-- side-info-column -->
                       
		<!-- Start the settings form and set up the plugin options-->   
		<form method="post" action="options.php">
		<?php settings_fields( 'easy_nivo_slider_group' ); ?>
		<?php $options = get_option('easy_nivo_slider_options'); ?>
     
   		<input id="nivo_settings_current_tab" name="easy_nivo_slider_options[nivo_settings_current_tab]" type="hidden" 
    	value="<?php echo $options['nivo_settings_current_tab']; ?>" />
		<!-- Start the settings form -->    
        
		<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
        <!-- NAVIGATION TABS 																			-->
		<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
        <div id="post-body" class="has-sidebar">
			<div id="post-body-content" class="has-sidebar-content">
				<div id="normal-sortables" class="meta-box-sortables">
                   	
        	        <ul id="nivo_settings_tab">
						<li class="tab_first"><a name="tab_first" href="#">First Slider</a></li>
						<li class="tab_second"><a name="tab_second" href="#">Second Slider</a></li>
						<li class="tab_widget"><a name="tab_widget" href="#">Widget Slider</a></li>
						<li class="tab_preview"><a name="tab_preview" href="#">Preview</a></li>
						<li class="tab_settings"><a name="tab_settings" href="#">Settings</a></li>
					</ul>           
            
					<div class="postbox">
						<div class="inside"> 
							<div id="nivo_settings_content">
                            
	<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
    <!-- TAB																						-->
	<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
	<div class="tab tab_first">      
		<p>Add a Nivo Slider to a post or page by using the <span class="easy-nivo-slider-icon"></span> 
        button in the Visual editor.  The plugin will generate the <code>[nivo]</code> shortcode for 
        your choice of image selection, slider speed, and type of animation.</p>
        
        <p>There are three different configurations for slider size and behaviour.  This panel
        contains the settings for the <strong>First</strong> configuration.</p>
                
    	<?php easy_nivo_slider_options_for_size('first'); ?>
	</div> 
	
    <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
    <!-- TAB 																						-->
	<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
	<div class="tab tab_second">     
        <p>This panel contains the settings for the <strong>Second</strong> slider configuration.</p></p>
    	<?php easy_nivo_slider_options_for_size('second',false); ?>
    </div>
    
    <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
    <!-- TAB 																						-->
	<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->		
    <div class="tab tab_widget">       
        <p>This panel contains the settings for slider widgets.</p>
    	<?php easy_nivo_slider_options_for_size('widget',false); ?>
	</div>
    
   	<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
    <!-- TAB 																						-->
	<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
	<div class="tab tab_preview"> 
                     
       	<?php sns_form_image_selection ( 'nivo_', 'easy_nivo_slider_options', $options );	?>                         
       	<?php sns_form_slider_settings ( 'nivo_', 'easy_nivo_slider_options', $options  ); ?>

        <fieldset class="nivo-slider-fieldset">          
			<input type="submit" class="button-primary" value="Save Settings and Preview Slider" />
        
    	    <p>Here is how the slider will appear. A gray border has been added to show the exact size 
           	of the slider.</p>
        
	        <p>The <strong><?php echo ucwords($options['size']); ?></strong> slider has the size 
			<?php echo $options[$options['size'].'_width']; ?>px by 
			<?php echo $options[$options['size'].'_height']; ?>px.</p>

	        <?php easy_nivo_slider_for_featured_images($options); ?>
        </fieldset>		                                    
	</div>	
                      
    <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
    <!-- TAB 																						-->
	<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
	<div class="tab tab_settings"> 
                     
        <fieldset class="nivo-slider-fieldset">
        	<legend>Plugin Settings</legend>     
                            
			<p><input name="easy_nivo_slider_options[activate_nextgen]" type="checkbox" value="true" 
			<?php checked('true', $options['activate_nextgen']); ?>  /> Activate NextGen sliders. 
            If checked, you'll be able to create Nivo sliders from your NextGen galleries.
            
            Tested with version <?php echo EASY_NIVO_SLIDER_NEXTGEN_VERSION; ?> of NextGen.</p>

			<p><input name="easy_nivo_slider_options[debug]" type="checkbox" value="true" 
			<?php checked('true', $options['debug']); ?>  /> Activate Debug mode.  Hopefully you won't need it.</p>                                                                           
   			<p><input name="easy_nivo_slider_options[load_nivo]" type="checkbox" value="true" 
			<?php checked('true', $options['load_nivo']); ?>  /> Load Nivo Slider. By default, this plugin loads
            version <?php echo EASY_NIVO_SLIDER_NIVO_VERSION; ?> of Nivo Slider.  
            Leave this checked unless Nivo is installed separately.</p>
                            
			<p><input name="easy_nivo_slider_options[load_cis]" type="checkbox" value="true" 
			<?php checked('true', $options['load_cis']); ?>  /> Load Custom Image Sizes plugin.  By default, this plugin
            loads version <?php echo EASY_NIVO_SLIDER_CUSTOM_IMAGE_SIZES_VERSION; ?> of Custom Image Sizes. 
            Live this checked unless the plugin is installed separately.</p>                                                     
			<p><input name="easy_nivo_slider_options[uninstall]" type="checkbox" value="true" 
			<?php checked('true', $options['uninstall']); ?>  /> Uninstall the plugin when deactivated.  
            This will delete the options set by the plugin.</p>
                            
			<p><input type="submit" class="button-primary" value="Save Settings" /></p>
        
        </fieldset> 	                                    
	</div>	
        

	<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
    <!-- TAB 																						-->
	<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
                            
			                            
							</div> <!-- nivo_settings_content -->
						</div> <!-- inside -->
					</div> <!-- about -->
                    
				</div> <!-- normalx-sortables -->
			</div> <!-- post-body-content -->
		</div> <!-- post-body -->
                           
        
           
		<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
        <!-- CLOSE EVERYTHING DOWN, WHEW																-->
		<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->

		<!-- Close the settings form -->          
		</form>       

		</div> <!-- poststuff -->
	</div> <!-- wrap -->   

<?php 
} 

function easy_nivo_slider_options_for_size($size='first') { 

	$options = get_option('easy_nivo_slider_options'); ?>
	<table class="form-table">

     	<tr valign="top">
			<th scope="row"><?php echo ucwords($size); ?> Slider Size:</th>
        	<td><input name="easy_nivo_slider_options[<?php echo $size; ?>_width]" 
            	value="<?php echo $options[$size.'_width']; ?>" type="text" class="nivo_numeric_field" size="3" /> width 
                        
                <input name="easy_nivo_slider_options[<?php echo $size; ?>_height]" 
            	value="<?php echo $options[$size.'_height']; ?>" type="text" class="nivo_numeric_field" size="3" /> height

                <!--<?php if ($verbose) { ?>    
                    <p>WordPress will make copies of images that you upload to your site, scaled and cropped to this size.</p>
                        <p>To make resized copies of images that are already on your site, you can use a plugin like <a href="http://wordpress.org/extend/plugins/ajax-thumbnail-rebuild/" target="_blank">AJAX Thumbnail Rebuild</a> or <a href="http://wordpress.org/extend/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails</a>.  You will also want to regenerate these copies whenever you change the size of the silder.</p>
                <?php } ?> -->
    		</td>
		</tr>
 
 		<tr valign="top">
			<th scope="row">Number of slices:</th>
        	<td><input name="easy_nivo_slider_options[<?php echo $size; ?>_slices]" type="text" 
          		value="<?php echo $options[$size.'_slices']; ?>" class="nivo_numeric_field" size="3" /> 
             	      Suggested value is the width of your <?php echo $size; ?> slider divided by 40.
			</td>
		</tr>
 
 		<tr valign="top">
			<th scope="row">Linking:</th>
        	<td><input name="easy_nivo_slider_options[<?php echo $size; ?>_linking]" type="checkbox" value="true" 
				<?php checked('true', $options[$size.'_linking']); ?>  /> 
                If checked, then the slider will link each image to the post where it's featured.
			</td>
		</tr>
 
 		<tr valign="top">
			<th scope="row">Caption:</th>
        	<td><input name="easy_nivo_slider_options[<?php echo $size; ?>_caption]" type="checkbox" value="true" 
						<?php checked('true', $options[$size.'_caption']); ?>  /> Display a caption using each post's title.
					</td>
		</tr>
 
 		<tr valign="top">
			<th scope="row">Caption opacity:</th>
        	<td><input id="nivo_captionOpacity" name="easy_nivo_slider_options[<?php echo $size; ?>_captionOpacity]" 
                        type="text" value="<?php echo $options[$size.'_captionOpacity']; ?>"
                        class="nivo_numeric_field nivo_opacity_field" size="3" /> a number between 0 and 1.
					</td>
		</tr>
 		
        <tr valign="top">                               
			<th scope="row">Navigation:</th>
        	<td>
                <!-- pause_on_hover checkbox and hidden text field -->
                <input name="easy_nivo_slider_options[<?php echo $size; ?>_pause_on_hover]" type="hidden" 
                id="<?php echo $size; ?>_nivo_pause_on_hover" value="<?php echo $options[$size.'_pause_on_hover']; ?>"/> 
                	
                <input name="<?php echo $size; ?>_nivo_pause_on_hover" 
                type="checkbox" value="true"  class="nivo_checkbox"
				<?php checked('true', $options[$size.'_pause_on_hover']); ?> /> 
                Pause the slider when the mouse is over it.<br />
                
               	<!-- arrows checkbox and hidden text field -->
                <input name="easy_nivo_slider_options[<?php echo $size; ?>_arrows]" type="hidden" 
                id="<?php echo $size; ?>_nivo_arrows" value="<?php echo $options[$size.'_arrows']; ?>"/> 
                
                <input name="<?php echo $size; ?>_nivo_arrows" 
                type="checkbox" value="true" class="nivo_checkbox"
				<?php checked('true', $options[$size.'_arrows']); ?> /> Add Previous/Next navigation.<br />
                    
               	<!-- hide_arrows checkbox and hidden text field -->
                <input name="easy_nivo_slider_options[<?php echo $size; ?>_hide_arrows]" type="hidden" 
                id="<?php echo $size; ?>_nivo_hide_arrows" 
                value="<?php echo $options[$size.'_hide_arrows']; ?>" id="nivo_hide_arrows"/> 
                
                <input name="<?php echo $size; ?>_nivo_hide_arrows" 
                type="checkbox" value="true" class="nivo_checkbox" 
				<?php checked('true', $options[$size.'_hide_arrows']); ?>  /> 
                Hide the Previous/Next navigation when the mouse is not over the slider.<br />
			</td>
		</tr>
        
        
 		<tr valign="top">
			<th scope="row">&quot;Jump to slide&quot; navigation:</th>
        	<td>
                <!-- controls checkbox and hidden text field -->
                <input name="easy_nivo_slider_options[<?php echo $size; ?>_controls_buttons]"  
                id="<?php echo $size; ?>_nivo_controls_buttons" 
                class="nivo_checkbox_controls_field"
                type="hidden" value="<?php echo $options[$size.'_controls_buttons']; ?>"/>  
                
                <input name="<?php echo $size; ?>_nivo_controls_buttons" 
                type="checkbox" value="true" class="nivo_checkbox nivo_checkbox_controls" 
				<?php checked('true', $options[$size.'_controls_buttons']); ?> /> 
                Add a row of buttons for navigation to any image.<br /> 
                    
                <!-- controls checkbox and hidden text field -->
                <input name="easy_nivo_slider_options[<?php echo $size; ?>_controls_numbers]"
                id="<?php echo $size; ?>_nivo_controls_numbers"
                class="nivo_checkbox_controls_field"
                type="hidden" value="<?php echo $options[$size.'_controls_numbers']; ?>"/> 
                
                <input name="<?php echo $size; ?>_nivo_controls_numbers" 
                type="checkbox" value="true" class="nivo_checkbox nivo_checkbox_controls" 
				<?php checked('true', $options[$size.'_controls_numbers']); ?> /> 
                Add a row of numbers for navigation to any image.<br />
                
                <!-- controls checkbox and hidden text field -->
                <input name="easy_nivo_slider_options[<?php echo $size; ?>_controls_thumbs]"
                id="<?php echo $size; ?>_nivo_controls_thumbs"
                class="nivo_checkbox_controls_field"
                type="hidden" value="<?php echo $options[$size.'_controls_thumbs']; ?>"/> 
                
                <input name="<?php echo $size; ?>_nivo_controls_thumbs" 
                type="checkbox" value="true" class="nivo_checkbox nivo_checkbox_controls" 
				<?php checked('true', $options[$size.'_controls_thumbs']); ?> /> 
                Use thumbnail navigation.<br />
                
                <!--<input id="nivo_controls_offset" name="easy_nivo_slider_options[<?php echo $size; ?>_controls_offset]" 
				type="text" value="<?php echo $options[$size.'_controls_offset']; ?>"
                class="nivo_numeric_field" size="3" /> Space between controls and bottom of slider:  0=slider bottom,  24&asymp;just above caption, <?php echo ($options[$size.'_height']-24); ?>&asymp;slider top. -->
			</td>
		</tr>
        
     	<tr valign="top">
			<th scope="row"></th>
        	<td><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></td>
		</tr>
	</table>
<?php } ?>