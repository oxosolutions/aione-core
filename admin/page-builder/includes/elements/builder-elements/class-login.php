<?php
/**
 * Login implementation, it extends DDElementTemplate like all other elements
 */
	class TF_Login extends DDElementTemplate {
		
		public function __construct() {
			 
			parent::__construct();
		}

		// Implementation for the element structure.
		public function create_element_structure() {
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 	= get_class( $this );
			// element id
			$this->config['id']	   		= 'user_login';
			// element name
			$this->config['name']	 	= __('User Login', 'oxo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "oxo_element_box";
			// element icon class
			$this->config['icon_class']		= 'oxo-icon builder-options-icon dashicons dashicons-lock';
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 		= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {

			$innerHtml  = '<div class="oxo_iconbox textblock_element textblock_element_style" id="oxo_countdown">';
			$innerHtml .= '<div class="builder_icon_container"><span class="oxo_iconbox_icon"><i class="dashicons dashicons-lock"></i><sub class="sub">'. $this->config['name'] .'</sub>';
			$innerHtml .= '<div class="oxo-login-box oxo_login" style="display:none;">' . __( 'Login Element' ) . '</div>';
			$innerHtml .= '<div class="oxo-login-box oxo_register" style="display:none;">' . __( 'Register Element' ) . '</div>';
			$innerHtml .= '<div class="oxo-login-box oxo_lost_password" style="display:none;">' . __( 'Lost Password Element' ) . '</div>';
			$innerHtml .= '</span></div></div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {

			$choices_with_default = OxoHelper::get_shortcode_choices_with_default();
			
			$this->config['subElements'] = array(
			
				array(
						"name" 			=> __('Login Elements', 'oxo-core'),
						"desc" 			=> __('Choose the login element you want to use.', 'oxo-core'),
						"id" 			=> "oxo_login_type",
						"type"          => ElementTypeEnum::SELECT,
						"value"         => "oxo1_login",
						"allowedValues" => array(
							'oxo_oxo_login' 			=> __( 'Login Element', 'oxo-core' ),
							'oxo_oxo_register' 		=> __( 'Register Element', 'oxo-core' ),
							'oxo_oxo_lost_password' 	=> __( 'Lost Password Element', 'oxo-core' )
						)
				),
				
				array("name" 			=> __('Text Align', 'oxo-core'),
					  "desc" 			=> __('Choose the alignment of all content parts. "Text Flow" follows the default text align of the site. "Center" will center all elements.', 'oxo-core'),
					  "id" 				=> "oxo_textflow",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value"         	=> "oxo_login",
					  "allowedValues" 	=> array(
					  							''				=> __( 'Default', 'oxo-core' ),
					  							'textflow'		=> __( 'Text Flow', 'oxo-core' ),
					  							'center' 		=> __( 'Center', 'oxo-core' )
											) 
				),			
				
				array("name" 			=> __('Heading', 'oxo-core'),
					  "desc"			=> __('Choose a heading text.', 'oxo-core'),
					  "id" 				=> "oxo_heading_text",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
				),
					  
				array("name" 			=> __('Caption', 'oxo-core'),
					  "desc"			=> __('Choose a caption text.', 'oxo-core'),
					  "id" 				=> "oxo_caption_text",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
				),				  
				
				array("name" 			=> __('Button Span', 'oxo-core'),
					  "desc" 			=> __('Choose to have the button span the full width.', 'oxo-core'),
					  "id" 				=> "oxo_button_span",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "default",
					  "allowedValues" 	=> $choices_with_default
				),
				
				array("name" 			=> __('Form Backgound Color', 'oxo-core'),
					  "desc" 			=> __('Choose a background color for the form wrapping box.', 'oxo-core'),
					  "id" 				=> "oxo_background_color",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
				),					
					 
				array("name" 			=> __('Heading Color', 'oxo-core'),
					  "desc" 			=> __('Choose a heading color. Leave empty for Theme Option default.', 'oxo-core'),
					  "id" 				=> "oxo_heading_color",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
				),
					
				array("name" 			=> __('Caption Color', 'oxo-core'),
					  "desc" 			=> __('Choose a caption color. Leave empty for Theme Option default.', 'oxo-core'),
					  "id" 				=> "oxo_caption_color",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
				),
				
				array("name" 			=> __('Link Color', 'oxo-core'),
					  "desc" 			=> __('Choose a link color. Leave empty for Theme Option default.', 'oxo-core'),
					  "id" 				=> "oxo_link_color",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
				),
					
				array("name" 			=> __('Redirection Link', 'oxo-core'),
					  "desc" 			=> __('Add the url to which a user should redirected after form submission. Leave empty to use the same page.', 'oxo-core'),
					  "id" 				=> "oxo_redirection",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
				),
					  
				array("name" 			=> __('Register Link', 'oxo-core'),
					  "desc" 			=> __('Add the url the "Register" link should open.', 'oxo-core'),
					  "id" 				=> "oxo_register",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
				),		
					  
				array("name" 			=> __('Lost Password Link', 'oxo-core'),
					  "desc" 			=> __('Add the url the "Lost Password" link should open.', 'oxo-core'),
					  "id" 				=> "oxo_lost_password",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
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
				)
				
			);
		}
	}
