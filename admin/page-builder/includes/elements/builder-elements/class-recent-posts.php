<?php
/**
 * RecentPosts implementation, it extends DDElementTemplate like all other elements
 */
	class TF_RecentPosts extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'recent_posts';
			// element name
			$this->config['name']	 		= __('Recent Posts', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-feather';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Recent Posts Block';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			
			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><i class="oxoa-feather"></i><sub class="sub">'.__('Recent Posts', 'oxo-core').'</sub><p>layout = <span class="recent_posts_layout">icon-on-side</span> <br /> columns = <font class="recent_posts_columns">5</font><span class="rp_cats_container"><br>categories = <font class="recent_posts_cats">All</font></span></p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$no_of_columns 				= OxoHelper::oxo_create_dropdown_data( 1 , 6 );
			$wp_categories_list  		= OxoHelper::get_wp_categories_list();
			$animation_speed 			= OxoHelper::get_animation_speed_data();
			$animation_direction 		= OxoHelper::get_animation_direction_data();
			$animation_type 			= OxoHelper::get_animation_type_data();
			$choices					= OxoHelper::get_shortcode_choices();
			
			
			$this->config['subElements'] = array(
			
			   array("name" 			=> __('Layout', 'oxo-core'),
					  "desc" 			=> __('Select the layout for the shortcode', 'oxo-core'),
					  "id" 				=> "oxo_layout",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "default",
					  "allowedValues" 	=> array('default' 				=> __('Default', 'oxo-core'),
												 'thumbnails-on-side' 	=> __('Thumbnails on Side', 'oxo-core'),
												 'date-on-side' 		=> __('Date on Side', 'oxo-core'))
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

				array("name" 			=> __('Columns', 'oxo-core'),
					  "desc" 			=> __('Select the number of columns to display', 'oxo-core'),
					  "id" 				=> "oxo_columns",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "1",
					  "allowedValues" 	=> $no_of_columns
					  ),
					  
				array("name" 			=> __('Number of Posts', 'oxo-core'),
					  "desc" 			=> __('Select the number of posts to display', 'oxo-core'),
					  "id" 				=> "oxo_number_posts",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "4"
					  ),
					  
				array("name" 			=> __('Post Offset', 'oxo-core'),
					  "desc" 			=> __('The number of posts to skip. ex: 1.', 'oxo-core'),
					  "id" 				=> "oxo_offset",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
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
					 
				array("name" 			=> __('Show Thumbnail', 'oxo-core'),
					  "desc" 			=> __('Display the post featured image', 'oxo-core'),
					  "id" 				=> "oxo_thumbnail",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
				
				array("name" 			=> __('Show Title', 'oxo-core'),
					  "desc" 			=> __('Display the post title below the featured image', 'oxo-core'),
					  "id" 				=> "oxo_title",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
					 
				array("name" 			=> __('Show Meta', 'oxo-core'),
					  "desc" 			=> __('Choose to show all meta data', 'oxo-core'),
					  "id" 				=> "oxo_meta",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices
					 ),
					 
				array("name" 			=> __('Show Excerpt', 'oxo-core'),
					  "desc" 			=> __('Choose to display the post excerpt', 'oxo-core'),
					  "id" 				=> "oxo_excerpt",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
					 
				array("name" 			=> __('Excerpt Length', 'oxo-core'),
					  "desc" 			=> __('Insert the number of words/characters you want to show in the excerpt', 'oxo-core'),
					  "id" 				=> "oxo_excerpt_words",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> 35,
					 ),
					 
				array("name" 			=> __('Strip HTML', 'oxo-core'),
					  "desc" 			=> __('Strip HTML from the post excerpt', 'oxo-core'),
					  "id" 				=> "oxo_strip_html",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
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
					  "value" 			=> "0.1" ,
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