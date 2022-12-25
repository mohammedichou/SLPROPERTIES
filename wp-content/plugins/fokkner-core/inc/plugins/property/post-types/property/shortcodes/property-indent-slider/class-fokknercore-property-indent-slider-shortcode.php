<?php

if ( ! function_exists( 'fokkner_core_add_property_indent_slider_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function fokkner_core_add_property_indent_slider_shortcode( $shortcodes ) {
		$shortcodes[] = 'FokknerCore_Property_Indent_Slider_Shortcode';

		return $shortcodes;
	}

	add_filter( 'fokkner_core_filter_register_shortcodes', 'fokkner_core_add_property_indent_slider_shortcode' );
}

class FokknerCore_Property_Indent_Slider_Shortcode extends FokknerCore_List_Shortcode {

	public function __construct() {
		$this->set_post_type( 'property-item' );
		$this->set_post_type_taxonomy( 'property-category' );
		$this->set_post_type_additional_taxonomies( array( 'property-category', 'property-tag' ) );
		$this->set_layouts( apply_filters( 'fokkner_core_filter_property_indent_slider_layouts', array() ) );

		parent::__construct();
	}

	public function map_shortcode() {
		$this->set_shortcode_path( FOKKNER_CORE_PLUGINS_URL_PATH . '/property/post-types/property/shortcodes/property-indent-slider' );
		$this->set_base( 'fokkner_core_property_indent_slider' );
		$this->set_name( esc_html__( 'Property Indent Slider', 'fokkner-core' ) );
		$this->set_description( esc_html__( 'Shortcode that shows list of property items', 'fokkner-core' ) );
		$this->set_category( esc_html__( 'Fokkner Core', 'fokkner-core' ) );
		$this->map_layout_options( array( 'layouts' => $this->get_layouts() ) );
		$this->map_list_options(
			array(
				'exclude_behavior' => array( 'justified-gallery' ),
				'exclude_option'   => array( 'columns' ),
			)
		);
		$this->set_option(
			array(
				'field_type'    => 'select',
				'name'          => 'behavior',
				'title'         => esc_html__( 'List Appearance', 'fokkner-core' ),
				'options'       => array(
					'fixed-indent-slider' => esc_html__( 'Fixed Indent Slider', 'fokkner-core' ),
				),
				'default_value' => 'fixed-indent-slider',
			)
		);
		$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
		$this->map_additional_options(
			array(
				'exclude_filter'     => true,
				'exclude_pagination' => true,
			)
		);
		$this->set_option(
			array(
				'field_type' => 'text',
				'name'       => 'fixed_area_title',
				'title'      => esc_html__( 'Fixed Area Title', 'fokkner-core' ),
				'dependency' => array(
					'show' => array(
						'behavior' => array(
							'values'        => 'fixed-indent-slider',
							'default_value' => '',
						),
					),
				),
				'group'      => esc_html__( 'Fixed Content', 'fokkner-core' ),
			)
		);
		$this->set_option(
			array(
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Property Features', 'fokkner-core' ),
				'dependency' => array(
					'show' => array(
						'behavior' => array(
							'values'        => 'fixed-indent-slider',
							'default_value' => '',
						),
					),
				),
				'group'      => esc_html__( 'Fixed Content', 'fokkner-core' ),
				'items'      => array(
					array(
						'field_type'    => 'text',
						'name'          => 'feature_title',
						'title'         => esc_html__( 'Feature Title', 'fokkner-core' ),
						'default_value' => '',
					),
					array(
						'field_type'    => 'text',
						'name'          => 'feature_text',
						'title'         => esc_html__( 'Feature Text', 'fokkner-core' ),
						'default_value' => '',
					),
				),
			)
		);
		$this->map_extra_options();
	}

	public static function call_shortcode( $params ) {
		$html = qode_framework_call_shortcode( 'fokkner_core_property_indent_slider', $params );
		$html = str_replace( "\n", '', $html );

		return $html;
	}

	public function render( $options, $content = null ) {
		parent::render( $options );

		$atts = $this->get_atts();

		$atts['post_type'] = $this->get_post_type();

		$header_layout_meta = fokkner_core_get_post_value_through_levels( 'qodef_header_layout' );
		if ( 'vertical' === $header_layout_meta ) {
			$columns_1440 = 1.188;
			$columns_1368 = 1.156;
			$columns_1366 = 1.193;
			$columns_1280 = 1.125;
		} else {
			$columns_1440 = 1.338;
			$columns_1368 = 1.282;
			$columns_1366 = 1.279;
			$columns_1280 = 1.255;
		}

		if ( 'fixed-indent-slider' === $atts['behavior'] ) {
			$atts['columns'] = 1.389;
			$atts['columns_responsive'] = 'custom';
			$atts['columns_1440'] = $columns_1440;
			$atts['columns_1368'] = $columns_1368;
			$atts['columns_1366'] = $columns_1366;
			$atts['columns_1280'] = $columns_1280;
			$atts['columns_1024'] = 1;
			$atts['columns_768'] = 1;
			$atts['columns_680'] = 1;
			$atts['columns_480'] = 1;
		}

		// Additional query args
		$atts['additional_query_args'] = $this->get_additional_query_args( $atts );

		$atts['query_array']            = fokkner_core_get_query_params( $atts );
		$atts['holder_classes']         = $this->get_holder_classes( $atts );
		$atts['slider_attr']            = $this->get_slider_data( $atts );
		$atts['item_classes']           = $this->get_item_classes( $atts );
		$atts['holder_wrapper_classes'] = $this->get_holder_wrapper_classes( $atts );
		$atts['features']               = $this->parse_repeater_items( $atts['children'] );
		$atts['query_result']           = new \WP_Query( $atts['query_array'] );
		$atts['posts_count']            = $atts['query_result']->post_count;
		$atts['data_attr']              = fokkner_core_get_pagination_data( FOKKNER_CORE_REL_PATH, 'plugins/property/post-types/property/shortcodes', 'property-indent-slider', 'property-item', $atts );

		$atts['this_shortcode'] = $this;

		return fokkner_core_get_template_part( 'plugins/property/post-types/property/shortcodes/property-indent-slider', 'templates/content', $atts['behavior'], $atts );
	}

	private function get_holder_classes( $atts ) {
		$holder_classes = $this->init_holder_classes();

		$holder_classes[] = 'qodef-property-indent-slider';
		$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';

		$list_classes            = $this->get_list_classes( $atts );
		$hover_animation_classes = $this->get_hover_animation_classes( $atts );
		$holder_classes          = array_merge( $holder_classes, $list_classes, $hover_animation_classes );

		return implode( ' ', $holder_classes );
	}

	public function get_item_classes( $atts ) {
		$item_classes = $this->init_item_classes();

		$list_item_classes = $this->get_list_item_classes( $atts );

		$item_classes = array_merge( $item_classes, $list_item_classes );

		return implode( ' ', $item_classes );
	}

	private function get_holder_wrapper_classes( $atts ) {
		$holder_wrapper_classes[] = 'qodef-property-indent-slider';
		$holder_wrapper_classes[] = ! empty( $atts['behavior'] ) ? 'qodef-behavior--' . $atts['behavior'] : '';

		return implode( ' ', $holder_wrapper_classes );
	}

	public function get_title_styles( $atts ) {
		$styles = array();

		if ( ! empty( $atts['text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $atts['text_transform'];
		}

		return $styles;
	}
}
