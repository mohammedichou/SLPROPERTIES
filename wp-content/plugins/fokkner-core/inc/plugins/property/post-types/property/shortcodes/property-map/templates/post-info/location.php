<?php
$locations = wp_get_post_terms( get_the_ID(), 'stores-location' );

if ( ! empty( $locations ) ) { ?>
	<div class="qodef-e-info qodef-e-info--location">
		<?php
		foreach ( $locations as $location ) {
			fokkner_core_store_get_term_html( $location, false );
		}
		?>
	</div>
<?php } ?>
