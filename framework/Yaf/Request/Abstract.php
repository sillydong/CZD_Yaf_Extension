<?php
/**
 *
 * Handle request object ...
 *
 */
abstract class Yaf_Request_Abstract
{
    /**
     * Has the action been dispatched?
     * @var boolean
     */
    protected $dispatched = false;

    /**
     * Module
     * @var string
     */
    public $module;

    /**
     * Controller
     * @var string
     */
    public $controller;

    /**
     * Action
     * @var string
     */
    public $action;

    /**
     * Method
     * @var string
     */
    public $method;


    /**
     * Request parameters
     * @var array
     */
    protected $params = array();

    /**
     * request_uri
     * @var string
     */
    protected $language;

    /**
     * routed
     * @var string
     */
    protected $routed;

    /**
     * base_uri
     * @var string
     */
    protected $_baseUri;

    /**
     * exception
     * @var string
     */
    protected $_exception;


    /**
     * Retrieve the action name
     *
     * @return string
     */
    public function getActionName()
    {
        return $this->action;
    }

    public function getBaseUri()
    {
    }

    /**
     * Retrieve the controller name
     *
     * @return string
     */
    public function getControllerName()
    {
        return $this->controller;
    }

    /**
     * Retrieve a member of the $_ENV superglobal
     *
     * If no $key is passed, returns the entire $_ENV array.
     *
     * @param string $name
     * @param mixed $default Default value to use if key not found
     * @return mixed Returns null if key does not exist
     */
    public function getEnv($name = null, $default = null)
    {
        if (null === $name) {
            return $_ENV;
        }
        return (isset($_ENV[$name])) ? $_ENV[$name] : $default;
    }

    /**
     * Retrieve the exception
     * @todo check if this is OK
     * @return string
     */
    public function getException()
    {
        return $this->_exception;
    }
    /**
     * Retrieve the language
     * @return string
     */
    public function getLanguage()
    {
        if (null === $this->language) {
            $this->language = $this->getEnv('HTTP_ACCEPT_LANGUAGE');
        }
        return $this->language;
    }

    /**
     * Retrieve the method
     * @return string
     */
    public function getMethod()
    {
        if (null === $this->method) {
            $method = $this->getServer('REQUEST_METHOD');
            if ($method) {
                $this->method = $method;
            } else {
                $sapiType = php_sapi_name();
                if (strtolower($sapiType) == 'cli'
                    || substr($sapiType, 0, 3) == 'cgi'
                ) {
                    $this->method = 'CLI';
                } else {
                    $this->method = 'Unknown';
                }
            }
        }
        return $this->method;
    }


    public function getModuleName()
    {
        return $this->module;
    }

    /**
     * Get an action parameter
     *
     * @param string $key
     * @param mixed $default Default value to use if key not found
     * @return mixed
     */
    public function getParam($name, $default = null)
    {
        $name = (string) $name;
        if (isset($this->params[$name])) {
            return $this->params[$name];
        }
        return $default;
    }
    /**
     * Get all action parameters
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
    public function getRequestUri()
    {
    }
    /**
     * Retrieve a member of the $_SERVER superglobal
     *
     * If no $key is passed, returns the entire $_SERVER array.
     *
     * @param string $key
     * @param mixed $default Default value to use if key not found
     * @return mixed Returns null if key does not exist
     */
    public function getServer($name = null, $default = null)
    {
        if (null === $name) {
            return $_SERVER;
        }
        return (isset($_SERVER[$name])) ? $_SERVER[$name] : $default;
    }

    public function isCli()
    {
        if ('CLI' == $this->getMethod()) {
            return true;
        }
        return false;
    }
    /**
     * Determine if the request has been dispatched
     *
     * @return boolean
     */
    public function isDispatched()
    {
        return $this->dispatched;
    }

    /**
     * Was the request made by GET?
     *
     * @return boolean
     */
    public function isGet()
    {
        if ('GET' == $this->getMethod()) {
            return true;
        }
        return false;
    }

