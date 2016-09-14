<?php
/**
 * RecentWorks implementation, it extends DDElementTemplate like all other elements
 */
	class TF_RecentWorks extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'recent_works';
			// element name
			$this->config['name']	 		= __('Recent Works', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-insertpicture';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Recent Works Blck';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="oxo_recent_works">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><i class="oxoa-insertpicture"></i><sub class="sub">'.__('Recent Works', 'oxo-core').'</sub><p>layout = <span class="recent_works_layout">icon-on-side</span><span class="columns_container" style="selector:attrib"> <br />columns = <font class="recent_works_columns">5</font></span><span class="rw_cats_container"><br>categories = <font class="recent_works_cats">All</font></span></p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;

		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$no_of_columns 				= OxoHelper::oxo_create_dropdown_data( 1 , 6 );
			$wp_categories_list  		= OxoHelper::oxo_shortcodes_categories('portfolio_category');
			$animation_speed 			= OxoHelper::get_animation_speed_data();
			$animation_direction 		= OxoHelper::get_animation_direction_data();
			$animation_type 			= OxoHelper::get_animation_type_data();
			$choices					= OxoHelper::get_shortcode_choices();
			
			$this->config['subElements'] = array(
			
			   array( "name" 			=> __('Layout', 'oxo-core'),
					  "desc" 			=> __('Choose the layout for the shortcode', 'oxo-core'),
					  "id" 				=> "oxo_layout",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "carousel",
					  "allowedValues" 	=> array('carousel' 			=> __('Carousel', 'oxo-core'),
												 'grid' 				=> __('Grid', 'oxo-core'),
												 'grid-with-excerpts' 	=> __('Grid with Excerpts', 'oxo-core'))
					  ),
					  
				array( "name" 			=> __('Picture Size', 'oxo-core'),
					  "desc" 			=> __('fixed = width and height will be fixed<br>auto = width and height will adjust to the image.', 'oxo-core'),
					  "id" 				=> "oxo_picture_size",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "fixed",
					  "allowedValues" 	=> array('fixed' 			=> __('Fixed', 'oxo-core'),
												 'auto' 			=> __('Auto', 'oxo-core'))
					  ),
					  
				array( "name" 			=> __('Grid with Excerpts Layout', 'oxo-core'),
					  "desc" 			=> __('Select if the grid with excerpts layouts are boxed or unboxed.', 'oxo-core'),
					  "id" 				=> "oxo_boxed_text",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "unboxed",
					  "allowedValues" 	=> array('boxed' 			=> __('Boxed', 'oxo-core'),
												 'unboxed' 			=> __('Unboxed', 'oxo-core'))
					  ),
					  
				array("name" 			=> __('Show Filters', 'oxo-core'),
					  "desc" 			=> __('Choose to show or hide the category filters', 'oxo-core'),
					  "id" 				=> "oxo_filters",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> 	array('yes' => __('Yes', 'oxo-core'), 
												  'yes-without-all' => __('Yes without "All"', 'oxo-core'),
												  'no' => __('No', 'oxo-core'))
					 ),
					 
				array("name" 			=> __('Columns', 'oxo-core'),
					  "desc" 			=> __('Select the number of columns to display. With Carousel layout this specifies the maximum amount of columns.', 'oxo-core'),
					  "id" 				=> "oxo_columns",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "3",
					  "allowedValues" 	=> $no_of_columns
					  ),
					  
				array("name" 			=> __('Column Spacing', 'oxo-core'),
					  "desc" 			=> __('Insert the amount of spacing between portfolio items without "px". ex: 7.', 'oxo-core'),
					  "id" 				=> "oxo_column_spacing",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "12",
					 ),					  
					  
				array("name" 			=> __('Categories', 'oxo-core'),
					  "desc" 			=> __('Select a category or leave blank for all', 'oxo-core'),
					  "id" 				=> "oxo_cat_slug",
					  "type" 			=> ElementTypeEnum::MULTI,
					  "value" 			=> array(''),
					  "allowedValues" 	=> $wp_categories_list 
					 ),
					 
				array("name" 			=> __('Exclude Categories', 'oxo-core'),
					  "desc" 			=> __('Select a category to exclude', 'oxo-core'),
					  "id" 				=> "oxo_exclude_cats",
					  "type" 			=> ElementTypeEnum::MULTI,
					  "value" 			=> array(''),
					  "allowedValues" 	=> $wp_categories_list 
					 ),
					 
				array("name" 			=> __('Number of Posts', 'oxo-core'),
					  "desc" 			=> __('Select the number of posts to display', 'oxo-core'),
					  "id" 				=> "oxo_number_posts",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "8"
					  ),
					  
				array("name" 			=> __('Post Offset', 'oxo-core'),
					  "desc" 			=> __('The number of posts to skip. ex: 1.', 'oxo-core'),
					  "id" 				=> "oxo_offset",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),					  
		  
				array("name" 			=> __('Excerpt Length', 'oxo-core'),
					  "desc" 			=> __('Insert the number of words/characters you want to show in the excerpt', 'oxo-core'),
					  "id" 				=> "oxo_excerpt_words",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> 35,
					 ),
					 
                array("name"                 => __('Strip HTML from Posts Content', 'oxo-core'),
                          "desc"             => __('Strip HTML from the post excerpt.', 'oxo-core'),
                          "id"                 => "oxo_strip_html",
                          "type"             => ElementTypeEnum::SELECT,
                          "value"             => "yes",
                          "allowedValues"     => $choices 
                         ),                     					 
					 
				array("name" 			=> __('Carousel Layout', 'oxo-core'),
					  "desc" 			=> __('Choose to show titles on rollover image, or below image.', 'oxo-core'),
					  "id" 				=> "oxo_carousel_layout",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "title_on_rollover",
					  "allowedValues" 	=> array('title_on_rollover' 				=> __('Title on rollover', 'oxo-core'),
												 'title_below_image' 				=> __('Title below image', 'oxo-core')) 
					  ),
					  
				array("name" 			=> __('Carousel Scroll Items', 'oxo-core'),
					  "desc" 			=> __("Insert the amount of items to scroll. Leave empty to scroll number of visible items.", 'oxo-core'),
					  "id" 				=> "oxo_scroll_items",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "",
					 ),					  
					 
				array("name" 			=> __('Carousel Autoplay', 'oxo-core'),
					  "desc" 			=> __('Choose to autoplay the carousel.', 'oxo-core'),
					  "id" 				=> "oxo_autoplay",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "no",
					  "allowedValues" 	=> array('yes' 				=> __('Yes', 'oxo-core'),
												 'no' 				=> __('No', 'oxo-core')) 
					  ),			  				  	
			  	
				array("name" 			=> __('Carousel Show Navigation', 'oxo-core'),
					  "desc" 			=> __('Choose to show navigation buttons on the carousel.', 'oxo-core'),
					  "id" 				=> "oxo_navigation",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> array('yes' 				=> __('Yes', 'oxo-core'),
												 'no' 				=> __('No', 'oxo-core')) 
					  ),	
					  
				array("name" 			=> __('Carousel Mouse Scroll', 'oxo-core'),
					  "desc" 			=> __('Choose to enable mouse drag control on the carousel.', 'oxo-core'),
					  "id" 				=> "oxo_mouse_scroll",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "no",
					  "allowedValues" 	=> array('yes' 				=> __('Yes', 'oxo-core'),
												 'no' 				=> __('No', 'oxo-core')) 
					  ),
					  			  	 
				array("name" 			=> __('Animation Type', 'oxo-core'),
					  "desc" 			=> __('Select the type on animation to use on the shortcode', 'oxo-core'),
					  "id" 				=> "oxo_animation_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $animation_type 
					 ),
				
				array("name" 			=> __('Direction of Animation', 'oxo-core'),
					  "desc" 			=> __('Select the incoming direction for the animation', 'oxo-core'),
					  "id" 				=> "oxo_animation_direction",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $animation_direction 
					 ),
				
				array("name" 			=> __('Speed of Animation', 'oxo-core'),
					  "desc"			=> __('Type in speed of animation in seconds (0.1 - 1)', 'oxo-core'),
					  "id" 				=> "oxo_animation_speed",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "0.1",
					  "allowedValues"	=> $animation_speed
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
					 
				);
		}
	}