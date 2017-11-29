<?php
/**
 * PostSlider implementation, it extends DDElementTemplate like all other elements
 */
	class TF_PostSlider extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'post_slider';
			// element name
			$this->config['name']	 		= __('Post Slider', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-layers-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates Elastic Slider';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="oxo_post_slider">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><i class="oxoa-layers-alt"></i><sub class="sub">'.__('Post Slider', 'oxo-core').'</sub><p>layout = <span class="post_slider_layout">posts-with-excerpts</span><br /><span class="cat_container" style="selector:attrib"> category = <span class="post_slider_cat">design</span></span></p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$wp_categories 	= OxoHelper::get_wp_categories_list();
			$cat_element	= array('' => 'All');
			$wp_categories  = $cat_element + $wp_categories;
			
			$this->config['subElements'] = array(
			
				array("name" 			=> __('Layout', 'oxo-core'),
					  "desc" 			=> __('Choose a layout style for Post Slider.', 'oxo-core'),
					  "id" 				=> "oxo_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "posts",
					  "allowedValues" 	=> array('posts' 				=> __('Posts with Title', 'oxo-core'),
												 'posts-with-excerpt' 	=> __('Posts with Title and Excerpt', 'oxo-core'),
												 'attachments' 			=> __('Attachment Layout, Only Images Attached to Post/Page', 'oxo-core')) 
					  ),
					  
				array("name" 			=> __('Excerpt Number of Words', 'oxo-core'),
					  "desc" 			=> __('Insert the number of words you want to show in the excerpt.', 'oxo-core'),
					  "id" 				=> "oxo_excerpt",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "35",
					  ),
					  
				array("name" 			=> __('Category', 'oxo-core'),
					  "desc" 			=> __('Select a category of posts to display.', 'oxo-core'),
					  "id" 				=> "oxo_category",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $wp_categories
					  ),
					  
				array("name" 			=> __('Number of Slides', 'oxo-core'),
					  "desc" 			=> __('Select the number of slides to display.', 'oxo-core'),
					  "id" 				=> "oxo_limit",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "3"
					  ),
					  
				array("name" 			=> __('Lightbox on Click', 'oxo-core'),
					  "desc" 			=> __('Only works on attachment layout.', 'oxo-core'),
					  "id" 				=> "oxo_lightbox",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> array('yes' 					=> __('Yes', 'oxo-core'),
												 'no' 					=> __('No', 'oxo-core')) 
					  ),
					  
				array("name" 			=> __('Attach Images to Post/Page Gallery', 'oxo-core'),
					  "desc" 			=> __('Only works for attachments layout.', 'oxo-core'),
					  "id" 				=> "oxo_gallery",
					  "type" 			=> ElementTypeEnum::GALLERY,
					  "value" 			=> " "
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