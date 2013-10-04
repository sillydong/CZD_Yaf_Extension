<?php
/**
 * Yaf_Router is the standard framework router.
 */
class Yaf_Router
{

    /**
     * Array of routes to match against
     *
     * @var array
     */
    protected $_routes = array();

    /**
     * Currently matched route
     *
     * @var string
     */
    protected $_current = null;

    const URI_DELIMITER = '/';
    const URI_VARIABLE = ':';
    const YAF_DEFAULT_EXT = 'php';
    const YAF_ROUTER_DEFAULT_ACTION = 'index';
    const YAF_ROUTER_DEFAULT_CONTROLLER = 'Index';
    const YAF_ROUTER_DEFAULT_MODULE = 'Index';


    public function __construct()
    {
        $defaultRoute = Yaf_G::get('default_route');
        if ($defaultRoute!=null) {
            $this->addRoute(
                '_default',
                $this->_getRouteFromArray($defaultRoute)
            );
        } else {
            $this->addRoute('_default', new Yaf_Route_Static());
        }
    }

    /**
     * Add route to the route chain
     *
     * @param  string $name Name of the route
     * @param  Yaf_Route_Interface $route Instance of the route
     * @return Yaf_Router
     */
    public function addRoute($name, Yaf_Route_Interface $route)
    {
        $this->_routes[$name] = $route;
        return $this;
    }

    /**
     *
     * Example INI:
     * routes.archive.type = "simple"
     * routes.archive.module = Index
     * routes.archive.controller = archive
     * routes.archive.action = show
     *
     * routes.news.type = "static"
     * routes.news.route = "news"
     *
     * And finally after you have created a Yaf_Config with above ini:
     * $router = new Yaf_Router();
     * $router->addConfig($config);
     *
     * @param  array|Yaf_Config $config  Configuration object
     * @throws Yaf_Router_Exception
     * @return Yaf_Router
     */
    public function addConfig($config)
    {
        if (is_array($config)) {
            //$config = new Yaf_Config_Simple($config);
        } else if ($config instanceof Yaf_Config_Abstract) {
            $config = $config->toArray();
        } else {
            throw new Yaf_Exception_RouterFailed(
                'Expecting Array or Yaf_Config_Abstract instance'
            );
        }
        $name = key($config);
        foreach ($config as $entry) {
            $route = $this->_getRouteFromArray($entry);
            if ($route!=null) {
                if ($route instanceof Yaf_Route_Interface) {
                    $this->addRoute($name, $route);
                } else {
                    $this->addRoute($name, $route);
                }
            } else {
                if (is_string($name)) {
                    throw new Yaf_Exception_RouterFailed(
                        'Unable to initialize route named '.$name
                    );
                } else {
                    throw new Yaf_Exception_RouterFailed(
                        'Unable to initialize route at index '.$name
                    );
                }
            }
            $name = key($config);
            next($config);
        }

        /*//exit();
        foreach ($config as $name => $info) {
            $route = $this->_getRouteFromConfig($info);

            if ($route!=null) {
                if ($route instanceof Yaf_Route_Interface) {
                    $this->addRoute($name, $route);
                } else {
                    $this->addRoute($name, $route);
                }
            } else {
                throw new Yaf_Exception_RouterFailed(
                    'Unable to initialize route named '.$name
                );
            }
        }*/

        return $this;
    }

    /**
     * Get a route from a config instance
     *
     * @param  Yaf_Config_Abstract $info
     * @return Yaf_Route_Interface
     */
    protected function _getRouteFromConfig(Yaf_Config_Abstract $info)
    {
        $useNamespace = Yaf_G::iniGet('yaf.use_namespace');
        if ($useNamespace) {
            $class = (isset($info['type']))
                ? '\\Yaf\\Route\\'.ucfirst($info['type'])
                : '\\Yaf\\Route\\Static';
        } else {
            $class = (isset($info['type']))
                ? 'Yaf_Route_'.ucfirst($info['type'])
                : 'Yaf_Route_Static';
        }
        try {
            $route = call_user_func(array($class, 'getInstance'), $info);
        } catch (Exception $e) {
            return null;
        }
        return $route;
    }

    /**
     * Get a route from an array
     *
     * @param  array $info
     * @return Yaf_Route_Interface
     */
    protected function _getRouteFromArray(array $info)
    {
        $useNamespace = Yaf_G::iniGet('yaf.use_namespace');
        if ($useNamespace) {
            $class = (isset($info['type']))
                ? '\\Yaf\\Route\\'.ucfirst($info['type'])
                : '\\Yaf\\Route\\Static';
        } else {
            $class = (isset($info['type']))
                ? 'Yaf_Route_'.ucfirst($info['type'])
                : 'Yaf_Route_Static';
        }
        try {
            $route = call_user_func(array($class, 'getInstance'), $info);
        } catch (Exception $e) {
            return null;
        }
        return $route;
    }

    /**
     * Retrieve a currently matched route
     *
     * @throws Yaf_Exception_RouterFailed
     * @return Yaf_Route_Interface Route object
     */
    public function getCurrentRoute()
    {
        return $this->_current;
    }

    /**
     * Retrieve a named route
     *
     * @param string $name Name of the route
     * @throws Yaf_Exception_RouterFailed
     * @return Yaf_Route_Interface Route object
     */
    public function getRoute($name)
    {
        if (!isset($this->_routes[$name])) {
            return null;
            /* throw new Yaf_Exception_RouterFailed(
                "Route $name is not defined"
            ); */
        }
        return $this->_routes[$name];
    }

    /**
     * Retrieve an array of routes added to the route chain
     *
     * @return array All of the defined routes
     */
    public function getRoutes()
    {
        return $this->_routes;
    }

    /**
     * Find a matching route to the current Request and inject
     * returning values to the Request object.
     *
     * @return bool if there is a valid route
     */
    public function route(Yaf_Request_Abstract $request)
    {
        // Find the matching route
        $routeMatched = false;

        foreach (array_reverse($this->_routes, true) as $name => $route) {
            if (($ret = $route->route($request))!=false) {
                $this->_current = $name;
                $routeMatched   = true;
                break;
            }
        }

         if (!$routeMatched) {
             return false;
         } else {
             $request->setRouted(true);
             return true;
         }
         return false;
    }
}
