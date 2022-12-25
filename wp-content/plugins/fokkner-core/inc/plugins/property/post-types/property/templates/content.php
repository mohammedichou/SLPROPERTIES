<?php
// Hook to include additional content before page content holder
do_action( 'fokkner_core_action_before_property_content_holder' );
?>
	<main id="qodef-page-content" class="qodef-grid qodef-layout--template <?php echo esc_attr( fokkner_core_get_grid_gutter_classes() ); ?>">
		<?php
		$content = isset( $content ) ? $content : '';
		fokkner_core_template_part( 'plugins/property/post-types/property', 'templates/property', $content );
		?>
	</main>
<?php
// Hook to include additional content after main page content holder
do_action( 'fokkner_core_action_after_property_content_holder' );
?>
