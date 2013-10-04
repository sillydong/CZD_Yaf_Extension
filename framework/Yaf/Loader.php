<?php
/**
 * Yaf loader
 * @todo
 * check if local namespace from application.ini with , as sep would be
 * transformed to :
 *
 */
class Yaf_Loader
{
    const YAF_LOADER_RESERVERD = 'Yaf_';

    const YAF_LOADER_CONTROLLER	= 'Controller';
    const YAF_LOADER_MODEL = 'Model';
    const YAF_LOADER_PLUGIN	= 'Plugin';
    //not used yet
    const YAF_LOADER_DAO	= 'Dao_';
    const YAF_LOADER_SERVICE	= 'Service_';

    const YAF_LIBRARY_DIRECTORY_NAME = 'library';
    const YAF_CONTROLLER_DIRECTORY_NAME= 'controllers';
    const YAF_PLUGIN_DIRECTORY_NAME= 'plugins';
    const YAF_MODULE_DIRECTORY_NAME= 'modules';
    const YAF_VIEW_DIRECTORY_NAME= 'views';
    const YAF_MODEL_DIRECTORY_NAME= 'models';
    const YAF_DEFAULT_VIEW_EXT = 'phtml';



    /**
     * @var Yaf_Loader instance
     */
    protected static $_instance;
    /**
     * @var string default library path
     */
    protected $_library;
    /**
     * @var string global library path
     */
    protected $_globalLibrary;

    /**
     * @var string Namespace of classes within this resource
     */
    protected $_localNamespace='';

    public function internal_autoload($class, $dirs = null)
    {
        if (class_exists($class, false) || interface_exists($class, false)) {
            return ;
        }

        if ((null !== $dirs) && !is_string($dirs)) {
            throw new Yaf_Exception('Directory argument must be a string');
        }
        if ($dirs == null) {
            $dirs = $this->resolveDirectory($class);
        }
        $file = $this->resolveClass($class);

        if (!empty($dirs)) {
            // use the autodiscovered path
            $dirPath = dirname($file);
            $dirs = explode(PATH_SEPARATOR, $dirs);
            foreach ($dirs as $key => $dir) {
                if ($dir == '.') {
                    $dirs[$key] = $dirPath;
                } else {
                    $dir = rtrim($dir, '\\/');
                    $dirs[$key] = $dir . DIRECTORY_SEPARATOR . $dirPath;
                }
            }
            $file = basename($file);
            return self::import($file, $dirs);
        } else {
            return self::import($file);
        }
    }

    /**
     * Attempt to autoload a class
     *
     * @param  string $class
     * @return mixed False if not matched, otherwise result if include operation
     */
    public function autoload($class)
    {
        $className = $class;
        if (
            class_exists($className, false)
            ||
            interface_exists($className, false)
        ) {
            return true;
        }
        if (strpos($class, self::YAF_LOADER_RESERVERD) === 0) {
            throw new Yaf_Exception(
                'You should not use '.self::YAF_LOADER_RESERVERD.
                ' as class name prefix'
            );
        }
        $appDir = Yaf_G::get('directory');
        $directory = '';
        if ($this->isCategoryType($class, self::YAF_LOADER_MODEL)) {
            //this is a model
            $directory = $appDir .
                DIRECTORY_SEPARATOR .
                self::YAF_MODEL_DIRECTORY_NAME .
                DIRECTORY_SEPARATOR;
            $class = $this->resolveCategory(
                $class, self::YAF_LOADER_MODEL
            );
        } else if ($this->isCategoryType($class, self::YAF_LOADER_PLUGIN)) {
            //this is a plugin
            $directory = $appDir .
                DIRECTORY_SEPARATOR .self::YAF_PLUGIN_DIRECTORY_NAME;
            $class = $this->resolveCategory(
                $class, self::YAF_LOADER_PLUGIN
            );
        } else if (
            $this->isCategoryType($class, self::YAF_LOADER_CONTROLLER)
        ) {
            //this is a controller
            $directory = $appDir .
                DIRECTORY_SEPARATOR .self::YAF_CONTROLLER_DIRECTORY_NAME;
            $class = $this->resolveCategory(
                $class, self::YAF_LOADER_CONTROLLER
            );
        } else if (
            $this->isCategoryType($class, self::YAF_LOADER_DAO)
            ||
            $this->isCategoryType($class, self::YAF_LOADER_SERVICE)
        ) {
            //this is used internally
            $directory = $appDir .
                DIRECTORY_SEPARATOR .self::YAF_MODEL_DIRECTORY_NAME;
        }
        if ($directory!='' && $appDir=='') {
            Yaf_Exception::trigger_error(
                'Couldn\'t load a framework MVC class without an '.
                'Yaf_Application initializing ',
                E_USER_WARNING
            );
        }
        $splAutoLoadIni = Yaf_G::iniGet('yaf.use_spl_autoload');
        if ($this->internal_autoload($class, $directory)) {
            if (
                !class_exists($className, false)
                &&
                !interface_exists($className, false)
            ) {
                if ($splAutoLoadIni == false) {
                    Yaf_Exception::trigger_error(
                        'Could not find class '.$className.' in '.$directory,
                        E_USER_ERROR
                    );
                } else {
                    return false;
                }
            }
        } else {
            if ($splAutoLoadIni == false) {
                Yaf_Exception::trigger_error(
                    'Could not find script '.
                    ($directory!=''?$directory:$this->resolveDirectory($class)).
                    DIRECTORY_SEPARATOR.$this->resolveClass($class),
                    E_USER_WARNING
                );
            } else {
                return false;
            }
        }
        return true;
    }

