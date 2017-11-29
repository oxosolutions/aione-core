<?php
/**
 * Tabs element implementation, it extends DDElementTemplate like all other elements
 */
	class TF_Tabs extends DDElementTemplate {
		public function __construct( $am_elements = array() ) {
			parent::__construct($am_elements);
		}
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'tabs_box';
			// element name
			$this->config['name']	 		= __('Tabs', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-folder';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Tabs Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="oxo_tabs">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><i class="oxoa-folder"></i><sub class="sub">'.__('Tabs', 'oxo-core').'</sub><ul class="tabs_elements"><li>tab title 1 here</li><li>tab, title 2 here</li><li>tab title 3 here</li></ul></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements( $am_elements ) {
			
			$choices					= OxoHelper::get_shortcode_choices();
			
	 $am_array = array();
	  $am_array[] = array ( 
							array("name"	=> __('Tab Title', 'oxo-core'),
										"desc"		=> __('Title of the tab', 'oxo-core'),
										"id"		=> "oxo_title[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array("") 
							),
						  array("name"	  => __('Select Icon', 'oxo-core'),
									  "desc"		  => __('Display an icon next to tab title. Click an icon to select, click again to deselect.', 'oxo-core'),
									  "id"		  => "oxo_icon[0]",
									  "type"		  => ElementTypeEnum::ICON_BOX,
									  "value"		 => array (""),
							"list"		  => OxoHelper::GET_ICONS_LIST()
							),							
						  array( "name"	 => __('Tab Content', 'oxo-core'),
										"desc"		=> __('Add the tabs content', 'oxo-core'),
										"id"		=> "oxo_content_wp[0]",
										"type"		=> ElementTypeEnum::HTML_EDITOR,
										"value"	   => array("Tab content") 
							),
					  );

			$this->config['defaults'] = $am_array[0];

			if($am_elements) {
			  $am_array_copy = $am_array[0];
			  $am_array = array();
			  foreach($am_elements as $key => $am_element) {
				$build_am = $am_array_copy;
				foreach($build_am as $build_am_key => $build_am_element) {
				  $build_am[$build_am_key]['value'] = $am_elements[$key][$build_am_key];
				  $build_am[$build_am_key]['id'] = str_replace('[0]', '[' . $key . ']', $build_am_element['id']);
				}
				$am_array[] = $build_am;
			  }
			}

			$this->config['subElements'] = array(
				array("name"			=> __('Design', 'oxo-core'),
					  "desc"			=> __('Choose a design for the shortcode.', 'oxo-core'),
					  "id"				=> "oxo_design",
					  "type"			=> ElementTypeEnum::SELECT,
					  "value"	   		=> array(""),
					  "allowedValues"   => array('classic'	 => __('Classic', 'oxo-core'),
												 'clean'	 => __('Clean', 'oxo-core')) 
				  	  ),
				  	  
				array("name" 			=> __('Layout', 'oxo-core'),
					  "desc" 			=> __('Choose the layout of the shortcode', 'oxo-core'),
					  "id" 				=> "oxo_layout",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "horizontal",
					  "allowedValues" 	=> array('horizontal' 		=> __('Horizontal', 'oxo-core'),
												 'vertical' 		=> __('Vertical', 'oxo-core')) 
					  ),
					  
				array("name" 			=> __('Justify Tabs', 'oxo-core'),
					  "desc" 			=> __('Choose to get tabs stretched over full shortcode width.', 'oxo-core'),
					  "id" 				=> "oxo_justified",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $choices 
					  ),
					  
				array("name" 			=> __('Background Color', 'oxo-core'),
					  "desc" 			=> __('Controls the background tab color. Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_backgroundcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Inactive Color', 'oxo-core'),
					  "desc" 			=> __('Controls the inactive tab color. Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_inactivecolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Border Color', 'oxo-core'),
					  "desc" 			=> __('Controls the color of the outer tab border. Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_bordercolor",
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
					  
				array("type" 			=> ElementTypeEnum::ADDMORE,
					  "buttonText"		=> __('Add New Tab', 'oxo-core'),
					  "id"				=> "am_oxo_tab",
					  "elements" 		=> $am_array
					  ),
				);
		}
	}