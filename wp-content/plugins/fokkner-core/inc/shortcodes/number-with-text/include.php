<?php

include_once FOKKNER_CORE_SHORTCODES_PATH . '/number-with-text/class-fokknercore-number-with-text-shortcode.php';

foreach ( glob( FOKKNER_CORE_SHORTCODES_PATH . '/number-with-text/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
