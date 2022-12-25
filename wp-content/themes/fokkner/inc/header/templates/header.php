<?php
// Hook to include additional content before page header
do_action( 'fokkner_action_before_page_header' );
?>
<header id="qodef-page-header" <?php fokkner_class_attribute( apply_filters( 'fokkner_filter_header_class', array() ) ); ?>>
	<?php
	// Hook to include additional content before page header inner
	do_action( 'fokkner_action_before_page_header_inner' );
	?>
	<div id="qodef-page-header-inner" <?php fokkner_class_attribute( apply_filters( 'fokkner_filter_header_inner_class', array(), 'default' ) ); ?>>
		<?php
		// Include module content template
		echo apply_filters( 'fokkner_filter_header_content_template', fokkner_get_template_part( 'header', 'templates/header-content' ) );
		?>
	</div>
	<?php
	// Hook to include additional content after page header inner
	do_action( 'fokkner_action_after_page_header_inner' );
	?>
</header>
