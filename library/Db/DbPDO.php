<?php

class DbPDO extends Db {
	public static function hasTableWithSamePrefix($server, $user, $pwd, $db, $prefix) {
		try
		{
			$link = DbPDO::_getPDO($server, $user, $pwd, $db, 5);
		} catch (PDOException $e)
		{
			return false;
		}

		$sql = 'SHOW TABLES LIKE \'' . $prefix . '%\'';
		$result = $link->query($sql);

		return (bool)$result->fetch();
	}

	public function connect() {
		try
		{
			$this->link = $this->_getPDO($this->server, $this->user, $this->password, $this->database, 5);
		} catch (PDOException $e)
		{
			die(sprintf(Tools::displayError('Link to database cannot be established: %s'), $e->getMessage()));
		}

		// UTF-8 support
		if ($this->link->exec('SET NAMES \'utf8\'') === false)
			die(Tools::displayError('Fatal error: no utf-8 support. Please check your server configuration.'));

		return $this->link;
	}

	public function disconnect() {
		unset($this->link);
	}

	public function nextRow($result = false) {
		if (!$result)
			$result = $this->result;

		return $result->fetch(PDO::FETCH_ASSOC);
	}

	public function Insert_ID() {
		return $this->link->lastInsertId();
	}

	public function Affected_Rows() {
		return $this->result->rowCount();
	}

	public function getMsgError($query = false) {
		$error = $this->link->errorInfo();

		return ($error[0] == '00000') ? '' : $error[2];
	}

	public function getNumberError() {
		$error = $this->link->errorInfo();

		return isset($error[1]) ? $error[1] : 0;
	}

	public function getVersion() {
		return $this->getValue('SELECT VERSION()');
	}

	public function _escape($str) {
		$search = array("\\", "\0", "\n", "\r", "\x1a", "'", '"');
		$replace = array("\\\\", "\\0", "\\n", "\\r", "\Z", "\'", '\"');

		return str_replace($search, $replace, $str);
	}

	public function set_db($db_name) {
		return $this->link->exec('USE ' . pSQL($db_name));
	}

	protected function _query($sql) {
		return $this->link->query($sql);
	}

	protected function _numRows($result) {
		return $result->rowCount();
	}

	public static function checkCreatePrivilege($server, $user, $pwd, $db, $prefix, $engine) {
		try
		{
			$link = DbPDO::_getPDO($server, $user, $pwd, $db, 5);
		} catch (PDOException $e)
		{
			return false;
		}

		$sql = '
		CREATE TABLE `' . $prefix . 'test` (
		`test` tinyint(1) unsigned NOT NULL
		) ENGINE=MyISAM';
		$result = $link->query($sql);
		if (!$result)
		{
			$error = $link->errorInfo();

			return $error[2];
		}
		$link->query('DROP TABLE `' . $prefix . 'test`');

		return true;
	}

	public static function tryToConnect($server, $user, $pwd, $db, $newDbLink = true, $engine = null, $timeout = 5) {
		try
		{
			$link = DbPDO::_getPDO($server, $user, $pwd, $db, $timeout);
		} catch (PDOException $e)
		{
			return ($e->getCode() == 1049) ? 2 : 1;
		}

		if (strtolower($engine) == 'innodb')
		{
			$sql = 'SHOW VARIABLES WHERE Variable_name = \'have_innodb\'';
			$result = $link->query($sql);
			if (!$result)
				return 4;
			$row = $result->fetch();
			if (!$row || strtolower($row['Value']) != 'yes')
				return 4;
		}
		unset($link);

		return 0;
	}

	public static function tryUTF8($server, $user, $pwd) {
		try
		{
			$link = DbPDO::_getPDO($server, $user, $pwd, false, 5);
		} catch (PDOException $e)
		{
			return false;
		}
		$result = $link->exec('SET NAMES \'utf8\'');
		unset($link);

		return ($result === false) ? false : true;
	}

	protected static function _getPDO($host, $user, $password, $dbname, $timeout = 5) {
		$dsn = 'mysql:';
		if ($dbname)
			$dsn .= 'dbname=' . $dbname . ';';
		if (preg_match('/^(.*):([0-9]+)$/', $host, $matches))
			$dsn .= 'host=' . $matches[1] . ';port=' . $matches[2];
		elseif (preg_match('#^.*:(/.*)$#', $host, $matches))
			$dsn .= 'unix_socket=' . $matches[1];
		else
			$dsn .= 'host=' . $host;

		return new PDO($dsn, $user, $password, array(PDO::ATTR_TIMEOUT => $timeout, PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
	}
}
