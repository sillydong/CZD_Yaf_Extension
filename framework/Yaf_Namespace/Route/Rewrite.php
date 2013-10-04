<?php
/**
 * Yaf Route Rewrite
 */

/**
 * @namespace
 */
namespace Yaf\Route;

class Rewrite implements \Yaf\Route_Interface
{
    protected $_route = '';
    protected $_default = array();
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
        } else {
            return new self(
                $config['match'],
                $config['route']
            );
        }
    }

    public function __construct($match, $route, $verify = null)
    {
        if (!is_string($match) || $match == '') {
            throw new \Yaf\Exception\TypeError(
                'Expects a string as the first parameter'
            );
        }
        if (!is_array($route)) {
            throw new \Yaf\Exception\TypeError(
                'Expects an array as the second parameter'
            );
        }
        if ($verify!=null && !is_array($verify)) {
            throw new \Yaf\Exception\TypeError(
                'Expects an array as third parameter'
            );
        }
        $this->_route = $match;
        $this->_default = (array) $route;
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
        $path = trim(urldecode($path), \Yaf\Router::URI_DELIMITER);

        $values = $this->_match($path);
        if ($values == null) {
            return false;
        }

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
     * @todo this method can be write differently with (P< style match
     * Matches a user submitted path with parts defined by a map. Assigns and
     * returns an array of variables on a successful match.
     *
     * @param string $path Path used to match against this routing map
     * @return array|false An array of assigned values or a false on a mismatch
     */
    protected function _match($path)
    {
        $staticCount = 0;
        $pathStaticCount = 0;
        $values          = array();
        $matchedPath     = '';
        $parts = array();
        $variables = array();
        $wildcardData = array();

        if ($this->_route !== '') {
            foreach (
                explode(
                    \Yaf\Router::URI_DELIMITER, trim(
                        $this->_route, \Yaf\Router::URI_DELIMITER
                    )
                ) as $pos => $part
            ) {
                if (
                    substr($part, 0, 1) == \Yaf\Router::URI_VARIABLE
                    && substr($part, 1, 1) != \Yaf\Router::URI_VARIABLE
                ) {
                    $name = substr($part, 1);
                    $parts[$pos] = null;
                    $variables[$pos] = $name;
                } else {
                    if (substr($part, 0, 1) == \Yaf\Router::URI_VARIABLE) {
                        $part = substr($part, 1);
                    }

                    $parts[$pos] = $part;

                    if ($part !== '*') {
                        $staticCount++;
                    }
                }
            }
        }
        if ($path !== '') {
            $pathMatch = explode(\Yaf\Router::URI_DELIMITER, $path);
            foreach ($pathMatch as $pos => $pathPart) {
                // Path is longer than a route, it's not a match
                if (!array_key_exists($pos, $parts)) {
                    return false;
                }

                $matchedPath .= $pathPart . \Yaf\Router::URI_DELIMITER;

                // If it's a wildcard, get the rest of URL as
                // wildcard data and stop matching
                if ($parts[$pos] == '*') {
                    $count = count($pathMatch);
                    for ($i = $pos; $i < $count; $i+=2) {
                        $var = urldecode($pathMatch[$i]);
                        if (
                            !isset($wildcardData[$var])
                            && !isset($this->_default[$var])
                            && !isset($values[$var])
                        ) {
                            $wildcardData[$var] =
                                (isset($pathMatch[$i+1])) ?
                                urldecode($pathMatch[$i+1]) :
                                null;
                        }
                    }

                    $matchedPath = implode(
                        \Yaf\Router::URI_DELIMITER, $pathMatch
                    );
                    break;
                }

                $name     = isset($variables[$pos]) ? $variables[$pos] : null;
                $pathPart = urldecode($pathPart);

                $part = $parts[$pos];

                if (substr($part, 0, 2) === '@@') {
                    $part = substr($part, 1);
                }

                // If it's a static part, match directly
                if ($name === null && $part != $pathPart) {
                    return false;
                }

                // If it's a variable with requirement,
                // match a regex. If not - everything matches
                if (
                    $part !== null
                    && !preg_match('#^' . $part . '$#' . 'iu', $pathPart)
                ) {
                    return false;
                }

                // If it's a variable store it's value for later
                if ($name !== null) {
                    $values[$name] = $pathPart;
                } else {
                    $pathStaticCount++;
                }
            }
        }

        // Check if all static mappings have been matched
        if ($staticCount != $pathStaticCount) {
            return false;
        }
        $return = $values + $wildcardData;


        // Check if all map variables have been initialized
        foreach ($variables as $var) {
            if (!array_key_exists($var, $return)) {
                return false;
            } elseif ($return[$var] == '' || $return[$var] === null) {
                // Empty variable? Replace with the default value.
                $return[$var] = $this->_default[$var];
            }
        }
        if ($values == null && $wildcardData == null && $staticCount!=0) {
            $return = $return + $this->_default;
        }
        return $return;

    }
}
