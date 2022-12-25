<?php

if ( ! function_exists( 'fokkner_core_add_property_image_map_gallery_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function fokkner_core_add_property_image_map_gallery_shortcode( $shortcodes ) {
		$shortcodes[] = 'FokknerCore_Property_Image_Map_Gallery_Shortcode';

		return $shortcodes;
	}

	add_filter( 'fokkner_core_filter_register_shortcodes', 'fokkner_core_add_property_image_map_gallery_shortcode' );
}

class FokknerCore_Property_Image_Map_Gallery_Shortcode extends FokknerCore_Shortcode {

	public function __construct() {
		parent::__construct();
	}

	public function map_shortcode() {
		$this->set_shortcode_path( FOKKNER_CORE_PLUGINS_URL_PATH . '/property/post-types/property/shortcodes/property-image-map-gallery' );
		$this->set_base( 'fokkner_core_property_image_map_gallery' );
		$this->set_name( esc_html__( 'Property Image Map Gallery', 'fokkner-core' ) );
		$this->set_description( esc_html__( 'Shortcode that shows property image map gallery', 'fokkner-core' ) );
		$this->set_category( esc_html__( 'Fokkner Core', 'fokkner-core' ) );
		$this->set_is_parent_shortcode( true );
		$this->set_child_elements(
			array(
				'fokkner_core_property_image_map_gallery_child',
			)
		);
		$this->set_scripts(
			array(
				'swiper'         => array(
					'registered' => true,
				),
				'jquery-ui-tabs' => array(
					'registered' => true,
				),
			)
		);
		$this->set_option(
			array(
				'field_type'  => 'text',
				'name'        => 'custom_class',
				'title'       => esc_html__( 'Custom CSS Class', 'fokkner-core' ),
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'fokkner-core' ),
			)
		);
		$this->set_option(
			array(
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Image Map Items', 'fokkner-core' ),
				'items'      => array(
					array(
						'field_type'  => 'image',
						'multiple'    => 'yes',
						'name'        => 'images',
						'title'       => esc_html__( 'Images', 'fokkner-core' ),
						'description' => esc_html__( 'Select images from media library', 'fokkner-core' ),
					),
					array(
						'field_type'    => 'select',
						'name'          => 'image_size',
						'title'         => esc_html__( 'Image Size', 'fokkner-core' ),
						'description'   => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'fokkner-core' ),
						'options'       => fokkner_core_get_select_type_options_pool( 'list_image_dimension', false, array( 'custom' ) ),
						'default_value' => 'full',
					),
					array(
						'field_type' => 'text',
						'name'       => 'video_link',
						'title'      => esc_html__( 'Video Link', 'fokkner-core' ),
					),
					array(
						'field_type'  => 'image',
						'multiple'    => 'no',
						'name'        => 'video_image',
						'title'       => esc_html__( 'Video Image', 'fokkner-core' ),
						'description' => esc_html__( 'Select image from media library', 'fokkner-core' ),
					),
					array(
						'field_type' => 'text',
						'name'       => 'video_link_360',
						'title'      => esc_html__( 'Video Link 360', 'fokkner-core' ),
					),
					array(
						'field_type'  => 'image',
						'multiple'    => 'no',
						'name'        => 'video_image_360',
						'title'       => esc_html__( 'Video Image 360', 'fokkner-core' ),
						'description' => esc_html__( 'Select image from media library', 'fokkner-core' ),
					),
					array(
						'field_type'  => 'select',
						'name'        => 'image_map',
						'options'     => $this->getIMPList(),
						'title'       => esc_html__( 'Image Map Name', 'fokkner-core' ),
						'description' => esc_html__( 'Enter the name of the image map you have created.', 'fokkner-core' ),
					),
				),
			)
		);

		$this->map_extra_options();
	}

	public function load_assets() {
		wp_enqueue_script( 'jquery-ui-tabs' );
	}

	public function render( $options, $content = null ) {
		parent::render( $options );

		$atts = $this->get_atts();

		$atts['tabs_titles']    = $this->get_tabs_titles( $content );
		$atts['items']          = $this->parse_repeater_items( $atts['children'] );
		$atts['holder_classes'] = $this->getHolderClasses( $atts );
		$atts['content']        = $content;
		$atts['content']        = preg_replace( '/\[fokkner_core_property_image_map_gallery_child/i', '[fokkner_core_property_image_map_gallery_child', $content );

		foreach ( $atts['items'] as &$item ) {

			if ( '' !== $item['image_map'] ) {
				$item['image_map_name']           = $this->getIMPName( $item['image_map'] );
				$item['image_map_shortcode']      = $this->getIMPShortcode( $item['image_map'] );
				$item['image_map_shortcode_attr'] = $this->getIMPShortcodeDataAtts( $item['image_map'] );
			}

			$item['images']           = $this->getGalleryImages( $item );
			$item['image_map_object'] = $this->getIMPInstance();

		}

		$atts['params'] = $atts;

		return fokkner_core_get_template_part( 'plugins/property/post-types/property/shortcodes/property-image-map-gallery', 'templates/property-image-map-gallery', '', $atts );
	}

	private function getHolderClasses( $params ) {
		$holder_classes = array(
			'qodef-e',
			'qodef-image-map-gallery',
			'qodef-grid',
			'qodef-layout--template',
			'clear',
		);

		$tab_items = count( $params['tabs_titles'] );
		$img_items = count( $params['items'] );

		if ( $tab_items === $img_items ) {
			$holder_classes[] = 'qodef-image-map-gallery-display';
		}

		$holder_classes[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';

		return implode( ' ', $holder_classes );
	}

	public function getIMPInstance() {
		if ( class_exists( 'ImageMapPro' ) ) {
			$imp_instance = new \ImageMapPro();

			return $imp_instance;
		}

		return false;
	}

	public function getIMPList() {
		$imp_formatted = array();
		$instance      = $this->getIMPInstance();

		if ( $instance ) {
			$options   = get_option( $instance->admin_options_name );
			$imp_items = $options['saves'];

			foreach ( $imp_items as $id => $save ) {
				$imp_formatted[ $id ] = $save['meta']['name'];
			}
		}

		return $imp_formatted;
	}

	private function getGalleryImages( $params ) {
		$image_ids = array();
		$images    = array();
		$i         = 0;

		if ( '' !== $params['images'] ) {
			$image_ids = explode( ',', $params['images'] );
		}

		$counter      = 0;
		$image_shapes = $this->getIMPShapes( $params['image_map'] );

		foreach ( $image_ids as $id ) {

			$image['image_id'] = $id;
			$image_original    = wp_get_attachment_image_src( $id, 'full' );
			$image['url']      = $image_original[0];
			$image['title']    = get_the_title( $id );
			$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );

			if ( ! empty( $image_shapes[ $counter ] ) ) {
				$image['image_shape'] = $image_shapes[ $counter ];
				++ $counter;
			} else {
				$image['image_shape'] = 'empty';
			}

			$images[ $i ] = $image;
			$i ++;
		}

		return $images;
	}

	private function getIMPName( $imp_id ) {
		$name     = '';
		$instance = $this->getIMPInstance();

		if ( $instance ) {
			$imp_instance = $instance;
			$options      = get_option( $imp_instance->admin_options_name );
			$imp_items    = $options['saves'];

			if ( ! empty( $imp_items[ $imp_id ] ) ) {
				$imp_item     = $imp_items[ $imp_id ];
				$name         = $imp_item['meta']['name'];
			} else {
				return false;
			}
		}

		return $name;
	}

	private function getIMPShortcode( $imp_id ) {
		$shortcode = '';
		$instance  = $this->getIMPInstance();

		if ( $instance ) {
			$imp_instance = $instance;
			$options      = get_option( $imp_instance->admin_options_name );
			$imp_items    = $options['saves'];
			if ( ! empty( $imp_items[ $imp_id ] ) ) {
				$imp_item     = $imp_items[ $imp_id ];
				$shortcode    = $imp_item['meta']['shortcode'];
				$shortcode    = '[' . $shortcode . ']';
			} else {
				return false;
			}
		}

		return $shortcode;
	}

	private function getIMPShortcodeDataAtts( $imp_id ) {
		$instance  = $this->getIMPInstance();
		$options   = get_option( $instance->admin_options_name );
		$imp_items = $options['saves'];

		if ( ! empty( $imp_items[ $imp_id ] ) ) {
			$imp_item  = $imp_items[ $imp_id ];
			$imp_item = $instance->sanitize_json_for_save( $imp_item );
		} else {
			return false;
		}

		return $imp_item['json'];
	}

	private function getIMPShapes( $imp_id ) {
		$spots_value = array();
		$instance    = $this->getIMPInstance();

		if ( $instance ) {
			$imp_instance = $instance;
			$options      = get_option( $imp_instance->admin_options_name );
			$imp_items    = $options['saves'];
			//Load item with selected image map id
			if ( ! empty( $imp_items[ $imp_id ] ) ) {
				$imp_item = $imp_items[ $imp_id ];

				//Get selected image map fragments
				$spots = $imp_item['json'];

				//Reformat fragments
				$spots = str_replace( '\n', '<br>', $spots ); // Replace new line characters with <br>
				$spots = str_replace( '\\n', '<br>', $spots ); // Replace new line characters with <br>
				$spots = str_replace( '\\"', '"', $spots ); // Replace \" with "
				$spots = str_replace( '\\"', '"', $spots ); // Replace \" with "
				$spots = str_replace( "\\'", "'", $spots ); // Replace \' with '

				//Decode formatted fragments
				$spots_decoded = json_decode( $spots );

				//Get fragment ids
				$spots_array = $spots_decoded->spots;
				if ( is_array( $spots_array ) && count( $spots_array ) > 1 ) {
					foreach ( $spots_array as $spot ) {
						$spots_value[] = $spot->title;
					}
				} else {
					$spots_value[] = $spots_array->title;
				}
			} else {
				return false;
			}
		}

		return $spots_value;
	}

	private function get_tabs_titles( $content ) {
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
