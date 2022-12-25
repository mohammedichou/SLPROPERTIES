<?php

$email = get_post_meta( get_the_ID(), 'qodef_store_email', true );

if ( ! empty( $email ) ) { ?>
	<div class="qodef-e-info qodef-e-info--email">
		<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
	</div>
<?php } ?>
