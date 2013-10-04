<?php
/**
 * Yaf Registry
 */
class Yaf_Registry
{
   /**
     * the data array
     * @var array
     */
    private static $_entrys = array();
    /**
     * @set undefined data
     * @param string $index
     * @param mixed $value
     * @return void
     */
    static public function set ($name, $value)
    {
        self::$_entrys[$name] = $value;
    }
    /**
     * @get variables
     * @param mixed $index
     * @return mixed
     */
    static public function get ($name)
    {
        if (self::has($name)) {
            return self::$_entrys[$name];
        } else {
            return null;
        }
    }
    /**
     * check if the variable is in the registry
     * @param mixed $index
     * @return mixed
     */
    static public function has ($name)
    {
        return isset(self::$_entrys[$name]);
    }
    /**
     * @del variables
     * @param mixed $index
     * @return mixed
     */
    static public function del ($name)
    {
        if (isset(self::$_entrys[$name])) {
            unset(self::$_entrys[$name]);
        }
    }
}