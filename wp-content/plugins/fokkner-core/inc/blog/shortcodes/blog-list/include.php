<?php

include_once FOKKNER_CORE_INC_PATH . '/blog/shortcodes/blog-list/class-fokknercore-blog-list-shortcode.php';

foreach ( glob( FOKKNER_CORE_INC_PATH . '/blog/shortcodes/blog-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
