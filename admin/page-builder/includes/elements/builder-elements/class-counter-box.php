<?php
/**
 * CounterBox implementation, it extends DDElementTemplate like all other elements
 */
	class TF_CounterBox extends DDElementTemplate {
		public function __construct( $am_elements = array() ) {
			parent::__construct($am_elements);
		}
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'counter_box';
			// element name
			$this->config['name']	 		= __('Counter Box', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-browser';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Counter Box';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="oxo_counter_box">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><i class="oxoa-browser"></i><sub class="sub">'.__('Counter Box', 'oxo-core').'</sub><p>columns = <font class="counter_box_columns">5</font></p></span></div>';
			$innerHtml .= '</div>';

			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements( $am_elements ) {
			
			$fille_area_data 			= OxoHelper::oxo_create_dropdown_data( 1, 100 );
			$no_of_columns 				= OxoHelper::oxo_create_dropdown_data(1,6);
			$choices					= OxoHelper::get_shortcode_choices();
			
	  $am_array = array();
	  $am_array[] = array ( 
							array( "name"	 => __('Counter Value', 'oxo-core'),
										"desc"		=> __('The number to which the counter will animate.', 'oxo-core'),
										"id"		=> "oxo_value[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array("") 
							),
							
						  array( "name"	 => __('Delimiter Digit', 'oxo-core'),
										"desc"		=> __('Insert a delimiter digit for better readability. ex: ,', 'oxo-core'),
										"id"		=> "oxo_delimiter[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array("") 
							),								
							
						  array( "name"	 => __('Counter Box Unit', 'oxo-core'),
										"desc"		=> __('Insert a unit for the counter. ex %', 'oxo-core'),
										"id"		=> "oxo_unit[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array("") 
							),
						  array("name"	=> __('Unit Position', 'oxo-core'),
									  "desc"		=> __('Choose the positioning of the unit.', 'oxo-core'),
									  "id"		=> "oxo_unitpos[0]",
									  "type"		=> ElementTypeEnum::SELECT,
							"value"	   => array(""),
									  "allowedValues"   => array('suffix'   =>__('After Counter', 'oxo-core'),
																 'prefix'   =>__('Before Counter', 'oxo-core')) 
						  ),
						  array( "name"	 => __('Icon', 'oxo-core'),
										"desc"		=> __('Click an icon to select, click again to deselect', 'oxo-core'),
										"id"		=> "icon[0]",
										"type"		=> ElementTypeEnum::ICON_BOX,
										"value"	   => array() ,
						  "list"		=> OxoHelper::GET_ICONS_LIST()
							),
						  array("name"	=> __('Counter Direction', 'oxo-core'),
									  "desc"		=> __('Choose to count up or down.', 'oxo-core'),
									  "id"		=> "oxo_direction[0]",
									  "type"		=> ElementTypeEnum::SELECT,
							"value"	   => array(""),
									  "allowedValues"   => array('up'	 =>__('Count Up', 'oxo-core'),
																 'down'   =>__('Count Down', 'oxo-core')) 
						  ),
						  array( "name"	 => __('Counter Box Text', 'oxo-core'),
										"desc"		=> __('Insert text for counter box', 'oxo-core'),
										"id"		=> "oxo_content[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array("Text") 
							)
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
				array("name" 			=> __('Number of Columns', 'oxo-core'),
					  "desc" 			=> __('Set the number of columns per row.', 'oxo-core'),
					  "id" 				=> "oxo_columns",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "4",
					  "allowedValues" 	=> $no_of_columns 
					  ),
				  array("name"	=> __('Counter Box Title Font Color', 'oxo-core'),
							  "desc"		=> __('Controls the color of the counter "value" and icon. Leave blank for theme option styling.', 'oxo-core'),
							  "id"		=> "oxo_color",
							  "type"		=> ElementTypeEnum::COLOR,
							  "value"	   => array(),
				  ),
				array("name" 			=> __('Counter Box Title Font Size', 'oxo-core'),
					  "desc"			=> __('Controls the size of the counter "value" and icon. Enter the font size without \'px\' ex: 50. Leave blank for theme option styling.', 'oxo-core'),
					  "id" 				=> "oxo_title_size",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				array("name" 			=> __('Counter Box Icon Size', 'oxo-core'),
					  "desc"			=> __('Controls the size of the icon. Enter the font size without \'px\'. Default is 50. Leave blank for theme option styling.', 'oxo-core'),
					  "id" 				=> "oxo_icon_size",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				array("name" 			=> __('Counter Box Icon Top', 'oxo-core'),
					  "desc"			=> __('Controls the position of the icon. Select Default for theme option styling.', 'oxo-core'),
					  "id" 				=> "oxo_icon_top",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues"   => array( '' => __( 'Default', 'oxo-core' ), 'no' => __( 'No', 'oxo-core' ), 'yes' => __( 'Yes', 'oxo-core' ) )
					  ),
				  array("name"	=> __('Counter Box Body Font Color', 'oxo-core'),
							  "desc"		=> __('Controls the color of the counter body text. Leave blank for theme option styling.', 'oxo-core'),
							  "id"		=> "oxo_body_color",
							  "type"		=> ElementTypeEnum::COLOR,
							  "value"	   => array(),
				  ),
				array("name" 			=> __('Counter Box Body Font Size', 'oxo-core'),
					  "desc"			=> __('Controls the size of the counter body text. Enter the font size without \'px\' ex: 13. Leave blank for theme option styling.', 'oxo-core'),
					  "id" 				=> "oxo_body_size",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				  array("name"	=> __('Counter Box Border Color', 'oxo-core'),
							  "desc"		=> __('Controls the color of the border.', 'oxo-core'),
							  "id"		=> "oxo_border_color",
							  "type"		=> ElementTypeEnum::COLOR,
							  "value"	   => array(),
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
					  "buttonText"		=> __('Add New Counter Box', 'oxo-core'),
					  "id"				=> "cb_oxo_box",
					  "elements" 		=> $am_array
											
					  )
				);
		}
	}