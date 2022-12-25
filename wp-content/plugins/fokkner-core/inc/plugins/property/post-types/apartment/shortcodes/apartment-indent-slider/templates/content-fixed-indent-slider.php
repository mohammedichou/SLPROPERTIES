<div <?php qode_framework_class_attribute( $holder_wrapper_classes ); ?>>
	<div class="qodef-left-info">
		<div class="qodef-left-info-content">
			<?php if ( ! empty( $fixed_area_title ) ) { ?>
				<h3 class="qodef-e-title entry-title"><?php echo esc_html( $fixed_area_title ); ?></h3>
			<?php } ?>

			<?php if ( ! empty( $features ) ) { ?>
				<div class="qodef-e-features-list-holder">
			<?php } ?>

			<?php foreach ( $features as $feature ) : ?>
				<?php if ( ! empty( $feature['feature_title'] ) || ! empty( $feature['feature_text'] ) ) { ?>
					<div class="qodef-e-features-list">
					<?php if ( isset( $feature['feature_title'] ) && ! empty( $feature['feature_title'] ) ) { ?>
						<span class="qodef-m-feature-title"><?php echo esc_html( $feature['feature_title'] ); ?></span>
					<?php } ?>
					<?php if ( isset( $feature['feature_text'] ) && ! empty( $feature['feature_text'] ) ) { ?>
						<span class="qodef-m-feature-text"><?php echo esc_html( $feature['feature_text'] ); ?></span>
					<?php } ?>
					</div>
				<?php } ?>
			<?php endforeach; ?>

			<?php if ( ! empty( $features ) ) { ?>
				</div>
			<?php } ?>

		</div>
	</div>
	<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>
		<div class="swiper-wrapper">
			<?php
			// Include items
			fokkner_core_template_part( 'plugins/property/post-types/apartment/shortcodes/apartment-indent-slider', 'templates/loop', '', $params );
			?>
		</div>
		<div class="qodef-e-navigation-wrapper">
			<?php fokkner_core_template_part( 'content', 'templates/swiper-nav', '', $params ); ?>
		</div>

		<?php fokkner_core_template_part( 'content', 'templates/swiper-pag', '', $params ); ?>
	</div>
</div>
