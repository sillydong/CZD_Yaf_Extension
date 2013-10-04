<?php
/**
 * Yaf Controller Abstract
 */
abstract class Yaf_Controller_Abstract
{
    public $actions = array();
    protected $_module;
    protected $_name = '';

    /**
     * Yaf_Request_Abstract object wrapping the request environment
     * @var Yaf_Request_Abstract
     */
    protected $_request = null;

    /**
     * Yaf_Response_Abstract object wrapping the response
     * @var Yaf_Response_Abstract
     */
    protected $_response = null;

    /**
     * Array of arguments provided to the constructor, minus the
     * {@link $_request Request object}.
     * @var array
     */
    protected $_invokeArgs = array();

    /**
     * View object
     * @var Yaf_View_Interface
     */
    protected $_view = null;

    /**
     * Class constructor
     *
     * The request and response objects should be registered with the
     * controller, as should be any additional optional arguments; these will be
     * available via {@link getRequest()}, {@link getResponse()}, and
     * {@link getInvokeArgs()}, respectively.
     *
     * @param Yaf_Request_Abstract $request
     * @param Yaf_Response_Abstract $response
     * @param Yaf_View_Interface $view
     * @param array $invokeArgs Any additional invocation arguments
     * @return void
     */
    public function __construct(
        Yaf_Request_Abstract $request,
        Yaf_Response_Abstract $response,
        Yaf_View_Interface $view,
        array $invokeArgs = array()
    )
    {
        $this->_request = $request;
        $this->_response = $response;
        $this->_view = $view;
        $this->_invokeArgs = $invokeArgs;
        $this->_module = $request->getModuleName();
        $this->_name = get_class($this);
        $this->init();
    }

    /**
     * Render a view
     *
     * Renders a view. By default, views are found in the view script path as
     * <controller>/<action>.phtml. You may change the script suffix by
     * resetting {@link $viewSuffix}.
     *
     *
     * @see Yaf_Response_Abstract::appendBody()
     * @param  string|null $tpl Defaults to action registered in request object
     * @param  array $parameters  add those variables to the view
     * @return void
     */
    public function display($tpl = null, $parameters = array())
    {
        $view   = $this->initView();
        $script = $this->getViewScript($tpl);
        $view->display($script, $parameters);
    }


    /**
     * Forward to another controller/action.
     *
     * It is important to supply the unformatted names, i.e. "article"
     * rather than "ArticleController".  The dispatcher will do the
     * appropriate formatting when the request is received.
     *
     * If only an action name is provided, forwards to that action in this
     * controller.
     *
     * If an action and controller are specified, forwards to that action and
     * controller in this module.
     *
     * Specifying an action, controller, and module is the most specific way to
     * forward.
     *
     * A fourth argument, $params, will be used to set the request parameters.
     * If either the controller or module are unnecessary for forwarding,
     * simply pass null values for them before specifying the parameters.
     *
     * @todo this should be checked again within a test
     * @param string $action
     * @param string $controller
     * @param string $module
     * @param array $args
     * @return void
     */
    public function forward(
        $module, $controller=null, $action=null, array $args = null
    )
    {
        $request = $this->getRequest();
        if (null !== $args) {
            $request->setParams($args);
        }

        if ($controller == null && $action == null) {
            $action = $module;
            $module = null;
        } elseif ($action == null) {
            $action = $controller;
            $controller = $module;
            $module = null;
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


        $request->setActionName($action)
        ->setDispatched(false);
    }

    /**
     * Return a single invocation argument
     *
     * @param string $key
     * @return mixed
     */
    public function getInvokeArg($key)
    {
        if (isset($this->_invokeArgs[$key])) {
            return $this->_invokeArgs[$key];
        }

        return null;
    }

    /**
     * Return the array of constructor arguments (minus the Request object)
     *
     * @return array
     */
    public function getInvokeArgs()
    {
        return $this->_invokeArgs;
    }


    /**
     * return the current module name
     */
    public function getModuleName()
    {
        return $this->_module;
    }

    /**
     * Return the Request object
     *
     * @return Zend_Controller_Request_Abstract
     */
    public function getRequest()
    {
        return $this->_request;
    }


    /**
     * Return the Response object
     *
     * @return Yaf_Response_Abstract
     */
    public function getResponse()
    {
        return $this->_response;
    }


    /**
     * Return the View object
     *
     * @return Yaf_View_Interface
     */
    public function getView()
    {
        return $this->_view;
    }

    public function getViewpath()
    {
        $view  = $this->getView();
        return $view->getScriptPath();
    }


    /**
     * Initialize object
     *
     * Called from {@link __construct()} as final step of object instantiation.
     *
     * @return void
     */
    public function init()
    {
    }

    /**
     * Initialize View object
     * @todo this does nothing for now
     *
     * @return Yaf_View_Interface
     */
    public function initView()
    {
        return $this->_view;
    }

    /**
     * Render a view
     *
     * Renders a view. By default, views are found in the view script path as
     * <controller>/<action>.phtml. You may change the script suffix by
     * resetting {@link $viewSuffix}.
     *
     *
     * @see Yaf_Response_Abstract::appendBody()
     * @param  string|null $tpl Defaults to action registered in request object
     * @param  array $parameters  add those variables to the view
     * @return void
     */
    public function render($tpl = null, $parameters = array())
    {
        $view   = $this->initView();
        $script = $this->getViewScript($tpl);
        return $view->render($script, $parameters);
    }

    /**
     * Redirect to another URL
     *
     * @param string $url
     * @return void
     */
    public function redirect($url)
    {
        $response = $this->getResponse();
        $response->setRedirect($url);
    }

    public function setViewpath($templateDir)
    {
        $view  = $this->getView();
        $view->setScriptPath($templateDir);
    }

    /**
     * Construct view script path
     *
     * Used by render() and display to determine the path to the view script.
     *
     * @param  string $action Defaults to action registered in request object
     * @return string
     * @throws InvalidArgumentException with bad $action
     */
    protected function getViewScript($action = null)
    {
        $request = $this->getRequest();
        if (null === $action) {
            $action = $request->getActionName();
        } elseif (!is_string($action)) {
            throw new InvalidArgumentException(
                'Invalid action for view rendering'
            );
        }
        $action = str_replace('_', DIRECTORY_SEPARATOR, strtolower($action));
        $script = $action . '.' . Yaf_G::get('view_ext');
        $controller = $request->getControllerName();
        if ($controller!=null) {
            $controller = str_replace(
                '_', DIRECTORY_SEPARATOR, strtolower($controller)
            );
        }
        $script = $controller . DIRECTORY_SEPARATOR . $script;

        return $script;
    }
}
