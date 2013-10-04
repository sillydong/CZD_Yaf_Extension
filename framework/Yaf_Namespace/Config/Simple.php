<?php
/**
 * Yaf Config Simple
 */

/**
 * @namespace
 */
namespace Yaf\Config;

class Simple extends \Yaf\Config_Abstract implements
    \Iterator, \ArrayAccess, \Countable
{
    /**
     * Used when unsetting values during iteration to ensure we do not skip
     * the next element
     *
     * @var boolean
     */
    protected $_skipNextIteration;

    /**
     * Yaf_Config_Simple provides a property based interface to
     * an array. The data are read-only unless $readonly
     * is set to true on construction.
     *
     * Yaf_Config_Simple also implements Countable and Iterator to
     * facilitate easy access to the data.
     *
     * @param  array   $array
     * @param  boolean $readonly
     * @return void
     */
    public function __construct ($config, $readonly = false)
    {
        if (is_array($config)) {
            $this->_config = array();
            foreach ($config as $key => $value) {
                if (is_array($value)) {
                    $this->_config[$key] = new self($value, $readonly);
                } else {
                    $this->_config[$key] = $value;
                }
            }
        } else {
            throw new \Yaf\Exception\TypeError(
                'Invalid parameters provided, must be an array'
            );
        }
        //if (is_bool($readonly)) {
            $this->_readonly = (bool)$readonly;
        //}
    }
    /**
     * Defined by Countable interface
     *
     * @return int
     */
    public function count ()
    {
        return count($this->_config);
    }
    /**
     * Defined by Iterator interface
     *
     * @return mixed
     */
    public function current ()
    {
        $this->_skipNextIteration = false;
        return current($this->_config);
    }
    /**
     * Magic function so that $obj->value will work.
     *
     * @param string $name
     * @return mixed
     */
    public function __get ($name)
    {
        return $this->get($name);
    }
    /**
     * Support isset() overloading on PHP 5.1
     *
     * @param string $name
     * @return boolean
     */
    public function __isset ($name)
    {
        return isset($this->_config[$name]);
    }
    /**
     * Support isset() overloading on PHP 5.1
     *
     * @param string $name
     * @return boolean
     */
    public function offsetExists ($name)
    {
        return $this->__isset($name);
    }
    /**
     * Return a config value specified by name
     * @param  string $name
     * @return mixed
     */
    public function offsetGet ($name)
    {
        return $this->__get($name);
    }
    /**
     * Set a key of the config with value
     * @param  string $name
     * @param  string $value
     * @throws Yaf_Config_Exception
     * @return void
     */
    public function offsetSet ($name, $value)
    {
        return $this->__set($name, $value);
    }
    /**
     * Support unset() overloading on PHP 5.1
     *
     * @param  string $name
     * @throws Yaf_Config_Exception
     * @return void
     */
    public function offsetUnset ($name)
    {
        if (! $this->readonly()) {
            unset($this->_config[$name]);
        } else {
            //do nothing for now as Yaf is doing the same
            //throw new Yaf_Config_Exception('Config is read only');
        }
    }
    /**
     * Defined by Iterator interface
     *
     * @return mixed
     */
    public function key ()
    {
        return key($this->_config);
    }
    /**
     * Defined by Iterator interface
     *
     */
    public function next ()
    {
        if ($this->_skipNextIteration) {
            $this->_skipNextIteration = false;
            return;
        }
        next($this->_config);
    }
    /**
     * Defined by Iterator interface
     *
     */
    public function rewind ()
    {
        $this->_skipNextIteration = false;
        reset($this->_config);
    }
    /**
     * Only allow setting of a property if $readonly
     * was set to true on construction. Otherwise, throw an exception.
     *
     * @param  string $name
     * @param  mixed  $value
     * @throws Yaf_Config_Exception
     * @return void
     */
    public function __set ($name, $value)
    {
        if (! $this->readonly()) {
            if (is_string($name)) {
                if (is_array($value)) {
                    $this->_config[$name] = new self($value, false);
                } else {
                    $this->_config[$name] = $value;
                }
            } else {
                throw new Exception('Expect a string key name');
            }
        } else {
            //do nothing for now as Yaf is doing the same
            //throw new Yaf_Config_Exception('Config is read only');
        }
    }
    /**
     * Return an associative array of the stored data.
     *
     * @return array
     */
    public function toArray ()
    {
        $array = array();
        $data = $this->_config;
        foreach ($data as $key => $value) {
            if ($value instanceof Simple) {
                $array[$key] = $value->toArray();
            } else {
                $array[$key] = $value;
            }
        }
        return $array;
    }
    /**
     * Defined by Iterator interface
     *
     * @return boolean
     */
    public function valid ()
    {
        $key = key($this->_config);
        return ($key == null || $key == false) ? false: true;
    }
    /**
     * Support unset() overloading on PHP 5.1
     *
     * @param  string $name
     * @throws Yaf_Config_Exception
     * @return void
     */
    public function __unset($name)
    {
        if (!$this->readonly()) {
            unset($this->_config[$name]);
            $this->_skipNextIteration = true;
        } else {
            throw new Exception('Config is read only');
        }

    }
    /**
     * Retrieve a value and return $default if there is no element set.
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function get ($name)
    {
        $result = false;
        if (array_key_exists($name, $this->_config)) {
            $result = $this->_config[$name];
        }
        if (is_array($result)) {
            $result = new self($result, $this->readonly());
        }
        return $result;
    }
    /**
     * Only allow setting of a property if $readonly
     * was set to true on construction. Otherwise, throw an exception.
     *
     * @param  string $name
     * @param  mixed  $value
     * @throws Yaf_Config_Exception
     * @return void
     */
    public function set ($name, $value)
    {
        return $this->__set($name, $value);
    }
    /**
     * Merge two arrays recursively, overwriting keys of the same name
     * in $firstArray with the value in $secondArray.
     *
     * @param  mixed $firstArray  First array
     * @param  mixed $secondArray Second array to merge into first array
     * @return array
     */
    protected function _arrayMergeRecursive($firstArray, $secondArray)
    {
        if (is_array($firstArray) && is_array($secondArray)) {
            foreach ($secondArray as $key => $value) {
                if (isset($firstArray[$key])) {
                    $firstArray[$key] = $this->_arrayMergeRecursive(
                        $firstArray[$key], $value
                    );
                } else {
                    if ($key === 0) {
                        $firstArray= array(
                            0 => $this->_arrayMergeRecursive(
                                $firstArray, $value
                            )
                        );
                    } else {
                        $firstArray[$key] = $value;
                    }
                }
            }
        } else {
            $firstArray = $secondArray;
        }

        return $firstArray;
    }
}