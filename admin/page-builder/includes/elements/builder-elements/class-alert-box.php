<?php
/**
 * Alert Box implementation, it extends DDElementTemplate like all other elements
 */
	class TF_AlertBox extends DDElementTemplate {
		
		public function __construct() {
			 
			parent::__construct();
		}

		// Implementation for the element structure.
		public function create_element_structure() {
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 	= get_class($this);
			// element id
			$this->config['id']	   	= 'alert_box';
			// element name
			$this->config['name']	 	= __('Alert', 'oxo-core');
			// element icon
			$this->config['icon_url']  	= "icons/sc-notification.png";
			// css class related to this element
			$this->config['css_class'] 	= "oxo_element_box";
			// element icon class
			$this->config['icon_class']	= 'oxo-icon builder-options-icon oxoa-exclamation-sign';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  	= 'Creates an Alert Box';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 		= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {

			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="oxo_alert">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><i class="oxoa-exclamation-sign"></i><sub class="sub">'.__('Preview text will go here and custom icon choice', 'oxo-core').'</sub></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$animation_speed 		= OxoHelper::get_animation_speed_data();
			$animation_direction 	= OxoHelper::get_animation_direction_data();
			$animation_type 		= OxoHelper::get_animation_type_data();
			
			$this->config['subElements'] = array(
			
				array("name" 			=> __('Alert Type', 'oxo-core'),
					  "desc" 			=> __('Select the type of alert message. Choose custom for advanced color options below.', 'oxo-core'),
					  "id" 				=> "oxo_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "general",
					  "allowedValues" 	=> array('general' 	=>__('General', 'oxo-core'),
											   'error' 		=>__('Error', 'oxo-core'),
											   'success' 	=> __('Success', 'oxo-core'),
											   'notice' 	=> __('Notice', 'oxo-core'),
											   'custom' 	=> __('Custom', 'oxo-core'),)
					  ),
				
				array("name" 			=> __('Accent Color', 'oxo-core'),
					  "desc" 			=> __('Custom setting only. Set the border, text and icon color for custom alert boxes.', 'oxo-core'),
					  "id" 				=> "oxo_accentcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Background Color', 'oxo-core'),
					  "desc" 			=> __('Custom setting only. Set the background color for custom alert boxes.', 'oxo-core'),
					  "id" 				=> "oxo_backgroundcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Border Width', 'oxo-core'),
					  "desc"			=> __('Custom setting. For custom alert boxes. In pixels (px), ex: 1px.', 'oxo-core'),
					  "id" 				=> "oxo_bordersize",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "1px" 
					  ),
					  
				array("name" 			=> __('Select Custom Icon', 'oxo-core'),
					  "desc" 			=> __('Custom setting only. Click an icon to select, click again to deselect', 'oxo-core'),
					  "id" 				=> "icon",
					  "type" 			=> ElementTypeEnum::ICON_BOX,
					  "value" 			=> "",
					  "list"			=> OxoHelper::GET_ICONS_LIST()
					  ),

		array("name"	  => __('Box Shadow', 'oxo-core'),
			"desc"	  => __('Display a box shadow below the alert box.', 'oxo-core'),
					  "id"		=> "oxo_boxshadow",
					  "type"	  => ElementTypeEnum::SELECT,
					  "value"	   => "yes",
			"allowedValues"   => array('yes'	=> __('Yes', 'oxo-core'),
											   'no'	 => __('No', 'oxo-core'),)
		   ),
											   
				array("name" 			=> __('Alert Content', 'oxo-core'),
					  "desc" 			=> __('Insert the alert\'s content', 'oxo-core'),
					  "id" 				=> "oxo_content_wp",
					  "type" 			=> ElementTypeEnum::HTML_EDITOR,
					  "value" 			=> __('Your Content Goes Here', 'oxo-core')
					  ),
					  
				array("name" 			=> __('Animation Type', 'oxo-core'),
					  "desc" 			=> __('Select the type of animation to use on the shortcode', 'oxo-core'),
					  "id" 				=> "oxo_animation_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $animation_type 
					 ),
				
				array("name" 			=> __('Direction of Animation', 'oxo-core'),
					  "desc" 			=> __('Select the incoming direction for the animation', 'oxo-core'),
					  "id" 				=> "oxo_animation_direction",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "left",
					  "allowedValues" 	=> $animation_direction 
					 ),
				
				array("name" 			=> __('Speed of Animation', 'oxo-core'),
					  "desc"			=> __('Type in speed of animation in seconds (0.1 - 1)', 'oxo-core'),
					  "id" 				=> "oxo_animation_speed",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "" ,
					  "allowedValues"	=> $animation_speed
					  ),
					  
				array("name" 			=> __( 'Offset of Animation', 'oxo-core' ),
					  "desc"			=> __( 'Choose when the animation should start.', 'oxo-core' ),
					  "id" 				=> "oxo_animation_offset",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(
					  						''					=> __( 'Default', 'oxo-core' ),					  
											'top-into-view' 	=> __( 'Top of element hits bottom of viewport', 'oxo-core' ),
											'top-mid-of-view' 	=> __( 'Top of element hits middle of viewport', 'oxo-core' ),
											'bottom-in-view' 	=> __( 'Bottom of element enters viewport', 'oxo-core' ),
											)
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