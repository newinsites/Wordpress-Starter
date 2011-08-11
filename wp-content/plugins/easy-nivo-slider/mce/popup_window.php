<?php 
session_start(); 
include_once('../misc/forms.php');
include_once('../misc/post-type-functions.php');

$nivo_tax = unserialize($_SESSION['nivo_tax']);
$nivo_options = unserialize($_SESSION['nivo_options']);

if (isset($_SESSION['nivo_nextgen'])) {
	$nivo_nextgen = unserialize($_SESSION['nivo_nextgen']);
	include_once('../nextgen/functions.php');
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Easy Nivo Slider</title>
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/tiny_mce_popup.js"></script>
	<script type="text/javascript" src="js/popup_window.js"></script>
	<script type="text/javascript" src="../js/settings.js"></script>
	<script type="text/javascript" src="../js/admin.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
    <style>
	#nivo_settings_tab {  border-bottom:2px solid #aaa; } 
    
	
	
	#nivo_settings_tab a, #nivo_settings_tab a:active, #nivo_settings_tab a:visited {
	 	background-color: #e0e0e0; color:#999; border-color:#aaa;
	}
	#nivo_settings_tab .current a { border-bottom:#f1f1f1 2px solid; background:#f1f1f1; color:#333; }
    
    </style>
</head>
<body>	
	<form action="#" method="get" accept-charset="utf-8">
   	
		<ul id="nivo_settings_tab">
			<li class="current tab_current"><a name="tab_current" href="#">Current Post Slider</a></li>
			<li class="tab_featured"><a name="tab_featured" href="#">Featured Images Slider</a></li>
            
            <?php if ('true'==$nivo_options['activate_nextgen'] && is_array($nivo_nextgen)) { ?>
				<li class="tab_nextgen"><a name="tab_nextgen" href="#">NextGen Slider</a></li>
			<?php } ?>
		</ul>        
                        
    <input id="nivo_settings_current_tab" name="easy_nivo_slider_options[nivo_settings_current_tab]"
    	type="hidden" value="tab_current" />     

    <div id="nivo_settings_content">
    
		<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
	    <!-- TAB 																						-->
		<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
		<div class="tab current tab_current">  
	    	<p>Display a slider with images from the the current post or page.</p>      
		</div> 

		<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
	    <!-- TAB 																						-->
		<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
		<div class="tab tab_featured">   
	    	<p>Display a slider with the featured images from multiple posts.</p>
	    	<?php sns_form_image_selection ( 'nivo_', 'easy_nivo_slider_options', $options, $nivo_tax );	?>    
	    </div>

		<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
	    <!-- TAB 																						-->
		<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->	
	    <?php if (is_array($nivo_nextgen)) { ?>	
	    	<div class="tab tab_nextgen">       
	    		<p>Display a slider with images from a NextGen gallery</p>
	    	    <?php sns_print_nextgen_gallery_form ( 'nivo_', 'easy_nivo_slider_options', $options, $nivo_nextgen ); ?>
	    	</div>
	    <?php } ?>
    
    </div>   <!-- nivo_settings_content -->	
    
	<?php sns_form_slider_settings ( 'nivo_', 'easy_nivo_slider_options', $options  );	?>
               
	<div align="center">	   
		<input type="submit" id="insert" name="insert" value="Insert" onClick="submit_mce_form();" />
		<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();" />
        </div>
             
	</form>
</body>
</html>
<?php
// -----------------------
// EASY ECHO FUNCTION, BECAUSE THIS POPUP WINDOW DOESN'T RUN IN THE WORDPRESS SPACE
// -----------------------
function _e($txt) { echo $txt; }
?>

