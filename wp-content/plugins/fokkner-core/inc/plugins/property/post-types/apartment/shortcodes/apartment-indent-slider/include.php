<?php

include_once FOKKNER_CORE_PLUGINS_PATH . '/property/post-types/apartment/shortcodes/apartment-indent-slider/class-fokknercore-apartment-indent-slider-shortcode.php';

foreach ( glob( FOKKNER_CORE_PLUGINS_PATH . '/property/post-types/apartment/shortcodes/apartment-indent-slider/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
