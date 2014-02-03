<?php

class MySQL extends Db {

	public function connect() {
		if (!defined('_MYSQL_REAL_ESCAPE_STRING_'))
			define('_MYSQL_REAL_ESCAPE_STRING_', function_exists('mysql_real_escape_string'));

		if (!$this->link = mysql_connect($this->server, $this->user, $this->password))
			die(Tools::displayError('Link to database cannot be established.'));

		if (!$this->set_db($this->database))
			die(Tools::displayError('The database selection cannot be made.'));

		// UTF-8 support
		if (!mysql_query('SET NAMES \'utf8\'', $this->link))
			die(Tools::displayError('PrestaShop Fatal error: no utf-8 support. Please check your server configuration.'));

		return $this->link;
	}

	public function disconnect() {
		mysql_close($this->link);
	}

	protected function _query($sql) {
		return mysql_query($sql, $this->link);
	}

	public function nextRow($result = false) {
		$return = false;
		if (is_resource($result) && $result)
			$return = mysql_fetch_assoc($result);
		elseif (is_resource($this->_result) && $this->_result)
			$return = mysql_fetch_assoc($this->_result);

		return $return;
	}

	protected function _numRows($result) {
		return mysql_num_rows($result);
	}

	public function Insert_ID() {
		return mysql_insert_id($this->link);
	}

	public function Affected_Rows() {
		return mysql_affected_rows($this->link);
	}

	public function getMsgError($query = false) {
		return mysql_error($this->link);
	}

	public function getNumberError() {
		return mysql_errno($this->link);
	}

	public function getVersion() {
		return mysql_get_server_info($this->link);
	}

	public function _escape($str) {
		return _MYSQL_REAL_ESCAPE_STRING_ ? mysql_real_escape_string($str, $this->link) : addslashes($str);
	}

	public function set_db($db_name) {
		return mysql_select_db($db_name, $this->link);
	}

	public static function hasTableWithSamePrefix($server, $user, $pwd, $db, $prefix) {
		if (!$link = @mysql_connect($server, $user, $pwd, true))
			return false;
		if (!@mysql_select_db($db, $link))
			return false;

		$sql = 'SHOW TABLES LIKE \'' . $prefix . '%\'';
		$result = mysql_query($sql);

		return (bool)@mysql_fetch_assoc($result);
	}

	public static function tryToConnect($server, $user, $pwd, $db, $newDbLink = true, $engine = null, $timeout = 5) {
		ini_set('mysql.connect_timeout', $timeout);
		if (!$link = @mysql_connect($server, $user, $pwd, $newDbLink))
			return 1;
		if (!@mysql_select_db($db, $link))
			return 2;

		if (strtolower($engine) == 'innodb')
		{
			$sql = 'SHOW VARIABLES WHERE Variable_name = \'have_innodb\'';
			$result = mysql_query($sql);
			if (!$result)
				return 4;
			$row = mysql_fetch_assoc($result);
			if (!$row || strtolower($row['Value']) != 'yes')
				return 4;
		}
		@mysql_close($link);

		return 0;
	}

	public static function checkCreatePrivilege($server, $user, $pwd, $db, $prefix, $engine) {
		ini_set('mysql.connect_timeout', 5);
		if (!$link = @mysql_connect($server, $user, $pwd, true))
			return false;
		if (!@mysql_select_db($db, $link))
			return false;

		$sql = '
		CREATE TABLE `' . $prefix . 'test` (
		`test` tinyint(1) unsigned NOT NULL
		) ENGINE=MyISAM';

		$result = mysql_query($sql, $link);

		if (!$result)
			return mysql_error($link);

		mysql_query('DROP TABLE `' . $prefix . 'test`', $link);

		return true;
	}

	static public function tryUTF8($server, $user, $pwd) {
		$link = @mysql_connect($server, $user, $pwd);
		if (!mysql_query('SET NAMES \'utf8\'', $link))
			$ret = false;
		else
			$ret = true;
		@mysql_close($link);

		return $ret;
	}
}
