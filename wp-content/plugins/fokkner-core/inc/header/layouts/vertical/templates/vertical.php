<?php do_action( 'fokkner_action_before_page_header' ); ?>

<header id="qodef-page-header">
	<div id="qodef-page-header-inner" class="<?php echo implode( ' ', apply_filters( 'fokkner_filter_header_inner_class', array(), 'default' ) ); ?>">
		<?php
		// Include logo
		fokkner_core_get_header_logo_image();

		// Include divided left navigation
		fokkner_core_template_part( 'header', 'layouts/vertical/templates/navigation' );

		// Include widget area one
		fokkner_core_get_header_widget_area();
		?>
	</div>
</header>
