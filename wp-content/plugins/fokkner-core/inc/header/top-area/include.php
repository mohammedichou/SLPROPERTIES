<?php

include_once FOKKNER_CORE_INC_PATH . '/header/top-area/class-fokknercore-top-area.php';
include_once FOKKNER_CORE_INC_PATH . '/header/top-area/helper.php';

foreach ( glob( FOKKNER_CORE_INC_PATH . '/header/top-area/dashboard/*/*.php' ) as $dashboard ) {
	include_once $dashboard;
}
