<?php

abstract class Object {

	const TYPE_INT = 1;
	const TYPE_BOOL = 2;
	const TYPE_STRING = 3;
	const TYPE_FLOAT = 4;
	const TYPE_DATE = 5;
	const TYPE_HTML = 6;
	const TYPE_NOTHING = 7;

	const CACHE_PREFIX_MODEL = '_model_';
	const CACHE_PREFIX_SEARCH = '_search_';

	public $id;
	protected $def = array();
	protected $class_name;

	protected static $is_cache_enabled;
	protected static $db = false;

	public function __construct($id = null, $enable_hook = true) {
		$this->class_name = get_class($this);
		if (!Object::$db)
		{
			Object::$db = Db::getInstance();
		}
		self::$is_cache_enabled = (defined('OBJECT_CACHE_ENABLE') ? OBJECT_CACHE_ENABLE : false);

		if (isset($id) && Validate::isUnsignedId($id))
		{
			$cache_id = $this->class_name . self::CACHE_PREFIX_MODEL . (int)$id;
			if (!Cache::isStored($cache_id))
			{
				$sql = new DbQuery();
				$sql->from($this->def['table'], 'a');
				$sql->where('a.' . $this->def['primary'] . '=' . (int)$id);
				if ($object_datas = Object::$db->getRow($sql))
				{
					Cache::store($cache_id, $object_datas);
				}
			}
			else
			{
				$object_datas = Cache::retrieve($cache_id);
			}

			if ($object_datas)
			{
				$this->id = (int)$id;
				foreach ($object_datas as $key => $value)
				{
					if (array_key_exists($key, $this))
					{
						$this->{$key} = $value;
					}
				}
			}
			if ($enable_hook && method_exists($this, 'extraConstruct'))
			{
				$this->extraConstruct();
			}
		}
	}

	public function validateFields($die = false, $error_return = true) {
		foreach ($this->def['fields'] as $field => $data)
		{

			$message = $this->validateField($field, $this->$field);
			if ($message !== true)
			{
				if ($die)
					throw new Exception($message);

				return $error_return ? $message : false;
			}
		}

		return true;
	}

	protected function validateField($field, $value) {
		$data = $this->def['fields'][$field];

		if (!isset($value) && isset($data['default']))
		{
			$value = $data['default'];
			$this->$field = $value;
		}

		if (!isset($value) && isset($data['required']) && $data['required'] == true)
		{
			return $this->class_name . '->' . $field . ' is required';
		}

		if (isset($value))
		{
			if (!empty($data['values']) && is_array($data['values']) && !in_array($value, $data['values']))
				return $this->class_name . '->' . $field . ':' . $value . ' is bad value (allowed values are: ' . implode(', ', $data['values']) . ')';

			if (!empty($data['size']))
			{
				$size = $data['size'];
				if (!is_array($data['size']))
					$size = array('min' => 0, 'max' => $data['size']);

				$length = Tools::strlen($value);
				if ($length < $size['min'] || $length > $size['max'])
				{
					if (isset($data['cut']) && $data['cut'] == true)
					{
						$value = Tools::substr($value, 0, $size['max']);
					}
					else
					{
						return $this->class_name . '->' . $field . ' length (' . $length . ') must be between ' . $size['min'] . ' and ' . $size['max'];
					}
				}
			}

			if (!empty($data['validate']))
			{
				if (!method_exists('Validate', $data['validate']))
					throw new Exception('Validation function not found. ' . $data['validate']);

				if (!empty($value) && !call_user_func(array('Validate', $data['validate']), $value))
					return $this->class_name . '->' . $field . ':' . $value . ' is not valid';
			}
		}

		return true;
	}

	protected function formatFields($skip_update = false) {
		$fields = array();

		if ($skip_update && !isset($this->def['skip_update']))
		{
			$skip_update = false;
		}

		if (isset($this->id) && Validate::isUnsignedId($this->id))
			$fields[$this->def['primary']] = $this->id;

		foreach ($this->def['fields'] as $field => $data)
		{
			if (!$skip_update || !in_array($field, $this->def['skip_update']))
			{
				$fields[$field] = $this->formatValue($this->$field, $data['type']);
			}
		}

		return $fields;
	}

	protected function formatValue($value, $type, $with_quotes = false) {
		switch ($type)
		{
			case self::TYPE_INT :
				return (int)$value;

			case self::TYPE_BOOL :
				return (int)$value;

			case self::TYPE_FLOAT :
				return (float)str_replace(',', '.', $value);

			case self::TYPE_DATE :
				if (!$value)
					return '0000-00-00';

				if ($with_quotes)
					return '\'' . pSQL($value) . '\'';

				return pSQL($value);

			case self::TYPE_HTML :
				if ($with_quotes)
					return '\'' . pSQL($value, true) . '\'';

				return pSQL($value, true);

			case self::TYPE_NOTHING :
				return $value;

			case self::TYPE_STRING :
			default :
				if ($with_quotes)
					return '\'' . pSQL($value) . '\'';

				return pSQL($value);
		}
	}

	public function getFields($skip_validation = false, $skip_update = false) {
		$info = true;
		if (!$skip_validation)
			$info = $this->validateFields();
		if ($info === true)
		{
			$fields = $this->formatFields($skip_update);

			return $fields;
		}

		return $info;
	}

