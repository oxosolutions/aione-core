<?php
/**
 * ImageCarousel implementation, it extends DDElementTemplate like all other elements
 */
	class TF_ImageCarousel extends DDElementTemplate {
		public function __construct( $am_elements = array() ) {
			parent::__construct($am_elements);
		}
		
		// Implementation for the element structure.
		public function create_element_structure() {
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'image_carousel';
			// element name
			$this->config['name']	 		= __('Image Carousel', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-images';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates an Image Coursel';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="oxo_image_carousel">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><i class="oxoa-images"></i><sub class="sub">'.__('Image Carousel', 'oxo-core').'</sub><ul class="image_carousel_elements"><li></li><li></li><li></li><li></li><li></li></ul></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements( $am_elements ) {
			$no_of_columns 				= OxoHelper::oxo_create_dropdown_data( 1 , 6 );

	 		$am_array = array();
	  		$am_array[] = array ( 
							array( "name"	 => __('Image Website Link', 'oxo-core'),
										"desc"		=> __('Add the url to image\'s website. If lightbox option is enabled, you have to add the full image link to show it in the lightbox.', 'oxo-core'),
										"id"		=> "oxo_url[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array()
							),
						  array("name"	=> __('Link Target', 'oxo-core'),
									  "desc"		=> __('_self = open in same window<br>_blank = open in new window', 'oxo-core'),
									  "id"		=> "oxo_target[0]",
									  "type"		=> ElementTypeEnum::SELECT,
							"value"	   => array("_self"),
									  "allowedValues"   => array('_self'	=>'_self',
																 '_blank'	 =>'_blank') 
						  ),
						  array( "name"	 => __('Image', 'oxo-core'),
										"desc"		=> __('Upload an image to display.', 'oxo-core'),
										"id"		=> "oxo_image[0]",
										"type"		=> ElementTypeEnum::UPLOAD,
										"upid"		=> array(1),
									  	"value"	   => array()									
							),
						  array( "name"	 => __('Image Alt Text', 'oxo-core'),
										"desc"		=> __('The alt attribute provides alternative information if an image cannot be viewed.', 'oxo-core'),
										"id"		=> "oxo_alt[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array() 
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
				 array("name" 			=> __('Picture Size', 'oxo-core'),
					  "desc" 			=> __('fixed = width and height will be fixed<br>auto = width and height will adjust to the image.', 'oxo-core'),
					  "id" 				=> "oxo_picture_size",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "fixed",
					  "allowedValues" 	=> array('fixed' 				=> __('Fixed', 'oxo-core'),
												 'auto' 				=> __('Auto', 'oxo-core')) 
					  ),
			  	
				array("name" 			=> __('Hover Type', 'oxo-core'),
					  "desc" 			=> __('Select the hover effect type.', 'oxo-core'),
					  "id" 				=> "oxo_hover_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "none",
					  "allowedValues" 	=> array('none' 			=> __('None', 'oxo-core'),
												 'zoomin' 			=> __('Zoom In', 'oxo-core'),
												 'zoomout' 			=> __('Zoom Out', 'oxo-core'),
												 'liftup' 			=> __('Lift Up', 'oxo-core')) 
					  ),

				array("name" 			=> __('Autoplay', 'oxo-core'),
					  "desc" 			=> __('Choose to autoplay the carousel.', 'oxo-core'),
					  "id" 				=> "oxo_autoplay",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "no",
					  "allowedValues" 	=> array('yes' 				=> __('Yes', 'oxo-core'),
												 'no' 				=> __('No', 'oxo-core')) 
					  ),			  	
			  	
				array("name" 			=> __('Maximum Columns', 'oxo-core'),
					  "desc" 			=> __('Select the number of max columns to display.', 'oxo-core'),
					  "id" 				=> "oxo_columns",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "5",
					  "allowedValues" 	=> $no_of_columns
					  ),
					  
				array("name" 			=> __('Column Spacing', 'oxo-core'),
					  "desc" 			=> __("Insert the amount of spacing between items without 'px'. ex: 13.", 'oxo-core'),
					  "id" 				=> "oxo_column_spacing",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "13",
					 ),				 
					 
				array("name" 			=> __('Scroll Items', 'oxo-core'),
					  "desc" 			=> __("Insert the amount of items to scroll. Leave empty to scroll number of visible items.", 'oxo-core'),
					  "id" 				=> "oxo_scroll_items",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "",
					 ),						 
			  	
				array("name" 			=> __('Show Navigation', 'oxo-core'),
					  "desc" 			=> __('Choose to show navigation buttons on the carousel.', 'oxo-core'),
					  "id" 				=> "oxo_navigation",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> array('yes' 				=> __('Yes', 'oxo-core'),
												 'no' 				=> __('No', 'oxo-core')) 
					  ),	
					  
				array("name" 			=> __('Mouse Scroll', 'oxo-core'),
					  "desc" 			=> __('Choose to enable mouse drag control on the carousel. IMPORTANT: For easy draggability, when mouse scroll is activated, links will be disabled.', 'oxo-core'),
					  "id" 				=> "oxo_mouse_scroll",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "no",
					  "allowedValues" 	=> array('yes' 				=> __('Yes', 'oxo-core'),
												 'no' 				=> __('No', 'oxo-core')) 
					  ),	
					  
				array("name" 			=> __('Border', 'oxo-core'),
					  "desc" 			=> __('Choose to enable a border around the images.', 'oxo-core'),
					  "id" 				=> "oxo_border",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> array('yes' 				=> __('Yes', 'oxo-core'),
												 'no' 				=> __('No', 'oxo-core')) 
					  ),
 	
				array("name" 			=> __('Image lightbox', 'oxo-core'),
					  "desc" 			=> __('Show image in lightbox.', 'oxo-core'),
					  "id" 				=> "oxo_lightbox",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> array('yes' 				=> __('Yes', 'oxo-core'),
												 'no' 				=> __('No', 'oxo-core')) 
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
					  "buttonText"		=> __('Add New Image', 'oxo-core'),
					  "id"				=> "am_oxo_image",
					  "elements" 		=> $am_array
											
					  )
					  
				);
		}
	}