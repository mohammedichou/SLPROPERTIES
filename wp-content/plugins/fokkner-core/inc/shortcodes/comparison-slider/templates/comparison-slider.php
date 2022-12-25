<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-comparison-slider-holder">
		<?php echo wp_get_attachment_image( $image_before, 'full' ); ?>
		<?php echo wp_get_attachment_image( $image_after, 'full' ); ?>
	</div>
	<div class="qodef-e-dates">
		<div class="qodef-e-date-before">
			<span><?php echo esc_html( $date_before ); ?></span>
		</div>
		<div class="qodef-e-date-after">
			<span><?php echo esc_html( $date_after ); ?></span>
		</div>
	</div>
</div>
