<?php

abstract class Db {

	const INSERT = 1;
	const INSERT_IGNORE = 2;
	const REPLACE = 3;

	protected $server;

	protected $user;

	protected $password;

	protected $database;

	protected $is_cache_enabled;

	protected $log_error;

	protected $link;

	protected $result;

	protected static $instance = array();

	protected static $_servers = array();

	protected $last_query;

	protected $last_cached;

	abstract public function connect();

	abstract public function disconnect();

	abstract protected function _query($sql);

	abstract protected function _numRows($result);

	abstract public function Insert_ID();

	abstract public function Affected_Rows();

	abstract public function nextRow($result = false);

	abstract public function getVersion();

	abstract public function _escape($str);

	abstract public function getMsgError();

	abstract public function getNumberError();

	abstract public function set_db($db_name);

	/**
	 * 获取Db实例，可选择主从
	 *
	 * @param bool $master
	 *
	 * @return mixed
	 */
	public static function getInstance($master = true) {
		static $id = 0;

		if (self::$_servers == null)
		{
			self::$_servers = Yaf_Registry::get('database');
		}

		$id_server = ($master || count(self::$_servers) == 1) ? 0 : 1;

		if (!isset(self::$instance[$id_server]))
		{
			$class = Db::getClass();
			include_once(dirname(__FILE__) . '/' . $class . '.php');
			self::$instance[$id_server] = new $class(self::$_servers[$id_server]['server'], self::$_servers[$id_server]['user'], self::$_servers[$id_server]['password'], self::$_servers[$id_server]['database']);
		}

		return self::$instance[$id_server];
	}

	public static function getClass() {
		$class = 'MySQL';
		if (PHP_VERSION_ID >= 50200 && extension_loaded('pdo_mysql'))
			$class = 'DbPDO';
		else if (extension_loaded('mysqli'))
			$class = 'DbMySQLi';

		return $class;
	}

	public function __construct($server, $user, $password, $database, $connect = true) {
		$this->server = $server;
		$this->user = $user;
		$this->password = $password;
		$this->database = $database;
		$this->is_cache_enabled = (defined('MYSQL_CACHE_ENABLE')) ? MYSQL_CACHE_ENABLE : false;
		$this->log_error = (defined('MYSQL_LOG_ERROR') ? MYSQL_LOG_ERROR : false);

		if ($connect)
			$this->connect();
	}

	public function __destruct() {
		if ($this->link)
			$this->disconnect();
	}

	public function query($sql) {
		if ($sql instanceof DbQuery)
			$sql = $sql->build();

		$this->result = $this->_query($sql);
		if (!$this->result && $this->getNumberError() == 2006)
		{
			if ($this->connect())
				$this->result = $this->_query($sql);
		}
		if ($this->log_error)
		{
			$this->logError($sql);
		}

		return $this->result;
	}

	/**
	 * 插入
	 *
	 * @param      $table
	 * @param      $data
	 * @param bool $null_values
	 * @param bool $use_cache
	 * @param int  $type
	 *
	 * @return bool
	 */
	public function insert($table, $data, $null_values = false, $use_cache = true, $type = Db::INSERT) {
		if (!$data && !$null_values)
			return true;

		if ($type == Db::INSERT)
			$insert_keyword = 'INSERT';
		else if ($type == Db::INSERT_IGNORE)
			$insert_keyword = 'INSERT IGNORE';
		else if ($type == Db::REPLACE)
			$insert_keyword = 'REPLACE';
		else
			die(Tools::displayError('SQL Error'));

		// Check if $data is a list of row
		$current = current($data);
		if (!is_array($current) || isset($current['type']))
			$data = array($data);

		$keys = array();
		$values_stringified = array();
		foreach ($data as $row_data)
		{
			$values = array();
			foreach ($row_data as $key => $value)
			{
				if (isset($keys_stringified))
				{
					// Check if row array mapping are the same
					if (!in_array("`$key`", $keys))
						die(Tools::displayError('Keys form $data subarray don\'t match'));
				}
				else
					$keys[] = "`$key`";

				if (!is_array($value))
					$value = array('type' => 'text', 'value' => $value);
				if ($value['type'] == 'sql')
					$values[] = $value['value'];
				else
					$values[] = $null_values && ($value['value'] === '' || is_null($value['value'])) ? 'NULL' : "'{$value['value']}'";
			}
			$keys_stringified = implode(', ', $keys);
			$values_stringified[] = '(' . implode(', ', $values) . ')';
		}

		$sql = $insert_keyword . ' INTO `' . $table . '` (' . $keys_stringified . ') VALUES ' . implode(', ', $values_stringified);

		return (bool)$this->q($sql, $use_cache);
	}

	/**
	 * update
	 *
	 * @param        $table
	 * @param        $data
	 * @param string $where
	 * @param int    $limit
	 * @param bool   $null_values
	 * @param bool   $use_cache
	 *
	 * @return bool
	 */
	public function update($table, $data, $where = '', $limit = 0, $null_values = false, $use_cache = true) {
		if (!$data)
			return true;

		$sql = 'UPDATE `' . $table . '` SET ';
		foreach ($data as $key => $value)
		{
			if (!is_array($value))
				$value = array('type' => 'text', 'value' => $value);
			if ($value['type'] == 'sql')
				$sql .= "`$key` = {$value['value']},";
			else
				$sql .= ($null_values && ($value['value'] === '' || is_null($value['value']))) ? "`$key` = NULL," : "`$key` = '{$value['value']}',";
		}

		$sql = rtrim($sql, ',');
		if ($where)
			$sql .= ' WHERE ' . $where;
		if ($limit)
			$sql .= ' LIMIT ' . (int)$limit;

		return (bool)$this->q($sql, $use_cache);
	}

