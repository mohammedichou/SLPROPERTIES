<?php

if ( $query_results->have_posts() ) :
	while ( $query_results->have_posts() ) :
		$query_results->the_post();
		?>
		<div class="qodef-e-property-info-item">
			<div class="qodef-e-pi-main-content">
				<div class="qodef-e-pi-content-inner">
					<?php fokkner_core_list_sc_template_part( 'plugins/property/post-types/property/shortcodes/property-info', 'layouts/' . $layout, '', $params ); ?>
				</div>
			</div>
		</div>
		<?php
	endwhile;
else :
	// Include global posts not found
	fokkner_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
endif;
wp_reset_postdata();
?>
