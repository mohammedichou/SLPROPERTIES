<?php

if ( ! function_exists( 'fokkner_core_add_tabs_showcase_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function fokkner_core_add_tabs_showcase_shortcode( $shortcodes ) {
		$shortcodes[] = 'FokknerCore_Tabs_Showcase_Shortcode';

		return $shortcodes;
	}

	add_filter( 'fokkner_core_filter_register_shortcodes', 'fokkner_core_add_tabs_showcase_shortcode' );
}

if ( class_exists( 'FokknerCore_Shortcode' ) ) {
	class FokknerCore_Tabs_Showcase_Shortcode extends FokknerCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'fokkner_core_filter_tabs_showcase_layouts', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( FOKKNER_CORE_SHORTCODES_URL_PATH . '/tabs-showcase' );
			$this->set_base( 'fokkner_core_tabs_showcase' );
			$this->set_name( esc_html__( 'Tabs Showcase', 'fokkner-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds tabs showcase holder', 'fokkner-core' ) );
			$this->set_category( esc_html__( 'Fokkner Core', 'fokkner-core' ) );
			$this->set_is_parent_shortcode( true );
			$this->set_child_elements(
				array(
					'fokkner_core_tabs_showcase_child',
				)
			);
			$this->set_scripts(
				array(
					'jquery-ui-tabs' => array(
						'registered' => true,
					),
				)
			);

			$options_map = fokkner_core_get_variations_options_map( $this->get_layouts() );

			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'layout',
					'title'         => esc_html__( 'Layout', 'fokkner-core' ),
					'options'       => $this->get_layouts(),
					'default_value' => $options_map['default_value'],
					'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] ),
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
					'field_type' => 'text',
					'name'       => 'tabs_section_title',
					'title'      => esc_html__( 'Tabs Section Title', 'fokkner-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'tabs_section_title_tag',
					'title'         => esc_html__( 'Tabs Section Title Tag', 'fokkner-core' ),
					'options'       => fokkner_core_get_select_type_options_pool( 'title_tag' ),
					'default_value' => 'h4',
				)
			);
			$this->set_option(
				array(
					'field_type' => 'repeater',
					'name'       => 'children',
					'title'      => esc_html__( 'Image Items', 'fokkner-core' ),
					'items'      => array(
						array(
							'field_type'  => 'image',
							'name'        => 'tab_image',
							'title'       => esc_html__( 'Tab Image', 'fokkner-core' ),
							'description' => esc_html__( 'For each Tabs Showcase Child items add preview image that will be printed on the left of the tab content (e.g. if you have 3 tab items then also add 3 images)', 'fokkner-core' ),
						),
					),
				)
			);
		}

		public function load_assets() {
			wp_enqueue_script( 'jquery-ui-tabs' );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['tabs_showcase_titles'] = $this->get_tabs_showcase_titles( $content );
			$atts['items']                = $this->parse_repeater_items( $atts['children'] );
			$atts['holder_classes']       = $this->get_holder_classes( $atts );
			$atts['orientation']          = 'horizontal'; // only horizontal orientation
			$atts['content']              = $content;
			$atts['content']              = preg_replace( '/\[fokkner_core_tabs_showcase_child/i', '[fokkner_core_tabs_showcase_child layout="' . $atts['layout'] . '"', $content );

			return fokkner_core_get_template_part( 'shortcodes/tabs-showcase', 'variations/' . $atts['layout'] . '/templates/holder', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-tabs-showcase';
			$holder_classes[] = 'clear';
			$holder_classes[] = ! empty( $atts['orientation'] ) ? 'qodef-orientation--' . $atts['orientation'] : '';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';

			// count items to compare
			$tab_items = count( $atts['tabs_showcase_titles'] );
			$img_items = count( $atts['items'] );

			if ( $tab_items === $img_items ) {
				$holder_classes[] = 'qodef-tabs-with-images';
			}

			return implode( ' ', $holder_classes );
		}

		private function get_tabs_showcase_titles( $content ) {
			// Extract tab titles
			preg_match_all( '/tab_title="([^\"]+)"/i', $content, $titles, PREG_OFFSET_CAPTURE );
			$tab_titles = array();

			/**
			 * get tab titles array
			 */
			if ( isset( $titles[0] ) ) {
				$tab_titles = $titles[0];
			}

			$tab_title_array = array();

			foreach ( $tab_titles as $tab ) {
				preg_match( '/tab_title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
				$tab_title_array[] = $tab_matches[1][0];
			}

			return $tab_title_array;
		}
	}
}
