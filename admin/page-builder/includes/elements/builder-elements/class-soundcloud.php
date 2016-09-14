<?php
/**
 * SoundCloud element implementation, it extends DDElementTemplate like all other elements
 */
	class TF_SoundCloud extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'sound_cloud';
			// element name
			$this->config['name']	 		= __('Soundcloud', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-soundcloud';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Soundcloud Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="oxo_soundcloud">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><i class="oxoa-soundcloud"></i><sub class="sub">'.__('Soundcloud', 'oxo-core').'</sub><p class="soundcloud_url">Soundcloud URL here</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$choices					= OxoHelper::get_shortcode_choices();
			$reverse_choices			= OxoHelper::get_reversed_choice_data();
			
			$this->config['subElements'] = array(
			
				array("name" 			=> __('SoundCloud Url', 'oxo-core'),
					  "desc"			=> __('The SoundCloud url, ex: http://api.soundcloud.com/tracks/110813479', 'oxo-core'),
					  "id" 				=> "oxo_url",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),			
					  
				array("name" 			=> __('Layout', 'oxo-core'),
					  "desc" 			=> __('Choose the layout of the soundcloud embed.', 'oxo-core'),
					  "id" 				=> "oxo_layout",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> array( 'classic' => 'Classic', 'visual' => 'Visual' )
					  ),					  
					  
				array("name" 			=> __('Show Comments', 'oxo-core'),
					  "desc" 			=> __('Choose to display comments.', 'oxo-core'),
					  "id" 				=> "oxo_comments",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					  ),
					  
				array("name" 			=> __('Show Related', 'oxo-core'),
					  "desc" 			=> __('Choose to display related items.', 'oxo-core'),
					  "id" 				=> "oxo_related",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					  ),
					  
				array("name" 			=> __('Show User', 'oxo-core'),
					  "desc" 			=> __('Choose to display the user who posted the item.', 'oxo-core'),
					  "id" 				=> "oxo_user",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					  ),					  
					  
				array("name" 			=> __('Autoplay', 'oxo-core'),
					  "desc" 			=> __('Choose to autoplay the track', 'oxo-core'),
					  "id" 				=> "oxo_auto_play",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "no",
					  "allowedValues" 	=> $reverse_choices 
					  ),
				
				array("name" 			=> __('Color', 'oxo-core'),
					  "desc" 			=> __('Select the color of the shortcode', 'oxo-core'),
					  "id" 				=> "oxo_color",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#ff7700"
					  ),
					  
				array("name" 			=> __('Width', 'oxo-core'),
					  "desc"			=> __('In pixels (px) or percentage (%)', 'oxo-core'),
					  "id" 				=> "oxo_width",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "100%" 
					  ),
					  
				array("name" 			=> __('Height', 'oxo-core'),
					  "desc"			=> __('In pixels (px)', 'oxo-core'),
					  "id" 				=> "oxo_height",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "150px" 
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