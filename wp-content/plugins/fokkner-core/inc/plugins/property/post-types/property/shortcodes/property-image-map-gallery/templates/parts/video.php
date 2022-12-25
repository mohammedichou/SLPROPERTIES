<?php if ( ! empty( $item['video_link'] ) ) { ?>
	<div class="qodef-img-section qodef-img-video-inner">
		<?php
		$params = array(
			'video_link'  => $item['video_link'],
			'video_image' => $item['video_image'],
		);

		echo FokknerCore_Video_Button_Shortcode::call_shortcode( $params );
		?>
	</div>
<?php } ?>
