<?php
/**
 * Section Separator element implementation, it extends DDElementTemplate like all other elements
 */
	class TF_SectionSeparator extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'section_separator';
			// element name
			$this->config['name']	 		= __('Section Separator', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-ellipsis';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Separator Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			
			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><i class="oxoa-ellipsis"></i><sub class="sub">'.__('Section Separator', 'oxo-core').'</sub></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			$margin_data = OxoHelper::oxo_create_dropdown_data(1,100);
			$this->config['subElements'] = array(
			
			   array("name" 			=> __('Position of the Divider Candy', 'oxo-core'),
					  "desc" 			=> __('Select the position of the triangle candy', 'oxo-core'),
					  "id" 				=> "oxo_divider_candy",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('top' 			=> __('Top', 'oxo-core'),
												 'bottom' 		=> __('Bottom', 'oxo-core'),
												 'bottom,top' 	=> __('Top and Bottom', 'oxo-core')) 
					 ),
				array("name" 			=> __('Select Icon', 'oxo-core'),
					  "desc" 			=> __('Click an icon to select, click again to deselect', 'oxo-core'),
					  "id" 				=> "icon",
					  "type" 			=> ElementTypeEnum::ICON_BOX,
					  "value" 			=> "",
					  "list"			=> OxoHelper::GET_ICONS_LIST()
					  ),
					  
				array("name" 			=> __('Icon Color', 'oxo-core'),
					  "desc" 			=> __('Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_iconcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Border', 'oxo-core'),
					  "desc"			=> __('In pixels (px), ex: 1px. Leave blank for theme option selection.', 'oxo-core'),
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
					  
				array("name" 			=> __('Background Color of Divider Candy', 'oxo-core'),
					  "desc" 			=> __('Controls the background color of the triangle. Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_backgroundcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
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