<?php if ( ! post_password_required() && class_exists( 'FokknerCore_Button_Shortcode' ) ) { ?>
	<div class="qodef-e-read-more">
		<?php
		$button_params = array(
			'button_layout' => 'outlined',
			'link'          => get_the_permalink(),
			'text'          => esc_html__( 'View more', 'fokkner-core' ),
		);

		echo FokknerCore_Button_Shortcode::call_shortcode( $button_params );
		?>
	</div>
<?php } ?>
