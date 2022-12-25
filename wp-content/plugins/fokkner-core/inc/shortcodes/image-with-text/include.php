<?php

include_once FOKKNER_CORE_SHORTCODES_PATH . '/image-with-text/class-fokknercore-image-with-text-shortcode.php';

foreach ( glob( FOKKNER_CORE_SHORTCODES_PATH . '/image-with-text/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