    private function isCategoryType($className, $category)
    {
        $nameSeparator = Yaf_G::iniGet('yaf.name_separator');
        if (Yaf_G::iniGet('yaf.name_suffix') == true) {
            //we should check at the end of the class name
            if (
                $category == substr(
                    $className,
                    strlen($className)-strlen($category),
                    strlen($category)
                )
            ) {
                if (
                    $nameSeparator == ''
                    ||
                    substr(
                        $className,
                        strlen($className)-strlen($category)-
                        strlen($nameSeparator),
                        strlen($nameSeparator)
                    ) == $nameSeparator
                ) {
                    return true;
                }
            }
        } else {
            //we check at the begining
            if (
                $category == substr(
                    $className,
                    0,
                    strlen($category)
                )
            ) {
                if (
                    $nameSeparator == ''
                    ||
                    substr(
                        $className,
                        strlen($category),
                        strlen($nameSeparator)
                    ) == $nameSeparator
                ) {
                    return true;
                }
            }
        }
    }

    private function resolveCategory($className, $category)
    {
        $nameSeparator = Yaf_G::iniGet('yaf.name_separator');
        if (Yaf_G::iniGet('yaf.name_suffix') == true) {
            //we should remove from the end of classname
            return substr(
                $className,
                0,
                strlen($className)-strlen($category)-
                strlen($nameSeparator)
            );
        } else {
            //we should remove from the start of the classname
            return substr(
                $className,
                strlen($category)-strlen($nameSeparator),
                strlen($className)
            );
        }
    }

    private function resolveDirectory($class)
    {
        if ($this->isLocalName($class)) {
            $directory = $this->_library;
        } else {
            $directory = $this->_globalLibrary;
        }
        if ($directory == '') {
            Yaf_Exception::trigger_error(
                'Yaf_Loader requires Yaf_Application'.
                '(which set the library_directory) to be initialized first',
                E_USER_WARNING
            );
        }
        return $directory;
    }