	/**
	 * delete
	 *
	 * @param        $table
	 * @param string $where
	 * @param int    $limit
	 * @param bool   $use_cache
	 *
	 * @return bool
	 */
	public function delete($table, $where = '', $limit = 0, $use_cache = true) {

		$this->result = false;
		$sql = 'DELETE FROM `' . bqSQL($table) . '`' . ($where ? ' WHERE ' . $where : '') . ($limit ? ' LIMIT ' . (int)$limit : '');
		$res = $this->query($sql);
		if ($use_cache && $this->is_cache_enabled)
			Cache::getInstance()->deleteQuery($sql);

		return (bool)$res;
	}

	/**
	 * insert/delete/update
	 *
	 * @param      $sql
	 * @param bool $use_cache
	 *
	 * @return bool
	 */
	public function execute($sql, $use_cache = true) {
		if ($sql instanceof DbQuery)
			$sql = $sql->build();

		$this->result = $this->query($sql);
		if ($use_cache && $this->is_cache_enabled)
			Cache::getInstance()->deleteQuery($sql);

		return (bool)$this->result;
	}

	/**
	 * 执行select操作
	 *
	 * @param      $sql
	 * @param bool $array
	 * @param bool $use_cache
	 *
	 * @return array|bool|mixed
	 */
	public function executeS($sql, $array = true, $use_cache = true) {
		if ($sql instanceof DbQuery)
			$sql = $sql->build();

		// This method must be used only with queries which display results
		if (!preg_match('#^\s*\(?\s*(select|show|explain|describe|desc)\s#i', $sql))
		{
			return $this->execute($sql, $use_cache);
		}

		$this->result = false;
		$this->last_query = $sql;
		if ($use_cache && $this->is_cache_enabled && $array && ($result = Cache::getInstance()->get(md5($sql))))
		{
			$this->last_cached = true;

			return $result;
		}

		$this->result = $this->query($sql);
		if (!$this->result)
			return false;

		$this->last_cached = false;
		if (!$array)
			return $this->result;

		$result_array = array();
		while ($row = $this->nextRow($this->result))
			$result_array[] = $row;

		if ($use_cache && $this->is_cache_enabled)
			Cache::getInstance()->setQuery($sql, $result_array);

		return $result_array;
	}

	/**
	 * 限制select一行数据
	 *
	 * @param      $sql
	 * @param bool $use_cache
	 *
	 * @return bool|mixed
	 */
	public function getRow($sql, $use_cache = true) {
		if ($sql instanceof DbQuery)
			$sql = $sql->build();

		if (stripos($sql, ' limit ') === false)
		{
			$sql .= ' LIMIT 1';
		}
		$this->result = false;
		$this->last_query = $sql;
		if ($use_cache && $this->is_cache_enabled && ($result = Cache::getInstance()->get(md5($sql))))
		{
			$this->last_cached = true;

			return $result;
		}

		$this->result = $this->query($sql);
		if (!$this->result)
			return false;

		$this->last_cached = false;
		$result = $this->nextRow($this->result);
		if ($use_cache && $this->is_cache_enabled)
			Cache::getInstance()->setQuery($sql, $result);

		return $result;
	}

	/**
	 * 获取值
	 *
	 * @param      $sql
	 * @param bool $use_cache
	 *
	 * @return bool|mixed
	 */
	public function getValue($sql, $use_cache = true) {
		if ($sql instanceof DbQuery)
			$sql = $sql->build();

		if (!$result = $this->getRow($sql, $use_cache))
			return false;

		return array_shift($result);
	}

	/**
	 * 查询结果行数
	 *
	 * @return bool|mixed
	 */
	public function numRows() {
		if (!$this->last_cached && $this->result)
		{
			$nrows = $this->_numRows($this->result);
			if ($this->is_cache_enabled)
				Cache::getInstance()->set(md5($this->last_query) . '_nrows', $nrows);

			return $nrows;
		}
		else if ($this->is_cache_enabled && $this->last_cached)
			return Cache::getInstance()->get(md5($this->last_query) . '_nrows');

		return 0;
	}

	protected function q($sql, $use_cache = true) {
		if ($sql instanceof DbQuery)
			$sql = $sql->build();

		$this->result = false;
		$result = $this->query($sql);
		if ($use_cache && $this->is_cache_enabled)
			Cache::getInstance()->deleteQuery($sql);

		return $result;
	}

	public function escape($string, $html_ok = false) {
		if (get_magic_quotes_gpc())
			$string = stripslashes($string);
		if (!is_numeric($string))
		{
			$string = $this->_escape($string);
			if (!$html_ok)
				$string = strip_tags(Tools::nl2br($string));
		}

		return $string;
	}

	public function nextId($table_name) {
		return $this->getValue("select AUTO_INCREMENT from information_schema.TABLES where TABLE_SCHEMA='" . $this->database . "' and TABLE_NAME='" . pSQL($table_name) . "'");
	}

	protected function logError($sql = false) {
		if ($this->getNumberError())
		{
			Log::out('sql_error', 'E', $this->getMsgError() . ':' . $sql);
		}
	}

	public static function checkConnection($server, $user, $pwd, $db, $new_db_link = true, $engine = null, $timeout = 5) {
		return call_user_func_array(array(Db::getClass(), 'tryToConnect'), array($server, $user, $pwd, $db, $new_db_link, $engine, $timeout));
	}

	public static function checkEncoding($server, $user, $pwd) {
		return call_user_func_array(array(Db::getClass(), 'tryUTF8'), array($server, $user, $pwd));
	}

	public static function hasTableWithSamePrefix($server, $user, $pwd, $db, $prefix) {
		return call_user_func_array(array(Db::getClass(), 'hasTableWithSamePrefix'), array($server, $user, $pwd, $db, $prefix));
	}

}
