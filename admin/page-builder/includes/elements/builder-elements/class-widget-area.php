<?php
/**
 * Countdown implementation, it extends DDElementTemplate like all other elements
 */
	class TF_WidgetArea extends DDElementTemplate {
		
		public function __construct() {
			 
			parent::__construct();
		}

		// Implementation for the element structure.
		public function create_element_structure() {
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 	= get_class($this);
			// element id
			$this->config['id']	   		= 'widget_area';
			// element name
			$this->config['name']	 	= __('Widget Area', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-dashboard';
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 		= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
		
			$sidebars = OxoHelper::get_sidebars();

			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="oxo_widget_area">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><i class="oxoa-dashboard"></i><sub class="sub">'. $this->config['name'] .'</sub><div class="oxo_widget_name"><span>' . __( 'Name', 'oxo-core' ) . ': </span><span class="oxo_name">WidgetName</span></div></span></div>';
			$innerHtml .= '<div class="array_keys" style="display:none;">' . implode( ',', array_keys( $sidebars ) ) . '</div>';
			$innerHtml .= '<div class="array_values" style="display:none;">' . implode( ',', $sidebars ) . '</div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
				
			$sidebars = OxoHelper::get_sidebars();

			$this->config['subElements'] = array(
			
				array("name" 			=> __('Widget Area Name', 'oxo-core'),
					  "desc" 			=> __('Choose the name of the widget area to display.', 'oxo-core'),
					  "id" 				=> "oxo_sidebars",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $sidebars
					  ),			  
				
				array("name" 			=> __('Backgound Color', 'oxo-core'),
					  "desc" 			=> __('Choose a background color for the widget area.', 'oxo-core'),
					  "id" 				=> "oxo_background_color",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name"  			=> __( 'Padding', 'oxo-core' ),
					  "desc"  			=> __( 'In pixels or percentage, ex: 10px or 10%.', 'oxo-core' ),
					  "id"    			=> "padding",
					  "type"  			=> ElementTypeEnum::INPUT,
					  "value" 			=> "",
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
