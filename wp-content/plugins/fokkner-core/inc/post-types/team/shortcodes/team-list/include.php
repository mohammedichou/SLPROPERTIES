<?php

include_once FOKKNER_CORE_CPT_PATH . '/team/shortcodes/team-list/class-fokknercore-team-list-shortcode.php';

foreach ( glob( FOKKNER_CORE_CPT_PATH . '/team/shortcodes/team-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
