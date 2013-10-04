<?php
/**
 * Yaf Dispatcher
 */

/**
 * @namespace
 */
namespace Yaf;

class Dispatcher
{
    /**
     * Instance of Yaf_Router_Interface
     * @var Yaf_Router
     */
    protected $_router = null;
    /**
     * View object
     * @var Yaf_View_Interface
     */
    protected $_view=null;
    /**
     * Instance of Yaf_Request_Abstract
     * @var Yaf_Request_Abstract
     */
    protected $_request = null;
    /**
     * holds the references to the plugins
     * @var array
     */
    protected $_plugins = array();
    /**
     * Singleton instance
     * @var Yaf_Dispatcher
     */
    protected static $_instance = null;

    /**
     * Whether or not to enable view.
     * @var boolean
     */
    protected $_auto_render=true;
    /**
     * Whether or not to return the response prior to rendering output while in
     * {@link dispatch()}; default is to send headers and render output.
     * @var boolean
     */
    protected $_returnResponse = false;

    protected $_instantly_flush = false;
    protected $_default_module = '';
    protected $_default_controller = '';
    protected $_default_action = '';

    public function autoRender($flag)
    {
        if (!is_bool($flag)) {
            return ;
        } else {
            $this->_auto_render = $flag;
        }
    }

    /**
     * Set the throwExceptions flag and retrieve current status
     *
     * Set whether exceptions encounted in the dispatch loop should be thrown
     * or caught and trapped in the response object.
     *
     * Default behaviour is to trap them in the response object; call this
     * method to have them thrown.
     *
     * Passing no value will return the current value of the flag; passing a
     * boolean true or false value will set the flag and return the current
     * object instance.
     *
     * @param boolean $flag Defaults to null (return flag state)
     * @return boolean|Yaf_Dispatcher when used as a setter,
     * returns object; as a getter, returns boolean
     */
    public function catchException($flag = null)
    {
        if ($flag !== null) {
            G::set('catchException', (bool) $flag);
            return $this;
        }

        return G::get('catchException');
    }

    /**
     * Enforce singleton; disallow cloning
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Constructor
     *
     * Instantiate using {@link getInstance()}; dispatcher is a singleton
     * object.
     *
     * @return void
     */
    protected function __construct()
    {
    }

    public function disableView()
    {
        $this->_auto_render = false;
    }



    /**
     * Dispatch an HTTP request to a controller/action.
     *
     * @param Yaf_Request_Abstract|null $request
     * @return void|Yaf_Response_Abstract
     */
    public function dispatch(Request_Abstract $request = null)
    {
        /**
         * Instantiate default request object (HTTP version) if none provided
         */
        if ($request == null) {
            $request = $this->getRequest();
        } else {
            $this->setRequest($request);
        }
        if (!($request instanceof Request_Abstract)) {
            throw new Exception\TypeError(
                'Expect a Yaf_Request_Abstract instance'
            );
        }
        if ($request instanceof Request\Http) {
            $response = new Response\Http();
        } elseif ($request instanceof Request\Simple) {
            $response = new Response\Cli();
        }
        /**
         * Initialize router
         */
        $router = $this->getRouter();
        if (!$request->isRouted()) {
            /**
             * Notify plugins of router startup
             */
            foreach ($this->_plugins as $plugin) {
                $plugin->routerStartup($request, $response);
            }
            try {
                //@todo here seems there is 2 type of routes
                $router->route($request);
            }  catch (\Exception $e) {
                if ($this->throwException() == true) {
                    throw $e;
                }
            }
            $this->_fixDefault($request);
            /**
             * Notify plugins of router shutdown
             */
            foreach ($this->_plugins as $plugin) {
                $plugin->routerShutdown($request, $response);
            }
        } else {
            $this->_fixDefault($request);
        }
        $view = $this->initView();
        /**
         * Notify plugins of dispatch loop startup
         */
        foreach ($this->_plugins as $plugin) {
            $plugin->dispatchLoopStartup($request, $response);
        }
        $nested = G::iniGet('yaf.forward_limit');
        // Begin dispatch
        try {
            /**
             * Route request to controller/action, if a router is provided
             */
            do {
                /**
                 * Notify plugins of dispatch startup
                 */
                foreach ($this->_plugins as $plugin) {
                    $plugin->preDispatch($request, $response);
                }
                /**
                 * Dispatch request
                 */
                $this->handle($request, $response, $view);
                $this->_fixDefault($request);
                /**
                 * Notify plugins of dispatch completion
                 */
                foreach ($this->_plugins as $plugin) {
                    $plugin->postDispatch($request, $response);
                }
                $nested--;
            } while (!$request->isDispatched() && $nested>0);
            /**
             * Notify plugins of dispatch loop completion
             */
            foreach ($this->_plugins as $plugin) {
                $plugin->dispatchLoopShutdown($request, $response);
            }
        } catch (\Exception $e) {
            if ($this->throwException()) {
                throw $e;
            } else {
                Exception::trigger_error($e->getMessage(), E_USER_ERROR);
            }
        }

        if ($nested == 0 && !$request->isDispatched()) {
            throw new Exception\DispatchFailed(
                'The max dispatch nesting '.G::iniGet('yaf.forward_limit').
                ' was reached'
            );
        }
        if ($this->returnResponse() == false) {
            $response->response();
        }

        return $response;
    }

