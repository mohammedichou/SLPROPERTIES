<?php

include_once FOKKNER_CORE_INC_PATH . '/search/class-fokknercore-search.php';
include_once FOKKNER_CORE_INC_PATH . '/search/helper.php';
include_once FOKKNER_CORE_INC_PATH . '/search/dashboard/admin/search-options.php';

foreach ( glob( FOKKNER_CORE_INC_PATH . '/search/layouts/*/include.php' ) as $layout ) {
	include_once $layout;
}
