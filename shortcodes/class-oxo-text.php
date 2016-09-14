<?php
class OxoSC_OxoText {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_shortcode('text', array( $this, 'render' ) );

		add_filter( 'oxo_text_content', 'shortcode_unautop' );
		add_filter( 'oxo_text_content', 'do_shortcode' );
	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		return apply_filters( 'oxo_text_content', wpautop( $content, false ) );
	}

}

new OxoSC_OxoText();