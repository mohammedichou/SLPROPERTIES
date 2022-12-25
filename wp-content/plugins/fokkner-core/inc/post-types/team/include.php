<?php

include_once FOKKNER_CORE_CPT_PATH . '/team/helper.php';

foreach ( glob( FOKKNER_CORE_CPT_PATH . '/team/dashboard/admin/*.php' ) as $module ) {
	include_once $module;
}

foreach ( glob( FOKKNER_CORE_CPT_PATH . '/team/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}
