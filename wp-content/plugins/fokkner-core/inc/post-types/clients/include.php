<?php

include_once FOKKNER_CORE_CPT_PATH . '/clients/helper.php';

foreach ( glob( FOKKNER_CORE_CPT_PATH . '/clients/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}