    private function handle(
        Request_Abstract $request,
        Response_Abstract $response,
        View_Interface $view
    )
    {
        $request->setDispatched(true);
        $app = $this->getApplication();
        $appDir = $app->getAppDirectory();
        if ($appDir == '') {
            throw new Exception\StartupError(
                'Yaf_Dispatcher requires '.
                'Yaf_Application(which set the application.directory) '.
                'to be initialized first.'
            );
        }
        $module = $request->getModuleName();
        if (empty($module)) {
            throw new Exception\DispatchFailed(
                'Unexcepted an empty module name'
            );
        }
        if (!Application::isModuleName($module)) {
            throw new Exception\LoadFailed\Module(
                'There is no module ' . $module
            );
        }
        $controllerName = $request->getControllerName();
        if (empty($controllerName)) {
            throw new Exception\DispatchFailed(
                'Unexcepted an empty controller name'
            );
        }
        $className = $this->getController($appDir, $module, $controllerName);
        if (!$className) {
            return false;
        }
        $controller = new $className($request, $response, $view);
        if (!($controller instanceof Controller_Abstract)) {
            throw new Exception\TypeError(
                'Controller must be an instance of Yaf_Controller_Abstract'
            );
        }
        $viewDir = $view->getScriptPath();
        //template dir might be set from the __construct
        if (empty($viewDir)) {
            $templateDir = '';
            if ($this->_default_module == $module) {
                $templateDir = $appDir . DIRECTORY_SEPARATOR .
                Loader::YAF_VIEW_DIRECTORY_NAME;
            } else {
                $templateDir = $appDir . DIRECTORY_SEPARATOR .
                    Loader::YAF_MODULE_DIRECTORY_NAME .
                    DIRECTORY_SEPARATOR . $module .
                    DIRECTORY_SEPARATOR . Loader::YAF_VIEW_DIRECTORY_NAME;
            }
            $view->setScriptPath($templateDir);
            unset($templateDir);
        }
        $action  = $request->getActionName();
        $actionMethod  = $action.'Action';
        if (method_exists($controller, $actionMethod)) {
            //Get all action method parameters
            $methodParams = $this->getActionParams($className, $actionMethod);
            if (null == $methodParams) {
                $ret = call_user_func(array($controller, $actionMethod));
            } else {
                $ret = call_user_func_array(
                    array($controller, $actionMethod),
                    $this->prepareActionParams($request, $methodParams)
                );
            }
            if (is_bool($ret) && $ret == false) {
                return true;
            }
        } elseif (
            (
            $actionController =
                $this->getAction($appDir, $controller, $action, $module)
            ) != null
        ) {
            //check if not in actions vars we have the action
            $actionMethod = 'execute';
            if (method_exists($actionController, $actionMethod)) {
                //Get all action method parameters
                $methodParams = $this->getActionParams(
                    get_class($actionController), $actionMethod
                );
                $ret = null;
                if (null == $methodParams) {
                    $ret = call_user_func(
                        array($actionController, $actionMethod)
                    );
                } else {
                    $ret = call_user_func_array(
                        array($actionController, $actionMethod),
                        $this->prepareActionParams($request, $methodParams)
                    );
                }
                if (is_bool($ret) && $ret == false) {
                    return true;
                }
            } else {
                throw new Exception\LoadFailed\Action(
                    'There is no method '.$actionMethod.' in '.
                    get_class($controller).'::$actions'
                );
            }
        } else {
            return false;
        }

        if ($this->_auto_render == true) {
            if ($this->_instantly_flush == true) {
                $controller->display($action);
            } else {
                $ret = $controller->render($action);
                $response->setBody($ret);
            }
        }
        $controller = null;
    }

