<?php
/**
 * Blog element implementation, it extends DDElementTemplate like all other elements
 */
	class TF_WpBlog extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'wp_blog';
			// element name
			$this->config['name']	 		= __('Blog', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-blog';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Blog';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="oxo_blog">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><i class="oxoa-blog"></i><sub class="sub">'.__('Blog', 'oxo-core').'</sub><p>layout = <span class="blog_layout">icon-on-side</span><font class="blog_columns">columns = 5</font></p></span></div>';
			$innerHtml .= '</div>';

			$this->config['innerHtml'] = $innerHtml;
		}
		
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$posts_per_page 			= array('oxo_-1' => 'All' , 'oxo_' => 'Default');
			$blog_posts_per_page 		= OxoHelper::oxo_create_dropdown_data( 1, 25, $posts_per_page );
			$wp_categories_list  		= OxoHelper::get_wp_categories_list();
			$choices					= OxoHelper::get_shortcode_choices();
			
			$this->config['subElements'] = array(
			
				array("name" 			=> __('Blog Layout', 'oxo-core'),
					  "desc" 			=> __('Select the layout for the blog shortcode', 'oxo-core'),
					  "id" 				=> "oxo_layout",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "large",
					  "allowedValues" 	=> array('large' 			=> __('Large', 'oxo-core'),
												 'medium' 			=> __('Medium', 'oxo-core'),
												 'large alternate' 	=> __('Large Alternate', 'oxo-core'),
												 'medium alternate' => __('Medium Alternate', 'oxo-core'),
												 'grid'				=> __('Grid', 'oxo-core'),
												 'timeline'			=> __('Timeline', 'oxo-core'))
					  ),
											   
				array("name" 			=> __('Posts Per Page', 'oxo-core'),
					  "desc" 			=> __('Select number of posts per page.', 'oxo-core'),
					  "id" 				=> "oxo_posts_per_page",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $blog_posts_per_page
					  ),
					  
				array("name" 			=> __('Post Offset', 'oxo-core'),
					  "desc" 			=> __('The number of posts to skip. ex: 1.', 'oxo-core'),
					  "id" 				=> "oxo_offset",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> '',
					  ),					  					  
					  
				array("name" 			=> __('Categories', 'oxo-core'),
					  "desc" 			=> __('Select a category or leave blank for all.', 'oxo-core'),
					  "id" 				=> "oxo_cat_slug",
					  "type" 			=> ElementTypeEnum::MULTI,
					  "value" 			=> array(''),
					  "allowedValues" 	=> $wp_categories_list 
					 ),
					 
				array("name" 			=> __('Exclude Categories', 'oxo-core'),
					  "desc" 			=> __('Select a category to exclude.', 'oxo-core'),
					  "id" 				=> "oxo_exclude_cats",
					  "type" 			=> ElementTypeEnum::MULTI,
					  "value" 			=> array(''),
					  "allowedValues" 	=> $wp_categories_list 
					 ),
				
				array("name" 			=> __('Show Title', 'oxo-core'),
					  "desc" 			=> __('Display the post title below the featured image.', 'oxo-core'),
					  "id" 				=> "oxo_title",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
					 
				array("name" 			=> __('Link Title To Post', 'oxo-core'),
					  "desc" 			=> __('Choose if the title should be a link to the single post page.', 'oxo-core'),
					  "id" 				=> "oxo_title_link",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
				
				array("name" 			=> __('Show Thumbnail', 'oxo-core'),
					  "desc" 			=> __('Display the post featured image.', 'oxo-core'),
					  "id" 				=> "oxo_thumbnail",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
					 
			   array("name" 			=> __('Show Excerpt', 'oxo-core'),
					  "desc" 			=> __('Show excerpt or choose "no" for full content.', 'oxo-core'),
					  "id" 				=> "oxo_excerpt",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
			  
			  array("name" 				=> __('Number of words/characters in Excerpt', 'oxo-core'),
					  "desc" 			=> __('Control the excerpt length based on words/character setting in Theme Options > Extra.', 'oxo-core'),
					  "id" 				=> "oxo_excerpt_words",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> 35,
					 ),
					 
			 array("name" 				=> __('Show Meta Info', 'oxo-core'),
					  "desc" 			=> __('Choose to show all meta data.', 'oxo-core'),
					  "id" 				=> "oxo_meta_all",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
					 
			array("name" 				=> __('Show Author Name', 'oxo-core'),
					  "desc" 			=> __('Choose to show the author.', 'oxo-core'),
					  "id" 				=> "oxo_meta_author",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
			
			array("name" 				=> __('Show Categories', 'oxo-core'),
					  "desc" 			=> __("Choose to show the categories.", 'oxo-core'),
					  "id" 				=> "oxo_meta_categories",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
					 
			array("name" 				=> __('Show Comment Count', 'oxo-core'),
					  "desc" 			=> __('Choose to show the comments.', 'oxo-core'),
					  "id" 				=> "oxo_meta_comments",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
			
			array("name" 				=> __('Show Date', 'oxo-core'),
					  "desc" 			=> __('Choose to show the date.', 'oxo-core'),
					  "id" 				=> "oxo_meta_date",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
			
			array("name" 				=> __('Show Read More Link', 'oxo-core'),
					  "desc" 			=> __('Choose to show the Read More link.', 'oxo-core'),
					  "id" 				=> "oxo_meta_link",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
					 
			array("name" 				=> __('Show Tags', 'oxo-core'),
					  "desc" 			=> __("Choose to show the tags.", 'oxo-core'),
					  "id" 				=> "oxo_meta_tags",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
					 
			array("name" 				=> __('Show Pagination', 'oxo-core'),
					  "desc" 			=> __('Show numerical pagination boxes.', 'oxo-core'),
					  "id" 				=> "oxo_paging",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
					 
			array("name" 				=> __('Pagination Type', 'oxo-core'),
					  "desc" 			=> __('Choose the type of pagination.', 'oxo-core'),
					  "id" 				=> "oxo_scrolling",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "pagination",
					  "allowedValues" 	=> array('pagination' => __('Pagination', 'oxo-core'),
												 'infinite'   => __('Infinite Scrolling', 'oxo-core'),
												 'load_more_button' => __('Load More Button', 'oxo-core')) 
					 ),
					 
			array("name" 				=> __('Grid Layout # of Columns', 'oxo-core'),
					  "desc" 			=> __('Select whether to display the grid layout in 2, 3, 4, 5 or 6 column.', 'oxo-core'),
					  "id" 				=> "oxo_blog_grid_columns",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "3",
					  "allowedValues" 	=> array('2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6') 
					 ),
					 
			array("name" 				=> __('Grid Layout Column Spacing', 'oxo-core'),
					  "desc" 			=> __('Insert the amount of spacing between blog grid posts without "px".', 'oxo-core'),
					  "id" 				=> "oxo_blog_grid_column_spacing",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "40"
				  ),	
					 				 	 
			array("name" 				=> __('Strip HTML from Posts Content', 'oxo-core'),
					  "desc" 			=> __('Strip HTML from the post excerpt.', 'oxo-core'),
					  "id" 				=> "oxo_strip_html",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
					 
			array("name" 				=> __('CSS Class', 'oxo-core'),
					  "desc"			=> __('Add a class to the wrapping HTML element.', 'oxo-core'),
					  "id" 				=> "oxo_class",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
			array("name" 				=> __('CSS ID', 'oxo-core'),
				  	"desc"				=> __('Add an ID to the wrapping HTML element.', 'oxo-core'),
				  	"id" 				=> "oxo_id",
				  	"type" 				=> ElementTypeEnum::INPUT,
				  	"value" 			=> "" 
				  ),
				
				);
		}
	}