
function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function submit_mce_form() {
	if(window.tinyMCE) {
		
		shortcode = generate_shortcode();
		
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcode);
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}
	
	//nivo_change_tab();

	
function generate_shortcode() {

	shortcode = '[nivo';		
					   
	// ------------------------
	// SETTINGS WHICH APPLY TO A FEATURED IMAGE SLIDER
	// ------------------------
	if ($("#nivo_settings_current_tab").val() == 'tab_featured') {
				 
		// Show the post_type if specified 	
		if ($("#nivo_post_type").val() && $("#nivo_post_type").val()!='post') 
			shortcode = shortcode + ' post_type="' + $("#nivo_post_type").val() + '"';
				
		// Only include the taxonomy/term parameters if both are specified and we're not using all terms
		if ($("#nivo_taxonomy").val() && $("#nivo_term").val() && $("#nivo_term").val()!='all') {
		
			if ($("#nivo_taxonomy").val()=='category') {
				shortcode = shortcode + ' category="' + $("#nivo_term").val() + '"';
			} else {
				shortcode = shortcode + ' taxonomy="' + $("#nivo_taxonomy").val() + '"';
				shortcode = shortcode + ' term="' + $("#nivo_term").val() + '"';
			}
		}
	} 
	
	// ------------------------
	// SETTINGS WHICH APPLY TO A CURRENT POST SLIDER
	// ------------------------
	if ($("#nivo_settings_current_tab").val() == 'tab_current') {
		shortcode = shortcode + ' source="current-post" ';
		
	}
	// ------------------------
	// SETTINGS WHICH APPLY TO A NEXTGEN SLIDER
	// ------------------------
	if ($("#nivo_settings_current_tab").val() == 'tab_nextgen') {
		shortcode = shortcode + ' source="nextgen" ';
		
		// Show the gallery if specified 	
		if ($("#nivo_gallery").val() && $("#nivo_gallery").val()!='') 
			shortcode = shortcode + ' gallery=' + $("#nivo_gallery").val() + '';
		
	}
	
	// ------------------------
	// SLIDER SETTINGS APPLY TO SLIDERS WITH ANY SOURCE
	// ------------------------

	if ($("#nivo_number").val()) 	
		shortcode = shortcode + ' number=' + $("#nivo_number").val();

	if ($("#nivo_size").val() && $("#nivo_size").val()!='first') 		
		shortcode = shortcode + ' size="' + $("#nivo_size").val() + '"';
			
	if ($("#nivo_effect").val() && $("#nivo_effect").val()!='random') 		
		shortcode = shortcode + ' effect="' + $("#nivo_effect").val() + '"';
		
	if ($("#nivo_speed").val())			
		shortcode = shortcode + ' speed=' + $("#nivo_speed").val();
			
	if ($("#nivo_pause").val())			
		shortcode = shortcode + ' pause=' + $("#nivo_pause").val() + '';		

		/* The following options have been removed from the tinyMCE editor for now
		if ($("#nivo_pause_on_hover").val()) shortcode = shortcode + ' pause_on_hover='+$("#nivo_pause_on_hover").val();		
		if ($("#nivo_arrows").val())		shortcode = shortcode + ' arrows='+$("#nivo_arrows").val();
		if ($("#nivo_hide_arrows").val())	shortcode = shortcode + ' hide_arrows='+$("#nivo_hide_arrows").val();	
		if ($("#nivo_controls").val())		shortcode = shortcode + ' controls='+$("#nivo_controls").val();
		*/
		
	return shortcode+']<br>';
}