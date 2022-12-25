<div <?php qode_framework_class_attribute( $holder_classes ); ?>>

	<?php
	$total_images  = count( $items );
	$total_tabs    = count( $tabs_titles );
	$initial_class = '';
	?>

	<?php if ( ! empty( $items ) && $total_images === $total_tabs ) { ?>
		<div class="qodef-property-image-map-holder">
		<?php $img_index = 1; ?>
		<?php foreach ( $items as $item ) { ?>
			<?php
			if ( 1 === $img_index ) {
				$initial_class = 'qodef-section-active';
			} else {
				$initial_class = '';
			}
			?>
			<?php $params['item'] = $item; ?>
			<div class="qodef-property-image-map-inner <?php echo $initial_class; ?>" data-index="<?php echo esc_attr( $img_index ); ?>" data-image-map-name="<?php echo esc_attr( $item['image_map_name'] ); ?>">
				<div class="qodef-map-holder">
					<?php echo fokkner_core_get_template_part( 'plugins/property/post-types/property/shortcodes/property-image-map-gallery', 'templates/parts/right-section', '', $params ); ?>
				</div>
				<div class="qodef-img-holder">
					<?php echo fokkner_core_get_template_part( 'plugins/property/post-types/property/shortcodes/property-image-map-gallery', 'templates/parts/left-section', '', $params ); ?>
					<?php echo fokkner_core_get_template_part( 'plugins/property/post-types/property/shortcodes/property-image-map-gallery', 'templates/parts/navigation', '', $params ); ?>
				</div>
			</div>
			<?php $img_index ++; ?>
		<?php } ?>
	</div>
	<?php } ?>
	<div class="qodef-tabs-holder">
		<ul class="qodef-tabs-navigation">
			<?php $index = 1; ?>
			<?php foreach ( $tabs_titles as $title ) { ?>
				<li data-index="<?php echo esc_attr( $index ); ?>">
					<a href="#qodef-tab-<?php echo sanitize_title( $title ); ?>"><?php echo esc_html( $title ); ?></a>
				</li>
				<?php $index++; ?>
			<?php } ?>
		</ul>
		<?php echo do_shortcode( $content ); ?>
	</div>
</div>
