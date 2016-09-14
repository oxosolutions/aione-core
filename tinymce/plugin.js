tinymce.PluginManager.add('oxo_button', function(ed, url) {
	ed.addCommand("oxoPopup", function ( a, params )
	{
		var popup = 'shortcode-generator';

		if(typeof params != 'undefined' && params.identifier) {
			popup = params.identifier;
		}

		// load thickbox
		tb_show("Oxo Shortcodes", ajaxurl + "?action=oxo_shortcodes_popup&popup=" + popup);

		jQuery('#TB_window').hide();
	});

	// Add a button that opens a window
	ed.addButton('oxo_button', {
		text: '',
		icon: true,
		image: OxoShortcodes.plugin_folder + '/tinymce/images/icon.png',
		cmd: 'oxoPopup'
	});
});