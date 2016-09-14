<?php
class OxoSC_Countdown {

	public static $args;
	
	private $countdown_counter = 1;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'oxo_attr_countdown-shortcode', array( $this, 'attr' ) );
		add_filter( 'oxo_attr_countdown-shortcode-counter-wrapper', array( $this, 'counter_wrapper_attr' ) );
		add_filter( 'oxo_attr_countdown-shortcode-link', array( $this, 'link_attr' ) );
		
		add_shortcode( 'oxo_countdown', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 *
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 *
	 * @return string		  HTML output
	 */
	public function render( $args, $content = '' ) {

		$defaults = OxoCore_Plugin::set_shortcode_defaults(
			array(
				'class'			   		=> '',
				'id'				 	=> '',
				'background_color'		=> Aione()->settings->get( 'countdown_background_color' ),
				'background_image'		=> Aione()->settings->get( 'countdown_background_image' ),
				'background_position' 	=> Aione()->settings->get( 'countdown_background_position' ),				
				'background_repeat' 	=> Aione()->settings->get( 'countdown_background_repeat' ),				
				'border_radius'			=> Aione()->settings->get( 'countdown_border_radius' ),
				'counter_box_color'		=> Aione()->settings->get( 'countdown_counter_box_color' ),
				'counter_text_color'	=> Aione()->settings->get( 'countdown_counter_text_color' ),
				'countdown_end'			=> '2000-01-01 00:00:00',
				'dash_titles'			=> 'short',
				'heading_text'			=> '',
				'heading_text_color'	=> Aione()->settings->get( 'countdown_heading_text_color' ),
				'link_text'				=> '',
				'link_text_color'		=> Aione()->settings->get( 'countdown_link_text_color' ),
				'link_target'			=> Aione()->settings->get( 'countdown_link_target' ),
				'link_url'				=> '',
				'show_weeks'			=> Aione()->settings->get( 'countdown_show_weeks' ),
				'subheading_text'		=> '',
				'subheading_text_color'	=> Aione()->settings->get( 'countdown_subheading_text_color' ),
				'timezone'				=> Aione()->settings->get( 'countdown_timezone' ),
			), $args
		);
		
		extract( $defaults );

		self::$args = $defaults;

		$html = sprintf( '<div %s>', OxoCore_Plugin::attributes( 'countdown-shortcode' ) );
			$html .= self::get_styles();
			$html .= sprintf( '<div %s>', OxoCore_Plugin::attributes( 'oxo-countdown-heading-wrapper' ) );
				$html .= sprintf( '<div %s>%s</div>', OxoCore_Plugin::attributes( 'oxo-countdown-subheading' ), $subheading_text );
				$html .= sprintf( '<div %s>%s</div>', OxoCore_Plugin::attributes( 'oxo-countdown-heading' ), $heading_text );		
			$html .= '</div>';
			
			$html .= sprintf( '<div %s>', OxoCore_Plugin::attributes( 'countdown-shortcode-counter-wrapper' ) );
			
				$dashes = array (
					array( 'show' => $show_weeks, 'class' => 'weeks', 'shortname' => __( 'Weeks', 'oxo-core' ), 'longname' => __( 'Weeks', 'oxo-core' ) ),
					array( 'show' => 'yes', 'class' => 'days', 'shortname' => __( 'Days', 'oxo-core' ), 'longname' => __( 'Days', 'oxo-core' ) ),
					array( 'show' => 'yes', 'class' => 'hours', 'shortname' => __( 'Hrs', 'oxo-core' ), 'longname' => __( 'Hours', 'oxo-core' ) ),
					array( 'show' => 'yes', 'class' => 'minutes', 'shortname' => __( 'Min', 'oxo-core' ), 'longname' => __( 'Minutes', 'oxo-core' ) ),
					array( 'show' => 'yes', 'class' => 'seconds', 'shortname' => __( 'Sec', 'oxo-core' ), 'longname' => __( 'Seconds', 'oxo-core' ) )
				);
				
				$dash_class = '';
				if ( ! self::$args['counter_box_color'] || self::$args['counter_box_color'] == 'transparent' ) {
					$dash_class = ' oxo-no-bg';
				}				
								
				for ( $i = 0; $i < count( $dashes ); $i++ ) {
					if ( $dashes[$i]['show'] == 'yes' ) {
						$html .= sprintf( '<div class="oxo-dash-wrapper %s"><div class="oxo-dash oxo-dash-%s">%s<div class="oxo-digit">0</div><div class="oxo-digit">0</div><div class="oxo-dash-title">%s</div></div></div>', $dash_class, $dashes[$i]['class'], ( $dashes[$i]['class'] == 'days' ) ? '<div class="oxo-first-digit oxo-digit">0</div>' : '', $dashes[$i][$dash_titles . 'name'] );
					}
				}
			
			$html .= '</div>';
			
			$html .= sprintf( '<div %s>', OxoCore_Plugin::attributes( 'oxo-countdown-link-wrapper' ) );
				$html .= sprintf( '<a %s>%s</a>', OxoCore_Plugin::attributes( 'countdown-shortcode-link' ), $link_text );
			$html .= '</div>';
			
			
			$html .= do_shortcode( $content );
		$html .= '</div>';

		$this->countdown_counter++;

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'oxo-countdown oxo-countdown-%s', $this->countdown_counter );
		
		if ( ! self::$args['background_image'] && 
			 ( ! self::$args['background_color'] || self::$args['background_color'] == 'transparent' ) 
		) {
			$attr['class'] .= ' oxo-no-bg';
		}		
		
		if ( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

		if ( self::$args['id'] ) {
			$attr['id'] = self::$args['id'];
		}

		return $attr;
	}
	
	function counter_wrapper_attr() {

		$attr = array();

		$attr['class'] = 'oxo-countdown-counter-wrapper';
		
		$attr['id'] = sprintf( 'oxo-countdown-%s', $this->countdown_counter );	
		
		if ( self::$args['timezone'] == 'site_time' ) {
			$attr['data-gmt-offset'] = get_option( 'gmt_offset' );
		}
		
		if ( self::$args['countdown_end'] ) {
			$attr['data-timer'] = date( 'Y-m-d-H-i-s', strtotime( self::$args['countdown_end'] ) );
		}

		if ( self::$args['show_weeks'] == 'yes' ) {
			$attr['data-omit-weeks'] = '0';
		} else {
			$attr['data-omit-weeks'] = '1';
		}

		return $attr;
	}
	
	function link_attr() {

		$attr = array();

		$attr['class'] = 'oxo-countdown-link';
		
		$attr['target'] = self::$args['link_target'];
		$attr['href'] = self::$args['link_url'];

		return $attr;
	}	
	
	function get_styles() {
		$styles = '';
		
		// Set custom background styles
		if ( self::$args['background_image'] ) {
			$styles .= sprintf( '.oxo-countdown-%s {', $this->countdown_counter );
			$styles .= sprintf( 'background:url(%s) %s %s %s;', self::$args['background_image'], self::$args['background_position'], self::$args['background_repeat'], self::$args['background_color']  );
			
			if ( self::$args['background_repeat'] == 'no-repeat') {
				$styles .= '-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;';
			}	
			$styles .= '}';

		} elseif ( self::$args['background_color'] ) {
			$styles .= sprintf( '.oxo-countdown-%s {background-color:%s;}', $this->countdown_counter, self::$args['background_color'] );
		}
		
		if ( self::$args['border_radius'] ) {
			$styles .= sprintf( '.oxo-countdown-%s, .oxo-countdown-%s .oxo-dash {border-radius:%s;}', $this->countdown_counter, $this->countdown_counter, self::$args['border_radius'] );
		}		
		
		if ( self::$args['heading_text_color'] ) {
			$styles .= sprintf( '.oxo-countdown-%s .oxo-countdown-heading {color:%s;}', $this->countdown_counter, self::$args['heading_text_color'] );
		}
		
		if ( self::$args['subheading_text_color'] ) {
			$styles .= sprintf( '.oxo-countdown-%s .oxo-countdown-subheading {color:%s;}', $this->countdown_counter, self::$args['subheading_text_color'] );
		}		
		
		if ( self::$args['counter_text_color'] ) {
			$styles .= sprintf( '.oxo-countdown-%s .oxo-countdown-counter-wrapper {color:%s;}', $this->countdown_counter, self::$args['counter_text_color'] );
		}
		
		if ( self::$args['counter_box_color'] ) {			
			$styles .= sprintf( '.oxo-countdown-%s .oxo-dash {background-color:%s;}', $this->countdown_counter, self::$args['counter_box_color'] );
		}
		
		if ( self::$args['link_text_color'] ) {
			$styles .= sprintf( '.oxo-countdown-%s .oxo-countdown-link {color:%s;}', $this->countdown_counter, self::$args['link_text_color'] );
		}		

		if ( $styles ) {
			$styles = sprintf( '<style type="text/css" scoped="scoped">%s</style>', $styles );	
		}
		
		return $styles;
	}
}

new OxoSC_Countdown();
