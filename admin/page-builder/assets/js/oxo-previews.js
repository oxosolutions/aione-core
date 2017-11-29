/*
* Previews of builder elements
*/
( function($) {

	var oxoPreview		= {};
	window.oxoPreview 	= oxoPreview;
	/**
	* Caller for respective element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updatePreview = function ( thisRef, model, subElements ) {
		if(typeof model.get('css_class') != 'undefined' && model.get('css_class').indexOf('oxo_layout_column') > -1) {
			return;
		}

		switch( model.get( 'php_class' ) ) { //switch case on name of element
			case 'TF_AlertBox':
				oxoPreview.updateAlertPreview( thisRef, model, subElements );
			break;

			case 'TF_WpBlog':
				oxoPreview.updateBlogPreview( thisRef, model, subElements );
			break;

			case 'TF_ButtonBlock':
				oxoPreview.updateButtonPreview( thisRef, model, subElements );
			break;

			case 'TF_CheckList':
				oxoPreview.updateChecklistPreview( thisRef, model, subElements );
			break;

			case 'TF_ClientSlider':
				oxoPreview.updateClientSliderPreview( thisRef, model, subElements );
			break;

			case 'TF_ContentBoxes':
				oxoPreview.updateContentBoxesPreview( thisRef, model, subElements );
			break;

			case 'TF_CountDown':
				oxoPreview.updateCountdownPreview( thisRef, model, subElements );
			break;

			case 'TF_CounterBox':
				oxoPreview.updateCounterBoxPreview( thisRef, model, subElements );
			break;

			case 'TF_FlipBoxes':
				oxoPreview.updateFlipBoxesPreview( thisRef, model, subElements );
			break;

			case 'TF_FontAwesome':
				oxoPreview.updateFontAwesomePreview( thisRef, model, subElements );
			break;

			case 'TF_OxoSlider':
				oxoPreview.updateOxoSliderPreview( thisRef, model, subElements );
			break;

			case 'TF_GoogleMap':
				oxoPreview.updateGoogleMapPreview( thisRef, model, subElements );
			break;

			case 'TF_ImageFrame':
				oxoPreview.updateImageFramePreview( thisRef, model, subElements );
			break;

			case 'TF_ImageCarousel':
				oxoPreview.updateImageCarouselPreview( thisRef, model, subElements );
			break;

			case 'TF_LayerSlider':
				oxoPreview.updateLayerSliderPreview( thisRef, model, subElements );
			break;

			case 'TF_LightBox':
				oxoPreview.updateLightBoxPreview( thisRef, model, subElements );
			break;

			case 'TF_Login':
				oxoPreview.updateLoginPreview( thisRef, model, subElements );
			break;

			case 'TF_MenuAnchor':
				oxoPreview.updateMenuAnchorPreview( thisRef, model, subElements );
			break;

			case 'TF_Modal':
				oxoPreview.updateModalPreview( thisRef, model, subElements );
			break;

			case 'TF_Person':
				oxoPreview.updatePersonPreview( thisRef, model, subElements );
			break;

			case 'TF_PostSlider':
				oxoPreview.updatePostSliderPreview( thisRef, model, subElements );
			break;

			case 'TF_PricingTable':
				oxoPreview.updatePricingTablePreview( thisRef, model, subElements );
			break;

			case 'TF_ProgressBar':
				oxoPreview.updateProgressBarPreview( thisRef, model, subElements );
			break;

			case 'TF_RecentPosts':
				oxoPreview.updateRecentPostsPreview( thisRef, model, subElements );
			break;

			case 'TF_RecentWorks':
				oxoPreview.updateRecentWorksPreview( thisRef, model, subElements );
			break;

			case 'TF_RevolutionSlider':
				oxoPreview.updateRevSliderPreview( thisRef, model, subElements );
			break;

			case 'TF_Separator':
				oxoPreview.updateSeparatorPreview( thisRef, model, subElements );
			break;

			case 'TF_SharingBox':
				oxoPreview.updateSharingBoxPreview( thisRef, model, subElements );
			break;

			case 'TF_Slider':
				oxoPreview.updateSliderPreview( thisRef, model, subElements );
			break;

			case 'TF_SoundCloud':
				oxoPreview.updateSoundCloudPreview( thisRef, model, subElements );
			break;

			case 'TF_Tabs':
				oxoPreview.updateTabsPreview( thisRef, model, subElements );
			break;

			case 'TF_Table':
				oxoPreview.updateTablePreview( thisRef, model, subElements );
			break;

			case 'TF_TaglineBox':
				oxoPreview.updateTaglineBoxPreview( thisRef, model, subElements );
			break;

			case 'TF_Testimonial':
				oxoPreview.updateTestimonialPreview( thisRef, model, subElements );
			break;

			case 'TF_OxoText':
				oxoPreview.updateTextBlockPreview( thisRef, model, subElements );
			break;

			case 'TF_Title':
				oxoPreview.updateTitlePreview( thisRef, model, subElements );
			break;

			case 'TF_Toggles':
				oxoPreview.updateTogglesPreview( thisRef, model, subElements );
			break;

			case 'TF_Vimeo':
				oxoPreview.updateVimeoPreview( thisRef, model, subElements );
			break;

			case 'TF_WidgetArea':
				oxoPreview.updateWidgetAreaPreview( thisRef, model, subElements );
			break;

			case 'TF_WooShortcodes':
				oxoPreview.updateWooShortcodesPreview( thisRef, model, subElements );
			break;

			case 'TF_Youtube':
				oxoPreview.updateYoutubePreview( thisRef, model, subElements );
			break;
			
			case 'TF_Form':
				oxoPreview.updateFormPreview( thisRef, model, subElements );
			break;
			
			case 'TF_AioneGallery':
				oxoPreview.updateAioneGalleryPreview( thisRef, model, subElements );
			break;

			default:
				$(thisRef.el).find('.innerElement').html( model.get('innerHtml') );
		}
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateAlertPreview = function( thisRef, model, subElements ) {

		var innerHtml 	=  model.get('innerHtml');
		var icon		= '';
		//for icon
		switch(subElements[0].value ) {
			case 'general':
				icon = 'fa fa-lg fa-info-circle';
			break;
			case 'error':
				icon = 'fa fa-lg fa-exclamation-triangle';
			break;
			case 'success':
				icon = 'fa fa-lg fa-check-circle';
			break;
			case 'notice':
				icon = 'fa fa-lg fa-lg fa-cog';
			break;
			case 'custom':
				icon = 'fa '+subElements[4].value;
			break;
		}
		innerHtml 		= innerHtml.replace( $(innerHtml).find('sub.sub').html() , subElements[6].value );
		innerHtml 		= innerHtml.replace( $(innerHtml).find('i').attr('class') , icon );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateBlogPreview = function( thisRef, model, subElements ) {

		var innerHtml 	=  model.get('innerHtml');
		innerHtml 		= innerHtml.replace( $(innerHtml).find('span.blog_layout').html() , subElements[0].value );
		if(subElements[0].value == 'grid') {
			innerHtml 		= innerHtml.replace( $(innerHtml).find('font.blog_columns').html() , '<br /> columns = ' + subElements[19].value );
		} else {
			innerHtml 		= innerHtml.replace( $(innerHtml).find('font.blog_columns').html(), '' );
		}

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateButtonPreview = function( thisRef, model, subElements ) {

		var innerHtml 	=  model.get('innerHtml');
		var buttonStyle	= '';
		//for button color
		switch( subElements[1].value ) {
			case 'custom':
				var topC = ( subElements[9].value == 'transparent' ) ? '#ebeaea' : subElements[9].value;
				var botC = subElements[10].value;
				var acnC = subElements[11].value;
				buttonStyle = "background: "+topC+";background: -moz-linear-gradient(top,  "+topC+" 0%, "+botC+" 100%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,"+topC+"), color-stop(100%,"+botC+"));background: -webkit-linear-gradient(top,  "+topC+" 0%,"+botC+" 100%);background: -o-linear-gradient(top,  "+topC+" 0%,"+botC+" 100%);background: -ms-linear-gradient(top,  "+topC+" 0%,"+botC+" 100%);background: linear-gradient(to bottom,  "+topC+" 0%,"+botC+" 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='"+topC+"', endColorstr='"+botC+"',GradientType=0 );border: 1px solid #fff;color: #fff;border: 1px solid "+acnC+";color: "+acnC+";";
				innerHtml 		= innerHtml.replace( $(innerHtml).find('a.button').attr('style') , buttonStyle );
				innerHtml 		= innerHtml.replace( $(innerHtml).find('a.button').attr('class') , 'button custom' );
			break;

			default:
				buttonStyle		= "button "+subElements[1].value;
				innerHtml 		= innerHtml.replace( $(innerHtml).find('a.button').attr('class') , buttonStyle );
			break;
		}

		if ( subElements[3].value == 'yes' ) {
			innerHtml 		= innerHtml.replace( 'selector:attrib' , 'width:100%;' );
		}

		innerHtml 		= innerHtml.replace( $(innerHtml).find('span.oxo-button-text').html() , subElements[8].value );


		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateChecklistPreview = function( thisRef, model, subElements ) {

		var innerHtml 		=  model.get('innerHtml');
		var totalElements 	= subElements[7].elements.length;
		var previewData		= '';
		var counter			= 0;
		for ( i = 0; i <  totalElements; i ++) {
			element		= subElements[7].elements[i];
			value		= '';
			//fot HTML
			if( /<[a-z][\s\S]*>/i.test( element[1].value ) ) {
				value = $(element[1].value).text();
			}else {
				value = element[1].value;
			}

			if( element[1].value != '' ) {
				previewData+= '<li><i ';
				if( element[0].value != '' ) {
					previewData+= 'class="fa '+element[0].value+'"></i>';
				} else {
					previewData+= 'class="fa '+subElements[0].value+'"></i>';
				}
				previewData+=  value;
				previewData+= '</li>';
				counter++;
			}
			if( counter == 3 ) { break; }
		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.checklist_elements').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateClientSliderPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[3].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[3].elements[i];
			previewData+= '<li>';
			previewData+= ' <img src="'+element[2].value+'">';
			previewData+= '</li>';

			if( i == 4 ) break;
		}

		innerHtml = innerHtml.replace( $(innerHtml).find('ul.client_slider_elements').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateContentBoxesPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.content_boxes_layout').html() , subElements[1].value );
		innerHtml			= innerHtml.replace( $(innerHtml).find('font.content_boxes_columns').html() , subElements[2].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}

	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateCountdownPreview = function( thisRef, model, subElements ) {

		var $target_time = new Date(),
			$now_time = new Date();

		if ( subElements[0].value == '' ) {
			$secs = 0;
			$mins = 0;
			$hours = 0;
			$days = 0;
			$weeks = 0;
		} else {
			var	$timer = subElements[0].value.replace( ' ', '-' ).replace( new RegExp( ':', 'g' ), '-' ).split( '-' );

			$target_time = new Date( $timer[1] + '/' + $timer[2] + '/' + $timer[0] + ' ' + $timer[3] + ':' + $timer[4] + ':' + $timer[5] );

			$difference_in_secs = Math.floor( ( $target_time.valueOf() - $now_time.valueOf()) / 1000 );

			$secs = $difference_in_secs % 60;
			$mins = Math.floor( $difference_in_secs/60 )%60;
			$hours = Math.floor( $difference_in_secs/60/60 )%24;

			if ( subElements[1].value == 'no' ) {
				$days = Math.floor( $difference_in_secs/60/60/24 );
				$weeks = Math.floor( $difference_in_secs/60/60/24/7 );
			} else {
				$days = Math.floor( $difference_in_secs/60/60/24 )%7;
				$weeks = Math.floor( $difference_in_secs/60/60/24/7 );
			}
		}
		var innerHtml 		= model.get('innerHtml');

		if ( subElements[1].value == 'no' ) {
			innerHtml 		= innerHtml.replace( $( innerHtml ).find( '.oxo_dash_weeks' ).html(), '' );
			innerHtml 		= innerHtml.replace( '<span class="oxo_dash_weeks"></span>', '' );
		} else {
			innerHtml 		= innerHtml.replace( $( innerHtml ).find( '.oxo_dash_weeks .dash' ).html(), $weeks );
		}

		innerHtml 			= innerHtml.replace( $( innerHtml ).find( '.oxo_dash_days .dash' ).html(), $days );
		innerHtml 			= innerHtml.replace( $( innerHtml ).find( '.oxo_dash_hrs .dash' ).html(), $hours );
		innerHtml 			= innerHtml.replace( $( innerHtml ).find( '.oxo_dash_mins .dash' ).html(), $mins );
		innerHtml 			= innerHtml.replace( $( innerHtml ).find( '.oxo_dash_secs .dash' ).html(), $secs );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}

	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateCounterBoxPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('font.counter_box_columns').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateFlipBoxesPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('font.flip_boxes_columns').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateFontAwesomePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var previewData		= '';
		var iconElement		= '';
		//for icon
		if( !subElements[0].value.trim() ) {
			iconElement = '<i class="oxoa-flag" style="color:'+subElements[3].value+'"></i>';
		} else {
			iconElement = '<i class="fa '+subElements[0].value+'" style="color:'+subElements[3].value+'"></i>';
		}
		//for circle
		if( subElements[1].value == 'yes' ) {
			previewData = '<h3 style="background:'+subElements[4].value+'">'+iconElement+'</h3>';
		} else {
			previewData = iconElement;
		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.oxo_iconbox_icon').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateOxoSliderPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.oxo_slider_name').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateGoogleMapPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.google_map_address').html() , subElements[16].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateImageFramePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('div.img_frame_section').html() , '<img src="'+subElements[9].value+'">' );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateImageCarouselPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[12].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[12].elements[i];
			previewData+= '<li>';
			previewData+= ' <img src="'+element[2].value+'">';
			previewData+= '</li>';

			if( i == 4 ) break;

		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.image_carousel_elements').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateLayerSliderPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.layer_slider_id').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateLoginPreview = function( thisRef, model, subElements ) {

		var innerHtml 	= model.get('innerHtml');

		$(thisRef.el).find('.innerElement').html( innerHtml );
		$(thisRef.el).find('.innerElement').find( '.' + subElements[0].value ).show();
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateMenuAnchorPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.anchor_name').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateModalPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.modal_name').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updatePersonPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('div.img_frame_section').html() , '<img src="'+subElements[3].value+'">' );
		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.person_name').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updatePostSliderPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		//for attachment layout
		if( subElements[0].value == 'attachments' ) {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('span.cat_container').attr('style') , 'display:none' );
		} else {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('span.cat_container').attr('style') , 'display:' );
		}
		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.post_slider_layout').html() , subElements[0].value );

		var cat				= ( !subElements[2].value.trim() ) ? 'all' : subElements[2].value;
		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.post_slider_cat').html() , cat );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updatePricingTablePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var columns			= subElements[4].value.match(/pricing_column/g);

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.pricing_table_style').html() , subElements[0].value );
		innerHtml 			= innerHtml.replace( $(innerHtml).find('font.pricing_table_columns').html() , columns.length / 2 );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateProgressBarPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.progress_bar_text').html() , subElements[9].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateRecentPostsPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.recent_posts_layout').html() , subElements[0].value );
		innerHtml 			= innerHtml.replace( $(innerHtml).find('font.recent_posts_columns').html() , subElements[2].value );

		var cats 			= oxoParser.getUniqueElements( subElements[5].value ).join();
		cats 				= ( cats == '' ? 'All' : cats);
		innerHtml 			= innerHtml.replace( $(innerHtml).find('font.recent_posts_cats').html() , cats );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateRecentWorksPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		//for carousel layout
		if( subElements[0].value == 'carousel' ) {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('span.columns_container').attr('style') , 'display:none' );
		} else {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('span.columns_container').attr('style') , 'display:' );
		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.recent_works_layout').html() , subElements[0].value );
		innerHtml 			= innerHtml.replace( $(innerHtml).find('font.recent_works_columns').html() , subElements[4].value );

		var cats 			= oxoParser.getUniqueElements(subElements[6].value).join();
		cats 				= ( cats == '' ? 'All' : cats);
		innerHtml 			= innerHtml.replace( $(innerHtml).find('font.recent_works_cats').html() , cats );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateRevSliderPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.rev_slider_name').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateSeparatorPreview = function( thisRef, model, subElements ) {

		var innerHtml 			= model.get('innerHtml');
		var sep_css, icon_css	= '';
		subElements[0].value 	= ( !subElements[0].value.trim() ) ? 'none' : subElements[0].value;
		innerHtml 				= innerHtml.replace( $(innerHtml).find('section').attr('class') , 'separator ' + subElements[0].value.replace("|", "_") );

		switch( subElements[0].value ) {

			case 'none':
				//do nothing
			break;

			case 'double':
				  sep_css	= 'border-bottom: 1px solid '+subElements[3].value+';border-top: 1px solid '+subElements[3].value+';';
			break;

			case 'double|dashed':
				sep_css		= 'border-bottom: 1px dashed '+subElements[3].value+';border-top: 1px dashed '+subElements[3].value+';';
			break;

			case 'double|dotted':
				sep_css		= 'border-bottom: 1px dotted '+subElements[3].value+';border-top: 1px dotted '+subElements[3].value+';';
			break;

			case 'shadow':
				sep_css		= 'background:radial-gradient(ellipse at 50% -50% , '+subElements[3].value+' 0px, rgba(255, 255, 255, 0) 80%) repeat scroll 0 0 rgba(0, 0, 0, 0)';
			break;

			default:
				sep_css		= 'background:'+subElements[3].value+';';
			break;

		}

		// width
		if( subElements[8].value != '' ) {
			sep_css += 'width:'+subElements[7].value+';';

			// alignment
			if( subElements[9].value == 'left' ) {
				sep_css += 'margin-left:5%;margin-right:0;';
			} else if ( subElements[9].value == 'right' ) {
				sep_css += 'float:right;margin-right:5%;';
			}
		}

		if( subElements[3].value != '' || subElements[8].value != '' ) {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('section').attr('style') , sep_css );
		}

		//for icon
		if( subElements[0].value != 'none' && subElements[0].value != '' && subElements[5].value != '' ) {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('i:eq(1)').attr('class') , "icon fa "+subElements[5].value);
		} else {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('i:eq(1)').attr('class') , "fake_class");
		}
		//color for circle border
		if ( subElements[6].value != 'no' ) {
			icon_css 			= "color:"+subElements[3].value+";border-color:"+subElements[3].value+';';
		} else {
			icon_css 			= "color:"+subElements[3].value+";border-color:transparent;";
		}

		//color for circle bg
		if ( subElements[7].value != '' ) {
			icon_css 			+= "background-color:"+subElements[7].value;
		}

		innerHtml 				= innerHtml.replace( $(innerHtml).find('i:eq(1)').attr('style') , icon_css );

		//for upper content
		if( subElements[0].value != 'none' ) {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('span.upper_container').attr('style') , 'display:none' );
		} else {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('span.upper_container').attr('style') , '' );
		}
		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateSharingBoxPreview  = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.sharing_tagline').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateSliderPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[5].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[5].elements[i];

			previewData+= '<li>';
			if( element[0].value == 'video' ) {
				previewData+= '<h1 class="video_type">Video</h1>';
			} else if ( element[0].value == 'image' ) {
				previewData+= ' <img src="'+element[1].value+'">';
			}
			previewData+= '</li>';

			if( i == 4 ) break;

		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.slider_elements').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateSoundCloudPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.soundcloud_url').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateTabsPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[8].elements.length;
		var previewData		= '';
		var counter			= 0;
		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[8].elements[i];
			if( element[0].value != '' ) {
				previewData+= '<li>'+element[0].value+'</li>';
				counter++;
			}

			if( counter == 3 ) break;

		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.tabs_elements').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateTablePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.table_style').html() , subElements[0].value );
		innerHtml 			= innerHtml.replace( $(innerHtml).find('font.table_columns').html() , subElements[1].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateTaglineBoxPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.tagline_title').html() , subElements[15].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateTestimonialPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[6].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[6].elements[i];

			//if name exists
			if ( element[0].value != '' ) {
				previewData+= element[0].value ;
			}
			//if company exists
			if( element[4].value != '' ) {
				previewData+= ', '+element[4].value+'<br>';
			} else {
				previewData+= ', <br>';
			}
		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.testimonial_content').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateTextBlockPreview = function( thisRef, model, subElements ) {

		var text_block 		= $.parseHTML( subElements[0].value );
		var text_block_html = '';
		var insert_icon = '';

		$(text_block).each(function() {
			if($(this).get(0).tagName != 'IMG' && typeof $(this).get(0).tagName != 'undefined') {
				var childrens = $($(this).get(0)).find('*');
				var child_img = false;
				if(childrens.length >= 1) {
					$.each(childrens, function() {
						if($(this).get(0).tagName == 'IMG') {
							child_img = true;
						}
					});
				}
				if(child_img == true) {
					text_block_html += $(this).outerHTML();
				} else {
					text_block_html += $(this).text();
				}
			} else {
				text_block_html += $(this).outerHTML();
			}
		});

		if(text_block_html.indexOf('[/pricing_table]') > -1) {
			insert_icon = '<span class="text-block-icon"><i class="oxoa-icon oxoa-dollar"></i>Pricing Table</span>';
		}

		if(subElements[0].value.indexOf('<div class="table-1">') > -1 || subElements[0].value.indexOf('<div class="table-2">') > -1) {
			insert_icon = '<span class="text-block-icon"><i class="oxoa-icon oxoa-table"></i>Table</span>';
		}

		if(
			typeof wp.shortcode.next('woocommerce_order_tracking', text_block_html) == 'object' ||
			typeof wp.shortcode.next('add_to_cart', text_block_html) == 'object' ||
			typeof wp.shortcode.next('product', text_block_html) == 'object' ||
			typeof wp.shortcode.next('products', text_block_html) == 'object' ||
			typeof wp.shortcode.next('product_categories', text_block_html) == 'object' ||
			typeof wp.shortcode.next('product_category', text_block_html) == 'object' ||
			typeof wp.shortcode.next('recent_products', text_block_html) == 'object' ||
			typeof wp.shortcode.next('featured_products', text_block_html) == 'object' ||
			typeof wp.shortcode.next('woocommerce_shop_messages', text_block_html) == 'object'
			) {
			insert_icon = '<span class="text-block-icon"><i class="oxoa-icon oxoa-shopping-cart"></i>Woo Shortcodes</span>';
		}

		innerHtml   = $( '<div class="fake-wrapper">' + model.get('innerHtml') + '</div>' ).find( 'span' ).append( insert_icon + '<small>'+text_block_html+'</small>' ).parents('.fake-wrapper').html();

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateTitlePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var value			= '';
		//HTML check
		if( /<[a-z][\s\S]*>/i.test( subElements[6].value ) ) {
			value = $(subElements[6].value).text();
		}else {
			value = subElements[6].value;
		}
		//for text
		if( value != '' ) {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('sub.title_text').html() , value );
		}
		//for color and style
		if ( subElements[1].value == 'center' ) {
			innerHtml 				= innerHtml.replace( $(innerHtml).find('section').attr('class') , 'title-sep-center' );
			innerHtml 				= innerHtml.replace( $(innerHtml).find('section').attr('style') , '' );

			innerHtml 				= innerHtml.replace( $(innerHtml).find('section > div').attr('class') , subElements[2].value.replace(' ','_') );
			innerHtml 				= innerHtml.replace( $(innerHtml).find('section > div').attr('style') , "border-color:"+subElements[3].value);
		} else {
			innerHtml 				= innerHtml.replace( $(innerHtml).find('section').attr('class') , ( subElements[2].value.replace( ' ','_' ) ) ? ( subElements[2].value.replace( ' ','_' ) ) : 'none' );
			innerHtml 				= innerHtml.replace( $(innerHtml).find('section').attr('style') , "border-color:"+subElements[3].value);
		}
		//for alignment
		if( subElements[1].value == 'right' ) {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('sub.title_text').attr('class') , 'title_text align_right' );
		} else if( subElements[1].value == 'center' ) {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('sub.title_text').attr('class') , 'title_text align_center' );
		} else {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('sub.title_text').attr('class') , 'title_text align_left' );
		}
		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateTogglesPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[3].elements.length;
		var previewData		= '';
		var counter			= 0;

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[3].elements[i];
			if( element[0].value != '' ) {
				previewData+= '<li>'+element[0].value+'</li>';
				counter++;
			}

			if( counter == 3 ) break;

		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.toggles_content').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateVimeoPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.viemo_url').html() , "https://vimeo.com/"+subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}

	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateWidgetAreaPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml'),
			$array_keys		=  $( innerHtml ).find( '.array_keys' ).html().split( ',' ),
			$array_values	=  $( innerHtml ).find( '.array_values' ).html().split( ',' ),
			$key			= $.inArray( subElements[0].value, $array_keys )

		innerHtml 			= innerHtml.replace( $(innerHtml).find( '.oxo_name' ).html() , $array_values[$key] );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}

	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateWooShortcodesPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.woo_shortcode').html() , subElements[1].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	oxoPreview.updateYoutubePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.youtube_url').html() , "http://www.youtube.com/"+subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	
	oxoPreview.updateFormPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.form').html() , subElements[1].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	
	oxoPreview.updateAioneGalleryPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.aionegallery').html() , subElements[1].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	
  })(jQuery);

