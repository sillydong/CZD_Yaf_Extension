<?php
/**
 * Yaf Route Map for hash based ajax URL
 */

/**
 * @namespace
 */
namespace Yaf\Route;

class Map implements \Yaf\Route_Interface
{
    protected $_ctlPrefer=false;
    protected $_delimiter='';
    /**
     * Class constructor
     * @param string $module
     * @param string $controller
     * @param string $action
     */
    public function __construct($controller_prefer=false, $delimiter='#!')
    {
        if (is_bool($controller_prefer)) {
            $this->_ctlPrefer = $controller_prefer;
        }
        if (is_string($delimiter) && $delimiter!='') {
            $this->_delimiter = $delimiter;
        }

    }
    /**
     * Processes a request and sets its controller and action.  If
     * no route was possible, default route is set.
     *
     * @param  Yaf_Request_Abstract
     * @return Yaf_Request_Abstract|boolean
     */

    public function route(\Yaf\Request_Abstract $request)
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
        $path = trim(urldecode($path), \Yaf\Router::URI_DELIMITER);
        $rest = '';
        if (is_string($this->_delimiter) && $this->_delimiter!='') {
            if (($queryStringPos = strpos($path, $this->_delimiter))!==false) {
                $rest = substr(
                    $path,
                    $queryStringPos+strlen($this->_delimiter),
                    strlen($path)-1
                );
                $path = substr(
                    $path,
                    0,
                    $queryStringPos
                );
            }
        }
        $route = '';
        if ($path != '' && $path!='/') {
            $route = str_replace(
                \Yaf\Router::URI_DELIMITER,
                '_',
                trim($path, \Yaf\Router::URI_DELIMITER)
            );
        }
        if ($route!='') {
            if ($this->_ctlPrefer == true) {
                $request->setControllerName($route);
            } else {
                $request->setActionName($route);
            }
        }
        $params = array();
        if ($rest!=null && trim($rest)!='') {
            $path = explode(
                \Yaf\Router::URI_DELIMITER,
                trim($rest, \Yaf\Router::URI_DELIMITER)
            );
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

        return true;
    }
    /**
     * used to create routes on the fly from config
     *
     * @param array $config
     */
    public static function getInstance(array $config)
    {
        $controllerPrefer = false;
        if (
            isset($config['controllerPrefer'])
            &&
            is_bool($config['controllerPrefer'])
        ) {
            $controllerPrefer = $config['controllerPrefer'];
        }
        $delimiter = '#!';
        if (isset($config['delimiter'])) {
            $delimiter = $config['delimiter'];
        }
        return new self(
            $controllerPrefer, $delimiter
        );
    }
}