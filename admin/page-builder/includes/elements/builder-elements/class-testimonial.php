<?php
/**
 * Testimonial element implementation, it extends DDElementTemplate like all other elements
 */
	class TF_Testimonial extends DDElementTemplate {
		public function __construct( $am_elements = array() ) {
			parent::__construct($am_elements);
		}
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'testimonial_box';
			// element name
			$this->config['name']	 		= __('Testimonial', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-bubbles';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates Testimonial Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			
			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="oxo_testimonial">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><i class="oxoa-bubbles"></i><sub class="sub">'.__('Testimonial', 'oxo-core').'</sub><p class="testimonial_content">SGS Sandhu, OXO Solutions</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements( $am_elements ) {
		
			$reverse_choices			= OxoHelper::get_reversed_choice_data();

	 $am_array = array();
	  $am_array[] = array (  	  
							array("name"	=> __('Name', 'oxo-core'),
										"desc"		=> __('Insert the name of the person', 'oxo-core'),
										"id"		=> "oxo_name[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array("") 
							),
						  array("name"	=> __('Avatar', 'oxo-core'),
									  "desc"		=> __('Choose which kind of Avatar to be displayed.', 'oxo-core'),
									  "id"		=> "oxo_gender[0]",
									  "type"		=> ElementTypeEnum::SELECT,
							"value"	   => array(""),
									  "allowedValues"   => array('male'	 =>__('Male', 'oxo-core'),
																 'female'	 =>__('Female', 'oxo-core'), 'image' => __('Image', 'oxo-core'), 'none' => __('None', 'Aione')) 
						  ),
						  array("name"	  => __('Custom Avatar', 'oxo-core'),
										"desc"	  => __('Upload a custom avatar image.', 'oxo-core'),
										"id"		=> "oxo_image[0]",
										"type"	  => ElementTypeEnum::UPLOAD,
							  "upid"	  => "1",
										"value"	   => ""
							  ),
						  array("name" 					=> __('Border Radius', 'oxo-core'),
						  		"desc" 					=> __('Choose the radius of the testimonial image. In pixels (px), ex: 1px, or "round".  Leave blank for theme option selection.', 'oxo-core'),
						  		"id" 					=> "oxo_borderradius[0]",
						  		"type" 					=> ElementTypeEnum::INPUT,
						  		"value" 				=> array ("")
						  ),							  
						  array("name"	=> __('Company', 'oxo-core'),
										"desc"		=> __('Insert the name of the company.', 'oxo-core'),
										"id"		=> "oxo_company[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array("") 
							),
						  array("name"	=> __('Link', 'oxo-core'),
										"desc"		=> __('Add the url the company name will link to.', 'oxo-core'),
										"id"		=> "oxo_link[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array("") 
							),
						  array("name"	=> __('Target', 'oxo-core'),
									  "desc"		=> __('_self = open in same window<br>_blank = open in new window.', 'oxo-core'),
									  "id"		=> "oxo_target[0]",
									  "type"		=> ElementTypeEnum::SELECT,
							"value"	   => array("_self"),
									  "allowedValues"   => array('_self'	=>'_self',
																 '_blank'	 =>'_blank') 
						  ),
						  array( "name"	 => __('Testimonial Content', 'oxo-core'),
										"desc"		=> __('Add the testimonial content', 'oxo-core'),
										"id"		=> "oxo_content_wp[0]",
										"type"		=> ElementTypeEnum::TEXTAREA,
										"value"	   => array("") 
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
				array("name" 			=> __('Background Color', 'oxo-core'),
					  "desc" 			=> __('Controls the background color. Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_backgroundcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
				array("name" 			=> __('Text Color', 'oxo-core'),
					  "desc" 			=> __('Controls the text color. Leave blank for theme option selection.', 'oxo-core'),
					  "id" 				=> "oxo_textcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name"			=> __('Random Order', 'oxo-core'),
					  "desc"			=> __('Choose to display testimonials in random order.', 'oxo-core'),
					  "id"				=> "oxo_random",
					  "type"			=> ElementTypeEnum::SELECT,
					  "value"	   		=> '',
					  "allowedValues"   => array(
					  							'' => __( 'Default', 'oxo-core' ),
					  							'no' => __( 'No', 'oxo-core' ),
					  							'yes' => __( 'Yes', 'oxo-core' )
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
					  "buttonText"		=> __('Add New Testimonial', 'oxo-core'),
					  "id"				=> "am_oxo_testimonial",
					  "elements" 		=> $am_array
					  ),
				);
		}
	}