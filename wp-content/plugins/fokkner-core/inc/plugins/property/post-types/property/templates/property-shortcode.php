<div class="qodef-grid-item <?php echo esc_attr( fokkner_core_get_page_content_sidebar_classes() ); ?>">
	<?php
	$queried_tax = get_queried_object();
	$tax         = $queried_tax->taxonomy;
	$tax_slug    = $queried_tax->slug;

	fokkner_core_generate_property_archive_with_shortcode( $tax, $tax_slug );
	?>
</div>