	public function setDatas(array $data) {
		if (isset($data[$this->def['primary']]))
			$this->id = $data[$this->def['primary']];
		foreach ($data as $key => $value)
		{
			if (property_exists($this, $key))
				$this->$key = $value;
		}
	}

	public function add($skip_validation = false, $enable_hook = true, $autodate = true, $null_values = false) {
		if (!Object::$db)
			Object::$db = Db::getInstance();

		if ($enable_hook && method_exists($this, 'beforeAdd'))
		{
			$this->beforeAdd();
		}
		if ($autodate && property_exists($this, 'date_add') && empty($this->date_add))
		{
			$this->date_add = date('Y-m-d H:i:s');
		}
		if ($autodate && property_exists($this, 'date_update') && empty($this->date_update))
		{
			$this->date_update = date('Y-m-d H:i:s');
		}
		if (isset($this->id) && !Tools::getValue('forceIDs'))
			unset($this->id);
		$fields = $this->getFields($skip_validation);
		if (!is_array($fields))
		{
			Log::out('fieldserror', 'E', $fields);

			return 'Fields error:' . $fields;
		}
		if (!$result = Object::$db->insert($this->def['table'], $fields, $null_values))
		{
			return 'Add object db error';
		}

		$this->id = Object::$db->Insert_ID();
		if ($enable_hook && method_exists($this, 'afterAdd'))
		{
			$this->afterAdd();
		}
		$this->cleanCache(false, true);

		return true;
	}

	public function update($skip_validation = false, $enable_hook = true, $null_values = false) {
		if (!Object::$db)
			Object::$db = Db::getInstance();

		if ($enable_hook && method_exists($this, 'beforeUpdate'))
		{
			$this->beforeUpdate();
		}
		if (property_exists($this, 'date_update'))
			$this->date_update = date('Y-m-d H:i:s');

		$fields = $this->getFields($skip_validation, true);
		if (!is_array($fields))
		{
			Log::out('fieldserror', 'E', $fields);

			return 'Fields error' . $fields;
		}

		if (!$result = Object::$db->update($this->def['table'], $fields, '`' . pSQL($this->def['primary']) . '` = ' . (int)$this->id, 0, $null_values))
			return 'Add object db error';

		if ($enable_hook && method_exists($this, 'afterUpdate'))
		{
			$this->afterUpdate();
		}
		$this->cleanCache(true, true);

		return true;
	}

	public function delete($enable_hook = true) {
		if (!Object::$db)
			Object::$db = Db::getInstance();
		if ($enable_hook && method_exists($this, 'beforeDelete'))
		{
			$this->beforeDelete();
		}
		if (!$result = Object::$db->delete($this->def['table'], '`' . $this->def['primary'] . '`=' . (int)$this->id))
		{
			return false;
		}
		if ($enable_hook && method_exists($this, 'afterDelete'))
		{
			$this->afterDelete();
		}
		$this->cleanCache(true, true);

		return true;
	}

	protected function extraConstruct() { }

	protected function beforeAdd() { }

	protected function afterAdd() { }

	protected function beforeDelete() { }

	protected function afterDelete() { }

	protected function beforeUpdate() { }

	protected function afterUpdate() { }

	public function deleteSelection($selection) {
		$result = true;
		foreach ($selection as $id)
		{
			$this->id = (int)$id;
			$result = $result && $this->delete();
		}

		return $result;
	}

	public function toggleActive() {
		if (!property_exists($this, 'active'))
			throw new Exception('property "active" is missing in object ' . $this->class_name);

		$this->active = !(int)$this->active;
		$sql = "update " . $this->def['table'] . " set active=" . (int)$this->active . " where " . $this->def['primary'] . "=" . (int)$this->id;
		if (Object::$db->execute($sql))
		{
			$this->cleanCache(true, true);

			return true;
		}

		return false;
	}

	public function toggleStatus() {
		if (!property_exists($this, 'status'))
			throw new Exception('property "status" is missing in object ' . $this->class_name);

		$this->status = !(int)$this->status;
		$sql = "update " . $this->def['table'] . " set status=" . (int)$this->status . " where " . $this->def['primary'] . "=" . (int)$this->id;
		if (Object::$db->execute($sql))
		{
			$this->cleanCache(true, true);

			return true;
		}

		return false;
	}

	public function cleanCache($module, $search) {
		if (self::$is_cache_enabled)
		{
			if ($module)
				Cache::clean($this->class_name . self::CACHE_PREFIX_MODEL . $this->id);
			if ($search)
				Cache::clean($this->class_name . self::CACHE_PREFIX_SEARCH . '*');
		}
	}

	public static function existsInDatabase($id_entity, $table) {
		$row = Db::getInstance()->getRow('
				SELECT `id_' . pSQL($table) . '` as id
				FROM `' . pSQL($table) . '` e
				WHERE e.`id_' . pSQL($table) . '` = ' . (int)$id_entity);

		return isset($row['id']);
	}

	public static function isCurrentlyUsed($table = null, $has_active_column = false) {
		if ($table === null)
			$table = self::$def['table'];

		$query = new DbQuery();
		$query->select('`id_' . pSQL($table) . '`');
		$query->from($table);
		if ($has_active_column)
			$query->where('`active` = 1');

		return (bool)Db::getInstance()->getValue($query);
	}
}

?>
