<?php

	class OxoSC_WooProductSlider {

		public static $args;

		/**
		 * Initiate the shortcode
		 */
		public function __construct() {

			add_filter( 'oxo_attr_woo-product-slider-shortcode', array( $this, 'attr' ) );
			add_filter( 'oxo_attr_woo-product-slider-shortcode-carousel', array( $this, 'carousel_attr' ) );
			add_filter( 'oxo_attr_woo-product-slider-shortcode-img-div', array( $this, 'img_div_attr' ) );

			add_shortcode( 'products_slider', array( $this, 'render' ) );

		}

		/**
		 * Render the shortcode
		 *
		 * @param  array  $args    Shortcode paramters
		 * @param  string $content Content between shortcode
		 *
		 * @return string          HTML output
		 */
		function render( $args, $content = '' ) {
			global $woocommerce, $smof_data;

			$defaults = OxoCore_Plugin::set_shortcode_defaults(
				array(
					'class'           	=> '',
					'id'              	=> '',
					'autoplay'        	=> 'no',
					'carousel_layout' 	=> 'title_on_rollover',
					'cat_slug'        	=> '',
					'columns'         	=> '5',
					'column_spacing'  	=> '13',
					'mouse_scroll'    	=> 'no',
					'number_posts'    	=> 10,
					'picture_size'    	=> 'fixed',
					'scroll_items'		=> '',
					'show_buttons'   	=> 'yes',
					'show_cats'       	=> 'yes',
					'show_nav'        	=> 'yes',
					'show_price'      	=> 'yes',
				), $args
			);

			( $defaults['show_cats'] == "yes" ) ? ( $defaults['show_cats'] = 'enable' ) : ( $defaults['show_cats'] = 'disable' );
			( $defaults['show_price'] == "yes" ) ? ( $defaults['show_price'] = true ) : ( $defaults['show_price'] = false );
			( $defaults['show_buttons'] == "yes" ) ? ( $defaults['show_buttons'] = true ) : ( $defaults['show_buttons'] = false );

			extract( $defaults );

			self::$args = $defaults;

			$html    = '';
			$buttons = '';

			if ( class_exists( 'Woocommerce' ) ) {

				$items_in_cart = array();

				if ( $woocommerce->cart && $woocommerce->cart->get_cart() && is_array( $woocommerce->cart->get_cart() ) ) {
					foreach ( $woocommerce->cart->get_cart() as $cart ) {
						$items_in_cart[] = $cart['product_id'];
					}
				}

				$design_class = 'oxo-' . Aione()->settings->get( 'woocommerce_product_box_design' ) . '-product-image-wrapper';

				$number_posts = (int) $number_posts;

				$args = array(
					'post_type'      => 'product',
					'posts_per_page' => $number_posts,
					'meta_query'     => array(
						array(
							'key'     => '_thumbnail_id',
							'compare' => '!=',
							'value'   => null
						)
					)
				);

				if ( $cat_slug ) {
					$cat_id            = explode( '|', $cat_slug );
					$args['tax_query'] =
						array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    => $cat_id
							)
						);
				}

				if ( $picture_size == 'fixed' ) {
					$featured_image_size = 'related-img';
				} else {
					$featured_image_size = 'full';
				}

				$products         = new WP_Query( $args );
				$product_list = '';

				if ( $products->have_posts() ) {

					while ( $products->have_posts() ) {
						$products->the_post();

						$id      = get_the_ID();
						$in_cart = in_array( $id, $items_in_cart );
						$image = $price_tag = $terms = '';

						// Title on rollover layout
						if ( $carousel_layout == 'title_on_rollover' ) {
							$image = aione_render_first_featured_image_markup( get_the_ID(), $featured_image_size, get_permalink( get_the_ID() ), TRUE, $show_price, $show_buttons, $show_cats );
							// Title below image layout
						} else {
							if ( $show_buttons == 'yes' ) {
								$image = aione_render_first_featured_image_markup( get_the_ID(), $featured_image_size, get_permalink( get_the_ID() ), TRUE, FALSE, $show_buttons, 'disable', 'disable' );
							} else {
								$image = aione_render_first_featured_image_markup( get_the_ID(), $featured_image_size, get_permalink( get_the_ID() ), TRUE, FALSE, $show_buttons, 'disable', 'disable', '', '', 'no' );
							}

							// Get the post title
							$image .= sprintf( '<h4 %s><a href="%s" target="%s">%s</a></h4>', OxoCore_Plugin::attributes( 'oxo-carousel-title' ), get_permalink( get_the_ID() ), '_self', get_the_title() );

							$image .= '<div class="oxo-carousel-meta">';

							// Get the terms
							if ( $show_cats == 'enable' ) {
								$image .= get_the_term_list( get_the_ID(), 'product_cat', '', ', ', '' );
							}

							// Check if we should render the woo product price
							if ( $show_price ) {
								ob_start();
								woocommerce_get_template( 'loop/price.php' );
								$image .= sprintf( '<div class="oxo-carousel-price">%s</div>', ob_get_clean() );
							}

							$image .= '</div>';
						}

						if( $in_cart ) {
							$product_list .= sprintf( '<li %s><div class="%s"><div %s>%s</div></div></li>', OxoCore_Plugin::attributes( 'oxo-carousel-item' ), $design_class . ' oxo-item-in-cart', OxoCore_Plugin::attributes( 'oxo-carousel-item-wrapper' ), $image );
						} else {
							$product_list .= sprintf( '<li %s><div class="%s"><div %s>%s</div></div></li>', OxoCore_Plugin::attributes( 'oxo-carousel-item' ), $design_class, OxoCore_Plugin::attributes( 'oxo-carousel-item-wrapper' ), $image );
						}
					}
				}
				wp_reset_query();

				$html = sprintf( '<div %s>', OxoCore_Plugin::attributes( 'woo-product-slider-shortcode' ) );
				$html .= sprintf( '<div %s>', OxoCore_Plugin::attributes( 'woo-product-slider-shortcode-carousel' ) );
				$html .= sprintf( '<div %s>', OxoCore_Plugin::attributes( 'oxo-carousel-positioner' ) );
				$html .= sprintf( '<ul %s>', OxoCore_Plugin::attributes( 'oxo-carousel-holder' ) );
				$html .= $product_list;
				$html .= '</ul>';
				// Check if navigation should be shown
				if ( $show_nav == 'yes' ) {
					$html .= sprintf( '<div %s><span %s></span><span %s></span></div>', OxoCore_Plugin::attributes( 'oxo-carousel-nav' ),
						OxoCore_Plugin::attributes( 'oxo-nav-prev' ), OxoCore_Plugin::attributes( 'oxo-nav-next' ) );
				}
				$html .= '</div>';
				$html .= '</div>';
				$html .= '</div>';
			}

			return $html;

		}

		function attr() {
			$attr['class'] = 'oxo-woo-product-slider oxo-woo-slider';

			if ( self::$args['class'] ) {
				$attr['class'] .= ' ' . self::$args['class'];
			}

			if ( self::$args['id'] ) {
				$attr['id'] = self::$args['id'];
			}

			return $attr;

		}

		function carousel_attr() {

			$attr['class'] = 'oxo-carousel';

			if ( self::$args['carousel_layout'] == 'title_below_image' ) {
				$attr['class'] .= ' oxo-carousel-title-below-image';

				$attr['data-metacontent'] = 'yes';
			} else {
				$attr['class'] .= ' oxo-carousel-title-on-rollover';
			}

			$attr['data-autoplay']    = self::$args['autoplay'];
			$attr['data-columns']     = self::$args['columns'];
			$attr['data-itemmargin']  = self::$args['column_spacing'];
			$attr['data-itemwidth']   = 180;
			$attr['data-touchscroll'] = self::$args['mouse_scroll'];
			$attr['data-imagesize']   = self::$args['picture_size'];
			$attr['data-scrollitems'] = self::$args['scroll_items'];

			return $attr;
		}
	}

	new OxoSC_WooProductSlider();