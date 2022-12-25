<?php
$property_label_enabled = get_post_meta( get_the_ID(), 'qodef_show_property_label', true );
?>
<?php if ( 'yes' === $property_label_enabled ) {
	$item_classes .= ' qodef-showp-roperty-label';
}
?>
<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php if ( 'yes' === $property_label_enabled ) { ?>
			<div class="qodef-property-label-holder">
				<?php fokkner_core_list_sc_template_part( 'plugins/property/post-types/property/shortcodes/property-list', 'post-info/property-label', '', $params ); ?>
			</div>
			<div class="qodef-e-image">
				<?php fokkner_core_list_sc_template_part( 'plugins/property/post-types/property/shortcodes/property-list', 'post-info/image', '', $params ); ?>
			</div>
		<?php } else { ?>
		<div class="qodef-e-image">
			<?php fokkner_core_list_sc_template_part( 'plugins/property/post-types/property/shortcodes/property-list', 'post-info/image', '', $params ); ?>
		</div>
		<div class="qodef-e-content">
			<div class="qodef-e-content-inner">
				<?php fokkner_core_list_sc_template_part( 'plugins/property/post-types/property/shortcodes/property-list', 'post-info/title', '', $params ); ?>
			</div>
		</div>
		<?php } ?>
	</div>
</article>
