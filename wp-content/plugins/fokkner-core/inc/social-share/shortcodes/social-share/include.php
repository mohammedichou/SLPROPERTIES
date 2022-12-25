<?php

include_once FOKKNER_CORE_INC_PATH . '/social-share/shortcodes/social-share/class-fokknercore-social-share-shortcode.php';

foreach ( glob( FOKKNER_CORE_INC_PATH . '/social-share/shortcodes/social-share/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
