<?php
/**
 * CheckList element implementation, it extends DDElementTemplate like all other elements
 */
	class TF_CheckList extends DDElementTemplate {

		public function __construct( $am_elements = array() ) {
			parent::__construct($am_elements);
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'check_list';
			// element name
			$this->config['name']	 		= __('Checklist', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-list-ul';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Checklist';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="oxo_ckecklist">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><i class="oxoa-list-ul"></i><sub class="sub">'.__('Checklist', 'oxo-core').'</sub><ul class="checklist_elements"><li><i class="oxoa-list-ul"></i> checklist preview text here</li><li><i class="oxoa-list-ul"></i> checklist preview text here</li><li><i class="oxoa-list-ul"></i> checklist preview text here</li></ul></span></div>';
			$innerHtml .= '</div>';

			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements( $am_elements ) {
			
			$choices					= OxoHelper::get_shortcode_choices_with_default();
			
	  $am_array = array();

	  $am_array[] = array ( 
						  array("name"	  => __('Select Icon', 'oxo-core'),
									  "desc"		  => __('This setting will override the global setting above. Leave blank for theme option selection.', 'oxo-core'),
									  "id"		  => "oxo_icon[0]",
									  "type"		  => ElementTypeEnum::ICON_BOX,
									  "value"		 => array (""),
							"list"		  => OxoHelper::GET_ICONS_LIST()
							),
						  array( "name"	   => __('List Item Content', 'oxo-core'),
										"desc"		  => __('Add list item content', 'oxo-core'),
										"id"		  => "oxo_content_wp[0]",
										"type"		  => ElementTypeEnum::HTML_EDITOR,
										"value"		 => array('') 
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
				array("name" 			=> __('Select Icon', 'oxo-core'),
					  "desc" 			=> __('Global setting for all list items, this can be overridden individually below. Click an icon to select, click again to deselect.', 'oxo-core'),
					  "id" 				=> "icon",
					  "type" 			=> ElementTypeEnum::ICON_BOX,
					  "value" 			=> "fa-check",
					  "list"			=> OxoHelper::GET_ICONS_LIST()
					  ),
					  
						  array("name"	  => __('Icon Color', 'oxo-core'),
									  "desc"		  => __('Global setting for all list items. Leave blank for theme option selection. Defines the icon color.', 'oxo-core'),
									  "id"		  => "oxo_iconcolor",
									  "type"		  => ElementTypeEnum::COLOR,
									  "value"		 => ''
							),

				array("name" 			=> __('Icon in Circle', 'oxo-core'),
					  "desc" 			=> __('Global setting for all list items. Set to default for theme option selection. Choose to have icons in circles.', 'oxo-core'),
					  "id" 				=> "oxo_circle",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $choices 
					  ),
					  
						   array("name"	   => __('Circle Color', 'oxo-core'),
									  "desc"		  => __('Global setting for all list items. Leave blank for theme option selection. Defines the circle color.', 'oxo-core'),
									  "id"		  => "oxo_circlecolor",
									  "type"		  => ElementTypeEnum::COLOR,
									  "value"		 => ''
							), 
					  
				array("name" 			=> __('Item Size', 'oxo-core'),
					  "desc" 			=> __('Select the list item\'s size. In pixels (px), ex: 13px.', 'oxo-core'),
					  "id" 				=> "oxo_size",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "13px",
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
					  "buttonText"		=> __('Add New List Item', 'oxo-core'),
					  "id"				=> "am_oxo_content",
					  "elements" 		=> $am_array
					  ),
				);

		}
	}