    /**
     * Was the request made by HEAD?
     *
     * @return boolean
     */
    public function isHead()
    {
        if ('HEAD' == $this->getMethod()) {
            return true;
        }
        return false;
    }

    /**
     * Was the request made by OPTIONS?
     *
     * @return boolean
     */
    public function isOptions()
    {
        if ('OPTIONS' == $this->getMethod()) {
            return true;
        }

        return false;
    }

    /**
     * Was the request made by POST?
     *
     * @return boolean
     */
    public function isPost()
    {
        if ('POST' == $this->getMethod()) {
            return true;
        }

        return false;
    }

   /**
     * Was the request made by PUT?
     *
     * @return boolean
     */
    public function isPut()
    {
        if ('PUT' == $this->getMethod()) {
            return true;
        }

        return false;
    }

    /**
     * Was the request made by DELETE?
     *
     * @return boolean
     */
    public function isDelete()
    {
        if ('DELETE' == $this->getMethod()) {
            return true;
        }

        return false;
    }

    /**
     * Is the request a Javascript XMLHttpRequest?
     *
     * Should work with Prototype/Script.aculo.us, possibly others.
     *
     * @return boolean
     */
    public function isXmlHttpRequest()
    {
        return (strcasecmp(
            $this->getServer('HTTP_X_REQUESTED_WITH'),
            'XMLHttpRequest'
        )==0?true:false);
    }

    /**
     * Determine if the request has been routed
     *
     * @return boolean
     */
    public function isRouted()
    {
        return $this->routed;
    }

    /**
     * Set the action name
     *
     * @param string $value
     * @return Yaf_Request_Abstract
     */
    public function setActionName($action)
    {
        if (!is_string($action)) {
            throw new Yaf_Request_Exception('Expect a string action name');
        }
        $this->action = $action;
        if (null === $action) {
            $this->setParam('action', $action);
        }
        return $this;
    }
    public function setBaseUri($baseUri = null)
    {
    }
    /**
     * Set the controller name to use
     *
     * @param string $value
     * @return Yaf_Request_Abstract
     */
    public function setControllerName($controller)
    {
        if (!is_string($controller)) {
            throw new Yaf_Request_Exception('Expect a string controller name');
        }
        $this->controller = $controller;
        return $this;
    }

    public function setDispatched($dispatched=true)
    {
        $this->dispatched = $dispatched;
    }

    /**
     * Set the module name to use
     *
     * @param string $value
     * @return Yaf_Request_Abstract
     */
    public function setModuleName($module)
    {
        if (!is_string($module)) {
            throw new Yaf_Request_Exception('Expect a string module name');
        }
        $this->module = $module;
        return $this;
    }

    /**
     * Set an action parameter
     *
     * A $value of null will unset the $key if it exists
     *
     * @param string $key
     * @param mixed $value
     * @return Yaf_Request_Abstract
     */
    public function setParam($name, $value=null)
    {
        if (is_array($name)) {
            $this->params = $this->params + (array) $name;

            /*foreach ($name as $key => $value) {
                if (null === $value) {
                    unset($this->_params[$key]);
                }
            }*/
        } else {
            $name = (string) $name;

            /*if ((null === $value) && isset($this->_params[$name])) {
                unset($this->_params[$name]);
            } elseif (null !== $value) {
                $this->_params[$name] = $value;
            }*/
            $this->params[$name] = $value;
        }
        return $this;
    }

    /**
     * Unset all user parameters
     *
     * @return Yaf_Request_Abstract
     */
    public function clearParams()
    {
        $this->params = array();
        return $this;
    }
    public function setRequestUri($requestUri = null)
    {
    }
    /**
     * Set flag indicating whether or not request has been dispatched
     *
     * @param boolean $flag
     * @return Yaf_Request_Abstract
     */
    public function setRouted($flag = true)
    {
        $this->routed = $flag ? true : false;
        return $this;
    }
}
