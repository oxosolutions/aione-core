<?php
/**
 * Person element implementation, it extends DDElementTemplate like all other elements
 */
	class TF_Person extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'person_box';
			// element name
			$this->config['name']	 		= __('Person', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-user';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Person Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="oxo_person">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><i class="oxoa-user"></i><sub class="sub">'.__('Person', 'oxo-core').'</sub><div class="img_frame_section">Image here</div><p class="person_name">Luke Beck</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$reverse_choices			= OxoHelper::get_shortcode_choices_with_default();
			
			$this->config['subElements'] = array(
					  
				array("name" 			=> __('Name', 'oxo-core'),
					  "desc"			=> __('Insert the name of the person.', 'oxo-core'),
					  "id" 				=> "oxo_name",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Title', 'oxo-core'),
					  "desc"			=> __('Insert the title of the person', 'oxo-core'),
					  "id" 				=> "oxo_title",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
		array("name"	  => __('Profile Description', 'oxo-core'),
					  "desc"	  => __('Enter the content to be displayed', 'oxo-core'),
					  "id"		=> "oxo_content_wp",
					  "type"	  => ElementTypeEnum::TEXTAREA,
					  "value"	   => "" 
			),

				array("name" 			=> __('Picture', 'oxo-core'),
					  "desc" 			=> __('Upload an image to display.', 'oxo-core'),
					  "id" 				=> "oxo_picture",
					  "upid" 			=> "1",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Picture Link URL', 'oxo-core'),
					  "desc"			=> __('Add the URL the picture will link to, ex: http://example.com.', 'oxo-core'),
					  "id" 				=> "oxo_piclink",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),

				array("name"	  		=> __('Link Target', 'oxo-core'),
					  "desc"	  		=> __('_self = open in same window<br>_blank = open in new window', 'oxo-core'),
					  "id"				=> "oxo_target",
					  "type"	  		=> ElementTypeEnum::SELECT,
					  "value"	   		=> "_self",
					  "allowedValues"   => array('_self'	=>'_self',
											   '_blank'	 =>'_blank') 
		   			  ),
					  
				array("name"	  		=> __('Picture Style Type', 'oxo-core'),
					  "desc"	  		=> __('Selected the style type for the picture.', 'oxo-core'),
					  "id"				=> "oxo_picstyle",
					  "type"	  		=> ElementTypeEnum::SELECT,
					  "value"	   		=> "",
					  "allowedValues"   => array('none'	   		=> __('None', 'oxo-core'),
					  							 'glow'	   		=> __('Glow', 'oxo-core'),
						 						 'dropshadow'	=> __('Drop Shadow', 'oxo-core'),
						 						 'bottomshadow' => __('Bottom Shadow', 'oxo-core')) 
					  ),

				array("name" 			=> __('Hover Type', 'oxo-core'),
					  "desc" 			=> __('Select the hover effect type.', 'oxo-core'),
					  "id" 				=> "oxo_hover_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "none",
					  "allowedValues" 	=> array('none' 			=> __('None', 'oxo-core'),
												 'zoomin' 			=> __('Zoom In', 'oxo-core'),
												 'zoomout' 			=> __('Zoom Out', 'oxo-core'),
												 'liftup' 			=> __('Lift Up', 'oxo-core')) 
					  ),

				array("name"	  => __('Background Color', 'oxo-core'),
					  "desc"	  => __('Controls the background color. Leave blank for theme option selection', 'oxo-core'),
					  "id"		=> "oxo_background_color",
					  "type"	  => ElementTypeEnum::COLOR,
					  "value"	   => ""
					  ),

				array("name" 			=> __('Content Alignment', 'oxo-core'),
					  "desc" 			=> __('Choose the alignment of content. Choose default for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_alignment",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('' 		=> __('Default', 'oxo-core'),
					  							 'left' 	=> __('Left', 'oxo-core'),
					  							 'center' 	=> __('Center', 'oxo-core'),
					  							 'right' 	=> __('Right', 'oxo-core'))
					  ),

				array("name"	  => __('Picture Style Color', 'oxo-core'),
					  "desc"	  => __('For all style types except border. Controls the style color. Leave blank for theme option selection.', 'oxo-core'),
					  "id"		=> "oxo_picstylecolor",
					  "type"	  => ElementTypeEnum::COLOR,
					  "value"	   => ""
					  ),

				array("name" 			=> __('Picture Border Size', 'oxo-core'),
					  "desc"			=> __('In pixels (px), ex: 1px. Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_picborder",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),

				array("name"	  		=> __('Picture Border Color', 'oxo-core'),
					  "desc"	  		=> __('Controls the picture\'s border color. Leave blank for theme option selection.', 'oxo-core'),
					  "id"				=> "oxo_picbordercolor",
					  "type"	  		=> ElementTypeEnum::COLOR,
					  "value"	   		=> ""
					  ),
			
				array("name" 			=> __('Picture Border Radius', 'oxo-core'),
					  "desc"			=> __('Choose the border radius of the person image. In pixels (px), ex: 1px, or "round".  Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_picborderradius",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),			
					  
				array("name" 			=> __('Social Icons Position', 'oxo-core'),
					  "desc" 			=> __('Choose the social icon position. Choose default for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_icon_position",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('' 		=> __('Default', 'oxo-core'),
					  							 'top' 		=> __('Top', 'oxo-core'),
					  							 'bottom' 	=> __('Bottom', 'oxo-core')),
					  ),

				array("name" 			=> __('Boxed Social Icons', 'oxo-core'),
					  "desc" 			=> __('Choose to get a boxed icons. Choose default for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_iconboxed",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $reverse_choices 
					  ),
					  
				array("name" 			=> __('Social Icon Box Radius', 'oxo-core'),
					  "desc"			=> __('Choose the border radius of the boxed icons. In pixels (px), ex: 1px, or "round". Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_iconboxedradius",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Social Icon Custom Colors', 'oxo-core'),
					  "desc"			=> __('Specify the color of social icons. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_iconcolor",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Social Icon Custom Box Colors', 'oxo-core'),
					  "desc"			=> __('Specify the box color of social icons. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_boxcolor",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Social Icon Tooltip Position', 'oxo-core'),
					  "desc" 			=> __('Choose the display position for tooltips. Choose default for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_icontooltip",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('' 				=> __('Default', 'oxo-core'),
												 'top' 				=> __('Top', 'oxo-core'),
												 'bottom' 			=> __('Bottom', 'oxo-core'),
												 'left' 			=> __('Left', 'oxo-core'),
												 'Right' 			=> __('Right', 'oxo-core')) 
					  ),
					  
				array("name" 			=> __('Email Address', 'oxo-core'),
					  "desc"			=> __('Insert an email address to display the email icon', 'oxo-core'),
					  "id" 				=> "oxo_email",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Facebook Link', 'oxo-core'),
					  "desc"			=> __('Insert your custom Facebook link', 'oxo-core'),
					  "id" 				=> "oxo_facebook",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Twitter Link', 'oxo-core'),
					  "desc"			=> __('Insert your custom Twitter link', 'oxo-core'),
					  "id" 				=> "oxo_twitter",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),

		array("name"	  => __('Instagram Link', 'oxo-core'),
					  "desc"	  => __('Insert your custom Instagram link', 'oxo-core'),
					  "id"		=> "oxo_instagram",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => "" 
			),
					  
				array("name" 			=> __('Dribbble Link', 'oxo-core'),
					  "desc"			=> __('Insert your custom Dribbble link', 'oxo-core'),
					  "id" 				=> "oxo_dribbble",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Google+ Link', 'oxo-core'),
					  "desc"			=> __('Insert your custom Google+ link', 'oxo-core'),
					  "id" 				=> "oxo_google",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> __('LinkedIn Link', 'oxo-core'),
					  "desc"			=> __('Insert your custom LinkedIn link', 'oxo-core'),
					  "id" 				=> "oxo_linkedin",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Blogger Link', 'oxo-core'),
					  "desc"			=> __('Insert your custom Blogger link', 'oxo-core'),
					  "id" 				=> "oxo_blogger",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Tumblr Link', 'oxo-core'),
					  "desc"			=> __('Insert your custom Tumblr link', 'oxo-core'),
					  "id" 				=> "oxo_tumblr",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Reddit Link', 'oxo-core'),
					  "desc"			=> __('Insert your custom Reddit link', 'oxo-core'),
					  "id" 				=> "oxo_reddit",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Yahoo Link', 'oxo-core'),
					  "desc"			=> __('Insert your custom Yahoo link', 'oxo-core'),
					  "id" 				=> "oxo_yahoo",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Deviantart Link', 'oxo-core'),
					  "desc"			=> __('Insert your custom Deviantart link', 'oxo-core'),
					  "id" 				=> "oxo_deviantart",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Vimeo Link', 'oxo-core'),
					  "desc"			=> __('Insert your custom Vimeo link', 'oxo-core'),
					  "id" 				=> "oxo_vimeo",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Youtube Link', 'oxo-core'),
					  "desc"			=> __('Insert your custom Youtube link', 'oxo-core'),
					  "id" 				=> "oxo_youtube",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Pinterst Link', 'oxo-core'),
					  "desc"			=> __('Insert your custom Pinterest link', 'oxo-core'),
					  "id" 				=> "oxo_pinterest",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('RSS Link', 'oxo-core'),
					  "desc"			=> __('Insert your custom RSS link', 'oxo-core'),
					  "id" 				=> "oxo_rss",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Digg Link', 'oxo-core'),
					  "desc"			=> __('Insert your custom Digg link', 'oxo-core'),
					  "id" 				=> "oxo_digg",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Flickr Link', 'oxo-core'),
					  "desc"			=> __('Insert your custom Flickr link', 'oxo-core'),
					  "id" 				=> "oxo_flickr",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Forrst Link', 'oxo-core'),
					  "desc"			=> __('Insert your custom Forrst link', 'oxo-core'),
					  "id" 				=> "oxo_forrst",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Myspace Link', 'oxo-core'),
					  "desc"			=> __('Insert your custom Myspace link', 'oxo-core'),
					  "id" 				=> "oxo_myspace",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Skype Link', 'oxo-core'),
					  "desc"			=> __('Insert your custom Skype link', 'oxo-core'),
					  "id" 				=> "oxo_skype",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),

		array("name"	  => __('PayPal Link', 'oxo-core'),
					  "desc"	  => __('Insert your custom PayPal link', 'oxo-core'),
					  "id"		=> "oxo_paypal",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => "" 
			),

		array("name"	  => __('Dropbox Link', 'oxo-core'),
					  "desc"	  => __('Insert your custom Dropbox link', 'oxo-core'),
					  "id"		=> "oxo_dropbox",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => "" 
			),

					 
		array("name"	  => __('SoundCloud Link', 'oxo-core'),
					  "desc"	  => __('Insert your custom SoundCloud link', 'oxo-core'),
					  "id"		=> "oxo_soundcloud",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => "" 
			),

		array("name"	  => __('VK Link', 'oxo-core'),
					  "desc"	  => __('Insert your custom VK link', 'oxo-core'),
					  "id"		=> "oxo_vk",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => "" 
			),

				array("name" 			=> __('CSS Class', 'oxo-core'),
					  "desc"			=> __('Add a class to the wrapping HTML element.', 'oxo-core'),
					  "id" 				=> "oxo_class",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('CSS ID', 'oxo-core'),
					  "desc"			=> __('Add an ID to the wrapping HTML element.', 'oxo-core'),
					  "id" 				=> "oxo_id",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				);
		}
	}