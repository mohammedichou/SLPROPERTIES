<?php

include_once FOKKNER_CORE_SHORTCODES_PATH . '/custom-font/class-fokknercore-custom-font-shortcode.php';

foreach ( glob( FOKKNER_CORE_SHORTCODES_PATH . '/custom-font/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
