<?php
/**
 * Countdown implementation, it extends DDElementTemplate like all other elements
 */
	class TF_CountDown extends DDElementTemplate {
		
		public function __construct() {
			 
			parent::__construct();
		}

		// Implementation for the element structure.
		public function create_element_structure() {
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 	= get_class($this);
			// element id
			$this->config['id']	   		= 'countdown';
			// element name
			$this->config['name']	 	= __('Countdown', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-calendar-check-o';
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 		= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {

			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="oxo_countdown">';
			$innerHtml .= '<div class="builder_icon_container"><span class="oxo_iconbox_icon"><i class="oxoa-calendar-check-o"></i><sub class="sub">'. $this->config['name'] .'</sub>';
			$innerHtml .= '<div class="oxo_countdown_timer"><span class="oxo_dash_weeks"><span class="dash">ph_weeks</span>' . __( 'Weeks', 'oxo-core' ) . '</span><span class="oxo_dash_days"><span class="dash">ph_days</span>' . __( 'Days', 'oxo-core' ) . '</span><span class="oxo_dash_hrs"><span class="dash">ph_hrs</span>' . __( 'Hrs', 'oxo-core' ) . '</span><span class="oxo_dash_mins"><span class="dash">ph_mins</span>' . __( 'Min', 'oxo-core' ) . '</span><span class="oxo_dash_secs"><span class="dash">ph_secs</span>' . __( 'Sec', 'oxo-core' ) . '</span></div>';
			$innerHtml .= '</span></div></div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
				
			$choices_width_default = OxoHelper::get_shortcode_choices_with_default();
			
			$this->config['subElements'] = array(
			
				array("name" 			=> __('Countdown Timer End', 'oxo-core'),
					  "desc" 			=> __('Set the end date and time for the countdown time. Use SQL time format: YYYY-MM-DD HH:MM:SS. E.g: 2016-05-10 12:30:00.', 'oxo-core'),
					  "id" 				=> "oxo_type",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array(
					"name"          => __( 'Timezone', 'oxo-core' ),
					"desc"          => __( 'Choose which timezone should be used for the countdown calculation.', 'oxo-core' ),
					"id"            => "oxo_timezone",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "",
					"allowedValues" => array(
						'' 				=> __( 'Default', 'oxo-core' ),
						'site_time' => __( 'Timezone of Site', 'oxo-core' ),
						'user_time' => __( 'Timezone of User', 'oxo-core' )
					)
				),					  
					  
				array("name" 			=> __('Show Weeks', 'oxo-core'),
					  "desc" 			=> __('Select "yes" to show weeks for longer countdowns.', 'oxo-core'),
					  "id" 				=> "oxo_show_weeks",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $choices_width_default 
					 ),					  
				
				array("name" 			=> __('Backgound Color', 'oxo-core'),
					  "desc" 			=> __('Choose a background color for the countdown wrapping box.', 'oxo-core'),
					  "id" 				=> "oxo_background_color",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array(
					"name"  => __( 'Background Image', 'oxo-core' ),
					"desc"  => __( 'Upload an image to display in the background of the countdown wrapping box.', 'oxo-core' ),
					"id"    => "background_image",
					"type"  => ElementTypeEnum::UPLOAD,
					"upid"  => "1",
					"value" => ""
				),
				array(
					"name"          => __( 'Background Repeat', 'oxo-core' ),
					"desc"          => __( 'Choose how the background image repeats.', 'oxo-core' ),
					"id"            => "background_repeat",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "",
					"allowedValues" => array(
						'' 			=> __( 'Default', 'oxo-core' ),
						'no-repeat' => __( 'No Repeat', 'oxo-core' ),
						'repeat'    => __( 'Repeat Vertically and Horizontally', 'oxo-core' ),
						'repeat-x'  => __( 'Repeat Horizontally', 'oxo-core' ),
						'repeat-y'  => __( 'Repeat Vertically', 'oxo-core' )
					)
				),
				array(
					"name"          => __( 'Background Position', 'oxo-core' ),
					"desc"          => __( 'Choose the postion of the background image.', 'oxo-core' ),
					"id"            => "background_position",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "",
					"allowedValues" => array(
						'' 				=> __( 'Default', 'oxo-core' ),
						'left top'      => __( 'Left Top', 'oxo-core' ),
						'left center'   => __( 'Left Center', 'oxo-core' ),
						'left bottom'   => __( 'Left Bottom', 'oxo-core' ),
						'right top'     => __( 'Right Top', 'oxo-core' ),
						'right center'  => __( 'Right Center', 'oxo-core' ),
						'right bottom'  => __( 'Right Bottom', 'oxo-core' ),
						'center top'    => __( 'Center Top', 'oxo-core' ),
						'center center' => __( 'Center Center', 'oxo-core' ),
						'center bottom' => __( 'Center Bottom', 'oxo-core' )
					)
				),					  
					  
				array("name" 			=> __('Border Radius', 'oxo-core'),
					  "desc"			=> __('Choose the radius of outer box and also the counter boxes. In pixels (px), ex: 1px.', 'oxo-core'),
					  "id" 				=> "oxo_borderradius",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),					  
					  
				array("name" 			=> __('Counter Boxes Color', 'oxo-core'),
					  "desc" 			=> __('Choose a background color for the counter boxes.', 'oxo-core'),
					  "id" 				=> "oxo_counterboxes_color",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),					  
					  
				array("name" 			=> __('Counter Boxes Text Color', 'oxo-core'),
					  "desc" 			=> __('Choose a text color for the countdown timer.', 'oxo-core'),
					  "id" 				=> "oxo_counterboxes_textcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Heading Text', 'oxo-core'),
					  "desc"			=> __('Choose a heading text for the countdown.', 'oxo-core'),
					  "id" 				=> "oxo_heading_text.",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Heading Text Color', 'oxo-core'),
					  "desc" 			=> __('Choose a text color for the countdown heading.', 'oxo-core'),
					  "id" 				=> "oxo_heading_textcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Subheading Text', 'oxo-core'),
					  "desc"			=> __('Choose a subheading text for the countdown.', 'oxo-core'),
					  "id" 				=> "oxo_subheading_text.",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Subheading Text Color', 'oxo-core'),
					  "desc" 			=> __('Choose a text color for the countdown subheading.', 'oxo-core'),
					  "id" 				=> "oxo_subheading_textcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),					  
					  
				array("name" 			=> __('Link Text', 'oxo-core'),
					  "desc"			=> __('Choose a link text for the countdown.', 'oxo-core'),
					  "id" 				=> "oxo_link_text.",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Link Text Color', 'oxo-core'),
					  "desc" 			=> __('Choose a text color for the countdown link.', 'oxo-core'),
					  "id" 				=> "oxo_link_textcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),					  
	
				array("name" 			=> __('Link URL', 'oxo-core'),
					  "desc" 			=> __('Add a url for the link. E.g: http://example.com.', 'oxo-core'),
					  "id" 				=> "oxo_url",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""),
				
				array("name" 			=> __('Link Target', 'oxo-core'),
					  "desc" 			=> __('_self = open in same window<br>_blank = open in new window', 'oxo-core'),
					  "id" 				=> "oxo_target",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "_self",
					  "allowedValues" 	=> array(
					  							'default'		=> 'Default',
					  							'_self' 		=> '_self',
												'_blank' 		=> '_blank'
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
				
				);
		}
	}
