<?php
/**
 * Yaf Config Abstract
 */
abstract class Yaf_Config_Abstract
{
    /**
     * holds the config array
     * @var array
     */
    protected $_config=array();
    /**
	 * Whether the config is  readonly and cannot be changed/modified
	 * true means canmot be changed
	 * false means can be changed
	 * @var boolean
     */
    protected $_readonly=false;

    abstract public function get($name);
    abstract public function set($name, $value);
    public function readonly()
    {
        return $this->_readonly;
    }
    abstract public function toArray();
}