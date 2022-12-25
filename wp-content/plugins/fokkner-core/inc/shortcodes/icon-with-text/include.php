<?php

include_once FOKKNER_CORE_SHORTCODES_PATH . '/icon-with-text/class-fokknercore-icon-with-text-shortcode.php';

foreach ( glob( FOKKNER_CORE_SHORTCODES_PATH . '/icon-with-text/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
