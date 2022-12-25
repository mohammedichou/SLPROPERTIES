<?php if ( ! empty( $item['video_link'] ) || ! empty( $item['video_link_360'] ) ) { ?>
	<div class="qodef-map-navigation">
		<div class="qodef-map-nav-item qodef-active-map active">
			<?php echo qode_framework_icons()->render_icon( 'qodef-property-photos', 'property-icons' ); ?>
			<span class="qodef-map-nav-item-text"><?php echo esc_html__( 'Photos', 'fokkner-core' ); ?></span>
		</div>
		<?php if ( ! empty( $item['video_link'] ) ) { ?>
			<div class="qodef-map-nav-item qodef-inactive-map">
				<?php echo qode_framework_icons()->render_icon( 'qodef-property-video', 'property-icons' ); ?>
				<span class="qodef-map-nav-item-text"><?php echo esc_html__( 'Video', 'fokkner-core' ); ?></span>
			</div>
		<?php } ?>
		<?php if ( ! empty( $item['video_link_360'] ) ) { ?>
			<div class="qodef-map-nav-item qodef-inactive-map">
				<?php echo qode_framework_icons()->render_icon( 'qodef-property-360', 'property-icons' ); ?>
				<span class="qodef-map-nav-item-text"><?php echo esc_html__( '360 Video', 'fokkner-core' ); ?></span>
			</div>
		<?php } ?>
	</div>
<?php } ?>
