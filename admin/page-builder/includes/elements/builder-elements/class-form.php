<?php
/**
 * Form element implementation, it extends DDElementTemplate like all other elements
 */
	class TF_Form extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'form_box';
			// element name
			$this->config['name']	 		= __('Form', 'oxo-core');
			// element shortcode base
			$this->config['base'] = 'gravityform';
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-H';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a form Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="oxo_image_frame">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><sub class="sub">'.__('Form', 'oxo-core').'</sub></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			global $wpdb;
			$sql = "SELECT *   FROM `".$wpdb->prefix."rg_form` ";
			$gf_forms = $wpdb->get_results($sql);
			$gf_form_options = array();
			foreach($gf_forms as $gf_form){
				$gf_form_options[$gf_form->id] =  __($gf_form->title, 'oxo-core');
			}
			
			$this->config['subElements'] = array(
	       
				array("name" 			=> __('Select Form', 'oxo-core'),
					  "desc" 			=> __('Select a form below to add it to your post or page. ', 'oxo-core'),
					  "id" 				=> "id",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> array( '' ),
					  "allowedValues" 	=> $gf_form_options                    

				     ),	
					  
				array("name" 			=> __('CSS Class', 'oxo-core'),
					  "desc"			=> __('Add a class to the wrapping HTML element.', 'oxo-core'),
					  "id" 				=> "oxo_class",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				/*array("name" 			=> __('CSS ID', 'oxo-core'),
					  "desc"			=> __('Add an ID to the wrapping HTML element.', 'oxo-core'),
					  "id" 				=> "oxo_id",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),*/
				);
		}
	}

	
	
	
	
	
	
	
	