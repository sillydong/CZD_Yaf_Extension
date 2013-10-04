<?php
/**
 * Yaf Route Regexp
 */

/**
 * @namespace
 */
namespace Yaf\Route;

class Regex implements \Yaf\Route_Interface
{
    protected $_route = '';
    protected $_default = array();
    protected $_maps = array();
    protected $_verify = null;

    /**
     * Instantiates route based on passed Yaf_Config_Abstract structure
     *
     * @param array $config Configuration object
     */
    public static function getInstance(array $config)
    {
        if (!isset($config['match']) || !is_string($config['match'])) {
            return null;
        } elseif (!isset($config['route']) || empty($config['route'])) {
            return null;
        } elseif (!isset($config['map']) || empty($config['map'])) {
            return null;
        } else {
            return new self(
                $config['match'],
                $config['route'],
                $config['map']
            );
        }
    }

    public function __construct(
        $match, $route, $map, $verify = null
    )
    {
        if (!is_string($match) || $match == '') {
            throw new \Yaf\Exception\RouterFailed(
                'Expects a string as the first parameter'
            );
        }
        if (!is_array($route)) {
            throw new \Yaf\Exception\RouterFailed(
                'Expects a array as the second parameter'
            );
        }
        if (!is_array($map)) {
            throw new \Yaf\Exception\RouterFailed(
                'Expects a array as the third parameter'
            );
        }
        if ($verify != null && !is_array($verify)) {
            throw new \Yaf\Exception\RouterFailed(
                'Expects an array as verify parameter'
            );
        }
        $this->_route = $match;
        $this->_default = (array) $route;
        $this->_maps = (array) $map;
        $this->_verify = $verify;
    }

    /**
     * Matches a user submitted path with a previously defined route.
     * Assigns and returns an array of defaults on a successful match.
     *
     * @param  string $path Path used to match against this routing map
     * @return array|false  An array of assigned values or a false on a mismatch
     */
    public function route(\Yaf\Request_Abstract $request)
    {
        $requestUri = $request->getRequestUri();
        $baseuri = $request->getBaseUri();
        if (
            $requestUri!=''
            && $baseuri!=''
            && stripos($requestUri, $baseuri)!==false
        ) {
            $path = substr($requestUri, strlen($baseuri));
        } else {
            $path = $requestUri;
        }
        $path = urldecode($path);
        $res = preg_match($this->_route, $path, $values);

        if ($res === 0) {
            return false;
        }

        $values = $this->_getMappedValues($values);

        if (isset($this->_default['module'])) {
            $request->setModuleName($this->_default['module']);
        }
        if (isset($this->_default['controller'])) {
            $request->setControllerName($this->_default['controller']);
        }
        if (isset($this->_default['action'])) {
            $request->setActionName($this->_default['action']);
        }
        $request->setParam($values);

        return true;
    }

    /**
     * Uses user provided map array which consists
     * of index => name parameter mapping. If map is not found,
     * it returns nothing.
     *
     * @param  array   $values Indexed or associative array of values to map
     * @return array   An array of mapped values
     */
    protected function _getMappedValues($values)
    {
        $return = array();
        foreach ($values as $key => $value) {
            if (is_int($key)) {
                if (array_key_exists($key, $this->_maps)) {
                    $index = $this->_maps[$key];
                    $return[$index] = $values[$key];
                }
            } else {
                $return[$key] = $values[$key];
            }
        }
        return $return;
    }
}
