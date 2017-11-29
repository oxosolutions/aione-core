<?php
/**
 * Button element implementation, it extends DDElementTemplate like all other elements
 */
	class TF_ButtonBlock extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'button_block';
			// element name
			$this->config['name']	 		= __('Button', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-check-empty';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Button';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="oxo_button">';
			$innerHtml .= '<div class="bilder_icon_container"> <a title="" target="_self" class="button orange" style="selector:attrib"><span class="oxo-button-text">Button Text</span></a> </div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$choices					= OxoHelper::get_shortcode_choices();
			$choices_with_default		= OxoHelper::get_shortcode_choices_with_default();
			$leftright					= OxoHelper::get_left_right_data();
			$animation_speed 			= OxoHelper::get_animation_speed_data();
			$animation_direction 		= OxoHelper::get_animation_direction_data();
			$animation_type 			= OxoHelper::get_animation_type_data();
			
			$this->config['subElements'] = array(
				array("name" 			=> __('Button URL', 'oxo-core'),
					  "desc" 			=> __('Add the button\'s url ex: http://example.com', 'oxo-core'),
					  "id" 				=> "oxo_url",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""),
					  
				array("name" 			=> __('Button Style', 'oxo-core'),
					  "desc" 			=> __('Select the button\'s color. Select default or color name for theme options, or select custom to use advanced color options below.', 'oxo-core'),
					  "id" 				=> "oxo_style",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "default",
					  "allowedValues" 	=> array('default' 			=> __('Default', 'oxo-core'),
					  						   'custom'			=> __('Custom', 'oxo-core'),
											   'green' 			=> __('Green', 'oxo-core'),
											   'darkgreen' 		=> __('Dark Green', 'oxo-core'),
											   'orange' 		=> __('Orange', 'oxo-core'),
											   'blue'			=> __('Blue', 'oxo-core'),
											   'red' 			=> __('Red', 'oxo-core'),
											   'pink' 			=> __('Pink', 'oxo-core'),
											   'darkgray' 		=> __('Dark Gray', 'oxo-core'),
											   'lightgray' 		=> __('Light Gray', 'oxo-core')) 
					 ),
					 
				array("name" 			=> __('Button Size', 'oxo-core'),
					  "desc" 			=> __('Select the button\'s size. Choose default for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_size",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(''	   => __('Default', 'oxo-core'),
						'small' 		=> __('Small', 'oxo-core'),
											   'medium' 		=> __('Medium', 'oxo-core'),
											   'large' 			=> __('Large', 'oxo-core'),
												'xlarge' 		=> __('XLarge', 'oxo-core'),) 
					 ),
					 
				array("name" 			=> __('Button Span', 'oxo-core'),
					  "desc" 			=> __('Choose to have the button span the full width of its container.', 'oxo-core'),
					  "id" 				=> "oxo_button_span",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "default",
					  "allowedValues" 	=> $choices_with_default
					 ),					 
					 
				array("name" 			=> __('Button Type', 'oxo-core'),
					  "desc" 			=> __('Select the button\'s type. Choose default for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(''	   => __('Default', 'oxo-core'),
						'flat' 		=>__('Flat', 'oxo-core'),
											   '3d' 			=>'3D') 
					 ),
					 
				array("name" 			=> __('Button Shape', 'oxo-core'),
					  "desc" 			=> __('Select the button\'s shape. Choose default for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_shape",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(''	   => __('Default', 'oxo-core'),
						'square' 		=> __('Square', 'oxo-core'),
												'pill' 			=> __('Pill', 'oxo-core'),
												'round' 		=> __('Round', 'oxo-core')) 
					 ),
					 
				array("name" 			=> __('Button Target', 'oxo-core'),
					  "desc" 			=> __('_self = open in same window<br>_blank = open in new window', 'oxo-core'),
					  "id" 				=> "oxo_target",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "_self",
					  "allowedValues" 	=> array('_self' 		=>'_self',
											   '_blank' 		=>'_blank') 
					 ),
					 
				array("name" 			=> __('Button Title attribute', 'oxo-core'),
					  "desc" 			=> __('Set a title attribute for the button link.', 'oxo-core'),
					  "id" 				=> "oxo_title",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  	 
				array("name" 			=> __('Button\'s Text', 'oxo-core'),
					  "desc" 			=> __('Add the text that will display on button', 'oxo-core'),
					  "id" 				=> "oxo_content",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> "Button Text"
					  ),
				
				array("name" 			=> __('Button Gradient Top Color', 'oxo-core'),
					  "desc" 			=> __('Custom setting only. Set the top color of the button background.', 'oxo-core'),
					  "id" 				=> "oxo_gradtopcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Button Gradient Bottom Color', 'oxo-core'),
					  "desc" 			=> __('Custom setting only. Set the bottom color of the button background or leave empty for solid color.', 'oxo-core'),
					  "id" 				=> "oxo_gradbottomcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Button Gradient Top Color Hover', 'oxo-core'),
					  "desc" 			=> __('Custom setting only. Set the top hover color of the button background.', 'oxo-core'),
					  "id" 				=> "oxo_gradtopcolorhover",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Button Gradient Bottom Color Hover', 'oxo-core'),
					  "desc" 			=> __('Custom setting only. Set the bottom hover color of the button background or leave empty for solid color.', 'oxo-core'),
					  "id" 				=> "oxo_gradbottomcolorhover",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Accent Color', 'oxo-core'),
					  "desc" 			=> __('Custom setting only. This option controls the color of the button border, divider, text and icon.', 'oxo-core'),
					  "id" 				=> "oxo_bordercolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Accent Hover Color', 'oxo-core'),
					  "desc" 			=> __('Custom setting only. This option controls the hover color of the button border, divider, text and icon.', 'oxo-core'),
					  "id" 				=> "oxo_borderhovercolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Bevel Color (3D Mode only)', 'oxo-core'),
					  "desc" 			=> __('Custom setting. Set the bevel color of 3D buttons.', 'oxo-core'),
					  "id" 				=> "oxo_bevelcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Border Width', 'oxo-core'),
					  "desc"			=> __('Custom setting only. In pixels (px), ex: 1px. Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_bordersize",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					 
				array("name" 			=> __('Select Custom Icon', 'oxo-core'),
					  "desc" 			=> __('Click an icon to select, click again to deselect', 'oxo-core'),
					  "id" 				=> "icon",
					  "type" 			=> ElementTypeEnum::ICON_BOX,
					  "value" 			=> "",
					  "list"			=> OxoHelper::GET_ICONS_LIST()
					  ),
					  
				
				array("name" 			=> __('Icon Position', 'oxo-core'),
					  "desc" 			=> __('Choose the position of the icon on the button.', 'oxo-core'),
					  "id" 				=> "oxo_iconposition",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $leftright
					 ),
					 
				array("name" 			=> __('Icon Divider', 'oxo-core'),
					  "desc" 			=> __('Choose to display a divider between icon and text.', 'oxo-core'),
					  "id" 				=> "oxo_icondivider",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "no",
					  "allowedValues" 	=> $choices
					 ),
					 
				array("name" 			=> __('Modal Window Anchor', 'oxo-core'),
					  "desc"			=> __('Add the class name of the modal window you want to open on button click.', 'oxo-core'),
					  "id" 				=> "oxo_modal",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
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
					  "allowedValues" 	=> $animation_speed 
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

		  array("name"	  => __('Alignment', 'oxo-core'),
					  "desc"	  => __('Select the button\'s alignment.', 'oxo-core'),
					  "id"		=> "oxo_alignment",
					  "type"	  => ElementTypeEnum::SELECT,
			"value"	   => "",
					  "allowedValues"   => array(''	  => __('Default', 'oxo-core'),
						   'left'	 => __('Left', 'oxo-core'),
											   'center'	  => __('Center', 'oxo-core'),
						 'right'	=> __('Right', 'oxo-core')) 
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