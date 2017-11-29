<?php
/**
 * Class for Pre-Built templates
 *
 * @package   AioneCore
 * @author	OXO Solutions
 * @link	  http://oxosolutions.com
 * @copyright OXO Solutions
 */

if( ! class_exists( 'Oxo_Core_Prebuilt_Templates' ) ) {

	class Oxo_Core_Prebuilt_Templates {

		/**
		 * Instance of this class.
		 *
		 * @since	2.0.0
		 *
		 * @var	  object
		 */
		protected static $instance = null;
		/**
		 * content of templates.
		 *
		 * @since	2.0.0
		 *
		 * @var	  string
		 */
		 
		
		function __construct() {
			//construct
		}

		/**
		 * Return an instance of this class.
		 *
		 * @since	 2.0.0
		 *
		 * @return	object	A single instance of this class.
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;

		}
		/**
		 * Function to get signle page content
		 *
		 * @since	 2.0.0
		 *
		 * @return	String	Page content
		 */
		public function get_single_template() {
			
			//$content = unserialize( base64_decode( self::$content ) );
			$template_id = $_POST['ID'];
			$page 		= stripslashes( file_get_contents(OXO_BUILDER_TEMPLATES_PATH.$template_id) );
			return $page;
		}
		/**
		 * Function to get tab content for pre-built templates
		 *
		 * @since	 2.0.0
		 *
		 * @return	String	String having tab content
		 */
		public function get_prebuilt_templates () {
			
			$columns		= 6; //number of columns
			$content 		= '<div id="pre_built_templates_wrapper"><div id="custom_templates_right" class="custom_pre_built">';
			$templates_directory = OXO_BUILDER_TEMPLATES_PATH;
			$templates = array();
			
			if (is_dir($templates_directory)) :
				if ($handle = opendir($templates_directory)):
					while (false !== ($template_name = readdir($handle))) {
						if ($template_name != "." && $template_name != ".."):
							$templates[$template_name] = ucwords(str_replace('_',' ',str_replace('.txt','',$template_name)));
						endif;
					}
					closedir($handle);
				endif;
			endif;
			
			//if value exists and there are more than 1 number of templates
			if ( $templates && count($templates) > 0 ) {
				//generate column combinations
				$combinations 	= OxoHelper::generate_column_combinations( count($templates), $columns );
				//add data in each column
				for( $i = 0; $i < $columns; $i++) {
					//if no data available for this column then break
					if( $combinations[$i] == 0 ) { break; }
					$counter = 0 ;
					$content.= ' <div class="pre_built_templates_section">';
					foreach( $templates as $key => $value ) {
						$content.= ' <div class="template_selection_wrapper"> ';
						$content.= ' <a class="oxo_pre_built_template templates_selection" data-id="'.$key.'" ';
						$content.= ' href="JavaScript:void(0)">'.$value.'</a>';
						$content.= ' </div>';
						//echo "$entry\n";
						
						//remove current element from array for next iteration
						unset( $templates[$key] );
						$counter++;
						//if reached combination value then break loop
						if ( $counter == $combinations[$i] ) { break; }
					}
					$content.= '</div>';
				}
			}
			$content.=	'</div></div>';
			return $content;
		}
	}
}