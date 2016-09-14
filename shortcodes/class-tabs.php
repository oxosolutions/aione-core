<?php
class OxoSC_Tabs {

	private $tabs_counter = 1;
	private $tab_counter = 1;
	private $tabs = array();
	private $active = false;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'oxo_attr_tabs-shortcode', array( $this, 'attr' ) );
		add_filter( 'oxo_attr_tabs-shortcode-link', array( $this, 'link_attr' ) );
		add_filter( 'oxo_attr_tabs-shortcode-icon', array( $this, 'icon_attr' ) );		
		add_filter( 'oxo_attr_tabs-shortcode-tab', array( $this, 'tab_attr' ) );

		add_shortcode( 'tabs', array( $this, 'render_parent' ) );
		add_shortcode( 'tab', array( $this, 'render_child' ) );

		add_shortcode( 'oxo_tabs', array( $this, 'oxo_tabs' ) );
		add_shortcode( 'oxo_tab', array( $this, 'oxo_tab' ) );

	}

	/**
	 * Render the parent shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render_parent( $args, $content = '') {
		global $smof_data;

		$defaults = OxoCore_Plugin::set_shortcode_defaults(
			array(
				'class' 			=> '',
				'id' 				=> '',
				'backgroundcolor' 	=> $smof_data['tabs_bg_color'],
				'bordercolor'		=> $smof_data['tabs_border_color'],
				'design'			=> 'classic',
				'inactivecolor' 	=> $smof_data['tabs_inactive_color'],
				'justified'			=> 'yes',
				'layout' 			=> 'horizontal',
			), $args
		);	

		extract( $defaults );

		self::$parent_args = $defaults;

		$justified_class = '';
		if( $justified == 'yes' &&
			$layout != 'vertical'
		) {
			$justified_class = ' nav-justified';
		}
		
		$styles = sprintf( '.oxo-tabs.oxo-tabs-%s .nav-tabs li a{border-top-color:%s;background-color:%s;}', $this->tabs_counter, 
						   self::$parent_args['inactivecolor'], self::$parent_args['inactivecolor'] );	
		if( $design != 'clean' ) {
			$styles .= sprintf( '.oxo-tabs.oxo-tabs-%s .nav-tabs{background-color:%s;}', $this->tabs_counter, self::$parent_args['backgroundcolor'] );
			
			$styles .= sprintf( '.oxo-tabs.oxo-tabs-%s .nav-tabs li.active a,.oxo-tabs.oxo-tabs-%s .nav-tabs li.active a:hover,.oxo-tabs.oxo-tabs-%s .nav-tabs li.active a:focus{border-right-color:%s;}', 
							    $this->tabs_counter, $this->tabs_counter, $this->tabs_counter, self::$parent_args['backgroundcolor'] );			
		} else {
			$styles = sprintf( '#wrapper .oxo-tabs.oxo-tabs-%s.clean .nav-tabs li a{border-color:%s;}.oxo-tabs.oxo-tabs-%s .nav-tabs li a{background-color:%s;}', 
							   $this->tabs_counter, self::$parent_args['bordercolor'], $this->tabs_counter, self::$parent_args['inactivecolor'] );
		}
		$styles .= sprintf( '.oxo-tabs.oxo-tabs-%s .nav-tabs li.active a,.oxo-tabs.oxo-tabs-%s .nav-tabs li.active a:hover,.oxo-tabs.oxo-tabs-%s .nav-tabs li.active a:focus{background-color:%s;}', 
							$this->tabs_counter, $this->tabs_counter, $this->tabs_counter, self::$parent_args['backgroundcolor'] );
		$styles .= sprintf( '.oxo-tabs.oxo-tabs-%s .nav-tabs li a:hover{background-color:%s;border-top-color:%s;}', 
				  			$this->tabs_counter, self::$parent_args['backgroundcolor'], self::$parent_args['backgroundcolor'] );		
 		$styles .= sprintf( '.oxo-tabs.oxo-tabs-%s .tab-pane{background-color:%s;}', $this->tabs_counter, self::$parent_args['backgroundcolor'] );
 		$styles .= sprintf( '.oxo-tabs.oxo-tabs-%s .nav,.oxo-tabs.oxo-tabs-%s .nav-tabs,.oxo-tabs.oxo-tabs-%s .tab-content .tab-pane{border-color:%s;}', $this->tabs_counter, $this->tabs_counter, $this->tabs_counter, self::$parent_args['bordercolor'] );
		$styles = sprintf( '<style type="text/css">%s</style>', $styles );
		
		$html = sprintf( '<div %s>%s<div %s><ul %s>', OxoCore_Plugin::attributes( 'tabs-shortcode' ), $styles, OxoCore_Plugin::attributes( 'nav' ), OxoCore_Plugin::attributes( 'nav-tabs'.$justified_class ) );

		$is_first_tab = true;
		
		if( empty( $this->tabs ) ) {
			$this->parse_tab_parameter( $content, 'tab', $args );
		}
		
		if ( strpos( $content, 'oxo_tab' ) ) {
			preg_match_all( '/(\[oxo_tab (.*?)\](.*?)\[\/oxo_tab\])/s', $content, $matches );
		} else {
			preg_match_all( '/(\[tab (.*?)\](.*?)\[\/tab\])/s', $content, $matches );
		}
		
		$tab_content  = '';
		
		for( $i = 0; $i < count( $this->tabs ); $i++ ) {
			$icon = '';
			if(	$this->tabs[$i]['icon'] != 'none' ) {
				$icon =  sprintf( '<i %s></i>', OxoCore_Plugin::attributes( 'tabs-shortcode-icon', array( 'index' => $i ) ) );
			}
			
			if( $is_first_tab ) {
				$tab_nav = sprintf( '<li %s><a %s><h4 %s>%s%s</h4></a></li>', OxoCore_Plugin::attributes( 'active' ), OxoCore_Plugin::attributes( 'tabs-shortcode-link', array( 'index' => $i ) ), 
								  	 OxoCore_Plugin::attributes( 'oxo-tab-heading' ), $icon, $this->tabs[$i]['title'] );
				$is_first_tab = false;
			} else {
				$tab_nav = sprintf( '<li><a %s><h4 %s>%s%s</h4></a></li>', OxoCore_Plugin::attributes( 'tabs-shortcode-link', array( 'index' => $i ) ), 
								  	 OxoCore_Plugin::attributes( 'oxo-tab-heading' ), $icon, $this->tabs[$i]['title'] );
			}
			
			$html .= $tab_nav;

			$tab_content .=  sprintf( '<div %s><ul %s>%s</ul></div>%s', OxoCore_Plugin::attributes( 'nav oxo-mobile-tab-nav' ), OxoCore_Plugin::attributes( 'nav-tabs'.$justified_class ), $tab_nav, do_shortcode($matches[1][$i]) );			
		}
		
		$html .= '';
		$html .= sprintf( '</ul></div><div %s>%s</div></div>', OxoCore_Plugin::attributes( 'tab-content' ), $tab_content );

		$this->tabs_counter++;
		$this->tab_counter = 1;
		$this->active = false;
		unset( $this->tabs );

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'oxo-tabs oxo-tabs-%s %s', $this->tabs_counter, self::$parent_args['design'] );

		if( self::$parent_args['justified'] != 'yes' &&
			self::$parent_args['layout'] != 'vertical'
		) {
			$attr['class'] .= ' nav-not-justified';
		}

		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' .self::$parent_args['class'];
		}

		if( self::$parent_args['layout'] == 'vertical' ) {
			$attr['class'] .= ' vertical-tabs';
		} else {
			$attr['class'] .= ' horizontal-tabs';
		}

		if( self::$parent_args['id'] ) {
			$attr['id'] = self::$parent_args['id'];
		}

		return $attr;

	}	

	function link_attr( $atts ) {

		$attr = array();

		$index = $atts['index'];

		$attr['class'] = 'tab-link';
		$attr['id'] = 'oxo-tab-' . strtolower( preg_replace( '/\s+/', '', $this->tabs[$index]['title'] ) );
		$attr['href'] = '#' . $this->tabs[$index]['unique_id'];
		$attr['data-toggle'] = 'tab';

		return $attr;

	}
	
	function icon_attr( $atts ) {

		$attr = array();
		
		$index = $atts['index'];
	
		$attr['class'] = sprintf( 'fa fontawesome-icon %s', OxoCore_Plugin::font_awesome_name_handler( $this->tabs[$index]['icon'] ) );
	
		return $attr;

	}	

	/**
	 * Render the child shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render_child( $args, $content = '') {

		$defaults = OxoCore_Plugin::set_shortcode_defaults(
			array(
				'icon'			=> 'none',
				'id'			=> '',
				'oxo_tab'	=> 'no'
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;

		$html = sprintf( '<div %s>%s</div>', OxoCore_Plugin::attributes( 'tabs-shortcode-tab' ), do_shortcode( $content ) );

		return $html;

	}

	function tab_attr() {

		$attr = array();

		if( ! isset( $this->active ) ) {
			$this->active = false;
		}

		if( ! $this->active ) {
			$attr['class'] = 'tab-pane fade in active';
			$this->active = true;
		} else {
			$attr['class'] = 'tab-pane fade';
		}
		
		if( self::$child_args['oxo_tab'] == 'yes' ) {
			$attr['id'] = self::$child_args['id'];
		} else {
			$index = self::$child_args['id'] - 1;
			$attr['id'] = $this->tabs[$index]['unique_id'];
		}

		return $attr;

	}

	function oxo_tabs( $atts, $content = null ) {
		global $smof_data;

		$defaults = OxoCore_Plugin::set_shortcode_defaults(
			array(
				'class' 			=> '',
				'id' 				=> '',
				'backgroundcolor' 	=> $smof_data['tabs_bg_color'],
				'bordercolor'		=> $smof_data['tabs_border_color'],
				'design'			=> 'classic',
				'inactivecolor' 	=> $smof_data['tabs_inactive_color'],
				'justified'			=> 'yes',
				'layout' 			=> 'horizontal',
			), $atts
		);

		extract( $defaults );

		$atts = $defaults;

		$content = preg_replace('/tab\][^\[]*/','tab]', $content);
		$content = preg_replace('/^[^\[]*\[/','[', $content);

		$this->parse_tab_parameter( $content, 'oxo_tab' );

		$shortcode_wrapper = '[tabs design="' . $atts['design'] . '" layout="' . $atts['layout'] . '" justified="' . $atts['justified'] . '" backgroundcolor="' . $atts['backgroundcolor'] . '" inactivecolor="' . $atts['inactivecolor'] . '" bordercolor="' . $atts['bordercolor'] .'" class="' . $atts['class'] . '" id="' . $atts['id'] . '"]';
		$shortcode_wrapper .= $content;
		$shortcode_wrapper .= '[/tabs]';

		return do_shortcode($shortcode_wrapper);
	}

	function oxo_tab( $atts, $content = null) {
		$defaults = OxoCore_Plugin::set_shortcode_defaults(
			array(
				'id'	=> '',
				'icon'	=> '',
				'title' => '',
			), $atts
		);

		extract( $defaults );

		$atts = $defaults;	
	
		// create unique tab id for linking
		$sanitized_title = hash("md5", $title, false);
		$sanitized_title = 'tab'. str_replace( '-', '_', $sanitized_title );
		$unique_id = 'tab-' . substr( md5( get_the_ID() . '-' . $this->tabs_counter . '-' . $this->tab_counter . '-' . $sanitized_title), 13 );

		$shortcode_wrapper = sprintf( '[tab id="%s" icon="%s" oxo_tab="yes"]%s[/tab]', $unique_id, $icon, do_shortcode( $content ) );

		$this->tab_counter++;

		return do_shortcode( $shortcode_wrapper );
	}
	
	function parse_tab_parameter( $content, $shortcode, $args = null ) {
		$preg_match_tabs_single = preg_match_all( OxoCore_Plugin::get_shortcode_regex( $shortcode ), $content, $tabs_single );

		if( is_array( $tabs_single[0] ) ) {
			foreach( $tabs_single[0] as $key => $tab ) {
				
				if( is_array( $args ) ) {
					$preg_match_titles = preg_match_all( '/' . $shortcode . ' id=([0-9]+)/i', $tab, $ids );	

					if( array_key_exists( '0', $ids[1] ) ) {
						$id = $ids[1][0];
					} else {
						$title = 'default';
					}				

					foreach ( $args as $key => $value ) {

						if( $key == $shortcode . $id ) {
							
							$title = $value;
						}
					}
				} else {
					$preg_match_titles = preg_match_all( '/' . $shortcode . ' title="([^\"]+)"/i', $tab, $titles );
					if( array_key_exists( '0', $titles[1] ) ) {
						$title = $titles[1][0];
					} else {
						$title = 'default';
					}
				}
			
				$preg_match_icons = preg_match_all( '/' . $shortcode . '( id=[0-9]+| title="[^\"]+")? icon="([^\"]+)"/i', $tab, $icons );
				if( array_key_exists( '0', $icons[2] ) ) {
					$icon = $icons[2][0];
				} else {
					$icon = 'none';
				}
				
				// create unique tab id for linking
				$sanitized_title = hash("md5", $title, false);
				$sanitized_title = 'tab'. str_replace( '-', '_', $sanitized_title );
				$unique_id = 'tab-' . substr( md5( get_the_ID() . '-' . $this->tabs_counter . '-' . $this->tab_counter . '-' . $sanitized_title), 13 );

				// create array for every single tab shortcode
				$this->tabs[] = array( 'title' => $title, 'icon' => $icon, 'unique_id' => $unique_id );
				
				$this->tab_counter++;
			}
			
			$this->tab_counter = 1;
		}
	}

}

new OxoSC_Tabs();