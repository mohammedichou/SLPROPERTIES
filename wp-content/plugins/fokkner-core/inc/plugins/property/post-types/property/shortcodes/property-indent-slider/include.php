<?php

include_once FOKKNER_CORE_PLUGINS_PATH . '/property/post-types/property/shortcodes/property-indent-slider/class-fokknercore-property-indent-slider-shortcode.php';

foreach ( glob( FOKKNER_CORE_PLUGINS_PATH . '/property/post-types/property/shortcodes/property-indent-slider/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
