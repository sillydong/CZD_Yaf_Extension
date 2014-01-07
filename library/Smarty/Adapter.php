<?php

/**
 * chenzhidong
 * 2013-4-25
 */
class Smarty_Adapter implements Yaf_View_Interface {

	public $_smarty;

	public function __construct($tplPath = null, $extraParams = array()) {

		$current_dir = dirname(__FILE__);
		Yaf_Loader::import($current_dir . '/Smarty.class.php');
		Yaf_Loader::import($current_dir . '/sysplugins/smarty_internal_templatecompilerbase.php');
		Yaf_Loader::import($current_dir . '/sysplugins/smarty_internal_templatelexer.php');
		Yaf_Loader::import($current_dir . '/sysplugins/smarty_internal_templateparser.php');
		Yaf_Loader::import($current_dir . '/sysplugins/smarty_internal_compilebase.php');
		Yaf_Loader::import($current_dir . '/sysplugins/smarty_internal_write_file.php');

		$this->_smarty = new Smarty;

		if ($tplPath !== null)
		{
			$this->setScriptPath($tplPath);
		}

		if ($extraParams != null)
		{
			foreach ($extraParams as $key => $value)
			{
				if ($key == 'plugins_dir')
					$this->_smarty->$key = array_merge($this->_smarty->$key, array($value));
				else
					$this->_smarty->$key = $value;
			}
		}
	}

	public function getEngine() {
		return $this->_smarty;
	}

	public function setScriptPath($path) {
		if (is_readable($path))
		{
			$this->_smarty->template_dir = $path;
		}
		else
		{
			throw new Exception('Invalid path provided');
		}
	}

	public function getScriptPath() {
		return $this->_smarty->template_dir;
	}

	public function __set($key, $val) {
		$this->_smarty->assign($key, $val);
	}

	public function __get($key) {
		return $this->_smarty->getTemplateVars($key);
	}

	public function __isset($key) {
		return ($this->_smarty->getTemplateVars($key) !== null);
	}

	public function __unset($key) {
		$this->_smarty->clearAssign($key);
	}

	public function clearVars() {
		$this->_smarty->clearAllAssign();
	}

	public function cleanCache($name) {
		if (!empty($name))
		{
			$this->_smarty->clearCache($name);
			$this->_smarty->clearCompiledTemplate($name);
		}
		else
		{
			$this->_smarty->clearAllCache();
			$this->_smarty->clearCompiledTemplate();
		}
	}

	public function display($name, $tpl_vars = array()) {
		//die(var_dump($name));
		if (!empty($tpl_vars))
		{
			$this->assign($tpl_vars);
		}
		echo $this->_smarty->display($name);
	}

	public function assign($spec, $value = null) {
		if (is_array($spec))
		{
			$this->_smarty->assign($spec);

			return;
		}

		$this->_smarty->assign($spec, $value);
	}

	public function render($name, $tpl_vars = array()) {
		if (!empty($tpl_vars))
		{
			$this->assign($tpl_vars);
		}

		return $this->_smarty->fetch($name);
	}

	public function registerFunction($type, $function, $params) {
		if (!in_array($type, array('function', 'modifier')))
			return false;
		$this->_smarty->registerPlugin($type, $function, $params);
	}
}
