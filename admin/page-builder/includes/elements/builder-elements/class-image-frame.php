<?php
/**
 * ImageFrame implementation, it extends DDElementTemplate like all other elements
 */
	class TF_ImageFrame extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'image_frame';
			// element name
			$this->config['name']	 		= __('Image Frame', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-image';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates an Image Frame';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			
			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="oxo_image_frame">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><i class="oxoa-image"></i><sub class="sub">'.__('Image Frame', 'oxo-core').'</sub><div class="img_frame_section">Image here</div></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;

		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$border_size 				= OxoHelper::oxo_create_dropdown_data( 0, 10 );
			$reverse_choices			= OxoHelper::get_reversed_choice_data();
			$animation_speed 			= OxoHelper::get_animation_speed_data();
			$animation_direction 		= OxoHelper::get_animation_direction_data();
			$animation_type 			= OxoHelper::get_animation_type_data();
			
			$this->config['subElements'] = array(
				array("name" 			=> __('Frame Style Type', 'oxo-core'),
					  "desc" 			=> __('Select the frame style type.', 'oxo-core'),
					  "id" 				=> "oxo_style",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "none",
					  "allowedValues" 	=> array('none' 			=> __('None', 'oxo-core'),
												 'glow' 			=> __('Glow', 'oxo-core'),
												 'dropshadow' 		=> __('Drop Shadow', 'oxo-core'),
												 'bottomshadow' 	=> __('Bottom Shadow', 'oxo-core')) 
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
					  
				array("name" 			=> __('Border Color', 'oxo-core'),
					  "desc" 			=> __('Controls the border color. Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_bordercolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Border Size', 'oxo-core'),
					  "desc" 			=> __('In pixels (px), ex: 1px. Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_bordersize",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "0px",
					  ),

				array("name" 			=> __('Border Radius', 'oxo-core'),
					  "desc"			=> __('Choose the radius of the image. In pixels (px), ex: 1px, or "round".  Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_borderradius",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "0" 
					  ),						  
					  
				array("name" 			=> __('Style Color', 'oxo-core'),
					  "desc" 			=> __('For all style types except border. Controls the style color. Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_stylecolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Align', 'oxo-core'),
					  "desc" 			=> __('Choose how to align the image.', 'oxo-core'),
					  "id" 				=> "oxo_align",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "none",
					  "allowedValues" 	=> array('none'				=> __('None', 'oxo-core'),
					  							'left' 				=> __('Left', 'oxo-core'),
												 'right' 			=> __('Right', 'oxo-core'),
												 'center' 			=> __('Center', 'oxo-core')) 
					  ),
					  
				array("name" 			=> __('Image lightbox', 'oxo-core'),
					  "desc" 			=> __('Show image in Lightbox.', 'oxo-core'),
					  "id" 				=> "oxo_lightbox",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "no",
					  "allowedValues" 	=> $reverse_choices 
					  ),
					  
				array("name" 			=> __('Lightbox Image', 'oxo-core'),
					  "desc" 			=> __('Upload an image that will show up in the lightbox.', 'oxo-core'),
					  "id" 				=> "oxo_lightboximage",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "upid" 			=> "2",
					  "value" 			=> ""
					  ),						  
					  
				array("name" 			=> __('Image', 'oxo-core'),
					  "desc" 			=> __('Upload an image to display in the frame.', 'oxo-core'),
					  "id" 				=> "oxo_image",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "upid" 			=> "1",
					  "value" 			=> ""
					  ),				  
					  
				array("name" 			=> __('Image Alt Text', 'oxo-core'),
					  "desc"			=> __('The alt attribute provides alternative information if an image cannot be viewed.', 'oxo-core'),
					  "id" 				=> "oxo_alt",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Picture Link URL', 'oxo-core'),
					  "desc"			=> __('Add the URL the picture will link to, ex: http://example.com.', 'oxo-core'),
					  "id" 				=> "oxo_link",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),

				array("name"	  		=> __('Link Target', 'oxo-core'),
					  "desc"	  		=> __('_self = open in same window<br>_blank = open in new window.', 'oxo-core'),
					  "id"				=> "oxo_target",
					  "type"	  		=> ElementTypeEnum::SELECT,
					  "value"	   		=> "_self",
					  "allowedValues"   => array('_self'	=>'_self',
											   '_blank'	 =>'_blank') 
		   			  ),					  
				
				array("name" 			=> __('Animation Type', 'oxo-core'),
					  "desc" 			=> __('Select the type of animation to use on the shortcode.', 'oxo-core'),
					  "id" 				=> "oxo_animation_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "0",
					  "allowedValues" 	=> $animation_type
					 ),
				
				array("name" 			=> __('Direction of Animation', 'oxo-core'),
					  "desc" 			=> __('Select the incoming direction for the animation.', 'oxo-core'),
					  "id" 				=> "oxo_animation_direction",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $animation_direction 
					 ),
				
				array("name" 			=> __('Speed of Animation', 'oxo-core'),
					  "desc"			=> __('Type in speed of animation in seconds (0.1 - 1).', 'oxo-core'),
					  "id" 				=> "oxo_animation_speed",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "0.1" ,
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
				array(
					"name"          => __( 'Hide on Mobile', 'oxo-core' ),
					"desc"          => __( 'Select yes to hide full width container on mobile.', 'oxo-core' ),
					"id"            => "hide_on_mobile",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "no",
					"allowedValues" => array(
						'no'  => __( 'No', 'oxo-core' ),
						'yes' => __( 'Yes', 'oxo-core' ),
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