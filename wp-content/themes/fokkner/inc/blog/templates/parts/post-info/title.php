<?php
// single post title tag h3 when core not installed
if ( ! fokkner_is_installed( 'core' ) ) {
	$title_tag = is_single() ? 'h3' : 'h4';
}
$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h4';
?>
<<?php echo esc_attr( $title_tag ); ?> itemprop="name" class="qodef-e-title entry-title">
	<?php if ( ! is_single() ) { ?>
		<a itemprop="url" class="qodef-e-title-link" href="<?php the_permalink(); ?>">
	<?php } ?>
		<?php the_title(); ?>
	<?php if ( ! is_single() ) { ?>
		</a>
	<?php } ?>
</<?php echo esc_attr( $title_tag ); ?>>
