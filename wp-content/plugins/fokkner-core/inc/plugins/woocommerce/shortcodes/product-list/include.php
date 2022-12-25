<?php

include_once FOKKNER_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-list/class-fokknercore-product-list-shortcode.php';

foreach ( glob( FOKKNER_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
