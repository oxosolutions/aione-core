<?php
/**
 * Title element implementation, it extends DDElementTemplate like all other elements
 */
	class TF_Title extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'title_box';
			// element name
			$this->config['name']	 		= __('Title', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-H';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Title Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			
			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="fusian_title">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><section class="double_dotted" ><div class="oxo-title-border"></div><sub class="title_text align_right">'.__('Title', 'oxo-core').'</sub></section></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			$title_data = OxoHelper::oxo_create_dropdown_data(1, 6);
			$this->config['subElements'] = array(
			
				array("name" 			=> __('Title Size', 'oxo-core'),
					  "desc" 			=> __('Choose the title size, H1-H6', 'oxo-core'),
					  "id" 				=> "oxo_size",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "1",
					  "allowedValues" 	=> $title_data
					  ),
					  
				array("name" 			=> __('Title Alignment', 'oxo-core'),
					  "desc" 			=> __('Choose to align the heading left or right.', 'oxo-core'),
					  "id" 				=> "oxo_contentalign",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "left",
					  "allowedValues" 	=> array('left' 		=> __('Left', 'oxo-core'),
					  							 'center' 		=> __('Center', 'oxo-core'),
											   'right' 			=> __('Right', 'oxo-core')) 
					 ),
					 
				array("name" 			=> __('Separator', 'oxo-core'),
					  "desc" 			=> __('Choose the kind of the title separator you want to use.', 'oxo-core'),
					  "id" 				=> "oxo_style_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(
					  	'default'		  => __('Default', 'oxo-core'),
						'single'		  => __('Single', 'oxo-core'),
						'single solid'	=> __('Single Solid', 'oxo-core'),
						'single dashed'	=> __('Single Dashed', 'oxo-core'),
						'single dotted'	=> __('Single Dotted', 'oxo-core'),
						'double'	 => __('Double', 'oxo-core'),
						 'double solid'	 => __('Double Solid', 'oxo-core'),
						 'double dashed'	 => __('Double Dashed', 'oxo-core'),
						 'double dotted'	 => __('Double Dotted', 'oxo-core'),
						 'underline'	=> __('Underline', 'oxo-core'),
											   'underline solid'		=> __('Underline Solid', 'oxo-core'),
						 'underline dashed'	=> __('Underline Dashed', 'oxo-core'),
						 'underline dotted'	=> __('Underline Dotted', 'oxo-core'),
						 'none'	=> __('None', 'oxo-core'))
					 ),
					 
					 
				array("name" 			=> __('Separator Color', 'oxo-core'),
					  "desc" 			=> __('Controls the separator color. Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_sepcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Top Margin', 'oxo-core'),
					  "desc"			=> __('Spacing above the title. In px or em, e.g. 10px.', 'oxo-core'),
					  "id" 				=> "oxo_margin_top",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Bottom Margin', 'oxo-core'),
					  "desc"			=> __('Spacing below the title. In px or em, e.g. 10px.', 'oxo-core'),
					  "id" 				=> "oxo_margin_bottom",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),					  						  
					  
			   array("name" 			=> __('Title', 'oxo-core'),
					  "desc"			=> __('Insert the title text', 'oxo-core'),
					  "id" 				=> "oxo_content_wp",
					  "type" 			=> ElementTypeEnum::HTML_EDITOR,
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