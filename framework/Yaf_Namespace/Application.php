<?php
/**
 * Yaf Application
 */

/**
 * @namespace
 */
namespace Yaf;

class Application
{
    /**
     * @var Yaf_Config_Abstract
     */
    protected $_config = null;
    /**
     *
     * @var Yaf_Dispatcher
     */
    protected $_dispatcher = null;
    /**
     *
     * @var Yaf_Application
     */
    protected static $_app = null;
    protected $_modules = array();
    protected $_running = false;
    protected $_environ = null;
    protected $_options = array();
    protected $_errno = 0;
    protected $_errmsg = '';

    public function __construct($config, $env=null)
    {
        $app = self::app();
        if (!is_null($app)) {
            throw new Exception\StartupError(
                'Only one application can be initialized'
            );
        }
        $this->_environ = $env;

        $config = $this->_loadConfig($config);
        if (
            $config == null
            ||
            (!($config instanceof Config_Abstract))
            ||
            $this->parseOptions($config->toArray()) != true
        ) {
            throw new Exception\StartupError(
                'Initialization of application config failed'
            );
        }
        //$this->parseOptions($config->toArray());
        $this->_config = $config;

        //request initialization
        $request = new Request\Http();
        if ($request == null) {
            throw new Exception\StartupError(
                'Initialization of request failed'
            );
        }

        //dispatcher
        $this->_dispatcher = Dispatcher::getInstance();
        if (
            $this->_dispatcher == null
            ||
            !($this->_dispatcher instanceof Dispatcher)
        ) {
            throw new Exception\StartupError(
                'Instantiation of dispatcher failed'
            );
        }
        $this->_dispatcher->setRequest($request);

        //loader initialization
        $loader = Loader::getInstance(
            (
                isset($this->_options['local_library'])
                ?$this->_options['local_library']
                :''
            ),
            G::iniGet('yaf.library')
        );
        if (
            $loader == null
            ||
            !($loader instanceof Loader)
        ) {
            throw new Exception\StartupError(
                'Initialization of application auto loader failed'
            );
        }

        if (
            isset($this->_options['local_namespace'])
            &&
            $this->_options['local_namespace'] !=''
        ) {
            $namespace = str_replace(
                array(',', ' '),
                array(':', ':'),
                $this->_options['local_namespace']
            );
            $loader->registerLocalNamespace($namespace);
        }

        self::$_app = $this;
        if (G::get('throwException') == false) {
            set_exception_handler(array($this, 'exceptionHandler'));
        }
    }
    public function __destruct()
    {

    }

    public function bootstrap()
    {
        $bootstrapClass = Bootstrap_Abstract::YAF_DEFAULT_BOOTSTRAP;
        if (isset($this->_options['bootstrap'])) {
            $bootstrap = $this->_options['bootstrap'];
        } else {
            $bootstrap =
                $this->getAppDirectory() .
                DIRECTORY_SEPARATOR. $bootstrapClass .
                '.' . G::get('ext');
        }

        $loader = Loader::getInstance();
        if (Loader::import($bootstrap)) {
            if (!class_exists($bootstrapClass)) {
                throw new Exception(
                    'Couldn\'t find class Bootstrap in '.$bootstrap
                );
            } else {
                $bootstrap = new $bootstrapClass();
                if (!($bootstrap instanceof Bootstrap_Abstract)) {
                    throw new Exception(
                        'Expect a Yaf_Bootstrap_Abstract instance, '.
                        get_class($bootstrap).' give '
                    );
                }
                if (version_compare(PHP_VERSION, '5.2.6') === -1) {
                    $class        = new \ReflectionObject($bootstrap);
                    $classMethods = $class->getMethods();
                    $methodNames  = array();

                    foreach ($classMethods as $method) {
                        $methodNames[] = $method->getName();
                    }
                } else {
                    $methodNames = get_class_methods($bootstrap);
                }
                $initMethodLength = strlen(
                    Bootstrap_Abstract::YAF_BOOTSTRAP_INITFUNC_PREFIX
                );
                foreach ($methodNames as $method) {
                    if (
                        $initMethodLength < strlen($method)
                        &&
                        Bootstrap_Abstract::YAF_BOOTSTRAP_INITFUNC_PREFIX
                        ===
                        substr(
                            $method, 0, $initMethodLength
                        )
                    ) {
                        $bootstrap->$method($this->_dispatcher);
                    }
                }
            }
        } else {
            throw new Exception(
                'Couldn\'t find bootstrap file '.$bootstrap
            );
        }
        return $this;
    }
    /**
     * Start Yaf_Application
     */
    public function run()
    {
        if ($this->_running == true) {
            throw new Exception\StartupError(
                'An application instance already run'
            );
        } else {
            $this->_running = true;
            return $this->_dispatcher->dispatch();
        }
    }
    /**
     * Retrieve application instance
     * @return Yaf_Application
     */
    public static function app()
    {
        return self::$_app;
    }

