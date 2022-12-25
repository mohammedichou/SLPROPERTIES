<div <?php qode_framework_class_attribute( $holder_classes ); ?>>

	<?php
	$total_images = count( $items );
	$total_tabs   = count( $tabs_showcase_titles );
	?>

	<?php if ( ! empty( $items ) && $total_images === $total_tabs ) { ?>
	<div class="qodef-tabs-images">
			<?php $img_index = 1; ?>
		<?php foreach ( $items as $item ) { ?>
			<?php if ( isset( $item['tab_image'] ) && ! empty( $item['tab_image'] ) ) { ?>
				<div class="qodef-tab-image" data-index="<?php echo esc_attr( $img_index ); ?>">
					<?php echo wp_get_attachment_image( $item['tab_image'], 'full' ); ?>
				</div>
			<?php } ?>
			<?php $img_index++; ?>
		<?php } ?>
	</div>
	<?php } ?>
<div class="qodef-tabs-showcase-holder">
	<?php if ( ! empty( $tabs_section_title ) ) : ?>
		<?php echo '<' . esc_attr( $tabs_section_title_tag ); ?> class="qodef-m-title">
		<?php echo esc_html( $tabs_section_title ); ?>
		<?php echo '</' . esc_attr( $tabs_section_title_tag ); ?>>
	<?php endif; ?>
	<ul class="qodef-tabs-showcase-navigation">
		<?php $index = 1; ?>
		<?php foreach ( $tabs_showcase_titles as $title ) { ?>
			<li data-index="<?php echo esc_attr( $index ); ?>">
				<a href="#qodef-tab-<?php echo sanitize_title( $title ); ?>"><?php echo esc_html( $title ); ?></a>
			</li>
			<?php $index++; ?>
		<?php } ?>
	</ul>
	<?php echo do_shortcode( $content ); ?>
</div>
</div>
