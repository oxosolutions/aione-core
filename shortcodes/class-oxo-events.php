<?php
class OxoSC_OxoEvents {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_shortcode('oxo_events', array( $this, 'render' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		$defaults =	shortcode_atts(
			array(
				'class'			=> '',
				'id'			=> '',
				'cat_slug'		=> '',
				'columns'		=> '4',				
				'number_posts'	=> '4',
				'picture_size'	=> 'cover'
			), $args
		);

		extract( $defaults );

		if( class_exists( 'Tribe__Events__Main' ) ) {

			$html = '';

			$args = array(
				'post_type' => 'tribe_events',
				'posts_per_page' => $number_posts,
			);

			if ( $cat_slug ) {
				$terms = explode( ',', $cat_slug );
				$args['tax_query'] = array(
					array(
						'taxonomy' 	=> 'tribe_events_cat',
						'field'    	=> 'slug',
						'terms'		=> array_map( 'trim', $terms ),
					),
				);
			}

			switch ( $columns ) {
				case '1':
					$column_class = 'full-one';
				break;
				case '2':
					$column_class = 'one-half';
				break;
				case '3':
					$column_class = 'one-third';
				break;
				case '4':
					$column_class = 'one-fourth';
				break;
				case '5':
					$column_class = 'one-fifth';
				break;
				case '6':
					$column_class = 'one-sixth';
				break;
			}

			$events = new WP_Query( $args );

			if ( $events->have_posts() ) {
				if( $id ) {
					$id = ' id="'  . $id . '"';
				}
				$html .= '<div class="oxo-events-shortcode ' . $class .'"' . $id . '>';
					$i = 1;
					$last = false;
					$columns = (int) $columns;

					while ( $events->have_posts() ) {
						$events->the_post();

						if ( $i == $columns ) {
							$last = true;
						}

						if ( $i > $columns ) {
							$i = 1;
							$last = false;
						}

						if( $columns == 1 ) {
							$last = true;
						}

						$html .= '<div class="oxo-' . $column_class . ' oxo-spacing-yes oxo-layout-column ' . ( ( $last ) ? 'oxo-column-last' : '' ) .'">';
							$html .= '<div class="oxo-column-wrapper">';
								$thumb_id = get_post_thumbnail_id();
								$thumb_link = wp_get_attachment_image_src( $thumb_id, 'full', true );
								$thumb_url = '';
								
								if ( has_post_thumbnail( get_the_ID() ) ) {
									$thumb_url = $thumb_link[0];
								} elseif ( class_exists( 'Tribe__Events__Pro__Main' ) ) {
									$thumb_url = esc_url( trailingslashit( Tribe__Events__Pro__Main::instance()->pluginUrl ) . 'src/resources/images/tribe-related-events-placeholder.png' );
								}							
								
								$img_class = ( has_post_thumbnail( get_the_ID() ) ) ? '' : 'oxo-events-placeholder';
								
								if ( $thumb_url ) {
									$thumb_img = '<img class="' . $img_class . '" src="' . $thumb_url . '" alt="' . esc_attr( get_the_title( get_the_ID() ) ) . '" />';
									$thumb_bg = '<span class="tribe-events-event-image" style="background-image: url(' . $thumb_url . '); -webkit-background-size: cover; background-size: cover; background-position: center center;"></span>';
								}
								$html .= '<div class="oxo-events-thumbnail hover-type-' . Aione()->settings->get( 'ec_hover_type' ) . '">';
									$html .='<a href="' . get_the_permalink() . '" class="url" rel="bookmark">';
									
									if ( $thumb_url ) {
										if ( $picture_size == 'auto' ) {
											$html .= $thumb_img;
										} else {
											$html .= $thumb_bg;
										}
									} else {
										ob_start();
										/**
										 * aione_placeholder_image hook
										 *
										 * @hooked aione_render_placeholder_image - 10 (outputs the HTML for the placeholder image)
										 */
										do_action( 'aione_placeholder_image', 'fixed' );

										$placeholder = ob_get_clean();
										$html .= str_replace( 'oxo-placeholder-image', ' oxo-placeholder-image tribe-events-event-image', $placeholder );
									}
									
									$html .= '</a>';
								$html .= '</div>';
								$html .= '<div class="oxo-events-meta">';
									$html .= '<h2><a href="' . get_the_permalink() . '" class="url" rel="bookmark">' . get_the_title() . '</a></h2>';
									$html .= '<h4>' . tribe_events_event_schedule_details() . '</h4>';
								$html .= '</div>';
							$html .= '</div>';
						$html .= '</div>';
						if( $last ) {
							$html .= '<div class="oxo-clearfix"></div>';
						}
						$i++;
					}
					wp_reset_query();
					$html .= '<div class="oxo-clearfix"></div>';
				$html .= '</div>';
			}
			
			return $html;
			
		}
	}

}

new OxoSC_OxoEvents();