    /**
     * Retrieve the config instance
     */
    public function getConfig()
    {
        return $this->_config;
    }

    /**
     * Get Yaf_Dispatcher instance
     * @return Yaf_Dispatcher
     */
    public function getDispatcher()
    {
        return $this->_dispatcher;
    }
    /**
     * Get defined module names
     */
    public function getModules()
    {
        return $this->_modules;
    }
    /**
     * Retrieve environment
     */
    public function environ()
    {
        $env = $this->_environ;
        if ($env == null) {
            $fromIni = ini_get('yaf.environ');
            if ($fromIni) {
                $env = $fromIni;
            } else {
                $env = 'product';
            }
        }
        return $env;
    }

    public function execute($args)
    {
        $arguments = func_get_args();
        $callback = $arguments[0];
        if (!is_callable($callback)) {
            Exception::trigger_error(
                'First argument is expected to be a valid callback',
                E_USER_WARNING
            );
        }
        array_shift($arguments);
        return call_user_func_array($callback, $arguments);
    }

    /**
     * Yaf_Application can not be cloned
     */
    private function __clone()
    {

    }
    /**
     * Yaf_Application can not be serialized
     */
    private function __sleep()
    {

    }
    /**
     * Yaf_Application can not be deserialized
     */
    private function __wakeup()
    {

    }

    public function getAppDirectory()
    {
        return G::get('directory');
    }

    public function setAppDirectory($directory)
    {
        if (!is_dir($directory) || !G::isAbsolutePath($directory)) {
            return false;
        }
        G::set('directory', $directory);
        return $this;
    }

    /**
     * this was added internally
     * @param string $module
     * @return boolean
     */
    public static function isModuleName($module)
    {
        $app = self::app();
        if ($app == null) {
            return false;
        }
        $modules = $app->getModules();
        if (
            array_search(
                strtolower($module),
                array_map('strtolower', $modules)
            ) !== false
        ) {
            return true;
        }
        return false;
    }

    public function setErrorNo($errno)
    {
        $this->_errno = $errno;
    }

    public function setErrorMsg($msg)
    {
        $this->_errmsg = $msg;
    }

    public function clearLastError()
    {
        $this->_errno = 0;
        $this->_errmsg = '';
    }

    public function getLastErrorMsg()
    {
        return $this->_errmsg;
    }

    public function getLastErrorNo()
    {
        return $this->_errno;
    }

     /**
     * Load configuration file of options
     *
     * @param  string $file
     * @throws Yaf_Exception when invalid configuration file is provided
     * @return array
     */
    protected function _loadConfig($file)
    {
        $environment = $this->environ();
        if (is_string($file)) {
            $config = new Config\Ini($file, $environment);
        } elseif (is_array($file)) {
            $config = new Config\Simple($file);
        } elseif ($file instanceof Config_Abstract) {
            $config = $file;
        } else {
            throw new Exception(
                'Invalid options provided; must be location of config file, '.
                'a config object, or an array'
            );
        }
        return $config;
    }

