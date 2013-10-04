<?php
/**
 * StaticRoute is used for managing static URIs.
 *
 */

/**
 * @namespace
 */
namespace Yaf;

class Route_Static implements Route_Interface
{
    /**
     * Class constructor
     *
     */
    public function __construct()
    {
    }

    /**
     * @todo this method is not used anywhere
     *
     * @param string $uri
     * @return bool
     */
    public function match($uri)
    {
        return true;
    }

     /**
     * Processes a request and sets its controller and action.  If
     * no route was possible, default route is set.
     *
     * @param  Yaf_Request_Abstract
     * @return Yaf_Request_Abstract|boolean
     */
    public function route(Request_Abstract $request)
    {
        $requestUri = $request->getRequestUri();
        $baseuri = $request->getBaseUri();
        if (
            $requestUri!=''
            && $baseuri!=''
            && stripos($requestUri, $baseuri)===0
        ) {
            $path = substr($requestUri, strlen($baseuri));
        } else {
            $path = $requestUri;
        }
        $module = null;
        $controller = null;
        $action = null;
        $rest = null;
        $path = trim($path, Router::URI_DELIMITER);
        if ($path != '') {
            $path = explode(Router::URI_DELIMITER, $path);
            $path = array_filter($path, 'strlen');
            if (Application::isModuleName($path[0])) {
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
            $rest = implode(Router::URI_DELIMITER, $path);
            $actionPrefer = G::iniGet('yaf.action_prefer');

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
                $path = explode(Router::URI_DELIMITER, $rest);
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
    public function getInstance(array $config)
    {
        return new self();
    }

}
