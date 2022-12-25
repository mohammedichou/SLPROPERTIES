<?php

include_once FOKKNER_CORE_PLUGINS_PATH . '/property/post-types/property/helper.php';

foreach ( glob( FOKKNER_CORE_PLUGINS_PATH . '/property/post-types/property/dashboard/admin/*.php' ) as $module ) {
	include_once $module;
}

foreach ( glob( FOKKNER_CORE_PLUGINS_PATH . '/property/post-types/property/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}
