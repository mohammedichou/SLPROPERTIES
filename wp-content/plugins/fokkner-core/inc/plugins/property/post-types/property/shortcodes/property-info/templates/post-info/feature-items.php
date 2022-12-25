<div <?php qode_framework_class_attribute( $grid_holder_classes ); ?>>
	<div class="qodef-grid-inner clear">
		<?php
		if ( is_array( $feature_items ) && count( $feature_items ) > 0 ) {
			foreach ( $feature_items as $feature_item ) {
				?>
				<div class="qodef-e qodef-e-property-info-item qodef-grid-item">
					<div class="qodef-e-pi-item-inner">
						<div> <?php echo wp_get_attachment_image( $feature_item['image'], $image_proportions ); ?></div>
						<div>
							<<?php echo esc_attr( $features_title_tag ); ?> class="qodef-e-feature-title"><?php echo $feature_item['title']; ?></<?php echo esc_attr( $features_title_tag ); ?>>
						<span class="qodef-e-feature-description"><?php echo $feature_item['description']; ?></span>
					</div>
					</div>
				</div>
				<?php
			}
		}
		?>
	</div>
</div>
