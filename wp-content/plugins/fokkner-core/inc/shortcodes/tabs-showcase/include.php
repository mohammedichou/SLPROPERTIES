<?php

include_once FOKKNER_CORE_SHORTCODES_PATH . '/tabs-showcase/class-fokknercore-tab-showcase-shortcode.php';
include_once FOKKNER_CORE_SHORTCODES_PATH . '/tabs-showcase/class-fokknercore-tab-showcase-child-shortcode.php';

foreach ( glob( FOKKNER_CORE_SHORTCODES_PATH . '/tabs-showcase/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
