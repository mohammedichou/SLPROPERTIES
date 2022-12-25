<?php

include_once FOKKNER_CORE_PLUGINS_PATH . '/property/helper.php';
include_once FOKKNER_CORE_PLUGINS_PATH . '/property/dashboard/admin/property-options.php';

foreach ( glob( FOKKNER_CORE_PLUGINS_PATH . '/property/*/include.php' ) as $module ) {
	include_once $module;
}