    /**
     * Parse application options
     *
     * @param  array $options
     * @throws Yaf_Exception When no bootstrap path is provided
     * @throws Yaf_Exception When invalid bootstrap information are provided
     * @return Yaf_Application
     */
    protected function parseOptions(array $options)
    {
        if (!is_array($options)) {
            throw new Exception\TypeError(
                'Expected an array of application configure'
            );
        }
        $options = array_change_key_case($options, CASE_LOWER);
        if (!isset($options['application'])) {
            throw new Exception\TypeError(
                'Expected an array of application configure'
            );
        }
        $options = $options['application'];
        if (!empty($options['directory'])) {
            G::set(
                'directory',
                preg_replace(
                    "/".preg_quote(DIRECTORY_SEPARATOR, "/")."$/",
                    "", $options['directory']
                )
            );
        } else {
            throw new Exception\StartupError(
                'Expected a directory entry in application configures'
            );
        }

        if (!empty($options['ext'])) {
            G::set('ext', $options['ext']);
        }
        if (!empty($options['bootstrap']) && is_string($options['bootstrap'])) {
            $this->_options['bootstrap'] = $options['bootstrap'];
        }
        if (!empty($options['library'])) {
            if (is_string($options['library'])) {
                $this->_options['local_library'] = $options['library'];
            } elseif (is_array($options['library'])) {
                if (!empty($options['library']['directory'])
                    && is_string($options['library']['directory'])
                ) {
                    $this->_options['local_library'] =
                    $options['library']['directory'];
                }
                if (!empty($options['library']['namespace'])
                    && is_string($options['library']['namespace'])
                ) {
                    $this->_options['local_namespace'] =
                    $options['library']['namespace'];
                }

            }
        } else {
            $this->_options['local_library'] =
                G::get('directory') . DIRECTORY_SEPARATOR .
                Loader::YAF_LIBRARY_DIRECTORY_NAME;
        }
        if (!empty($options['view'])
            && is_array($options['view'])
            && !empty($options['view']['ext'])
            && is_string($options['view']['ext'])
        ) {
            G::set('view_ext', $options['view']['ext']);
        }
        if (!empty($options['baseUri']) && is_string($options['baseUri'])) {
            $this->_options['baseUri'] = $options['baseUri'];
        } else {
            $this->_options['baseUri'] = $_SERVER['PHP_SELF'];
        }
        if (!empty($options['dispatcher']) && is_array($options['dispatcher'])
        ) {
            if (!empty($options['dispatcher']['defaultModule'])
            && is_string($options['dispatcher']['defaultModule'])
            ) {
                G::set(
                    'default_module', $options['dispatcher']['defaultModule']
                );
            } else {
                G::set(
                    'default_module',
                    Router::YAF_ROUTER_DEFAULT_MODULE
                );
            }
            if (!empty($options['dispatcher']['defaultController'])
            && is_string($options['dispatcher']['defaultController'])
            ) {
                G::set(
                    'default_controller',
                    $options['dispatcher']['defaultController']
                );
            } else {
                G::set(
                    'default_controller',
                    Router::YAF_ROUTER_DEFAULT_CONTROLLER
                );
            }
            if (!empty($options['dispatcher']['defaultAction'])
            && is_string($options['dispatcher']['defaultAction'])
            ) {
                G::set(
                    'default_action',
                    $options['dispatcher']['defaultAction']
                );
            } else {
                G::set(
                    'default_action',
                    Router::YAF_ROUTER_DEFAULT_ACTION
                );
            }
            if (isset($options['dispatcher']['throwException'])) {
                G::set(
                    'throwException',
                    (boolean)$options['dispatcher']['throwException']
                );
            }
            if (isset($options['dispatcher']['catchException'])) {
                G::set(
                    'catchException',
                    (boolean)$options['dispatcher']['catchException']
                );
            }
            if (
                isset($options['dispatcher']['defaultRoute'])
                &&
                is_array($options['dispatcher']['defaultRoute'])
            ) {
                G::set(
                    'default_route',
                    $options['dispatcher']['defaultRoute']
                );
            }
        } else {
            G::set(
                'default_module',
                Router::YAF_ROUTER_DEFAULT_MODULE
            );
            G::set(
                'default_controller',
                Router::YAF_ROUTER_DEFAULT_CONTROLLER
            );
            G::set(
                'default_action',
                Router::YAF_ROUTER_DEFAULT_ACTION
            );
            $this->_options['throwException'] = true;
            $this->_options['catchException'] = true;
        }
        if (!empty($options['modules']) && is_string($options['modules'])) {
            $modules = preg_split("/,/", $options['modules']);
            foreach ($modules as $module) {
                $this->_modules[] = trim($module);
            }
        }
        if (empty($this->_modules)) {
            $this->_modules[] = G::get('default_module');
        }
        return true;
    }

     public function exceptionHandler (\Exception $e)
     {
         //the exception is registered
         echo PHP_EOL.'Exception throught App - '.$e->getMessage();
     }
}