<div class="qodef-fullscreen-search-holder qodef-m">
	<?php
	fokkner_core_get_opener_icon_html(
		array(
			'option_name'  => 'search',
			'custom_class' => 'qodef-m-close',
			'custom_icon'  => 'search',
		),
		false,
		true
	);
	?>
	<div class="qodef-m-inner">
		<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="qodef-m-form" method="get">
			<input type="text" placeholder="<?php esc_attr_e( 'Search', 'fokkner-core' ); ?>" name="s" class="qodef-m-form-field" autocomplete="off" required/>
			<?php
			fokkner_core_get_opener_icon_html(
				array(
					'html_tag'     => 'button',
					'option_name'  => 'search',
					'custom_icon'  => 'search',
					'custom_class' => 'qodef-m-form-submit',
				)
			);
			?>
			<div class="qodef-m-form-line"></div>
		</form>
		<p class="qodef-m-search-text"><?php echo esc_html__( 'Type at least 1 character to search', 'fokkner-core' ); ?></p>
	</div>
</div>
