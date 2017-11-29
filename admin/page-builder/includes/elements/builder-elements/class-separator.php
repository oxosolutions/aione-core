<?php
/**
 * Separator element implementation, it extends DDElementTemplate like all other elements
 */
	class TF_Separator extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'separator_element';
			// element name
			$this->config['name']	 		= __('Separator', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-minus';
			// tooltip that will be displyed upon mous over the element
			//$this->config['tool_tip']  		= 'Creates a Separator Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			
			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="oxo_seprator">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><span class="upper_container" style="selector:spattrib"><i class="oxoa-minus"></i><sub class="sub">'.__('Separator', 'oxo-core').'</sub></span><section class="separator double_dotted" style="selector:sattrib"><i class="fake_class" style="selector:iattrib"></i></section></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			$margin_data = OxoHelper::oxo_create_dropdown_data(1,100);
			$choices = OxoHelper::get_shortcode_choices_with_default();
			$this->config['subElements'] = array(
			
			   array("name" 			=> __('Style', 'oxo-core'),
					  "desc" 			=> __('Choose the separator line style', 'oxo-core'),
					  "id" 				=> "oxo_style",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "none",
					  "allowedValues" 	=> array(		'none' => __('No Style', 'oxo-core'),
		'single' => __('Single Border Solid', 'oxo-core'),
		'double' => __('Double Border Solid', 'oxo-core'),
		'single|dashed' => __('Single Border Dashed', 'oxo-core'),
		'double|dashed' => __('Double Border Dashed', 'oxo-core'),
		'single|dotted' => __('Single Border Dotted', 'oxo-core'),
		'double|dotted' => __('Double Border Dotted', 'oxo-core'),
		'shadow' => __('Shadow', 'oxo-core')) 
					 ),
				
				array("name" 			=> __('Margin Top', 'oxo-core'),
					  "desc"			=> __('Spacing above the separator. In pixels or percentage, ex: 10px or 10%.', 'oxo-core'),
					  "id" 				=> "oxo_top",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" ,
					  ),
					  
				array("name" 			=> __('Margin Bottom', 'oxo-core'),
					  "desc"			=> __('Spacing below the separator. In pixels or percentage, ex: 10px or 10%.', 'oxo-core'),
					  "id" 				=> "oxo_bottom",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" ,
					  ),
					  
				array("name" 			=> __('Separator Color', 'oxo-core'),
					  "desc" 			=> __('Controls the separator color. Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_sepcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),

				array("name" 			=> __('Border Size', 'oxo-core'),
					  "desc"			=> __('In pixels (px), ex: 1px. Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_border_size",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" ,
					  ),
					  
				array("name" 			=> __('Select Icon', 'oxo-core'),
					  "desc" 			=> __('Click an icon to select, click again to deselect', 'oxo-core'),
					  "id" 				=> "icon",
					  "type" 			=> ElementTypeEnum::ICON_BOX,
					  "value" 			=> "",
					  "list"			=> OxoHelper::GET_ICONS_LIST()
					  ),
					  
				array("name" 			=> __('Circled Icon', 'oxo-core'),
					  "desc" 			=> __('Choose to have a circle in separator color around the icon.', 'oxo-core'),
					  "id" 				=> "oxo_circle",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $choices
					  ),	
					  
				array("name" 			=> __('Circle Color', 'oxo-core'),
					  "desc" 			=> __('Controls the background color of the circle around the icon.', 'oxo-core'),
					  "id" 				=> "oxo_circlecolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),					  
					  
				array("name" 			=> __('Separator Width', 'oxo-core'),
					  "desc"			=> __('In pixels (px or %), ex: 1px, ex: 50%. Leave blank for full width.', 'oxo-core'),
					  "id" 				=> "oxo_width",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Alignment', 'oxo-core'),
					  "desc" 			=> __('Select the separator alignment; only works when a width is specified.', 'oxo-core'),
					  "id" 				=> "oxo_alignment",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('center' 	=> __('Center', 'oxo-core'),
					  							 'left' 	=> __('Left', 'oxo-core'),
												 'right' 	=> __('Right', 'oxo-core'))
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