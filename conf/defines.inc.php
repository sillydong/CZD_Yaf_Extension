<?php
/**
 * chenzhidong
 * 2013-4-26
 */

define('_COOKIE_KEY_', '');
define('_COOKIE_IV_', '');

define('_RIJNDAEL_KEY_', '');
define('_RIJNDAEL_IV_', '');

define('LOG_DIR',APPLICATION_PATH.'/log/');

define('APP_KEY','');
define('APP_SECRET','');

function pSQL($string, $htmlOK = false){
	static $db = false;
	if (!$db)
		$db = Db::getInstance();

	return $db->escape($string, $htmlOK);
}

function bqSQL($string){
	return str_replace('`', '\`', pSQL($string));
}

