<?php
/**
 * 命令行请求入口
 *
 * Created by IntelliJ IDEA.
 * User: chenzhidong
 * Date: 13-12-5
 * Time: 上午11:43
 */
define('APPLICATION_PATH', dirname(__FILE__));

if (!extension_loaded("yaf"))
{
	include(APPLICATION_PATH . '/framework/loader.php');
}
$application = new Yaf_Application(APPLICATION_PATH . "/conf/application.ini");
$application->bootstrap()->getDispatcher()->dispatch(new Yaf_Request_Simple());
?>
