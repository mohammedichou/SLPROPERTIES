<div <?php qode_framework_class_attribute( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<div class="qodef-e-info--top">
			<?php fokkner_core_list_sc_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'post-info/image', '', $params ); ?>
			<div class="qodef-info-items">
				<?php fokkner_core_list_sc_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'post-info/author', '', $params ); ?>
				<?php fokkner_core_list_sc_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'post-info/title', '', $params ); ?>
			</div>
		</div>
		<div class="qodef-e-content">
			<?php fokkner_core_list_sc_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'post-info/text', '', $params ); ?>
		</div>
	</div>
</div>
