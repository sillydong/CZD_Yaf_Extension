<?php
/**
 * Yaf_Request_Simple
 *
 */

/**
 * @namespace
 */
namespace Yaf\Request;

class Simple extends \Yaf\Request_Abstract
{
    public function __construct(
        $method = null,
        $module = null,
        $controller = null,
        $action = null,
        $params = array()
    )
    {
        if (!is_array($params)) {
            throw new \Yaf\Exception\TypeError(
                'Expects the params is an array'
            );
        }
        if ($method == null) {
            if (isset($_SERVER['REQUEST_METHOD'])) {
                $method = $_SERVER['REQUEST_METHOD'];
            } else {
                $sapiType = php_sapi_name();
                if (strtolower($sapiType) == 'cli'
                || substr($sapiType, 0, 3) == 'cgi'
                ) {
                    $method = 'CLI';
                } else {
                    $method = 'unknown';
                }
            }
        }
        $this->method = $method;
        if ($module!=null || $action!=null || $controller!=null) {
            $this->setActionName($action);
            $this->setControllerName($controller);
            $this->setModuleName($module);
            $this->setRouted(true);
        } else {
            if ($module == null) {
                $this->setModuleName(\Yaf\G::get('default_module'));
            }
            if ($controller == null) {
                $this->setControllerName(\Yaf\G::get('default_controller'));
            }
            if ($action == null) {
                $this->setActionName(\Yaf\G::get('default_action'));
            }
        }

        if ($params) {
            $this->setParam($params);
        }
    }

    private function __clone()
    {
        //close is not possible to do
    }

}