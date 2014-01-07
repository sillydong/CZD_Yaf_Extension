<?php

/**
 * just a sample model showing how to use Object and Db
 * chenzhidong
 * 2013-4-27
 */
class SampleModel extends Object {

	public $email;
	public $nick;
	public $passwd;
	public $ip_address;
	public $date_add;
	public $date_update;
	public $active = 1;

	protected $def = array(
			'table' => 'user',
			'primary' => 'id_user',
			'fields' => array(
					'email' => array('type' => self::TYPE_STRING, 'validate' => 'isEmail', 'size' => 32),
					'nick' => array('type' => self::TYPE_STRING, 'validate' => 'isName', 'required' => true, 'size' => 32),
					'alias' => array('type' => self::TYPE_STRING, 'validate' => 'isAlias', 'size' => 12),
					'passwd' => array('type' => self::TYPE_STRING, 'validate' => 'isMd5', 'size' => 128),
					'ip_address' => array('type' => self::TYPE_STRING, 'validate' => 'isIpAddress', 'required' => true),
					'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate', 'required' => true),
					'date_update' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
					'active' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true),
			),
			'skip_update' => array('ip_address', 'date_add')
	);

	protected function extraConstruct() {
		//do something after __construct()
		$this->something = 'something';
	}

	public function setPassword($password) {
		if (Validate::isPasswd($password))
		{
			$this->passwd = md5($password);
		}
	}

	protected function afterAdd() {
		//do something after delete object
	}

	protected function afterUpdate() {
		//do something after update object
	}

	/**
	 * a sample for static function and Db::getInstance(false|true)->getValue() usages
	 *
	 * @param $email
	 *
	 * @return bool|mixed
	 */
	public static function getIdByEmail($email) {
		if (Validate::isEmail($email))
		{
			$sql = "select id_user from user where email='" . pSQL($email) . "'";
			$result = Db::getInstance(false)->getValue($sql);
			if ($result)
			{
				return $result;
			}
		}

		return false;
	}

	public static function emailExists($email) {
		if (Validate::isEmail($email))
		{
			$sql = "select id_user from user where email='" . pSQL($email) . "'";
			$result = Db::getInstance(false)->getValue($sql);
			if ($result)
			{
				return new SampleModel($result);
			}
		}

		return false;
	}

	public static function authorize($passwd, $email, $nick, $phone) {
		$way = '';
		if (!empty($email))
		{
			$way = $email;
			$sql = "select id_user,passwd from user where email='" . pSQL($email) . "'";
		}
		elseif (!empty($nick))
		{
			$way = $nick;
			$sql = "select id_user,passwd from user where nick='" . pSQL($nick) . "'";
		}
		elseif (!empty($phone))
		{
			$way = $phone;
			$sql = "select id_user,passwd from user where phone='" . pSQL($phone) . "'";
		}
		else
		{
			return array('way' => '', 'msg' => 'missing parameter', 'code' => 2);
		}
		$result = Db::getInstance(true)->getRow($sql);
		if (!$result || !is_array($result))
		{
			return array('way' => $way, 'msg' => 'not exists', 'code' => 3);
		}
		else
		{
			if ((string)$result['passwd'] === (string)md5($passwd))
			{
				return array('way' => $way, 'msg' => 'authorized', 'code' => 1, 'user' => new SampleModel($result['id_user']));
			}
			else
			{
				return array('way' => $way, 'msg' => 'password error', 'code' => 4);
			}
		}
	}

	public static function getUsers() {
		$sql = "select * from user";
		$result = Db::getInstance(false)->executeS($sql);
		if ($result)
		{
			return $result;
		}

		return false;
	}

	public function selectSample() {
		return 'sample';
	}
}
