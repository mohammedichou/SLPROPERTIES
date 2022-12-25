<?php

if ( ! function_exists( 'fokkner_is_installed' ) ) {
	/**
	 * Function that checks if forward plugin installed
	 *
	 * @param string $plugin - plugin name
	 *
	 * @return bool
	 */
	function fokkner_is_installed( $plugin ) {

		switch ( $plugin ) {
			case 'framework':
				return class_exists( 'QodeFramework' );
				break;
			case 'core':
				return class_exists( 'FokknerCore' );
				break;
			case 'woocommerce':
				return class_exists( 'WooCommerce' );
				break;
			case 'gutenberg-page':
				$current_screen = function_exists( 'get_current_screen' ) ? get_current_screen() : array();

				return method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor();
				break;
			case 'gutenberg-editor':
				return class_exists( 'WP_Block_Type' );
				break;
			default:
				return false;
		}
	}
}

if ( ! function_exists( 'fokkner_include_theme_is_installed' ) ) {
	/**
	 * Function that set case is installed element for framework functionality
	 *
	 * @param bool $installed
	 * @param string $plugin - plugin name
	 *
	 * @return bool
	 */
	function fokkner_include_theme_is_installed( $installed, $plugin ) {

		if ( 'theme' === $plugin ) {
			return class_exists( 'Fokkner_Handler' );
		}

		return $installed;
	}

	add_filter( 'qode_framework_filter_is_plugin_installed', 'fokkner_include_theme_is_installed', 10, 2 );
}

if ( ! function_exists( 'fokkner_template_part' ) ) {
	/**
	 * Function that echo module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 */
	function fokkner_template_part( $module, $template, $slug = '', $params = array() ) {
		echo fokkner_get_template_part( $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'fokkner_get_template_part' ) ) {
	/**
	 * Function that load module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return string - string containing html of template
	 */
	function fokkner_get_template_part( $module, $template, $slug = '', $params = array() ) {
		//HTML Content from template
		$html          = '';
		$template_path = FOKKNER_INC_ROOT_DIR . '/' . $module;

		$temp = $template_path . '/' . $template;
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params ); // @codingStandardsIgnoreLine
		}

		$template = '';

		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";

				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}

		if ( $template ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}

		return $html;
	}
}

if ( ! function_exists( 'fokkner_get_page_id' ) ) {
	/**
	 * Function that returns current page id
	 * Additional conditional is to check if current page is any wp archive page (archive, category, tag, date etc.) and returns -1
	 *
	 * @return int
	 */
	function fokkner_get_page_id() {
		$page_id = get_queried_object_id();

		if ( fokkner_is_wp_template() ) {
			$page_id = - 1;
		}

		return apply_filters( 'fokkner_filter_page_id', $page_id );
	}
}

if ( ! function_exists( 'fokkner_is_wp_template' ) ) {
	/**
	 * Function that checks if current page default wp page
	 *
	 * @return bool
	 */
	function fokkner_is_wp_template() {
		return is_archive() || is_search() || is_404() || ( is_front_page() && is_home() );
	}
}

if ( ! function_exists( 'fokkner_get_ajax_status' ) ) {
	/**
	 * Function that return status from ajax functions
	 *
	 * @param string $status - success or error
	 * @param string $message - ajax message value
	 * @param string|array $data - returned value
	 * @param string $redirect - url address
	 */
	function fokkner_get_ajax_status( $status, $message, $data = null, $redirect = '' ) {
		$response = array(
			'status'   => esc_attr( $status ),
			'message'  => esc_html( $message ),
			'data'     => $data,
			'redirect' => ! empty( $redirect ) ? esc_url( $redirect ) : '',
		);

		$output = json_encode( $response );

		exit( $output );
	}
}

if ( ! function_exists( 'fokkner_get_button_element' ) ) {
	/**
	 * Function that returns button with provided params
	 *
	 * @param array $params - array of parameters
	 *
	 * @return string - string representing button html
	 */
	function fokkner_get_button_element( $params ) {
		if ( class_exists( 'FokknerCore_Button_Shortcode' ) ) {
			return FokknerCore_Button_Shortcode::call_shortcode( $params );
		} else {
			$link   = isset( $params['link'] ) ? $params['link'] : '#';
			$target = isset( $params['target'] ) ? $params['target'] : '_self';
			$text   = isset( $params['text'] ) ? $params['text'] : '';

			return '<a itemprop="url" class="qodef-theme-button" href="' . esc_url( $link ) . '" target="' . esc_attr( $target ) . '">' . esc_html( $text ) . '</a>';
		}
	}
}

if ( ! function_exists( 'fokkner_render_button_element' ) ) {
	/**
	 * Function that render button with provided params
	 *
	 * @param array $params - array of parameters
	 */
	function fokkner_render_button_element( $params ) {
		echo fokkner_get_button_element( $params );
	}
}