    private function getAction(
        $appDir, Controller_Abstract $controller, $action, $module
    )
    {
        $nameSeparator = G::iniGet('yaf.name_separator');
        if (isset($controller->actions[$action])) {
            $actionPath = $appDir.DIRECTORY_SEPARATOR.
                $controller->actions[$action];
            if (Loader::import($actionPath)) {
                $actionMethod  = $action.'Action';
                if (G::iniGet('yaf.name_suffix') == true) {
                    $classname = $controller . $nameSeparator . 'Action';
                } else {
                    $classname = 'Action' . $nameSeparator . $controller;
                }
                if (!class_exists($classname, false)) {
                    throw new Exception\LoadFailed\Action(
                        'Could not find action '.$classname.
                        ' in '.$actionPath
                    );
                }
                $object = new $classname();
                if (!($object instanceof Action_Abstract)) {
                    throw new Exception\TypeError(
                        'Action '.$classname.
                        ' must extends from Yaf_Action_Abstract'
                    );
                }
                return $object;
            } else {
                throw new Exception\LoadFailed\Action(
                    'Could not find action script '.$actionPath
                );
            }
        } else {
            $actionrDir = '';
            if ($this->_default_module == $module) {
                $actionrDir = $appDir.DIRECTORY_SEPARATOR.'actions';
            } else {
                $actionrDir = $appDir.DIRECTORY_SEPARATOR.'modules'.
                DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.'actions';
            }
            if (G::iniGet('yaf.name_suffix') == true) {
                $classname = $controller . $nameSeparator . 'Action';
            } else {
                $classname = 'Action' . $nameSeparator . $controller;
            }
            if (!class_exists($classname, false)) {
                if (
                    !Loader::getInstance()->internal_autoload(
                        $classname, $actionrDir
                    )
                ) {
                    throw new Exception\LoadFailed\Action(
                        'Could not find action script '. $actionrDir
                    );
                }
            }
            if (!class_exists($classname, false)) {
                throw new Exception\LoadFailed\LoadFailed(
                    'Could not find class '.$classname.
                    ' in action script '.$actionrDir
                );
            }
            $object = new $classname();
            if (!($object instanceof Action_Abstract)) {
                throw new Exception\TypeError(
                    'Action must be an instance of Yaf_Action_Abstract'
                );
            }
            return $object;
        }
        return null;
    }

