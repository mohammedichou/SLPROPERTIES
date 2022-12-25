<?php

$phone = get_post_meta( get_the_ID(), 'qodef_store_phone', true );

if ( ! empty( $phone ) ) {
	?>
	<div class="qodef-e-info qodef-e-info--phone">
		<a href="tel:<?php echo esc_attr( str_replace( ' ', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
	</div>
<?php } ?>
