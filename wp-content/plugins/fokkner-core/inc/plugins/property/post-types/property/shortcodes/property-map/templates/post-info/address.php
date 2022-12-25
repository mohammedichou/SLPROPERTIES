<?php

$address = get_post_meta( get_the_ID(), 'qodef_store_full_address', true );

if ( ! empty( $address ) ) {
	?>
	<div class="qodef-e-info qodef-e-info--address">
		<?php echo esc_html( $address ); ?>
	</div>
<?php } ?>
