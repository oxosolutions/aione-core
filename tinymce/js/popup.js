// start the popup specefic scripts
// safe to use $
var old_tb_remove = window.tb_remove;
var using_text_editor = false;
var text_editor_toggle;
var html_editor_toggle;
var editor_area;
var cursor_position = 0;

oxo_popup = function ( a, params ) {
	var popup = 'shortcode-generator';

	if(typeof params != 'undefined' && params.identifier) {
		popup = params.identifier;
	}

	// load thickbox
	tb_show("Oxo Shortcodes", ajaxurl + "?action=oxo_shortcodes_popup&popup=" + popup);

	jQuery('#TB_window').hide();
};

jQuery(document).ready(function($) {
	var tb_remove = function() {
		// check if text editor shortcode button was used; if so return to it
		if ( using_text_editor ) {
			using_text_editor = false;
			window.switchEditors.go( 'content' );
		}

		old_tb_remove();
	};

	window.aione_tb_height = (92 / 100) * jQuery(window).height();
	window.aione_oxo_shortcodes_height = (71 / 100) * jQuery(window).height();
	if(window.aione_oxo_shortcodes_height > 550) {
		window.aione_oxo_shortcodes_height = (74 / 100) * jQuery(window).height();
	}

	jQuery(window).resize(function() {
		window.aione_tb_height = (92 / 100) * jQuery(window).height();
		window.aione_oxo_shortcodes_height = (71 / 100) * jQuery(window).height();

		if(window.aione_oxo_shortcodes_height > 550) {
			window.aione_oxo_shortcodes_height = (74 / 100) * jQuery(window).height();
		}
	});

	themeoxo_shortcodes = {
		loadVals: function()
		{
			var shortcode = $('#_oxo_shortcode').text(),
				uShortcode = shortcode;

			// fill in the gaps eg {{param}}
			$('.oxo-input').each(function() {
				var input = $(this),
					id = input.attr('id'),
					id = id.replace('oxo_', ''),		// gets rid of the oxo_ prefix
					re = new RegExp("{{"+id+"}}","g");
					var value = input.val();
					if(value == null) {
					  value = '';
					}
				uShortcode = uShortcode.replace(re, value);
			});

			// adds the filled-in shortcode as hidden input
			$('#_oxo_ushortcode').remove();
			$('#oxo-sc-form-table').prepend('<div id="_oxo_ushortcode" class="hidden">' + uShortcode + '</div>');
		},
		cLoadVals: function()
		{
			var shortcode = $('#_oxo_cshortcode').text(),
				pShortcode = '';

				if(shortcode.indexOf("<li>") < 0) {
					shortcodes = '<br />';
				} else {
					shortcodes = '';
				}

			// fill in the gaps eg {{param}}
			$('.oxo-shortcodes-popup .child-clone-row').each(function() {
				var row = $(this),
					rShortcode = shortcode;

				if($(this).find('#oxo_slider_type').length >= 1) {
					if($(this).find('#oxo_slider_type').val() == 'image') {
						rShortcode = '[slide type="{{slider_type}}" link="{{image_url}}" linktarget="{{image_target}}" lightbox="{{image_lightbox}}"]{{image_content}}[/slide]';
					} else if($(this).find('#oxo_slider_type').val() == 'video') {
						rShortcode = '[slide type="{{slider_type}}"]{{video_content}}[/slide]';
					}
				}
				$('.oxo-cinput', this).each(function() {
					var input = $(this),
						id = input.attr('id'),
						id = id.replace('oxo_', '')		// gets rid of the oxo_ prefix
						re = new RegExp("{{"+id+"}}","g");
						var value = input.val();
						if(value == null) {
						  value = '';
						}
					rShortcode = rShortcode.replace(re, input.val());
				});

				if(shortcode.indexOf("<li>") < 0) {
					shortcodes = shortcodes + rShortcode + '<br />';
				} else {
					shortcodes = shortcodes + rShortcode;
				}
			});

			// adds the filled-in shortcode as hidden input
			$('#_oxo_cshortcodes').remove();
			$('.oxo-shortcodes-popup .child-clone-rows').prepend('<div id="_oxo_cshortcodes" class="hidden">' + shortcodes + '</div>');

			// add to parent shortcode
			this.loadVals();
			pShortcode = $('#_oxo_ushortcode').html().replace('{{child_shortcode}}', shortcodes);

			// add updated parent shortcode
			$('#_oxo_ushortcode').remove();
			$('#oxo-sc-form-table').prepend('<div id="_oxo_ushortcode" class="hidden">' + pShortcode + '</div>');
		},
		children: function()
		{
			// assign the cloning plugin
			$('.oxo-shortcodes-popup .child-clone-rows').appendo({
				subSelect: '> div.child-clone-row:last-child',
				allowDelete: false,
				focusFirst: false,
				onAdd: function(row) {
					// Get Upload ID
					var prev_upload_id = jQuery(row).prev().find('.oxo-upload-button').data('upid');
					var new_upload_id = prev_upload_id + 1;
					jQuery(row).find('.oxo-upload-button').attr('data-upid', new_upload_id);

					// activate chosen
					jQuery('.oxo-form-multiple-select').chosen({
						width: '100%',
						placeholder_text_multiple: 'Select Options or Leave Blank for All'
					});

					// activate color picker
					jQuery('.wp-color-picker-field').wpColorPicker({
						change: function(event, ui) {
							themeoxo_shortcodes.loadVals();
							themeoxo_shortcodes.cLoadVals();
						}
					});

					// changing slide type
					var type = $(row).find('#oxo_slider_type').val();

					if(type == 'video') {
						$(row).find('#oxo_image_content, #oxo_image_url, #oxo_image_target, #oxo_image_lightbox').closest('li').hide();
						$(row).find('#oxo_video_content').closest('li').show();

						$(row).find('#_oxo_cshortcode').text('[slide type="{{slider_type}}"]{{video_content}}[/slide]');
					}

					if(type == 'image') {
						$(row).find('#oxo_image_content, #oxo_image_url, #oxo_image_target, #oxo_image_lightbox').closest('li').show();
						$(row).find('#oxo_video_content').closest('li').hide();

						$(row).find('#_oxo_cshortcode').text('[slide type="{{slider_type}}" link="{{image_url}}" linktarget="{{image_target}}" lightbox="{{image_lightbox}}"]{{image_content}}[/slide]');
					}

					themeoxo_shortcodes.loadVals();
					themeoxo_shortcodes.cLoadVals();
				}
			});

			// remove button
			$('.oxo-shortcodes-popup .child-clone-row-remove').live('click', function() {
				var	btn = $(this),
					row = btn.parent();

				if( $('.oxo-shortcodes-popup .child-clone-row').size() > 1 )
				{
					row.remove();
				}
				else
				{
					alert('You need a minimum of one row');
				}

				return false;
			});

			// assign jUI sortable
			$( ".oxo-shortcodes-popup .child-clone-rows" ).sortable({
				placeholder: "sortable-placeholder",
				items: '.child-clone-row',
				cancel: 'div.iconpicker, input, select, textarea, a'
			});
		},
		resizeTB: function()
		{
			var	ajaxCont = $('#TB_ajaxContent'),
				tbWindow = $('#TB_window'),
				oxoPopup = $('#oxo-popup');

			tbWindow.css({
				height: window.aione_tb_height,
				width: oxoPopup.outerWidth(),
				marginLeft: -(oxoPopup.outerWidth()/2)
			});

			ajaxCont.css({
				paddingTop: 0,
				paddingLeft: 0,
				paddingRight: 0,
				height: window.aione_tb_height,
				overflow: 'auto', // IMPORTANT
				width: oxoPopup.outerWidth()
			});

			tbWindow.show();

			$('#oxo-popup').addClass('no_preview');
			$('#oxo-sc-form-wrap #oxo-sc-form').height(window.aione_oxo_shortcodes_height);
		},
		load: function()
		{

			var	oxo = this,
				popup = $('#oxo-popup'),
				form = $('#oxo-sc-form', popup),
				shortcode = $('#_oxo_shortcode', form).text(),
				popupType = $('#_oxo_popup', form).text(),
				uShortcode = '';

			// if its the shortcode selection popup
			if($('#_oxo_popup').text() == 'shortcode-generator') {
				$('.oxo-sc-form-button').hide();
			}

			// resize TB
			themeoxo_shortcodes.resizeTB();
			$(window).resize(function() { themeoxo_shortcodes.resizeTB() });

			// initialise
			themeoxo_shortcodes.loadVals();
			themeoxo_shortcodes.children();
			themeoxo_shortcodes.cLoadVals();

			// update on children value change
			$('.oxo-cinput', form).live('change', function() {
				themeoxo_shortcodes.cLoadVals();
			});

			// update on value change
			$('.oxo-input', form).live('change', function() {
				themeoxo_shortcodes.loadVals();
			});

			// change shortcode when a user selects a shortcode from choose a dropdown field
			$('#oxo_select_shortcode').change(function() {
				var name = $(this).val();
				var label = $(this).text();

				if(name != 'select') {
					oxo_popup(false, {
						title: label,
						identifier: name
					});

					$('#TB_window').hide();
				}
			});

			// activate chosen
			$('.oxo-form-multiple-select').chosen({
				width: '100%',
				placeholder_text_multiple: 'Select Options'
			});

			// update upload button ID
			jQuery('.oxo-upload-button:not(:first)').each(function() {
				var prev_upload_id = jQuery(this).data('upid');
				var new_upload_id = prev_upload_id + 1;
				jQuery(this).attr('data-upid', new_upload_id);
			});
		}
	}

	// run
	$('#oxo-popup').livequery(function() {
		themeoxo_shortcodes.load();

		$('#oxo-popup').closest('#TB_window').addClass('oxo-shortcodes-popup');

		$('#oxo_video_content').closest('li').hide();

			// activate color picker
			$('.wp-color-picker-field').wpColorPicker({
				change: function(event, ui) {
					setTimeout(function() {
						themeoxo_shortcodes.loadVals();
						themeoxo_shortcodes.cLoadVals();
					},
					1);
				}
			});
	});

	// when insert is clicked
	$('.oxo-insert').live('click', function() {

		if( using_text_editor ) {
			if( $('#oxo_select_shortcode').val() != 'table' ) {
				using_text_editor = false;

				// switch back to text editor mode
				window.switchEditors.go( 'content', html_editor_toggle );

				var html = $('#_oxo_ushortcode').html().replace( /<br>/g, '' );

				// inserting the new shortcode at the correct position in the text editor content field
				editor_area.val( [ editor_area.val().slice(0, cursor_position), html, editor_area.val().slice(cursor_position)].join( '' ) );

				tb_remove();
			}

		} else if(window.tinyMCE)
		{
			window.tinyMCE.activeEditor.execCommand('mceInsertContent', false, $('#_oxo_ushortcode').html());
			tb_remove();
		}
	});

	//tinymce.init(tinyMCEPreInit.mceInit['oxo_content']);
	//tinymce.execCommand('mceAddControl', true, 'oxo_content');
	//quicktags({id: 'oxo_content'});

	// activate upload button
	$('.oxo-upload-button').live('click', function(e) {
		e.preventDefault();

		upid = $(this).attr('data-upid');

		if($(this).hasClass('remove-image')) {
			$('.oxo-upload-button[data-upid="' + upid + '"]').parent().find('img').attr('src', '').hide();
			$('.oxo-upload-button[data-upid="' + upid + '"]').parent().find('input').attr('value', '');
			$('.oxo-upload-button[data-upid="' + upid + '"]').text('Upload').removeClass('remove-image');

			return;
		}

		var file_frame = wp.media.frames.file_frame = wp.media({
			title: 'Select Image',
			button: {
				text: 'Select Image',
			},
			frame: 'post',
			multiple: false  // Set to true to allow multiple files to be selected
		});

		file_frame.open();

		$('.media-menu a:contains(Insert from URL)').remove();

		file_frame.on( 'select', function() {
			var selection = file_frame.state().get('selection');
			selection.map( function( attachment ) {
				attachment = attachment.toJSON();

				$('.oxo-upload-button[data-upid="' + upid + '"]').parent().find('img').attr('src', attachment.url).show();
				$('.oxo-upload-button[data-upid="' + upid + '"]').parent().find('input').attr('value', attachment.url);

				themeoxo_shortcodes.loadVals();
				themeoxo_shortcodes.cLoadVals();
			});

			$('.oxo-upload-button[data-upid="' + upid + '"]').text('Remove').addClass('remove-image');
			$('.media-modal-close').trigger('click');
		});

		file_frame.on( 'insert', function() {
			var selection = file_frame.state().get('selection');
			var size = jQuery('.attachment-display-settings .size').val();

			selection.map( function( attachment ) {
				attachment = attachment.toJSON();

				if(!size) {
					attachment.url = attachment.url;
				} else {
					attachment.url = attachment.sizes[size].url;
				}

				$('.oxo-upload-button[data-upid="' + upid + '"]').parent().find('img').attr('src', attachment.url).show();
				$('.oxo-upload-button[data-upid="' + upid + '"]').parent().find('input').attr('value', attachment.url);

				themeoxo_shortcodes.loadVals();
				themeoxo_shortcodes.cLoadVals();
			});

			$('.oxo-upload-button[data-upid="' + upid + '"]').text('Remove').addClass('remove-image');
			$('.media-modal-close').trigger('click');
		});
	});

	// activate iconpicker
	$('.iconpicker i').live('click', function(e) {
		e.preventDefault();

		var iconWithPrefix = $(this).attr('class');
		var fontName = $(this).attr('data-name');

		if($(this).hasClass('active')) {
			$(this).parent().find('.active').removeClass('active');

			$(this).parent().parent().find('input').attr('value', '');
		} else {
			$(this).parent().find('.active').removeClass('active');
			$(this).addClass('active');

			$(this).parent().parent().find('input').attr('value', fontName);
		}

		themeoxo_shortcodes.loadVals();
		themeoxo_shortcodes.cLoadVals();
	});

	// table shortcode
	$('#oxo-sc-form-table .oxo-insert').live('click', function(e) {
		e.stopPropagation();

		var shortcodeType = $('#oxo_select_shortcode').val();

		if(shortcodeType == 'table') {
			var type = $('#oxo-sc-form-table #oxo_type').val();
			var columns = $('#oxo-sc-form-table #oxo_columns').val();

			var text = '<div class="oxo-table table-' + type + '"><table width="100%"><thead><tr>';

			for(var i=0;i<columns;i++) {
				text += '<th>Column ' + (i + 1) + '</th>';
			}

			text += '</tr></thead><tbody>';

			for(var i=0;i<columns;i++) {
				text += '<tr>';
				if(columns >= 1) {
					text += '<td>Item #' + (i + 1) + '</td>';
				}
				if(columns >= 2) {
					text += '<td>Description</td>';
				}
				if(columns >= 3) {
					text += '<td>Discount:</td>';
				}
				if(columns >= 4) {
					text += '<td>$' + (i + 1) + '.00</td>';
				}
				if(columns >= 5) {
					text += '<td>$ 0.' + (i + 1) + '0</td>';
				}
				if(columns >= 6) {
					text += '<td>$ 0.' + (i + 1) + '0</td>';
				}
				text += '</tr>';
			}

			text += '<tr>';

			if(columns >= 1) {
				text += '<td><strong>All Items</strong></td>';
			}
			if(columns >= 2) {
				text += '<td><strong>Description</strong></td>';
			}
			if(columns >= 3) {
				text += '<td><strong>Your Total:</strong></td>';
			}
			if(columns >= 4) {
				text += '<td><strong>$10.00</strong></td>';
			}
			if(columns >= 5) {
				text += '<td><strong>Tax: $10.00</strong></td>';
			}
			if(columns >= 6) {
				text += '<td><strong>Gross: $10.00</strong></td>';
			}
			text += '</tr>';
			text += '</tbody></table></div>';

			if( using_text_editor ) {
				using_text_editor = false;

				// switch back to text editor mode
				window.switchEditors.go( 'content', html_editor_toggle );

				// inserting the new shortcode at the correct position in the text editor content field
				editor_area.val( [ editor_area.val().slice(0, cursor_position), text, editor_area.val().slice(cursor_position)].join( '' ) );

				tb_remove();
			} else if(window.tinyMCE)
			{
				window.tinyMCE.activeEditor.execCommand('mceInsertContent', false, text);
				tb_remove();
			}
		}
	});

	// slider shortcode
	$('#oxo_slider_type').live('change', function(e) {
		e.preventDefault();

		var type = $(this).val();
		if(type == 'video') {
			$(this).parents('ul').find('#oxo_image_content, #oxo_image_url, #oxo_image_target, #oxo_image_lightbox').closest('li').hide();
			$(this).parents('ul').find('#oxo_video_content').closest('li').show();

			$('#_oxo_cshortcode').text('[slide type="{{slider_type}}"]{{video_content}}[/slide]');
		}

		if(type == 'image') {
			$(this).parents('ul').find('#oxo_image_content, #oxo_image_url, #oxo_image_target, #oxo_image_lightbox').closest('li').show();
			$(this).parents('ul').find('#oxo_video_content').closest('li').hide();

			$('#_oxo_cshortcode').text('[slide type="{{slider_type}}" link="{{image_url}}" linktarget="{{image_target}}" lightbox="{{image_lightbox}}"]{{image_content}}[/slide]');
		}
	});

	$('.oxo-add-video-shortcode').live('click', function(e) {
		e.preventDefault();

		var shortcode = $(this).attr('href');
		var content = $(this).parents('ul').find('#oxo_video_content');

		content.val(content.val() + shortcode);
		themeoxo_shortcodes.cLoadVals();
	});

	$('#oxo-popup textarea').live('focus', function() {
		var text = $(this).val();

		if(text == 'Your Content Goes Here') {
			$(this).val('');
		}
	});

	$('.oxo-gallery-button').live('click', function(e) {
		var gallery_file_frame;

		e.preventDefault();

		alert('To add images to this post or page for attachments layout, navigate to "Upload Files" tab in media manager and upload new images.');

		gallery_file_frame = wp.media.frames.gallery_file_frame = wp.media({
			title: 'Attach Images to Post/Page',
			button: {
				text: 'Go Back to Shortcode',
			},
			frame: 'post',
			multiple: true  // Set to true to allow multiple files to be selected
		});

		gallery_file_frame.open();

		$('.media-menu a:contains(Insert from URL)').remove();

		$('.media-menu-item:contains("Upload Files")').trigger('click');

		gallery_file_frame.on( 'select', function() {
			$('.media-modal-close').trigger('click');

			themeoxo_shortcodes.loadVals();
			themeoxo_shortcodes.cLoadVals();
		});
	});

	// text editor shortcode button was used
	jQuery(window).resize(function() {
		$('.quicktags-toolbar input[id*=oxo_shortcodes_text_mode]').addClass( 'oxo-shortcode-generator-button' );
	});
	$( '.switch-html, .oxo-expand-child' ).live('click', function(e) {
		$('.quicktags-toolbar input[id*=oxo_shortcodes_text_mode]').addClass( 'oxo-shortcode-generator-button' );
	});

	$('.quicktags-toolbar input[id*="oxo_shortcodes_text_mode"]').each(function() {
		$(this).addClass( 'oxo-shortcode-generator-button' );
	})

	$('.quicktags-toolbar input[id*=oxo_shortcodes_text_mode]').live('click', function(e) {

		var popup = 'shortcode-generator';

		// set the flag for text editor, change to visual editor
		using_text_editor = true;
		text_editor_toggle = 'tmce';
		html_editor_toggle = 'html';
		editor_area = $( this ).parents( '.wp-editor-container' ).find( '.wp-editor-area' );

		cursor_position = editor_area.getCursorPosition();

		window.switchEditors.go( 'content' );

		// load thickbox
		tb_show("Oxo Shortcodes", ajaxurl + "?action=oxo_shortcodes_popup&popup=" + popup);

		jQuery('#TB_window').hide();
	});
});


// Helper function to check the cursor position of text editor content field before the shortcode generator is opened
(function($, undefined) {
    $.fn.getCursorPosition = function() {
        var el = $(this).get(0);
        var pos = 0;
        if ('selectionStart' in el) {
            pos = el.selectionStart;
        } else if ('selection' in document) {
            el.focus();
            var Sel = document.selection.createRange();
            var SelLength = document.selection.createRange().text.length;
            Sel.moveStart('character', -el.value.length);
            pos = Sel.text.length - SelLength;
        }
        return pos;
    }
})(jQuery);