<?php

include_once FOKKNER_CORE_SHORTCODES_PATH . '/button/class-fokknercore-button-shortcode.php';

foreach ( glob( FOKKNER_CORE_SHORTCODES_PATH . '/button/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