if ( ! function_exists( 'fokkner_class_attribute' ) ) {
	/**
	 * Function that render class attribute
	 *
	 * @param string|array $class
	 */
	function fokkner_class_attribute( $class ) {
		echo fokkner_get_class_attribute( $class );
	}
}

if ( ! function_exists( 'fokkner_get_class_attribute' ) ) {
	/**
	 * Function that return class attribute
	 *
	 * @param string|array $class
	 *
	 * @return string|mixed
	 */
	function fokkner_get_class_attribute( $class ) {
		$value = fokkner_is_installed( 'framework' ) ? qode_framework_get_class_attribute( $class ) : '';

		return $value;
	}
}

if ( ! function_exists( 'fokkner_get_post_value_through_levels' ) ) {
	/**
	 * Function that returns meta value if exists
	 *
	 * @param string $name name of option
	 * @param int $post_id id of
	 *
	 * @return string value of option
	 */
	function fokkner_get_post_value_through_levels( $name, $post_id = null ) {
		return fokkner_is_installed( 'framework' ) && fokkner_is_installed( 'core' ) ? fokkner_core_get_post_value_through_levels( $name, $post_id ) : '';
	}
}

if ( ! function_exists( 'fokkner_get_space_value' ) ) {
	/**
	 * Function that returns spacing value based on selected option
	 *
	 * @param string $text_value - textual value of spacing
	 *
	 * @return int
	 */
	function fokkner_get_space_value( $text_value ) {
		return fokkner_is_installed( 'core' ) ? fokkner_core_get_space_value( $text_value ) : 0;
	}
}

if ( ! function_exists( 'fokkner_wp_kses_html' ) ) {
	/**
	 * Function that does escaping of specific html.
	 * It uses wp_kses function with predefined attributes array.
	 *
	 * @param string $type - type of html element
	 * @param string $content - string to escape
	 *
	 * @return string escaped output
	 * @see wp_kses()
	 *
	 */
	function fokkner_wp_kses_html( $type, $content ) {
		return fokkner_is_installed( 'framework' ) ? qode_framework_wp_kses_html( $type, $content ) : $content;
	}
}

if ( ! function_exists( 'fokkner_render_svg_icon' ) ) {
	/**
	 * Function that print svg html icon
	 *
	 * @param string $name - icon name
	 * @param string $class_name - custom html tag class name
	 */
	function fokkner_render_svg_icon( $name, $class_name = '' ) {
		echo fokkner_get_svg_icon( $name, $class_name );
	}
}

