<?php
/**
 * chenzhidong
 * 2013-4-26
 */

define('SITE_NAME','sample');

define('_COOKIE_KEY_', '');
define('_COOKIE_IV_', '');

define('_RIJNDAEL_KEY_', '');
define('_RIJNDAEL_IV_', '');

define('LOG_DIR',APPLICATION_PATH.'/log/');

function pSQL($string, $htmlOK = false){
	static $db = false;
	if (!$db)
		$db = Db::getInstance();

	return $db->escape($string, $htmlOK);
}

function bqSQL($string){
	return str_replace('`', '\`', pSQL($string));
}

function truncate($string,$length){
	if(mb_strlen($string,'utf-8')>$length){
		$string=mb_substr($string, 0,$length,'utf-8').'...';
	}
	return $string;
}
