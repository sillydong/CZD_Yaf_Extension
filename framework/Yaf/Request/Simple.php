<?php
/**
 * Yaf_Request_Simple
 *
 */
class Yaf_Request_Simple extends Yaf_Request_Abstract
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
            throw new Yaf_Exception_TypeError(
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
                $this->setModuleName(Yaf_G::get('default_module'));
            }
            if ($controller == null) {
                $this->setControllerName(Yaf_G::get('default_controller'));
            }
            if ($action == null) {
                $this->setActionName(Yaf_G::get('default_action'));
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