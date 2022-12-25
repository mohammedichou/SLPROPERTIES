<?php
$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h2';
?>
<<?php echo esc_attr( $title_tag ); ?> itemprop="name" class="qodef-e-title entry-title">
<a itemprop="url" class="qodef-e-title-link" href="<?php the_permalink(); ?>">
	<?php echo qode_framework_wp_kses_html( 'content', $title ); ?>
</a>
</<?php echo esc_attr( $title_tag ); ?>>
