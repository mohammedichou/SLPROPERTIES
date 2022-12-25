<?php if ( ! empty( $video_link ) ) { ?>
	<a itemprop="url" class="qodef-m-play qodef-magnific-popup qodef-popup-item" <?php echo qode_framework_get_inline_style( $play_button_styles ); ?> href="<?php echo esc_url( $video_link ); ?>" data-type="iframe">
		<span class="qodef-m-play-inner">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="11" height="12"  viewBox="0 0 11 12" style="enable-background:new 0 0 11 12;" xml:space="preserve">
				<polygon points="0,12 0,0 11,6 "/>
			</svg>
		</span>
	</a>
<?php } ?>
