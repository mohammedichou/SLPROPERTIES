<?php if ( ! empty( $item['video_link_360'] ) ) { ?>
	<div class="qodef-img-section qodef-img-360-video-inner">
		<?php
		$params = array(
			'video_link'  => $item['video_link_360'],
			'video_image' => $item['video_image_360'],
		);

		echo FokknerCore_Video_Button_Shortcode::call_shortcode( $params );
		?>
	</div>
<?php } ?>
