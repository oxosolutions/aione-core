<?php

	/**
	 * One 1/3 layout category implementation, it extends DDElementTemplate like all other elements
	 */
	class TF_GridThree extends DDElementTemplate {

		public function __construct() {

			parent::__construct();
		}

		// Implementation for the element structure.
		public function create_element_structure() {

			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] = get_class( $this );
			// element id
			$this->config['id'] = 'grid_three';
			// element shortcode base
			$this->config['base'] = 'one_third';
			// element name
			$this->config['name'] = '1/3';
			// element icon class
			$this->config['icon_class'] = 'oxo-icon oxo-icon-grid-3';
			// element icon
			$this->config['icon_url'] = "icons/sc-three.png";
			// css class related to this element
			$this->config['css_class'] = "oxo_layout_column grid_three item-container sort-container ";
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a single (1/3) width column';
			// any special html data attribute (i.e. data-width) needs to be passed
			// width determine the ratio of them element related to its parent element in the editor, 
			// it's only important for layout elements.
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] = array( "floated_width" => "0.33", "width" => "3", "drop_level" => "3" );
		}

		// override default implemenation for this function as this element doesn't have any content.
		public function create_visual_editor( $params ) {

			$this->config['innerHtml'] = "";
		}

		//this function defines 1/3 sub elements or structure
		function popup_elements() {
			$animation_speed     = OxoHelper::get_animation_speed_data();
			$animation_direction = OxoHelper::get_animation_direction_data();
			$animation_type      = OxoHelper::get_animation_type_data();

			$this->config['layout_opt']  = true;
			$this->config['subElements'] = array(

				array(
					"name"          => __( 'Last Column', 'oxo-core' ),
					"desc"          => __( 'Choose if the column is last in a set. This has to be set to "Yes" for the last column in a set.', 'oxo-core' ),
					"id"            => "last",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "no",
					"allowedValues" => array(
						'yes' => __( 'Yes', 'oxo-core' ),
						'no'  => __( 'No', 'oxo-core' ),
					)
				),
				array(
					"name"          => __( 'Column Spacing', 'oxo-core' ),
					"desc"          => __( 'Set to "no" to eliminate margin between columns.', 'oxo-core' ),
					"id"            => "spacing",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "yes",
					"allowedValues" => array(
						'yes' => __( 'Yes', 'oxo-core' ),
						'no'  => __( 'No', 'oxo-core' ),
					)
				),
				array(
					"name"          => __( 'Center Content Vertically', 'oxo-core' ),
					"desc"          => __( 'Only works with columns inside a full width container that is set to equal heights. Set to "Yes" to center the content vertically.', 'oxo-core' ),
					"id"            => "center_content",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "no",
					"allowedValues" => array(
						'yes' => __( 'Yes', 'oxo-core' ),
						'no'  => __( 'No', 'oxo-core' ),
					)
				),
				array(
					"name"          => __( 'Hide on Mobile', 'oxo-core' ),
					"desc"          => __( 'Select yes to hide column on mobile.', 'oxo-core' ),
					"id"            => "hide_on_mobile",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "no",
					"allowedValues" => array(
						'no'  => __( 'No', 'oxo-core' ),
						'yes' => __( 'Yes', 'oxo-core' ),
					)
				),
				array(
					"name"  => __( 'Background Color', 'oxo-core' ),
					"desc"  => __( 'Controls the background color.', 'oxo-core' ),
					"id"    => "background_color",
					"type"  => ElementTypeEnum::COLOR,
					"value" => ""
				),
				array(
					"name"  => __( 'Background Image', 'oxo-core' ),
					"desc"  => __( 'Upload an image to display in the background', 'oxo-core' ),
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
					"value"         => "no-repeat",
					"allowedValues" => array(
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
					"value"         => "left top",
					"allowedValues" => array(
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
				array("name" 			=> __('Hover Type', 'oxo-core'),
					  "desc" 			=> __('Select the hover effect type. This will disable links on elements inside the column.', 'oxo-core'),
					  "id" 				=> "oxo_hover_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "none",
					  "allowedValues" 	=> array('none' 			=> __('None', 'oxo-core'),
												 'zoomin' 			=> __('Zoom In', 'oxo-core'),
												 'zoomout' 			=> __('Zoom Out', 'oxo-core'),
												 'liftup' 			=> __('Lift Up', 'oxo-core')) 
				),
				array("name" 			=> __('Link URL', 'oxo-core'),
					  "desc"			=> __('Add the URL the column will link to, ex: http://example.com. This will disable links on elements inside the column.', 'oxo-core'),
					  "id" 				=> "oxo_link",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
				),
				array(
					"name"          => __( 'Border Position', 'oxo-core' ),
					"desc"          => __( 'Choose the postion of the border.', 'oxo-core' ),
					"id"            => "border_position",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "all",
					"allowedValues" => array(
						'all' => __('All', 'oxo-core'),
						'top' => __('Top', 'oxo-core'),
						'right' => __('Right', 'oxo-core'),
						'bottom' => __('Bottom', 'oxo-core'),
						'left' => __('Left', 'oxo-core')
					)
				),					
				array(
					"name"  => __( 'Border Size', 'oxo-core' ),
					"desc"  => __( 'In pixels (px), ex: 1px.', 'oxo-core' ),
					"id"    => "border_size",
					"type"  => ElementTypeEnum::INPUT,
					"value" => "0px"
				),
				array(
					"name"  => __( 'Border Color', 'oxo-core' ),
					"desc"  => __( 'Controls the border color.', 'oxo-core' ),
					"id"    => "border_color",
					"type"  => ElementTypeEnum::COLOR,
					"value" => ""
				),
				array(
					"name"          => __( 'Border Style', 'oxo-core' ),
					"desc"          => __( 'Controls the border style.', 'oxo-core' ),
					"id"            => "border_style",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "",
					"allowedValues" => array(
						'solid'  => __( 'Solid', 'oxo-core' ),
						'dashed' => __( 'Dashed', 'oxo-core' ),
						'dotted' => __( 'Dotted', 'oxo-core' )
					)
				),
				array(
					"name"  => __( 'Padding', 'oxo-core' ),
					"desc"  => __( 'In pixels (px), ex: 10px.', 'oxo-core' ),
					"id"    => "padding",
					"type"  => ElementTypeEnum::INPUT,
					"value" => "",
				),
				array(
					"name"  => __( 'Margin Top', 'oxo-core' ),
					"desc"  => __( 'In pixels (px), ex: 1px.', 'oxo-core' ),
					"id"    => "margin_top",
					"type"  => ElementTypeEnum::INPUT,
					"value" => ""
				),
				array(
					"name"  => __( 'Margin Bottom', 'oxo-core' ),
					"desc"  => __( 'In pixels (px), ex: 1px.', 'oxo-core' ),
					"id"    => "margin_bottom",
					"type"  => ElementTypeEnum::INPUT,
					"value" => ""
				),
				array(
					"name"          => __( 'Animation Type', 'oxo-core' ),
					"desc"          => __( 'Select the type on animation to use on the shortcode', 'oxo-core' ),
					"id"            => "animation_type[0]",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => array(),
					"allowedValues" => $animation_type
				),
				array(
					"name"          => __( 'Direction of Animation', 'oxo-core' ),
					"desc"          => __( 'Select the incoming direction for the animation', 'oxo-core' ),
					"id"            => "animation_direction[0]",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => array(),
					"allowedValues" => $animation_direction
				),
				array(
					"name"          => __( 'Speed of Animation', 'oxo-core' ),
					"desc"          => __( 'Type in speed of animation in seconds (0.1 - 1)', 'oxo-core' ),
					"id"            => "animation_speed[0]",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => array( '0.1' ),
					"allowedValues" => $animation_speed
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
				array(
					"name"  => __( 'CSS Class', 'oxo-core' ),
					"desc"  => __( 'Add a class to the wrapping HTML element.', 'oxo-core' ),
					"id"    => "class",
					"type"  => ElementTypeEnum::INPUT,
					"value" => ""
				),
				array(
					"name"  => __( 'CSS ID', 'oxo-core' ),
					"desc"  => __( 'Add an ID to the wrapping HTML element.', 'oxo-core' ),
					"id"    => "id",
					"type"  => ElementTypeEnum::INPUT,
					"value" => ""
				),
			);
		}
	}