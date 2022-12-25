<div class="qodef-img-pagination qodef-pagination-slider clearfix">
	<div class="swiper-wrapper">
		<?php foreach ( $item['images'] as $image ) { ?>
			<div class="qodef-impp-item swiper-slide"><?php echo wp_get_attachment_image( $image['image_id'], 'full' ); ?></div>
		<?php } ?>
	</div>
</div>
