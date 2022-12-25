<?php if ( 'no' !== $show_social_links ) { ?>
	<div class="qodef-m-socail-links">
		<?php for ( $i = 1; $i <= 5; $i ++ ) {
			$selected_icon_pack = str_replace( '-', '_', $params[ 'main_icon_' . $i ] );

			if ( ! empty( $params[ 'main_icon_' . $i . '_' . $selected_icon_pack ] ) ) {
				$icon_params = array(
					'main_icon'                        => $params[ 'main_icon_' . $i ],
					'main_icon_' . $selected_icon_pack => $params[ 'main_icon_' . $i . '_' . $selected_icon_pack ],
					'link'                             => $params[ 'link_' . $i ],
					'target'                           => $params[ 'target_' . $i ],
					'custom_size'                      => $params[ 'custom_size_' . $i ],
					'margin'                           => $params[ 'margin_' . $i ],
					'background_color'                 => $params[ 'icon_background_color_' . $i ],
					'color'                            => $params[ 'icon_color_' . $i ],
					'hover_background_color'           => $params[ 'icon_hover_background_color_' . $i ],
					'hover_color'                      => $params[ 'icon_hover_color_' . $i ],
					'icon_layout'                      => $params['icon_layout'],
				);

				//$params = $this->generate_string_params( $params );

				//echo do_shortcode( "[fokkner_core_icon $params]" ); // XSS OK
				echo FokknerCore_Icon_Shortcode::call_shortcode( $icon_params );
			}
		} ?>
	</div>
<?php } ?>
