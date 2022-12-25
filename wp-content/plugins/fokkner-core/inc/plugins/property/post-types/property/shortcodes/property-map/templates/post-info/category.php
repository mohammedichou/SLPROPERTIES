<?php
$categories = wp_get_post_terms( get_the_ID(), 'stores-category' );

if ( ! empty( $categories ) ) {
	?>
	<div class="qodef-e-info qodef-e-info--category">
		<?php
		foreach ( $categories as $cat ) {
			fokkner_core_store_get_term_html( $cat, false );
		}
		?>
	</div>
<?php } ?>