    private function prepareActionParams($request, $methodParams)
    {
        $data = array(); // It will sent to the action
        $params = $request->getParams();
        foreach ($methodParams as $param) {
            $name = $param->getName();
            if ($param->isOptional()) {
                // If there is no data to send, use the default
                $data[$name] =
                !empty($params[$name])
                ?$params[$name]
                :$param->getDefaultValue();
            } elseif (empty($params[$name])) {
                // The parameter cannot be empty as defined
                throw new Exception(
                    'Parameter: '.$name.' cannot be empty'
                );
            } else {
                $data[$name] = $params[$name];
            }
        }
        return $data;
    }

    private function getActionParams($className, $action)
    {
        $funcRef = new \ReflectionMethod($className, $action);
        $paramsRef = $funcRef->getParameters();
        return $paramsRef;
    }

    private function getController($appDir, $module, $controller)
    {
        $controllerDir = '';
        if ($this->_default_module == $module) {
            $controllerDir = $appDir.DIRECTORY_SEPARATOR.
                Loader::YAF_CONTROLLER_DIRECTORY_NAME;
        } else {
            $controllerDir = $appDir.DIRECTORY_SEPARATOR.
                Loader::YAF_MODULE_DIRECTORY_NAME.DIRECTORY_SEPARATOR.
                $module.DIRECTORY_SEPARATOR.
                Loader::YAF_CONTROLLER_DIRECTORY_NAME;
        }
        $nameSeparator = G::iniGet('yaf.name_separator');
        if (G::iniGet('yaf.name_suffix') == true) {
            $classname = $controller . $nameSeparator . 'Controller';
        } else {
            $classname = 'Controller' . $nameSeparator . $controller;
        }
        if (!@class_exists($classname, false)) {
            if (
                !Loader::getInstance()->internal_autoload(
                    $controller, $controllerDir
                )
            ) {
                throw new Exception\LoadFailed\Controller(
                    'Could not find controller script '.
                    $controllerDir.DIRECTORY_SEPARATOR.$controller.
                    '.'.G::get('ext')
                );
            }
        }
        if (!class_exists($classname, false)) {
            throw new Exception\LoadFailed\LoadFailed(
                'Could not find class '.$classname.
                ' in controller script '.$controllerDir
            );
        }
        return $classname;
    }

    private function _fixDefault(Request_Abstract $request)
    {
        $module = $request->getModuleName();
        if (empty($module) || !is_string($module)) {
            $request->setModuleName($this->_default_module);
        } else {
            $request->setModuleName(ucfirst($module));
        }
        $controller = $request->getControllerName();
        if (empty($controller) || !is_string($controller)) {
            $request->setControllerName($this->_default_controller);
        } else {
            $request->setControllerName($this->_formatName($controller));
        }
        $action = $request->getActionName();
        if (empty($action) || !is_string($action)) {
            $request->setActionName($this->_default_action);
        } else {
            $request->setActionName(strtolower($action));
        }
    }

    private function _formatName($unformatted)
    {
        // we have namespace
        $segments = explode('\\', $unformatted);
        if ($segments!=null) {
            foreach ($segments as $key => $segment) {
                $segment = preg_replace(
                    '/[^a-z0-9 ]/', '', strtolower($segment)
                );
                $segments[$key] = str_replace(' ', '', ucwords($segment));
            }
            return implode('\\', $segments);
        }
        //we have _
        $segments = explode('_', $unformatted);
        if ($segments!=null) {
            foreach ($segments as $key => $segment) {
                $segment = preg_replace(
                    '/[^a-z0-9 ]/', '', strtolower($segment)
                );
                $segments[$key] = str_replace(' ', '', ucwords($segment));
            }
            return implode('_', $segments);
        }
    }

    public function enableView ()
    {
        $this->_auto_render = true;
    }

    public function flushInstantly($flag)
    {
        if (!is_bool($flag)) {
            return ;
        } else {
            $this->_instantly_flush = $flag;
        }
        return $this;
    }

    /**
     * returns the application
     *
     * @return Yaf_Application
     */
    public function getApplication()
    {
        return Application::app();
    }

