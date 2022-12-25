<?php

include_once FOKKNER_CORE_CPT_PATH . '/clients/shortcodes/clients-list/class-fokknercore-clients-list-shortcode.php';

foreach ( glob( FOKKNER_CORE_CPT_PATH . '/clients/shortcodes/clients-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
