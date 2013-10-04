<?php

define('APPLICATION_PATH', dirname(__FILE__));

if(!extension_loaded("yaf")){
	include(APPLICATION_PATH.'/framework/loader.php');
}
$application = new Yaf_Application( APPLICATION_PATH . "/conf/application.ini");
$application->bootstrap()->run();
?>