    private function resolveClass($class)
    {
        // Autodiscover the path from the class name
        // Implementation is PHP namespace-aware, and based on
        // Framework Interop Group reference implementation:
        // http://groups.google.com/group/php-standards/web/psr-0-final-proposal
        $className = ltrim($class, '\\');
        $file      = '';
        $namespace = '';
        if (($lastNsPos = strripos($className, '\\'))!==false) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $file      = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) .
            DIRECTORY_SEPARATOR;
        }
        if (Yaf_G::iniGet('yaf.lowcase_path') == true) {
            $file = strtolower($file);
            $segments = explode('_', $className);
            foreach ($segments as $key=>&$value) {
                if ($key != (count($segments)-1)) {
                    $value = strtolower($value);
                }
            }
            $file .= implode(DIRECTORY_SEPARATOR, $segments) .
                '.' . Yaf_G::get('ext');
        } else {
            $file .= str_replace('_', DIRECTORY_SEPARATOR, $className) .
                '.' . Yaf_G::get('ext');
        }

        return $file;
    }

    /**
     * Loads a PHP file.  This is a wrapper for PHP's include() function.
     *
     * $filename must be the complete filename, including any
     * extension such as ".php".  Note that a security check is performed that
     * does not permit extended characters in the filename.  This method is
     * intended for loading Zend Framework files.
     *
     * If $dirs is a string or an array, it will search the directories
     * in the order supplied, and attempt to load the first matching file.
     *
     * If the file was not found in the $dirs, or if no $dirs were specified,
     * it will attempt to load it from PHP's include_path.
     *
     *
     * @param  string        $filename
     * @param  string|array  $dirs - OPTIONAL either a path or array of paths
     *                       to search.
     * @return boolean
     */
    public static function import($filename, $dirs = null)
    {
        $loader = self::getInstance();
        $loader->_securityCheck($filename);

        /**
         * Search in provided directories, as well as include_path
         */
        $incPath = false;
        if (!empty($dirs) && (is_array($dirs) || is_string($dirs))) {
            if (is_array($dirs)) {
                $dirs = implode(PATH_SEPARATOR, $dirs);
            }
            $incPath = get_include_path();
            set_include_path($dirs . PATH_SEPARATOR . $incPath);
        }

        /**
         * Try finding for the plain filename in the include_path.
         */
        if (!@include $filename) {
            return false;
        }

        /**
         * If searching in directories, reset include_path
         */
        if ($incPath) {
            set_include_path($incPath);
        }

        return true;
    }

    /**
     * Ensure that filename does not contain exploits
     *
     * @param  string $filename
     * @return void
     * @throws Yaf_Exception
     */
    private function _securityCheck($filename)
    {
        /**
         * Security check
         */
        if (preg_match('/[^a-z0-9\\/\\\\_.:-]/i', $filename)) {
            throw new Yaf_Exception(
                'Security check: Illegal character in filename'
            );
        }
    }

    public function clearLocalNamespace()
    {
        $this->_localNamespace = '';
    }
    /**
     * not possible to clone
     */
    private function __clone()
    {
    }

    /**
     * Constructor
     *
     * @param
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Retrieve singleton instance
     *
     * @return Yaf_Loader
     */
    public static function getInstance($library = null, $globalLibrary = null)
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
            $instance = self::$_instance;
            if ($library!=null) {
                $instance->setLibraryPath($library, false);
            }
            if ($globalLibrary!=null) {
                $instance->setLibraryPath($globalLibrary, true);
            } else {
                if ($library!=null) {
                    $instance->setLibraryPath($library, true);
                }
            }
            if (phpversion() >= "5.3") {
                spl_autoload_register(
                    array($instance, 'autoload'), true, false
                );
            } else {
                spl_autoload_register(
                    array($instance, 'autoload'), true
                );
            }
        } else {
            $instance = self::$_instance;
            if ($library!=null) {
                $instance->setLibraryPath($library, false);
            }
            if ($globalLibrary!=null) {
                $instance->setLibraryPath($globalLibrary, true);
            }
        }

        return self::$_instance;
    }

    /**
     * Get base path to this set of resources
     *
     * @return string
     */
    public function getLibraryPath($isGlobal=false)
    {
        if ($isGlobal == true) {
            return $this->_globalLibrary;
        } else {
            return $this->_library;
        }
    }

    /**
     * Get namespace this autoloader handles
     *
     * @return string
     */
    public function getLocalNamespace()
    {
        return $this->_localNamespace;
    }

    public function isLocalName($className)
    {
        $namespaces = $this->getLocalNamespace();
        if (null == $namespaces) {
            return false;
        }
        $className = ltrim($className, '\\');
        $prefix = '';
        if (($pos = strpos($className, '_'))!==false) {
            $prefix = substr($className, 0, $pos);
            $class = substr($className, $pos + 1);
        } else if (($pos = strpos($className, '\\'))!==false) {
            $prefix = substr($className, 0, $pos);
            $class = substr($className, $pos + 1);
        }
        if ($prefix == '') {
            return false;
        }
        $prefixes = explode(PATH_SEPARATOR, $namespaces);
        if (in_array($prefix, $prefixes)) {
            return true;
        }
        return false;
    }
    /**
     * register a namespace for the loader
     *
     * @param  string|array $namespace
     * * @throws Yaf_Exception if namespace is not string or array
     */
    public function registerLocalNamespace($namespace)
    {
        if (!is_string($namespace) && !is_array($namespace)) {
            throw new Yaf_Exception(
                'Invalid parameters provided, must be a string, or an array'
            );
        }
        $directorySeparator = PATH_SEPARATOR;
        if (is_string($namespace)) {
            if ($this->_localNamespace == '') {
                $this->_localNamespace .= $directorySeparator;
            }
            $this->_localNamespace .= (string) $namespace . $directorySeparator;
        } elseif (is_array($namespace)) {
            if ($this->_localNamespace == '') {
                $this->_localNamespace .= $directorySeparator;
            }
            foreach ($namespace as $value) {
                $this->_localNamespace .= (string) $value . $directorySeparator;
            }
        }
    }



    /**
     * Set base path for this set of resources
     *
     * @param  string $path
     * @return void
     */
    public function setLibraryPath($path, $isGlobal=false)
    {
        if ($isGlobal == true) {
            $this->_globalLibrary = (string) $path;
        } else {
            $this->_library = (string) $path;
        }
    }

    private function __sleep()
    {

    }

    private function __wakeup()
    {

    }
}
