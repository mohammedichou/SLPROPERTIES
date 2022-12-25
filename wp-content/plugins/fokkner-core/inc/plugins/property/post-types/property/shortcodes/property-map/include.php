<?php

include_once FOKKNER_CORE_PLUGINS_PATH . '/property/post-types/property/shortcodes/property-map/helper.php';
include_once FOKKNER_CORE_PLUGINS_PATH . '/property/post-types/property/shortcodes/property-map/class-fokknercore-property-map-shortcode.php';

foreach ( glob( FOKKNER_CORE_PLUGINS_PATH . '/property/shortcodes/property-map/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
