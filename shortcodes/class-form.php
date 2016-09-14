<?php
class OxoSC_Form {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_shortcode('form', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		global $smof_data;

		$defaults =	OxoCore_Plugin::set_shortcode_defaults(
			array(
			    'id'       => '',
				'class'			=> '',
				//'id'			=> '',
			), $args
		);

		
     extract( $defaults );

		

		return $html;

	}

	
	
	
	

}

new OxoSC_Form();