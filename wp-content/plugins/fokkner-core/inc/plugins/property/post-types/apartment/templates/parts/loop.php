<?php

if ( have_posts() ) {
	while ( have_posts() ) :
		the_post();

		// Hook to include additional content before post item
		do_action( 'fokkner_core_action_before_apartment_item' );

		// Include post item
		fokkner_core_template_part( 'plugins/property/post-types/apartment', 'templates/layouts/default' );

		// Hook to include additional content after post item
		do_action( 'fokkner_core_action_after_apartment_item' );

	endwhile; // End of the loop.
} else {
	// Include global posts not found
	fokkner_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
}

wp_reset_postdata();
