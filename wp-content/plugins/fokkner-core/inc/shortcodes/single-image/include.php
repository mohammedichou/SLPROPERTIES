<?php

include_once FOKKNER_CORE_SHORTCODES_PATH . '/single-image/class-fokknercore-single-image-shortcode.php';

foreach ( glob( FOKKNER_CORE_SHORTCODES_PATH . '/single-image/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
