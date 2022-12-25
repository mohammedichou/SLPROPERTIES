<?php
$features = get_post_meta( get_the_ID(), 'qodef_property_feature_repeater', true );

if ( is_array( $features ) && count( $features ) > 0 ) { ?>
	<div class="qodef-e-pl-feature-titles-holder">
		<?php foreach ( $features as $feature ) { ?>
			<div class="qodef-e-pl-feature-title">
				<?php echo esc_html( $feature['qodef_property_feature_title'] ); ?>
			</div>
		<?php } ?>
	</div>
<?php } ?>
