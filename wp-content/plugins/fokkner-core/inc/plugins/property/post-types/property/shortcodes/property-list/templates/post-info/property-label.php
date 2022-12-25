<?php
$property_label_text         = get_post_meta( get_the_ID(), 'qodef_property_label', true );
$property_label_link         = get_post_meta( get_the_ID(), 'qodef_property_label_link', true );
$property_label_margin       = get_post_meta( get_the_ID(), 'qodef_property_label_margin', true );
$property_label_inline_style = '';
$link                        = get_the_permalink();

if ( ! empty( $property_label_link ) ) {
	$link = $property_label_link;
}

if ( ! empty( $property_label_margin ) ) {
	$property_label_inline_style = 'margin-top: ' . $property_label_margin;
}
?>

<div class="qodef-property-label-inner">
	<a href="<?php echo esc_attr( $link ); ?>" class="qodef-property-label-link">
	<?php if ( ! empty( $property_label_text ) ) { ?>
		<h4 class="qodef-property-label-title" style="<?php echo esc_html( $property_label_inline_style ); ?>">
		<?php echo esc_html( $property_label_text ); ?>
		</h4>
	<?php } ?>
	</a>
</div>
