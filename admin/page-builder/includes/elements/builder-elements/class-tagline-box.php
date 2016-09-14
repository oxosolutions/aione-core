<?php
/**
 * TaglineBox block implementation, it extends DDElementTemplate like all other elements
 */
	class TF_TaglineBox extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'tagline_box';
			// element name
			$this->config['name']	 		= __('Tagline Box', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-list-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Tagline Box';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="oxo_tagline_box">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><i class="oxoa-list-alt"></i><sub class="sub">'.__('Tagline Box', 'oxo-core').'</sub><p class="tagline_title">Tagline title text will go here...</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		//function to create shadow opacity data
		function create_shadow_opacity_data() {
			$opacity_data 	= array();
			$options 		= .1;
			while ($options < 1) {
				
				$opacity_data["oxo_".$options] = $options;
				$options				= $options + .1;
			}
			return $opacity_data;
		}
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$reverse_choices			= OxoHelper::get_reversed_choice_data();
			$animation_speed 			= OxoHelper::get_animation_speed_data();
			$animation_direction 		= OxoHelper::get_animation_direction_data();
			$animation_type 			= OxoHelper::get_animation_type_data();
			
			$opacity_data = $this->create_shadow_opacity_data();
			$this->config['subElements'] = array(
				array("name" 			=> __('Background Color', 'oxo-core'),
					  "desc" 			=> __('Controls the background color. Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_backgroundcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Shadow', 'oxo-core'),
					  "desc" 			=> __('Show the shadow below the box', 'oxo-core'),
					  "id" 				=> "oxo_shadow",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "no",
					  "allowedValues" 	=> $reverse_choices
					  ),
					  
				array("name" 			=> __('Shadow Opacity', 'oxo-core'),
					  "desc" 			=> __('Choose the opacity of the shadow', 'oxo-core'),
					  "id" 				=> "oxo_shadowopacity",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "0.7",
					  "allowedValues" 	=> $opacity_data
					  ),
					  
				array("name" 			=> __('Border', 'oxo-core'),
					  "desc"			=> __('In pixels (px), ex: 1px', 'oxo-core'),
					  "id" 				=> "oxo_border",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "1px" 
					  ),
					  
				array("name" 			=> __('Border Color', 'oxo-core'),
					  "desc" 			=> __('Controls the border color. Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_bordercolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Highlight Border Position', 'oxo-core'),
					  "desc" 			=> __('Choose the position of the highlight. This border highlight is from theme options primary color and does not take the color from border color above', 'oxo-core'),
					  "id" 				=> "oxo_highlightposition",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "top",
					  "allowedValues" 	=> array('top' 			=> __('Top', 'oxo-core'),
												'bottom' 		=> __('Bottom', 'oxo-core'),
												'left'			=> __('Left', 'oxo-core'),
												'right' 		=> __('Right', 'oxo-core'),
												'none'			=> __('None', 'oxo-core'))
					  ),
					  
				array("name" 			=> __('Content Alignment', 'oxo-core'),
					  "desc" 			=> __('Choose how the content should be displayed.', 'oxo-core'),
					  "id" 				=> "oxo_contentalignment",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('left' 			=> __('Left', 'oxo-core'),
												'center' 		=> __('Center', 'oxo-core'),
												'right'			=> __('Right', 'oxo-core'))
					  ),
					  
				array("name" 			=> __('Button Text', 'oxo-core'),
					  "desc" 			=> __('Insert the text that will display in the button', 'oxo-core'),
					  "id" 				=> "oxo_button",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Link', 'oxo-core'),
					  "desc" 			=> __('The url the button will link to', 'oxo-core'),
					  "id" 				=> "oxo_url",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""),
					  
				array("name" 			=> __('Link Target', 'oxo-core'),
					  "desc" 			=> __('_self = open in same window<br>_blank = open in new window', 'oxo-core'),
					  "id" 				=> "oxo_target",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "_self",
					  "allowedValues" 	=> array('_self' 		=>'_self',
											   '_blank' 		=>'_blank') 
					 ),

		array("name"	  => __('Modal Window Anchor', 'oxo-core'),
					  "desc"	  => __('Add the class name of the modal window you want to open on button click.', 'oxo-core'),
					  "id"		=> "oxo_modalanchor",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => ""),
					 
				array("name" 			=> __('Button Size', 'oxo-core'),
					  "desc" 			=> __('Select the button\'s size.', 'oxo-core'),
					  "id" 				=> "oxo_buttonsize",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(''		=>__('Default', 'oxo-core'),
					  							'small' 		=>__('Small', 'oxo-core'),
											   'medium' 		=>__('Medium', 'oxo-core'),
											   'large' 			=> __('Large', 'oxo-core'),
											   'xlarge' 		=> __('XLarge', 'oxo-core')) 
					 ),
					 
				array("name" 			=> __('Button Type', 'oxo-core'),
					  "desc" 			=> __('Select the button\'s type.', 'oxo-core'),
					  "id" 				=> "oxo_buttontype",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(''		=>__('Default', 'oxo-core'),
					  							'flat' 		=>__('Flat', 'oxo-core'),
											   '3D' 			=>'3D') 
					 ),
					 
				array("name" 			=> __('Button Shape', 'oxo-core'),
					  "desc" 			=> __('Select the button\'s shape.', 'oxo-core'),
					  "id" 				=> "oxo_buttonshape",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(''		=>__('Default', 'oxo-core'),
					  							'square' 		=> __('Square', 'oxo-core'),
											   'pill' 			=> __('Pill', 'oxo-core'),
											   'round' 			=> __('Round', 'oxo-core')) 
					 ),
					 
				array("name" 			=> __('Button Color', 'oxo-core'),
					  "desc" 			=> __('Choose the button color<br>Default uses theme option selection', 'oxo-core'),
					  "id" 				=> "oxo_buttoncolor",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('' 			=> __('Default', 'oxo-core'),
											   'green' 			=> __('Green', 'oxo-core'),
											   'darkgreen' 		=> __('Dark Green', 'oxo-core'),
											   'orange' 		=> __('Orange', 'oxo-core'),
											   'blue'			=> __('Blue', 'oxo-core'),
											   'red' 			=> __('Red', 'oxo-core'),
											   'pink' 			=> __('Pink', 'oxo-core'),
											   'darkgray' 		=> __('Dark Gray', 'oxo-core'),
											   'lightgray' 		=> __('Light Gray', 'oxo-core')) 
					 ),
					 
				array("name" 			=> __('Tagline Title', 'oxo-core'),
					  "desc"			=> __('Insert the title text', 'oxo-core'),
					  "id" 				=> "oxo_title",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Tagline Description', 'oxo-core'),
					  "desc"			=> __('Insert the description text', 'oxo-core'),
					  "id" 				=> "oxo_description",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> "" 
					  ),

				array("name" 			=> __('Additional Content', 'oxo-core'),
					  "desc"			=> __('This is additional content you can add to the tagline box. This will show below the title and description if one is used.', 'oxo-core'),
					  "id" 				=> "oxo_additionalcontent",
					  "type" 			=> ElementTypeEnum::HTML_EDITOR,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Margin Top', 'oxo-core'),
					  "desc" 			=> __('Add a custom top margin. In pixels.', 'oxo-core'),
					  "id" 				=> "oxo_margin_top",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""),
					  
				array("name" 			=> __('Margin Bottom', 'oxo-core'),
					  "desc" 			=> __('Add a custom bottom margin. In pixels.', 'oxo-core'),
					  "id" 				=> "oxo_margin_bottom",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""),						  
					  
				array("name" 			=> __('Animation Type', 'oxo-core'),
					  "desc" 			=> __('Select the type on animation to use on the shortcode', 'oxo-core'),
					  "id" 				=> "oxo_animation_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $animation_type 
					 ),
				
				array("name" 			=> __('Direction of Animation', 'oxo-core'),
					  "desc" 			=> __('Select the incoming direction for the animation', 'oxo-core'),
					  "id" 				=> "oxo_animation_direction",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $animation_direction 
					 ),
				
				array("name" 			=> __('Speed of Animation', 'oxo-core'),
					  "desc"			=> __('Type in speed of animation in seconds (0.1 - 1)', 'oxo-core'),
					  "id" 				=> "oxo_animation_speed",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "0.1",
					  "allowedValues"	=> $animation_speed 
					  ),
					  
				array("name" 			=> __( 'Offset of Animation', 'oxo-core' ),
					  "desc"			=> __( 'Choose when the animation shoul start.', 'oxo-core' ),
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