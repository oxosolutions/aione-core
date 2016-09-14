var instance;
(function ( $ ) {
	"use strict";

    $(".oxo-tabs-menu a").live('click',function(event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".oxo-tab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });


	$.OxoAdmin = (function () {

		//wrapper arround tinymce editor
		var classicEditorWrap		= $( '#postdivrich_wrap' );
		//button to switch between wordpress editor and avia builder
		var switchButton	  		= $( '#oxo-pb-switch-button' );
		//initial oxo page builder state
		window.oxoBuilderState 	= 'inactive';
		//oxo page builder element
		var oxoPageBuilder 		= $( '#oxo-page-builder' );
		//wp default editor element
		var wpDefaultEditor 		= $( '#postdivrich' );
		//oxo editor inside
		var oxoInsider			= $( '.oxo_insider' );
		//toggle handerl
		var toggleHander			= $( '.oxo_toggler' );
		//oxo builder undo
		var oxoBuilderUndo		= $( '.oxo_undo' );
		//oxo builder redo
		var oxoBuilderRedo		= $( '.oxo_redo' );
		//oxo upload button
		var oxoUploadButton		= $( '.oxob-upload-button , .oxob-edit-button' );
		//oxo gallery add
		var oxoGalleryAdd		= $( '.oxo-gallery-button' );
		//add more button
		var oxoAddMore			= $( '#oxo-child-add' );
		//expand child in edit panel
		var oxoExpandChild		= $( '.oxo-expand-child' );
		// oxo remove child element button
		var oxoRemoveChild		= $( '.child-clone-row-remove' );
		// pricing table handler 1-4
		var pricingTableHandler		= $( '#oxo_pricing_table_type , #oxo_pricing_table_columns, #oxo_pricing_table_class, #oxo_pricing_table_id');
		//princg table handlers for color fields
		var pricingTableHandlerC	= $( '#oxo_pricing_table_backgroundcolor , #oxo_pricing_table_bordercolor , #oxo_pricing_table_dividercolor' );
		//publish handler
		var oxoPublish			= $( '#publish' );
		// delete all elements handler
		var oxoDeleteAll			= $( '#del_icon' );
		//handler for icon pikcer
		var iconPickHandler			= $( '.icon_select_container .icon_preview' );
		//slide sub-elements type handler
		var sliderElementHandler	= $( "select[name*='oxo_slider_type']");
		//video shortocdes handler
		var videoScHandler			= $( '.oxob-add-shortcode' );
		//Woo shortocdes handler
		var WooShortcodeHanlder		= $( '#oxo_woo_shortocode' );
		// Oxo login shortcode handle
		var oxo_login_handler	= $( '#oxo_login_type' );
		//dialog overlay handler
		var dialogOverlayHanlder	= $('.ui-widget-overlay');
		//wp preview handler
		var wpPreviewHandler		= $( '#post-preview' );
		//save as draf handler
		var draftHandler			= $( '#save-post' )
		// parent/child level settings
		var settings_lvl			= $( '#oxo_settings_lvl' );

		//check if builder was used last time
		jQuery(document).ready(function() {
			// Allow interaction outside jQuery Dialog
			$.ui.dialog.prototype._allowInteraction = function(event) {
				return true;
			};

			instance = jQuery('#oxo-page-builder').attr('instance');
			var data = {
				action		: 'oxo_editor_state',
				instance	: instance
			};

			if ((typeof tinyMCE.get('content') != 'object' || typeof tinyMCE.get('content') != null) && jQuery('#oxo-page-builder input[name=oxo_builder_status]').val() == 'active' ){
				window.oxo_builder_initial_load = true;
				showOxoEditor(switchButton);
				setBuilderState('active');
				// Distraction free writing won't work with us the builder
				if ( $( '#qt_content_dfw' ).hasClass( 'active' ) ) {
					$( '.mce-wp-dfw.mce-active' ).click();
				}
			}
		});

		/*jQuery(window).load(function() {
			if ((typeof tinyMCE.get('content') != 'object' || typeof tinyMCE.get('content') != null) && jQuery('#oxo-page-builder input[name=oxo_builder_status]').val() == 'active' ){
				showOxoEditor(switchButton);
				setBuilderState('active');
			}
		});*/

		switchButton.on('click', function( e ) {
			// Distraction free writing won't work with us the builder
			if ( $( '#qt_content_dfw' ).hasClass( 'active' ) ) {
				$( '.mce-wp-dfw.mce-active' ).click();
			}
			if( oxoBuilderState != 'active' ) { //if page builder currently inactive
				DdHelper.shortCodestoBuilderElements();
				showOxoEditor(this);
				setBuilderState('active');
			} else {  //if page builder currently actives
				hideOxoEditor(this);
				setBuilderState('inactive');
				if(typeof window.editorExpand == 'object') {
					window.editorExpand.off();
				}
			}
		});

		//function to get content for default editor
		function getContentForEditor() {
			var editorElements 		= $("#editor").find('.item-wrapper').length;
			if (editorElements > 0) {
				var builderData = oxoHistoryManager.getAllElementsData();
				var data = {
					action			: 'oxo_get_shortcodes',
					builder_data	: builderData
				};

				$.post(ajaxurl, data ,function( response ) {
					if( isTinyMceActive() ) {
						window.tinyMCE.activeEditor.setContent( response );
					} else {
						$('#content').val( response );
					}

				});
			}

		}
		function isTinyMceActive() {

			var isActive = (typeof tinyMCE != "undefined") && tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden();

			return isActive;
		}
		//function to change builder state
		function setBuilderState( state ) {
			jQuery('#oxo-page-builder input[name=oxo_builder_status]').val(state);
			window.oxoBuilderState = state;
		}
		//function to show oxo editor and hide wp editor
		function showOxoEditor( obj ) {

			wpDefaultEditor.parent().addClass('default-editor-hide');//hide default editor
			oxoPageBuilder.removeClass('oxo-page-builder-hide');
			$(obj).text($(obj).attr('data-active-button'));
			$(obj).addClass('dashicons-no');
			$(obj).removeClass('dashicons-plus');
		}
		//function to hide wp editor and show oxo editor
		function hideOxoEditor( obj ) {

			wpDefaultEditor.parent().removeClass('default-editor-hide');//show default editor
			oxoPageBuilder.addClass('oxo-page-builder-hide');
			$(obj).text($(obj).attr('data-inactive-button'));
			$(obj).addClass('dashicons-plus');
			$(obj).removeClass('dashicons-no');
			oxoParser.checkBuilderElements();
		}
		//oxo builder toggle
		toggleHander.on('click', function( e ) {

			oxoInsider.fadeToggle( "fast", function() {
				$('.oxo-toggler').toggleClass("fa-sort-desc").toggleClass("fa-sort-asc");
  			});
		});
		//woocommerce shortocodes hanlder
		WooShortcodeHanlder.live('change', function( e ) {
			var shortoCodes = new Array(
										' ',
										'[woocommerce_order_tracking]',
										'[add_to_cart id="" sku=""]',
										'[product id="" sku=""]',
										'[products ids="" skus=""]',
										'[product_categories number=""]',
										'[product_category category="" per_page="12" columns="4" orderby="date" order="desc"]',
										'[recent_products per_page="12" columns="4" orderby="date" order="desc"]',
										'[featured_products per_page="12" columns="4" orderby="date" order="desc"]',
										'[woocommerce_shop_messages]'
										);
			var selected  = $(this).val();
			//update content
			$('#oxo_woo_shortocde_content').val( shortoCodes[selected] );

		});
		// Oxo login shortocodes hanlder
		oxo_login_handler.live('change', function( e ) {

			var $selected  = $( this ).val();

			if ( $selected == 'oxo_login' ) {
				$( this ).parents( '.TF_Login' ).find( '#oxo_register' ).parent().parent().show();
				$( this ).parents( '.TF_Login' ).find( '#oxo_lost_password' ).parent().parent().show();
			} else {
				$( this ).parents( '.TF_Login' ).find( '#oxo_register' ).parent().parent().hide();
				$( this ).parents( '.TF_Login' ).find( '#oxo_lost_password' ).parent().parent().hide();
			}
		});
		//change slider sub element type
		sliderElementHandler.live('change', function( e ) {

			var currentValue 	= $(this).val();
			var parent 			= $(this).parent().parent().parent();

			if( currentValue == "video") {
				$(parent).find('.funsion-element-child').hide();
				$(parent).find("select[name*='oxo_slider_type']").parent().parent().show();
				$(parent).find("[name*='video_content']").parent().parent().show();
			} else {
				$(parent).find('.funsion-element-child').show();
				$(parent).find("[name*='video_content']").parent().parent().hide();
			}

		});
		//inset short-code in text area on button click
		videoScHandler.live('click', function( e ) {
			e.preventDefault();
			var toInsert 	= $(this).attr('sc-data');
			$(this).parent().parent().parent().find("[name*='video_content']").val(toInsert);

		});
		//add more in editor
		oxoAddMore.live('click', function( e ) {

			var model_for_clone;
			var LastRow 			= $(this). // our button
									closest('table'). // Go upwards through our parents untill we hit the table
									find('tr.child-clone-row:last').html();

			var regex = /\d+/g;
			var lastId = regex.exec($(LastRow).find('[name^=oxo_]').attr('name'));
			lastId = lastId[0];
			var newId = parseInt(lastId) + 1;

			var newRowHTML = $('#child-element-data').html();
			var model = $('#dialog_form').dialog('option', 'referencedView').model;

			var newElement = $.extend(true, {}, model.attributes.defaults);

			newElement = _.toArray(newElement);
			for(var t=0; t<newElement.length; t++) {

				if( newElement[t] !== undefined && newElement[t]['id'] !== undefined ) {
					newElement[t]['id'] = newElement[t]['id'].replace('[0]', '[' + newId + ']');
				}
			}

			$.each(model.attributes.subElements, function(key, element) {
				if(element['type'] == 'addmore') {
					model.attributes.newElements.push(newElement);
				}
			});

			model_for_clone = newElement;

			var childrenHTML = "";
			childrenHTML	  += "<td><a href='#' class='oxo-expand-child'>" + model.attributes.name + " Item " + (newId + 1) + "<i class='oxoa-plus2'></i></a><div class='child-options' style='display: none;'>";
			jQuery.each (model_for_clone, function( innerKey, dynamic_element ) {
				var ChildElement = dynamic_element;
				//if not object then move to next iteration
				if( $.isEmptyObject( ChildElement ) == true ) { return true; }

				childrenHTML  += "<div class='clearfix form-element-container funsion-element-child form-element-container-" + ChildElement['type'] + "'><div class='name-description'>";

				if( ChildElement['name'] != "" ) { childrenHTML += "<strong>" + ChildElement['name'] + "</strong>"; }
				if( ChildElement['desc'] != "" ) { childrenHTML += "<span>" + ChildElement['desc'] + "</span>"; }

				childrenHTML  += "</div>";
				childrenHTML  += "<div class='element-type'>";
				childrenHTML  += DdElementParser.parseElementType(ChildElement);
				childrenHTML  += "</div>";
				childrenHTML  += "</div>";
			});
			childrenHTML	  +="<a class='child-clone-row-remove oxo-shortcodes-button' href='JavaScript:void(0)'>Remove</a>";
			childrenHTML	  += "</div></td>";

			var newRow 			= $('<tr class="child-clone-row">' + childrenHTML + '</tr>');

			var current_upid = parseInt($(LastRow).find('a.oxob-upload-button').attr('data-upid'));
			var text_arr = [];

			$(newRow).find(".html-field").each(function() {
				$(this).attr('id', 'oxo_content_wp_' + window['oxo_builder_tinymce_count']);
				text_arr.push(window['oxo_builder_tinymce_count']);
				window['oxo_builder_tinymce_count']++;
			});
			$(newRow).find('a.oxob-upload-button').attr('data-upid',current_upid+1);
			$(newRow).find('a.oxob-edit-button').attr('data-upid',current_upid+1);
			$(this).closest("table").find('tr:last').before(newRow); // add copy

			//activae color picker
			if ( $('.oxo-color-field').length > 0 ) {
				$('#dialog_form .oxo-color-field').wpColorPicker();
			}

			//activate WP editor
			if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) {
				$.each(text_arr, function(index, id) {
					var value = $(newRow).find('.html-field').val();
					$(newRow).find(".html-field").wp_editor( value );
				});
			}

		});
		//add more in editor
		oxoExpandChild.live('click', function( e ) {
			e.preventDefault();

			$(this).parent().find('.child-options').slideToggle('fast', function() {
				if($(this).is(':hidden')) {
					jQuery(this).parent().find('.oxo-expand-child i').attr('class', 'oxoa-plus2');
				} else {
					jQuery(this).parent().find('.oxo-expand-child i').attr('class', 'oxoa-minus');
				}
			});;
		});
		//remove child in editor
		oxoRemoveChild.live('click', function( e ) {
			var	button 		= $(this);
			var row 		= button.closest('tr');
			var totalRows 	= $(this).closest('table').find('tr.child-clone-row').size();
			var currentRow	= button.closest('tr').index();

			if( totalRows > 1 ) {
				row.remove();
			} else {
				alert('You need a minimum of one row');
				return;
			}

			Array.prototype.remove = function(from, to) {
				if ( this ) {
					var rest = this.slice((to || from) + 1 || this.length);
					this.length = from < 0 ? this.length + from : from;
					return this.push.apply(this, rest);
				}
			};

			var model = $('#dialog_form').dialog('option', 'referencedView').model;
			$.each(model.attributes.subElements, function(key, element) {
				if(element['type'] == 'addmore') {
					element['elements'].splice( parseInt( currentRow ) ,1 );
					model.attributes.subElements[key]['elements'] = element['elements'];
				}
			});

			return false;

		});
		//save builder contents
		oxoPublish.one('click', function( e ) {

			if( oxoBuilderState != 'active' ) { //if oxo builder not active i.e. WP default editor is active
				//trigger click event
				$( '#publish' ).trigger( "click" );
			} else {
				var editorElements 		= $("#editor").find('.item-wrapper').length;
				if(editorElements >= 0 && window.oxo_builder_fully_loaded == true) {
					// save data to server
					DdHelper.handleElementWidthAndOrder();
					// add short-codes to wp editor
					oxoParser.checkBuilderElements( true );
				} else {
					$( '#publish' ).trigger( "click" );
				}
			}

		});
		//delete all elements
		oxoDeleteAll.on('click', function( e ) {
			var editorElements 		= $("#editor").find('.item-wrapper').length;
			if (editorElements > 0) {
				var elText 		= editorElements > 1 ? 'elements' : 'element';
				if( confirm ("Are you sure you want to delete all ("+editorElements+") "+elText+"? it can not be undone.") ) {
					Editor.deleteAllElements();
				}
			}
		});
		//update pricing table
		pricingTableHandler.live( 'change blur', function() {
			updatePricingTable();
		});
		//update pricing table
		pricingTableHandlerC.live( 'change blur set' ,function() {
			updatePricingTable();
		});
		//table visual creator
		$( '#oxo_table_type, #oxo_table_columns' ).live( 'change', function() {

			var type 		= $( '#oxo_table_type' ).val();
			var columns 	= $( '#oxo_table_columns' ).val();
			var text 		= '[aione_text]<div class="table-' + type + '"><table width="100%"><thead><tr>';

			for( var i = 0; i < columns; i++ ) {
				text += '<th align="left">Column ' + (i + 1) + '</th>';
			}

			text += '</tr></thead><tbody>';

			for( var i = 0; i < columns; i++ ) {
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
				text += '</tr>';
			}

			text += '<tr>';

			if( columns >= 1 ) {
				text += '<td><strong>All Items</strong></td>';
			}
			if( columns >= 2 ) {
				text += '<td><strong>Description</strong></td>';
			}
			if( columns >= 3 ) {
				text += '<td><strong>Your Total:</strong></td>';
			}
			if( columns >= 4 ) {
				text += '<td><strong>$10.00</strong></td>';
			}
			if( columns >= 5 ) {
				text += '<td><strong>Tax</strong></td>';
			}
			text += '</tr>';
			text += '</tbody></table></div>[/aione_text]';
			//update content in wp editor
			tinyMCE.activeEditor.setContent( text );

		});
		// iconpicker select/deselect handler
		iconPickHandler.live('click', function(e) {

			e.preventDefault();
			var iconWithPrefix 	= $(this).find('i').attr('class');
			var fontName 		= $(this).find('i').attr('data-name');

			if( $(this).hasClass( 'selected-element' ) ) {
				$(this).find('i').parent().parent().find( '.selected-element' ).removeClass( 'selected-element' );
				$(this).find('i').parent().parent().parent().find( 'input' ).attr( 'value' , '' );

			} else {

				$(this).find('i').parent().parent().find( '.selected-element' ).removeClass( 'selected-element' );
				$(this).find('i').parent().addClass( 'selected-element' );
				$(this).find('i').parent().parent().parent().find( 'input' ).attr( 'value' , fontName );
			}


		});
		//backbone undo manager handler for Undo
		oxoBuilderUndo.click(function () {
			oxoHistoryManager.doUndo();
		});
		//backbone undo manager handler for redo
		oxoBuilderRedo.click(function () {
			oxoHistoryManager.doRedo();
		});
		// active media gallery upload
		oxoGalleryAdd.live('click', function(e) {
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

			$('.media-menu-item:contains("Upload Files")').trigger('click');

			gallery_file_frame.on( 'select', function() {
				$('.media-modal-close').trigger('click');

			});
		});

		// activate upload button
		oxoUploadButton.live('click', function(e) {

			e.preventDefault();
			var upid = $(this).attr('data-upid');

			if($(this).hasClass('remove-image')) {
				$('form .oxob-upload-button[data-upid="' + upid + '"]').parent().find('img').attr('src', '').hide();
				$('form .oxob-upload-button[data-upid="' + upid + '"]').parent().find('input').attr('value', '');
				$('form .oxob-edit-button[data-upid="' + upid + '"]').hide();
				$('form .oxob-upload-button[data-upid="' + upid + '"]').text('Upload').removeClass('remove-image');

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
			var src = $('form .oxob-upload-button[data-upid="' + upid + '"]').parent().find('img').attr('src');
			if( src != '' ) {

				var data = {
						action			: 'oxo_get_attachment_url_from_id',
						url				: src
					};

					$.post(ajaxurl, data ,function( response ) {

						var selection = file_frame.state().get('selection');
						var id = response;
						var attachment = wp.media.attachment(id );
						attachment.fetch();
						selection.add( attachment ? [ attachment ] : [] );

					});
			}



			//hide insert from URL
			$( '.media-menu a' ).last().remove();

			file_frame.on( 'select', function() {
				var selection = file_frame.state().get('selection');
					selection.map( function( attachment ) {
					attachment = attachment.toJSON();

					$('form .oxob-upload-button[data-upid="' + upid + '"]').parent().find('img').attr('src', attachment.url).show();
					$('form .oxob-upload-button[data-upid="' + upid + '"]').parent().find('input').attr('value', attachment.url);

				});

				$('form .oxob-upload-button[data-upid="' + upid + '"]').text('Remove').addClass('remove-image');
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

					$('form .oxob-upload-button[data-upid="' + upid + '"]').parent().find('img').attr('src', attachment.url).show();
					$('form .oxob-upload-button[data-upid="' + upid + '"]').parent().find('input').attr('value', attachment.url);
					$('form .oxob-edit-button[data-upid="' + upid + '"]').show();


				});

				$('form .oxob-upload-button[data-upid="' + upid + '"]').text('Remove').addClass('remove-image');
				$('.media-modal-close').trigger('click');
				//for generator
			});
		});

		//remove dialog overlay on click outside
		dialogOverlayHanlder.live('click', function() {
			$(".ui-dialog-titlebar-close").click();
		});
		//update pricing table
		function updatePricingTable() {

			var type 				= $( '#oxo_pricing_table_type' ).val();
			var columns 			= $( '#oxo_pricing_table_columns' ).val();
			var backgroundColor 	= $( '#oxo_pricing_table_backgroundcolor' ).val();;
			var borderColor 		= $( '#oxo_pricing_table_bordercolor' ).val();;
			var dividerColor 		= $( '#oxo_pricing_table_dividercolor' ).val();
			var cssClass			= $( '#oxo_pricing_table_class' ).val();
			var cssID				= $( '#oxo_pricing_table_id' ).val();

			var text 				=  ' [aione_text][pricing_table type="'+type+'" ';
				text				+= ' backgroundcolor="'+backgroundColor+'" ';
				text				+= ' bordercolor="'+borderColor+'" ';
				text				+= ' dividercolor="'+dividerColor+'"';
				text				+= ' class="'+cssClass+'"';
				text				+= ' id="'+cssID+'"]';

				if(jQuery('#' + tinyMCE.activeEditor.id).parents('.wp-editor-wrap').hasClass('html-active')) {
					text				+= columns.replace(/<br[^>]*>/gi, '\n')
				} else {
					text				+= columns;
				}
				text				+= '[/pricing_table][/aione_text]';

			//update content for wp editor
			tinyMCE.activeEditor.setContent( text );
			//update content for text editor
			$( ".TF_PricingTable textarea[id^='oxo_content_wp']" ).val( text );
		}
		//handle wordpress preview
		wpPreviewHandler.live('click', function( e, halt ) {
			if( halt != 'halt' ) {
				// pervent default preview actions.
				e.preventDefault();

				if( oxoBuilderState != 'active' ) { //if oxo builder not active i.e. WP default editor is active
					//trigger click event
					//wpPreviewHandler.trigger( "click" );
				} else {
					// add short-codes to wp editor
					oxoParser.checkBuilderElements();
					//trigger click event
					wpPreviewHandler.trigger( "click", [ "halt"] ); //pass argument to stop next execution
				}
			}
		});

		draftHandler.one( 'click', function ( e ) {
			// pervent default publish actions.
			e.preventDefault();
			if( oxoBuilderState != 'active' ) { //if oxo builder not active i.e. WP default editor is active
				//trigger click event
				draftHandler.trigger( "click" );
			} else {
				// add short-codes to wp editor
				oxoParser.checkBuilderElements();
				//trigger click event
				draftHandler.trigger( "click" );
			}
		});

		// change the level of settings
		settings_lvl.live('change', function() {
			tinyMCE.triggerSave();

			$('#dialog_form').dialog( 'option', 'referencedView' ).updateElement();

			var model = $('#dialog_form').dialog('option', 'referencedView').model;
			var $dialog = $('#dialog_form');

			model.attributes.subElements[0]['value'] = jQuery( this ).val();

			DdElementParser.generateHtml( model, jQuery( this ).val() );
			document.getElementById('dialog_form').innerHTML = model.get('editPanel_innerHtml');

			//activae color picker
			if ( $( '.oxo-color-field' ).length > 0 ) {
			    $dialog.find( '.oxo-color-field' ).wpColorPicker();

			}
			//for jQuery chosen
			if ( $( '.chosen-select' ).length > 0 ) {
			    $( '.chosen-select' ).chosen(
			        {
			            placeholder_text_multiple: 'Select Options'
			        }
			    );
			}
			//replace text area with wp_editor if element is text block
			if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) {
			    $dialog.find( ".html-field" ).each(
			        function() {
			            $( this ).attr( 'id', 'oxo_content_wp_' + window['oxo_builder_tinymce_count'] );
			            window['oxo_builder_tinymce_count']++;
						var value = $( this ).val();
						$( this ).wp_editor( value );
			        }
			    );
			}
			// icons
			$( '.icon_select_container' ).each(
			    function() {
			        var icon_name = $( this ).parents( '.element-type' ).find( 'input[type=hidden]' ).val();
			        if ( icon_name ) {
			            $( this ).find( '.' + icon_name ).addClass( 'selected-element' );
			        }
			    }
			);

			tinyMCE.triggerSave();
			$('#dialog_form').dialog( 'option', 'referencedView' ).updateElement();
		});

	});


	$(document).ready(function () {

		$.oxoAadminObj = new $.OxoAdmin();
	});

}(jQuery));
