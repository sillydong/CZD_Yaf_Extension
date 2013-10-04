<?php
/**
 * Yaf router supervar
 *
 */
class Yaf_Route_Supervar implements Yaf_Route_Interface
{

    protected $_varName = '';

    /**
     * Class constructor
     *
     */
    public function __construct($varName)
    {
        if (!is_string($varName) || $varName=='') {
            throw new Yaf_Exception_TypeError(
                'Expects a string super var name'
            );
        } else {
            $this->_varName = $varName;
        }
    }


     /**
     * Processes a request and sets its controller and action based on a
     * supervar value.
     *
     * @param  Yaf_Request_Abstract
     * @return Yaf_Request_Abstract|boolean
     */
    public function route(Yaf_Request_Abstract $request)
    {
        $requestUri = $request->getQuery($this->_varName);
        if ($requestUri==null || $requestUri=='') {
            return false;
        }
        $module = null;
        $controller = null;
        $action = null;
        $rest = null;
        $path = trim($requestUri, Yaf_Router::URI_DELIMITER);
        if ($path != '' && $path!='/') {
            $path = explode(Yaf_Router::URI_DELIMITER, $path);
            if (Yaf_Application::isModuleName($path[0])) {
                $module = $path[0];
                array_shift($path);
            }

            if (count($path) && !empty($path[0])) {
                $controller = $path[0];
                array_shift($path);
            }

            if (count($path) && !empty($path[0])) {
                $action = $path[0];
                array_shift($path);
            }
            $rest = implode(Yaf_Router::URI_DELIMITER, $path);
            $actionPrefer = Yaf_G::iniGet('yaf.action_prefer');

            if ($module == null && $controller == null && $action == null) {
                if ($actionPrefer == true) {
                    $action = $rest;
                } else {
                    $controller = $rest;
                }
                $rest = null;
            } elseif ($module == null && $action == null && $rest == null) {
                if ($actionPrefer == true) {
                    $action = $controller;
                    $controller = null;
                }
            } elseif ($controller == null && $action == null && $rest != null) {
                $controller = $module;
                $action = $rest;
                $module = null;
                $rest = null;
            } elseif ($action == null && $rest == null) {
                $action = $controller;
                $controller = $module;
                $module = null;
            } elseif ($controller == null && $action == null) {
                $controller = $module;
                $action = $rest;
                $module = null;
                $rest = null;
            } elseif ($action == null) {
                $action = $rest;
                $rest = null;
            }

            if ($module != null) {
                $request->setModuleName($module);
            }
            if ($controller != null) {
                $request->setControllerName($controller);
            }
            if ($action != null) {
                $request->setActionName($action);
            }
            $params = array();
            if ($rest!=null && trim($rest)!='') {
                $path = explode(Yaf_Router::URI_DELIMITER, $rest);
                if (($numSegs = count($path))!=0) {
                    for ($i = 0; $i < $numSegs; $i = $i + 2) {
                        $key = urldecode($path[$i]);
                        $val = isset($path[$i + 1]) ?
                            urldecode($path[$i + 1]) : null;
                        $params[$key] = (isset($params[$key])
                            ? (array_merge((array) $params[$key], array($val)))
                            : $val);
                    }
                }
                $request->setParam($params);
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
        if (!is_string($config['varname']) || $config['varname']=='') {
            return null;
        }
        return new self($config['varname']);
    }

}
