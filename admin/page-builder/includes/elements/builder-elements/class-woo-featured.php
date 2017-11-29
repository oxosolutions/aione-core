<?php

	/**
	 * WooFeatured element implementation, it extends DDElementTemplate like all other elements
	 */
	class TF_WooFeatured extends DDElementTemplate {
		public function __construct() {

			parent::__construct();
		}

		// Implementation for the element structure.
		public function create_element_structure() {

			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] = get_class( $this );
			// element id
			$this->config['id'] = 'woo_featured';
			// element shortcode base
			$this->config['base'] = 'featured_products_slider';
			// element name
			$this->config['name'] = __( 'Woo Featured', 'oxo-core' );
			// element icon
			$this->config['icon_url'] = "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] = "oxo_element_box";
			// element icon class
			$this->config['icon_class'] = 'oxo-icon builder-options-icon oxoa-star-empty';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Woo Featured Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] = array( "drop_level" => "4" );
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {

			$innerHtml = '<div class="oxo_iconbox textblock_element textblock_element_style">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><i class="oxoa-star-empty"></i><sub class="sub">' . __( 'Woo Featured', 'oxo-core' ) . '</sub></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}

		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			$no_of_columns           = OxoHelper::oxo_create_dropdown_data( 1, 6 );
			$choices                 = OxoHelper::get_shortcode_choices();		
		
			$this->config['subElements'] = array(
				array(
					"name"          => __( 'Picture Size', 'oxo-core' ),
					"desc"          => __( 'fixed = width and height will be fixed<br>auto = width and height will adjust to the image.', 'oxo-core' ),
					"id"            => "picture_size",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "auto",
					"allowedValues" => array(
						'fixed' => __( 'Fixed', 'oxo-core' ),
						'auto'  => __( 'Auto', 'oxo-core' )
					)
				),
				array(
					"name"          => __( 'Carousel Layout', 'oxo-core' ),
					"desc"          => __( 'Choose to show titles on rollover image, or below image.', 'oxo-core' ),
					"id"            => "carousel_layout",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "title_on_rollover",
					"allowedValues" => array(
						'title_on_rollover' => __( 'Title on rollover', 'oxo-core' ),
						'title_below_image' => __( 'Title below image', 'oxo-core' )
					)
				),
				array(
					"name"          => __( 'Carousel Autoplay', 'oxo-core' ),
					"desc"          => __( 'Choose to autoplay the carousel.', 'oxo-core' ),
					"id"            => "autoplay",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "no",
					"allowedValues" => array(
						'yes' => __( 'Yes', 'oxo-core' ),
						'no'  => __( 'No', 'oxo-core' )
					)
				),
				array(
					"name"          => __( 'Maximum Columns', 'oxo-core' ),
					"desc"          => __( 'Select the number of max columns to display.', 'oxo-core' ),
					"id"            => "columns",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "5",
					"allowedValues" => $no_of_columns
				),
				array(
					"name"  => __( 'Column Spacing', 'oxo-core' ),
					"desc"  => __( "Insert the amount of spacing between items without 'px'. ex: 13.", 'oxo-core' ),
					"id"    => "column_spacing",
					"type"  => ElementTypeEnum::INPUT,
					"value" => "10",
				),
				array(
					"name" 			=> __('Carousel Scroll Items', 'oxo-core'),
					"desc" 			=> __("Insert the amount of items to scroll. Leave empty to scroll number of visible items.", 'oxo-core'),
					"id" 			=> "oxo_scroll_items",
					"type" 			=> ElementTypeEnum::INPUT,
					"value" 		=> "",	
				),				
				array(
					"name"          => __( 'Carousel Show Navigation', 'oxo-core' ),
					"desc"          => __( 'Choose to show navigation buttons on the carousel.', 'oxo-core' ),
					"id"            => "navigation",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "yes",
					"allowedValues" => array(
						'yes' => __( 'Yes', 'oxo-core' ),
						'no'  => __( 'No', 'oxo-core' )
					)
				),
				array(
					"name"          => __( 'Carousel Mouse Scroll', 'oxo-core' ),
					"desc"          => __( 'Choose to enable mouse drag control on the carousel.', 'oxo-core' ),
					"id"            => "mouse_scroll",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "no",
					"allowedValues" => array(
						'yes' => __( 'Yes', 'oxo-core' ),
						'no'  => __( 'No', 'oxo-core' )
					)
				),
				array(
					"name"          => __( 'Show Categories', 'oxo-core' ),
					"desc"          => __( 'Choose to show or hide the categories', 'oxo-core' ),
					"id"            => "show_cats",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "yes",
					"allowedValues" => $choices
				),
				array(
					"name"          => __( 'Show Price', 'oxo-core' ),
					"desc"          => __( 'Choose to show or hide the price', 'oxo-core' ),
					"id"            => "show_price",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "yes",
					"allowedValues" => $choices
				),
				array(
					"name"          => __( 'Show Buttons', 'oxo-core' ),
					"desc"          => __( 'Choose to show or hide the icon buttons', 'oxo-core' ),
					"id"            => "show_buttons",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "yes",
					"allowedValues" => $choices
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