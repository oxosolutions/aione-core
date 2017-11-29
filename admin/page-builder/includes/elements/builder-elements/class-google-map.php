<?php
/**
 * GoogleMap implementation, it extends DDElementTemplate like all other elements
 */
	class TF_GoogleMap extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'google_map';
			// element name
			$this->config['name']	 		= __('Google Map', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon oxoa-map oxo_has_colorpicker';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Google Map Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="oxo_google_map">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="oxo_iconbox_icon"><i class="oxoa-map"></i><sub class="sub">'.__('Google Map', 'oxo-core').'</sub><p class="google_map_address">12345 West Elm Street, New York City ,NY 33544</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
	
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$zoom_levels 				= OxoHelper::oxo_create_dropdown_data( 1, 25 );
			$choices					= OxoHelper::get_shortcode_choices();
			
			$this->config['subElements'] = array(
			
				array("name" 			=> __('Map Type', 'oxo-core'),
					  "desc" 			=> __('Select the type of google map to display', 'oxo-core'),
					  "id" 				=> "oxo_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "roadmap",
					  "allowedValues" 	=> array('roadmap' 		=>__('Roadmap', 'oxo-core'),
												 'satellite' 	=>__('Satellite', 'oxo-core'),
												 'hybrid' 		=> __('Hybrid', 'oxo-core'),
												 'terrain' 		=> __('Terrain', 'oxo-core'))
					  ),
											   
				array("name" 			=> __('Map Width', 'oxo-core'),
					  "desc" 			=> __('Map width in percentage or pixels. ex: 100%, or 940px', 'oxo-core'),
					  "id" 				=> "oxo_width",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "100%"
					  ),
				
				array("name" 			=> __('Map Height', 'oxo-core'),
					  "desc" 			=> __('Map height in pixels. ex: 300px', 'oxo-core'),
					  "id" 				=> "oxo_height",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "300px"
					  ),
					  
				array("name" 			=> __('Zoom Level', 'oxo-core'),
					  "desc" 			=> __('Higher number will be more zoomed in.', 'oxo-core'),
					  "id" 				=> "oxo_zoom",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "14",
					  "allowedValues" 	=> $zoom_levels
					 ),
				
				array("name" 			=> __('Scrollwheel on Map', 'oxo-core'),
					  "desc" 			=> __('Enable zooming using a mouse\'s scroll wheel', 'oxo-core'),
					  "id" 				=> "oxo_scrollwheel",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
				
				array("name" 			=> __('Show Scale Control on Map', 'oxo-core'),
					  "desc"			=> __('Display the map scale', 'oxo-core'),
					  "id" 				=> "oxo_scale",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes" ,
					  "allowedValues" 	=> $choices 
					  ),
					  
				array("name" 			=> __('Show Pan Control on Map', 'oxo-core'),
					  "desc"			=> __('Displays pan control button', 'oxo-core'),
					  "id" 				=> "oxo_zoom_pancontrol",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes" ,
					  "allowedValues" 	=> $choices 
					  ),

				array("name" 			=> __('Address Pin Animation', 'oxo-core'),
					  "desc"			=> __('Choose to animate the address pins when the map first loads.', 'oxo-core'),
					  "id" 				=> "oxo_animation",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes" ,
					  "allowedValues" 	=> $choices 
					  ),

				array("name" 			=> __('Show tooltip by default', 'oxo-core'),
					  "desc"			=> __('Display or hide tooltip by default when the map first loads.', 'oxo-core'),
					  "id" 				=> "oxo_popup",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes" ,
					  "allowedValues" 	=> $choices 
					  ),
				
				array("name" 			=> __('Select the Map Styling Switch', 'oxo-core'),
					  "desc" 			=> __('Choose default styling for classic google map styles. Choose theme styling for our custom style. Choose custom styling to make your own with the advanced options below.', 'oxo-core'),
					  "id" 				=> "oxo_mapstyle",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "default",
					  "allowedValues" 	=> array('default' 		=> __('Default Styling', 'oxo-core'),
											   'theme' 			=> __('Theme Styling', 'oxo-core'),
											   'custom' 		=> __('Custom Styling', 'oxo-core'))
					  ),
					  
				array("name" 			=> __('Map Overlay Color', 'oxo-core'),
					  "desc" 			=> __('Custom styling setting only. Pick an overlaying color for the map. Works best with "roadmap" type.', 'oxo-core'),
					  "id" 				=> "oxo_overlaycolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Infobox Styling', 'oxo-core'),
					  "desc" 			=> __('Custom styling setting only. Choose between default or custom info box.', 'oxo-core'),
					  "id" 				=> "oxo_infobox",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "default",
					  "allowedValues" 	=> array('default' 		=> __('Default Infobox', 'oxo-core'),
											   'custom' 		=> __('Custom Infobox', 'oxo-core'))
					  ),
					  
				array("name" 			=> __('Infobox Content', 'oxo-core'),
					  "desc" 			=> __('Custom styling setting only. Type in custom info box content to replace address string. For multiple addresses, separate info box contents by using the | symbol. ex: InfoBox 1|InfoBox 2|InfoBox 3.', 'oxo-core'),
					  "id" 				=> "oxo_infoboxcontent",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Info Box Text Color', 'oxo-core'),
					  "desc" 			=> __('Custom styling setting only. Pick a color for the info box text.', 'oxo-core'),
					  "id" 				=> "oxo_infoboxtextcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Info Box Background Color', 'oxo-core'),
					  "desc" 			=> __('Custom styling setting only. Pick a color for the info box background.', 'oxo-core'),
					  "id" 				=> "oxo_infoboxbackgroundcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Custom Marker Icon', 'oxo-core'),
					  "desc" 			=> __('Custom styling setting only. Use full image urls for custom marker icons or input "theme" for our custom marker. For multiple addresses, separate icons by using the | symbol or use one for all. ex: Icon 1|Icon 2|Icon 3', 'oxo-core'),
					  "id" 				=> "oxo_icon",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> ""
					  ),
					  
			   array("name" 			=> __('Address', 'oxo-core'),
					  "desc" 			=> __('Add your address to the location you wish to show on the map. If the location is off, please try to use long/lat coordinates with latlng=. ex: latlng=12.381068,-1.492711. For multiple addresses, separate addresses by using the | symbol. ex: Address 1|Address 2|Address 3.', 'oxo-core'),
					  "id" 				=> "oxo_content",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('CSS Class', 'oxo-core'),
					  "desc"			=> __('Add a class to the wrapping HTML element.', 'oxo-core'),
					  "id" 				=> "oxo_class",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),

		array("name"	  => __('CSS ID', 'oxo-core'),
					  "desc"	  => __('Add an ID to the wrapping HTML element.', 'oxo-core'),
					  "id"		=> "oxo_id",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => "" 
			),
				
				);
		}
	}