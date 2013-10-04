<?php
/**
 * Yaf Session
 */
class Yaf_Session implements Iterator, ArrayAccess, Countable
{
    /**
     * @var Yaf_Session instance
     */
    protected static $_instance;
    /**
     * @var array holds the session data
     */
    public $session;
    /**
     * @var bool whether the session was already started or not
     */
    public $started = false;

    protected function __clone()
    {

    }

    protected function __construct()
    {

    }

    /**
     * Defined by Countable interface
     *
     * @return int
     */
    public function count ()
    {
        return count($this->session);
    }

    /**
     * Defined by Iterator interface
     *
     * @return mixed
     */
    public function current ()
    {
        return current($this->session);
    }

    public function del($name)
    {
        return $this->offsetUnset($name);
    }

    public function __destruct()
    {

    }

    /**
     * Magic function so that $obj->value will work.
     *
     * @param string $name
     * @return mixed
     */
    public function __get ($name)
    {
        $result = null;
        if ($name == null) {
            return null;
        }
        if (array_key_exists($name, $this->session)) {
            $result = $this->session[$name];
        } else if (array_key_exists($name, $_SESSION)) {
            $result = $_SESSION[$name];
        }
        return $result;
    }

    /**
     * Retrieve singleton instance
     *
     * @return Yaf_Session
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
            self::start();
        }
        return self::$_instance;
    }

    public function has($name)
    {
        return $this->offsetExists($name);
    }

    /**
     * Support isset() overloading on PHP 5.1
     *
     * @param string $name
     * @return boolean
     */
    public function __isset ($name)
    {
        return (isset($this->session[$name])?true:isset($_SESSION[$name]));
    }

    /**
     * Defined by Iterator interface
     *
     * @return mixed
     */
    public function key ()
    {
        return key($this->session);
    }
    /**
     * Defined by Iterator interface
     *
     */
    public function next ()
    {
        next($this->session);
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
     * Return a session value specified by name
     * @param  string $name
     * @return mixed
     */
    public function offsetGet ($name)
    {
        return $this->__get($name);
    }
    /**
     * Set a key of the session with value
     * @param  string $name
     * @param  string $value
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
     * @return void
     */
    public function offsetUnset ($name)
    {
        unset($this->session[$name]);
        unset($_SESSION[$name]);
    }

    /**
     * Defined by Iterator interface
     *
     */
    public function rewind ()
    {
        reset($this->session);
    }
    /**
     * Allow setting of a session variable.
     * Throw an exception if the name is not string.
     *
     * @param  string $name
     * @param  mixed  $value
     * @throws Yaf_Exception
     * @return void
     */
    public function __set ($name, $value)
    {
        if (is_string($name)) {
            $this->session[$name] = $value;
            $_SESSION[$name] = $value;
        } else {
            throw new Yaf_Exception('Expect a string key name');
        }
    }

    protected function __sleep()
    {

    }

    /**
     * Starts the session
     */
    public static function start()
    {
        $session = self::getInstance();
        if ($session->started == true) {
            return true;
        } else {
            session_start();
            $session->started = true;
            $session->session = $_SESSION;
        }
    }
    /**
     * Support unset() overloading on PHP 5.1
     *
     * @param  string $name
     * @return void
     */
    public function __unset($name)
    {
        unset($this->session[$name]);
    }
    /**
     * Defined by Iterator interface
     *
     * @return boolean
     */
    public function valid ()
    {
        $key = key($this->session);
        return ($key == null || $key == false) ? false: true;
    }

    protected function __wakeup()
    {

    }
}