if ( ! function_exists( 'fokkner_get_svg_icon' ) ) {
	/**
	 * Returns svg html
	 *
	 * @param string $name - icon name
	 * @param string $class_name - custom html tag class name
	 *
	 * @return string|html
	 */
	function fokkner_get_svg_icon( $name, $class_name = '' ) {
		$html  = '';
		$class = isset( $class_name ) && ! empty( $class_name ) ? 'class="' . esc_attr( $class_name ) . '"' : '';

		switch ( $name ) {
			case 'menu':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="64px" height="64px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve"><line x1="12" y1="21" x2="52" y2="21"/><line x1="12" y1="33" x2="52" y2="33"/><line x1="12" y1="45" x2="52" y2="45"/></svg>';
				break;
			case 'search':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20"><path d="M18.869 19.162l-5.943-6.484c1.339-1.401 2.075-3.233 2.075-5.178 0-2.003-0.78-3.887-2.197-5.303s-3.3-2.197-5.303-2.197-3.887 0.78-5.303 2.197-2.197 3.3-2.197 5.303 0.78 3.887 2.197 5.303 3.3 2.197 5.303 2.197c1.726 0 3.362-0.579 4.688-1.645l5.943 6.483c0.099 0.108 0.233 0.162 0.369 0.162 0.121 0 0.242-0.043 0.338-0.131 0.204-0.187 0.217-0.503 0.031-0.706zM1 7.5c0-3.584 2.916-6.5 6.5-6.5s6.5 2.916 6.5 6.5-2.916 6.5-6.5 6.5-6.5-2.916-6.5-6.5z"></path></svg>';
				break;
			case 'star':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32"><g><path d="M 20.756,11.768L 15.856,1.84L 10.956,11.768L0,13.36L 7.928,21.088L 6.056,32L 15.856,26.848L 25.656,32L 23.784,21.088L 31.712,13.36 z"></path></g></svg>';
				break;
			case 'menu-arrow-right':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32"><g><path d="M 13.8,24.196c 0.39,0.39, 1.024,0.39, 1.414,0l 6.486-6.486c 0.196-0.196, 0.294-0.454, 0.292-0.71 c0-0.258-0.096-0.514-0.292-0.71L 15.214,9.804c-0.39-0.39-1.024-0.39-1.414,0c-0.39,0.39-0.39,1.024,0,1.414L 19.582,17 L 13.8,22.782C 13.41,23.172, 13.41,23.806, 13.8,24.196z"></path></g></svg>';
				break;
			case 'slider-arrow-left':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 11" style="enable-background:new 0 0 32 11;" xml:space="preserve"><g><rect x="9.8" y="5" width="22.2" height="1"/><polygon points="11,0 11,11 0,5.5 	"/></g></svg>';
				break;
			case 'slider-arrow-right':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 11" style="enable-background:new 0 0 32 11;" xml:space="preserve"><g><rect y="5" transform="matrix(-1 -1.224647e-16 1.224647e-16 -1 22.1644 11)" width="22.2" height="1"/><polygon points="21,11 21,0 32,5.5"/></g></svg>';
				break;
			case 'pagination-arrow-left':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32"><g><path d="M 12.3,17.71l 6.486,6.486c 0.39,0.39, 1.024,0.39, 1.414,0c 0.39-0.39, 0.39-1.024,0-1.414L 14.418,17 L 20.2,11.218c 0.39-0.39, 0.39-1.024,0-1.414c-0.39-0.39-1.024-0.39-1.414,0L 12.3,16.29C 12.104,16.486, 12.008,16.742, 12.008,17 C 12.008,17.258, 12.104,17.514, 12.3,17.71z"></path></g></svg>';
				break;
			case 'pagination-arrow-right':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32"><g><path d="M 13.8,24.196c 0.39,0.39, 1.024,0.39, 1.414,0l 6.486-6.486c 0.196-0.196, 0.294-0.454, 0.292-0.71 c0-0.258-0.096-0.514-0.292-0.71L 15.214,9.804c-0.39-0.39-1.024-0.39-1.414,0c-0.39,0.39-0.39,1.024,0,1.414L 19.582,17 L 13.8,22.782C 13.41,23.172, 13.41,23.806, 13.8,24.196z"></path></g></svg>';
				break;
			case 'close':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="14" height="14" xml:space="preserve"><path transform="rotate(-45.001 7 7)" d="M5.5-1.4h3v16.8h-3z"/><path transform="rotate(-134.999 7 7)" d="M5.5-1.4h3v16.8h-3z"/></svg>';
				break;
			case 'spinner':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z"></path></svg>';
				break;
			case 'link':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32.816001892089844" viewBox="0 0 32 32.816001892089844" fill="currentColor"><g><path d="M 9.558,4.056c 1.17-1.17, 3.072-1.17, 4.242,0l 10.726,10.726c 0.528-1.998, 0.034-4.21-1.532-5.776 L 15.922,1.936c-2.344-2.344-6.142-2.344-8.486,0L 5.846,3.526c-2.344,2.344-2.344,6.142,0,8.486l 7.072,7.072 c 1.566,1.566, 3.778,2.060, 5.776,1.532L 7.968,9.89c-1.17-1.17-1.17-3.072,0-4.242L 9.558,4.056zM 16.078,30.064c 2.344,2.344, 6.142,2.344, 8.486,0l 1.59-1.592c 2.344-2.344, 2.344-6.142,0-8.486L 19.082,12.918 c-1.566-1.566-3.778-2.060-5.776-1.532l 10.726,10.726c 1.17,1.17, 1.17,3.072,0,4.242l-1.592,1.592c-1.17,1.17-3.072,1.17-4.242,0 L 7.474,17.218c-0.528,1.998-0.034,4.21, 1.532,5.776L 16.078,30.064z"></path></g></svg>';
				break;
			case 'quote':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="142px" height="112px" viewBox="0 0 142 112" style="enable-background:new 0 0 142 112;" xml:space="preserve"><g><path fill="currentColor" d="M40.4,0l27.4,17C54.4,36.7,47.5,57.1,47,78.4V112H0V81.5c0.1-14.2,4-29,11.6-44.4C19.2,21.7,28.8,9.3,40.4,0z M114.6,0L142,17c-13.4,19.6-20.3,40.1-20.8,61.3V112h-47V81.5c0.1-14.2,4-29,11.6-44.4C93.4,21.7,103,9.3,114.6,0z"/></g></svg>';
				break;
            case 'preloader':
                $html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 21 21" width="21" height="21" xml:space="preserve"><g><rect width="8" height="8"/><rect x="13" width="8" height="8"/><rect y="13" width="8" height="8"/><rect x="13" y="13" width="8" height="8"/></g></svg>';
                break;
		}

		return apply_filters( 'fokkner_filter_svg_icon', $html );
	}
}
