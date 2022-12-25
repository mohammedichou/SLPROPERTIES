<?php

include_once FOKKNER_CORE_SHORTCODES_PATH . '/tabs/class-fokknercore-tab-shortcode.php';
include_once FOKKNER_CORE_SHORTCODES_PATH . '/tabs/class-fokknercore-tab-child-shortcode.php';

foreach ( glob( FOKKNER_CORE_SHORTCODES_PATH . '/tabs/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
