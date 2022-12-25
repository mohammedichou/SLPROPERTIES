<?php

include_once FOKKNER_CORE_PLUGINS_PATH . '/property/post-types/property/shortcodes/property-list/class-fokknercore-property-list-shortcode.php';

foreach ( glob( FOKKNER_CORE_PLUGINS_PATH . '/property/post-types/property/shortcodes/property-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
