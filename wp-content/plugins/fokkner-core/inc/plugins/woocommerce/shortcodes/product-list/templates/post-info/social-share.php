<?php if ( class_exists( 'FokknerCore_Social_Share_Shortcode' ) ) { ?>
	<div class="qodef-woo-product-social-share">
		<?php
		$params              = array();
		$params['layout']    = 'list';
		$params['title']     = esc_html__( 'Share:', 'fokkner-core' );
		$params['icon_font'] = 'elegant-icons';

		echo FokknerCore_Social_Share_Shortcode::call_shortcode( $params );
		?>
	</div>
<?php } ?>
