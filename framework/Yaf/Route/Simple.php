<?php
/**
 * Yaf Route Simple
 */
class Yaf_Route_Simple implements Yaf_Route_Interface
{
    protected $_module=null;
    protected $_controller=null;
    protected $_action=null;
    /**
     * Class constructor
     * @param string $module
     * @param string $controller
     * @param string $action
     */
    public function __construct($module, $controller, $action)
    {
        if (
            !is_string($module)
            || !is_string($controller)
            || !is_string($action)
        ) {
            throw new Yaf_Exception_TypeError('Expect 3 string paramsters');
        } else {
            $this->_module = $module;
            $this->_controller = $controller;
            $this->_action = $action;
        }
    }
    /**
     * Processes a request and sets its controller and action.  If
     * no route was possible, default route is set.
     *
     * @param  Yaf_Request_Abstract
     * @return Yaf_Request_Abstract|boolean
     */

    public function route(Yaf_Request_Abstract $request)
    {
        $module = isset($_GET[$this->_module])
            ?$_GET[$this->_module]:null;
        $controller = isset($_GET[$this->_controller])
            ?$_GET[$this->_controller]:null;
        $action = isset($_GET[$this->_action])
            ?$_GET[$this->_action]:null;
        if ($module == null && $controller == null && $action == null) {
            return false;
        } else {
            if ($module!=null) {
                $request->setModuleName($module);
            }
            if ($controller!=null) {
                $request->setControllerName($controller);
            }
            if ($action!=null) {
                $request->setActionName($action);
            }
        }
        return true;
    }
    /**
     * used to create routes on the fly from config
     *
     * @param array $config
     */
    public static function getInstance(array $config)
    {
        if (!isset($config['module']) || !is_string($config['module'])) {
            return null;
        } elseif (
            !isset($config['controller'])
            || !is_string($config['controller'])
        ) {
            return null;
        } elseif (!isset($config['action']) || !is_string($config['action'])) {
            return null;
        } else {
            return new self(
                $config['module'], $config['controller'], $config['action']
            );
        }
    }
}