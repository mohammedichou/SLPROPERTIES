<?php

include_once FOKKNER_CORE_PLUGINS_PATH . '/property/post-types/property/shortcodes/property-info/class-fokknercore-property-info-shortcode.php';

foreach ( glob( FOKKNER_CORE_PLUGINS_PATH . '/property/post-types/property/shortcodes/property-info/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
