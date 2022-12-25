<?php if ( ! empty( $subtitle ) ) { ?>
	<<?php echo esc_attr( $subtitle_tag ); ?> class="qodef-m-subtitle" <?php qode_framework_inline_style( $subtitle_styles ); ?>>
		<?php if ( ! empty( $link ) ) : ?>
			<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
		<?php endif; ?>
			<?php echo qode_framework_wp_kses_html( 'content', $subtitle ); ?>
		<?php if ( ! empty( $link ) ) : ?>
			</a>
		<?php endif; ?>
	</<?php echo esc_attr( $subtitle_tag ); ?>>
<?php } ?>