    /**
     * Singleton instance
     *
     * @return Yaf_Dispatcher
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
            self::$_instance->setDefaultAction(G::get('default_action'));
            self::$_instance->setDefaultController(
                G::get('default_controller')
            );
            self::$_instance->setDefaultModule(
                G::get('default_module')
            );
            self::$_instance->_router = new Router();
        }
        return self::$_instance;
    }

    /**
     * Return the request object.
     *
     * @return null|Yaf_Request_Abstract
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * Return the router object.
     * @return Yaf_Router
     */
    public function getRouter()
    {
        return $this->_router;
    }

    public function initView($templates_dir=null, $options = array())
    {
        if ($this->_view == null) {
            $this->_view = new View\Simple($templates_dir, $options);
        }
        return $this->_view;
    }

    /**
     * Register a plugin.
     *
     * @param  Yaf_Plugin_Abstract $plugin
     * @return Yaf_Dispatcher
     */
    public function registerPlugin(Plugin_Abstract $plugin)
    {
        $this->_plugins[] = $plugin;
        return $this;
    }

    /**
     * Set whether {@link dispatch()} should return the response without first
     * rendering output. By default, output is rendered and dispatch() returns
     * nothing.
     *
     * @param boolean $flag
     * @return boolean|Yaf_Dispatcher Used as a setter,
     * returns object; as a getter, returns boolean
     */
    public function returnResponse($flag = null)
    {
        if (true === $flag) {
            $this->_returnResponse = true;
            return $this;
        } elseif (false === $flag) {
            $this->_returnResponse = false;
            return $this;
        }
        return $this->_returnResponse;
    }

    /**
     * Set the default action
     *
     * @param string $action
     * @return Yaf_Dispatcher
     */
    public function setDefaultAction($action)
    {
        $this->_default_action = (string) $action;
        return $this;
    }


    /**
     * Set the default controller
     *
     * @param string $controller
     * @return Yaf_Dispatcher
     */
    public function setDefaultController($controller)
    {
        $this->_default_controller = ucfirst((string) $controller);
        return $this;
    }

    /**
     * Set the default module name
     *
     * @param string $module
     * @return Yaf_Dispatcher
     */
    public function setDefaultModule($module)
    {
        if (
            Application::isModuleName($module)
            ||
            strtolower($module)=='index'
        ) {
            $this->_default_module = ucfirst((string) $module);
        }
        return $this;
    }

    public function setErrorHandler($callback , $error_types=E_ALL)
    {
        set_error_handler($callback, $error_types);
    }

    /**
     * Set the request object.
     * @param Yaf_Request_Abstract $request
     * @return Yaf_Dispatcher
     */
    public function setRequest(Request_Abstract $request)
    {
        $this->_request = $request;
        return $this;
    }

    /**
     * Set the view object.
     *
     * @param Yaf_View_Interface $view
     * @return Yaf_Dispatcher
     */
    public function setView(View_Interface $view)
    {
        $this->_view = $view;
        return $this;
    }

    /**
     * Enforce singleton; disallow serialization
     *
     * @return void
     */
    private function __sleep()
    {
    }

    /**
     * Set the throwExceptions flag and retrieve current status
     *
     * Set whether exceptions encounted in the dispatch loop should be thrown
     * or caught and trapped in the response object.
     *
     * Default behaviour is to trap them in the response object; call this
     * method to have them thrown.
     *
     * Passing no value will return the current value of the flag; passing a
     * boolean true or false value will set the flag and return the current
     * object instance.
     *
     * @param boolean $flag Defaults to null (return flag state)
     * @return boolean|Yaf_Dispatcher Used as a setter,
     *     returns object; as a getter, returns boolean
     */
    public function throwException($flag = null)
    {
        if ($flag !== null) {
            G::set('throwException', (bool) $flag);
            return $this;
        }

        return G::get('throwException');
    }

    /**
     * Enforce singleton; disallow serialization
     *
     * @return void
     */
    private function __wakeup()
    {
    }
}