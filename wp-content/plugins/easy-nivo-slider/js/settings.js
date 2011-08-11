// JavaScript Document
jQuery(document).ready(function($) {
	nivo_change_tab();

	// Handle tab navigation
	$('#nivo_settings_tab a').click(function() {	
						
		$('#nivo_settings_current_tab').val($(this).attr('name'));	
		nivo_change_tab();
	});
	
	$('.nivo_preview_button').click(function() {								
		$('#nivo_preview').val($(this).attr('name'));	
		$('#nivo_settings_current_tab').val('tab_general');	
		return true;
	});
	
	function nivo_change_tab() {	
		newtab = '.' + $('#nivo_settings_current_tab').val();
		if (newtab=='.') newtab = '.tab_1';

		$('#nivo_settings_tab li').removeClass('current');	
		$('#nivo_settings_tab li'+newtab).addClass('current');
		
		$('#nivo_settings_content .tab').removeClass('current');
		$('#nivo_settings_content '+newtab).addClass('current');
	}
});