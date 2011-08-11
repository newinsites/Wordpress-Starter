// JavaScript Document
(function() {
	//alert 'goober';
	tinymce.create('tinymce.plugins.easy_nivo_slider_plugin_function', {
		init : function(ed, url) {	
		
			// Register command to be executed.
			ed.addCommand('easy_nivo_slider_plugin_command', function() {
				ed.windowManager.open({
					file : url + '/popup_window.php',
					width : 500 + parseInt(ed.getLang('popup_window.delta_width', 0)),
					height : 430 + parseInt(ed.getLang('popup_window.delta_height', 0)),
					inline : 1
				}, {
					plugin_url : url
				});
			});

			// Register button that will be displayed on wordpress rich editor
			ed.addButton('easy_nivo_slider_plugin_button', 
				{title:'Easy Nivo Slider', cmd:'easy_nivo_slider_plugin_command', image:url+'/icon.gif'});},

				getInfo : function() {
					return {
						longname : 'Easy Nivo Slider',
						author : 'Phillip Bryan',
						authorurl : 'http://www.theemeraldcurtain.com',
						infourl : 'http://www.theemeraldcurtain.com',
						version : tinymce.majorVersion + "." + tinymce.minorVersion
					};
				}
			});

			// Register plugin
			tinymce.PluginManager.add('easy_nivo_slider_plugin', tinymce.plugins.easy_nivo_slider_plugin_function);
})();