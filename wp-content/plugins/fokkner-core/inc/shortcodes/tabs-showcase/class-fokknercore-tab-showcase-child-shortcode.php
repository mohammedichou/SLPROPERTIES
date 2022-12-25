<?php

if ( ! function_exists( 'fokkner_core_add_tabs_showcase_child_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function fokkner_core_add_tabs_showcase_child_shortcode( $shortcodes ) {
		$shortcodes[] = 'FokknerCore_Tabs_Showcase_Child_Shortcode';

		return $shortcodes;
	}

	add_filter( 'fokkner_core_filter_register_shortcodes', 'fokkner_core_add_tabs_showcase_child_shortcode' );
}

if ( class_exists( 'FokknerCore_Shortcode' ) ) {
	class FokknerCore_Tabs_Showcase_Child_Shortcode extends FokknerCore_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( FOKKNER_CORE_SHORTCODES_URL_PATH . '/tabs-showcase' );
			$this->set_base( 'fokkner_core_tabs_showcase_child' );
			$this->set_name( esc_html__( 'Tabs Showcase Child', 'fokkner-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds tab child to tabs holder', 'fokkner-core' ) );
			$this->set_category( esc_html__( 'Fokkner Core', 'fokkner-core' ) );
			$this->set_is_child_shortcode( true );
			$this->set_parent_elements(
				array(
					'fokkner_core_tabs_showcase',
				)
			);
			$this->set_is_parent_shortcode( true );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'tab_title',
					'title'      => esc_html__( 'Title', 'fokkner-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'layout',
					'title'         => esc_html__( 'Layout', 'fokkner-core' ),
					'default_value' => '',
					'visibility'    => array( 'map_for_page_builder' => false ),
				)
			);
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['tab_title'] = $atts['tab_title'] . '-' . rand( 0, 1000 );
			$atts['content']   = $content;

			return fokkner_core_get_template_part( 'shortcodes/tabs-showcase', 'variations/' . $atts['layout'] . '/templates/child', '', $atts );
		}
	}
}
