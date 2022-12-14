<?php if ( ! post_password_required() && class_exists( 'FokknerCore_Button_Shortcode' ) ) { ?>
	<div class="qodef-e-read-more">
		<?php
		$button_params = array(
			'button_layout' => 'textual',
			'link'          => get_the_permalink(),
			'text'          => esc_html__( 'Read More', 'fokkner-core' ),
		);

		echo FokknerCore_Button_Shortcode::call_shortcode( $button_params );
		?>
	</div>
<?php } ?>
