<?php
// Hook to include additional content before page content holder
do_action( 'fokkner_core_action_before_apartment_content_holder' );
?>
	<main id="qodef-page-content" class="qodef-grid qodef-layout--template <?php echo esc_attr( fokkner_core_get_grid_gutter_classes() ); ?>">
		<?php
		fokkner_core_template_part( 'plugins/property/post-types/apartment', 'templates/apartment', '' );
		?>
	</main>
<?php
// Hook to include additional content after main page content holder
do_action( 'fokkner_core_action_after_apartment_content_holder' );
?>
