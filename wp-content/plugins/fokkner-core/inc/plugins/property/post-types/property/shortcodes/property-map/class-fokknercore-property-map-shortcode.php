<?php

if ( ! function_exists( 'fokkner_core_add_property_map_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function fokkner_core_add_property_map_shortcode( $shortcodes ) {
		$shortcodes[] = 'FokknerCore_Property_Map_Shortcode';

		return $shortcodes;
	}

	add_filter( 'fokkner_core_filter_register_shortcodes', 'fokkner_core_add_property_map_shortcode' );
}

if ( class_exists( 'FokknerCore_List_Shortcode' ) ) {
	class FokknerCore_Property_Map_Shortcode extends FokknerCore_List_Shortcode {

		public function __construct() {
			$this->set_post_type( 'property-item' );
			$this->set_post_type_taxonomy( 'property-category' );
			$this->set_post_type_additional_taxonomies( array( 'property-tag' ) );
			$this->set_layouts( apply_filters( 'fokkner_core_filter_property_map_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'fokkner_core_filter_property_map_extra_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( FOKKNER_CORE_PLUGINS_URL_PATH . '/property/post-types/property/shortcodes/property-map' );
			$this->set_base( 'fokkner_core_property_map' );
			$this->set_name( esc_html__( 'Property Map', 'fokkner-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays map of properties', 'fokkner-core' ) );
			$this->set_category( esc_html__( 'Fokkner Core', 'fokkner-core' ) );
			$this->set_scripts(
				array(
					'select2'                         => array(
						'registered' => false,
						'url'        => QODE_FRAMEWORK_INC_URL_PATH . '/common/assets/plugins/select2/select2.full.min.js',
						'dependency' => array(),
					),
					'google-map-api'                  => array(
						'registered' => true,
					),
					'nouislider'                      => array(
						'registered' => true,
					),
					'geocomplete'                     => array(
						'registered' => false,
						'url'        => QODE_FRAMEWORK_INC_URL_PATH . '/common/assets/plugins/geocomplete/jquery.geocomplete.min.js',
						'dependency' => array(),
					),
					'fokkner-core-google-map'        => array(
						'registered' => true,
					),
					'fokkner-core-map-custom-marker' => array(
						'registered' => true,
					),
					'markerclusterer'                 => array(
						'registered' => true,
					),
				)
			);

			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'fokkner-core' ),
				)
			);

			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'property_map_height',
					'title'         => esc_html__( 'Map Height (px)', 'fokkner-core' ),
					'description' => esc_html__( 'Enter map height (default is 600px)', 'fokkner-core' ),
					'default_value' => 600,
				)
			);

			$this->map_query_options(
				array(
					'post_type'      => $this->get_post_type(),
					'exclude_option' => array( 'orderby', 'order' ),
				)
			);

			if ( ! empty( $this->get_post_type() ) ) {
				$main_taxonomy = $this->get_post_type_taxonomy();
				$taxonomies    = array_filter( array_merge( array( ! empty( $main_taxonomy ) ? $main_taxonomy : '' ), $this->get_post_type_additional_taxonomies() ) );

				if ( ! empty( $taxonomies ) ) {
					foreach ( $taxonomies as $taxonomy ) {
						$taxonomy_value = str_replace( array( '_', '-' ), array( ' ', ' ' ), $taxonomy );

						$taxonomies_formatted[ $taxonomy ] = ucwords( $taxonomy_value );
					}
				}
			}

			$this->map_additional_options(
				array(
					'exclude_filter'     => true,
					'exclude_pagination' => true,
				)
			);

			$this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'fokkner_core_property_map', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function load_assets() {
			wp_enqueue_script( 'select2' );
			wp_enqueue_script( 'google-map-api' );
			wp_enqueue_script( 'nouislider' );
			wp_enqueue_script( 'geocomplete' );
			wp_enqueue_script( 'fokkner-core-map-custom-marker' );
			wp_enqueue_script( 'markerclusterer' );
			wp_enqueue_script( 'fokkner-core-google-map' );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['post_type']       = $this->get_post_type();
			$atts['taxonomy_filter'] = $this->get_post_type_taxonomy();

			// additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );

			$atts['behavior']       = 'columns';
			$atts['orderby']        = 'date';
			$atts['order']          = 'DESC';
			$atts['query_array']    = fokkner_core_get_query_params( $atts );
			$atts['query_result']   = new \WP_Query( $atts['query_array'] );
			$atts['posts_count']    = $atts['query_result']->post_count;
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['map_styles']     = $this->get_map_styles( $atts );

			$atts['this_shortcode'] = $this;

			return fokkner_core_get_template_part( 'plugins/property/post-types/property/shortcodes/property-map', 'templates/content', $atts['behavior'], $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-property-map';

			return implode( ' ', $holder_classes );
		}

		public function get_item_classes( $atts ) {
			$item_classes = $this->init_item_classes();

			$list_item_classes = $this->get_list_item_classes( $atts );

			$item_classes = array_merge( $item_classes, $list_item_classes );

			return implode( ' ', $item_classes );
		}

		public function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}

			return $styles;
		}

		private function get_map_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['property_map_height'] ) ) {
				if ( qode_framework_string_ends_with_space_units( $atts['property_map_height'] ) ) {
					$styles[] = 'height: ' . $atts['property_map_height'];
				} else {
					$styles[] = 'height: ' . intval( $atts['property_map_height'] ) . 'px';
				}
			}

			return $styles;
		}

		public function additional_query( $args, $atts, $post_type ) {
			$number_of_taxonomies = count( array_merge( array( $this->get_post_type_taxonomy() ), $this->get_post_type_additional_taxonomies() ) );

			if ( ! empty( $atts['additional_params'] ) && 'tax' === $atts['additional_params'] && $number_of_taxonomies > 0 && $post_type === $this->get_post_type() ) {
				$args['tax_query'] = array();

				for ( $i = 1; $i <= $number_of_taxonomies; $i ++ ) {
					$taxonomy_values = array();

					$slug = isset( $atts[ 'tax_slug_' . $i ] ) ? $atts[ 'tax_slug_' . $i ] : '';
					$ids  = isset( $atts[ 'tax__in_' . $i ] ) ? $atts[ 'tax__in_' . $i ] : '';

					if ( ! empty( $ids ) && empty( $slug ) ) {
						$taxonomy_values['field'] = 'term_id';
						$taxonomy_values['terms'] = is_array( $ids ) ? array_map( 'intval', $ids ) : array_map( 'intval', explode( ',', str_replace( ' ', '', $ids ) ) );
					} elseif ( ! empty( $slug ) ) {
						$taxonomy_values['field'] = 'slug';
						$taxonomy_values['terms'] = $slug;
					}

					if ( ! empty( $atts[ 'tax_' . $i ] ) && ! empty( $taxonomy_values ) ) {
						$args['tax_query'][] = array_merge( array( 'taxonomy' => $atts[ 'tax_' . $i ] ), $taxonomy_values );
					}
				}

				if ( count( $args['tax_query'] ) > 1 ) {
					$args['tax_query'] = array_merge( array( 'relation' => 'AND' ), $args['tax_query'] );
				}
			}

			return $args;
		}
	}
}
