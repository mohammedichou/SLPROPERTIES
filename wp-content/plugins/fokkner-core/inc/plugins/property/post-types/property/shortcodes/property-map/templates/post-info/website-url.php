<?php

$website_url = get_post_meta( get_the_ID(), 'qodef_store_website_url', true );

if ( ! empty( $website_url ) ) {
	?>
	<div class="qodef-e-info qodef-e-info--website-url">
		<a href="<?php echo esc_url( $website_url ); ?>" target="_blank"><?php echo esc_html__( 'Visit Website', 'fokkner-core' ); ?></a>
	</div>
<?php } ?>
