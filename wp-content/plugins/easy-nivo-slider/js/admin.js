// JavaScript Document
jQuery(document).ready(function($) {
	change_post_type();
	change_taxonomy();	

	$('#nivo_post_type').change(function() {
		change_post_type();	
	});
	
	$('#nivo_taxonomy').change(function() {
		change_taxonomy();	
	});
	
	// When a checkbox is checked/unchecked, set the value of the text field whose ID matches the checkbox's name
	// This allows us to force a value to "false" even when the default is "true"
	$('.nivo_checkbox').change(function() {	
		if ($(this).is(":checked"))	$('#'+$(this).attr('name')).val('true');
		else $('#'+$(this).attr('name')).val('false');	
	});	
	
	// When a checkbox is checked/unchecked, set the value of the text field whose ID matches the checkbox's name
	// This allows us to force a value to "false" even when the default is "true"
	$('.nivo_checkbox_controls').change(function() {			 	
		if ($(this).is(":checked"))	{
			$('.nivo_checkbox_controls').attr('checked', false);
			$('.nivo_checkbox_controls_field').val('false');	
			$(this).attr('checked', true);
			
			$('#'+$(this).attr('name')).val('true');
		} else {
			$('#'+$(this).attr('name')).val('false');	
		}
	});	
	
	
	
	// Filter numeric fields 
	$(".nivo_numeric_field").keydown(function(event) {
		// Allow only backspace, delete, period, enter, tab
		if (event.keyCode==46 || event.keyCode==8 || event.keyCode==190 || event.keyCode==13  || event.keyCode==9) {
			// let it happen, don't do anything
		} else {
			// Ensure that it is a number and stop the keypress
			if (event.keyCode < 48 || event.keyCode > 57) {
				event.preventDefault();	
			}	
		}
	});
	
	// Validate the opacity field
	$('.nivo_opacity_field').change(function() {
		if ($(this).val() < 0) $(this).val(0);
		if ($(this).val() > 1) $(this).val(1);
	});

	// When the post_type is changed, show all the taxonomies linked to the new one
	function change_post_type() {					 
		$('.taxonomy').hide();
		$('.post_type_'+$('#nivo_post_type').val()).show();
		change_taxonomy();	
		
	}
	
	// When the taxonomy is changed, show all the terms linked to the new one
	function change_taxonomy() {
		$('.term').hide();
		$('.taxonomy_'+$('#nivo_taxonomy').val()).show();
	}	
});