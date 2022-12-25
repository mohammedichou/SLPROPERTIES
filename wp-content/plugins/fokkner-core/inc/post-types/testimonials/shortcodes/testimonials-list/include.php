<?php

include_once FOKKNER_CORE_CPT_PATH . '/testimonials/shortcodes/testimonials-list/class-fokknercore-testimonials-list-shortcode.php';

foreach ( glob( FOKKNER_CORE_CPT_PATH . '/testimonials/shortcodes/testimonials-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
