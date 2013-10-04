<?php
/**
 * Yaf Request Http
 */

/**
 * @namespace
 */
namespace Yaf\Request;

class Http extends \Yaf\Request_Abstract
{
    /**
     * Scheme for http
     *
     */
    const SCHEME_HTTP  = 'http';

    /**
     * Scheme for https
     *
     */
    const SCHEME_HTTPS = 'https';


    /**
     * REQUEST_URI
     * @var string;
     */
    protected $_requestUri;


    /**
     * Constructor
     *
     * @param string $requestUri
     * @param string $baseUri
     * @return void
     */
    public function __construct($requestUri = null, $baseUri=null)
    {
        if (null !== $requestUri) {
            $this->_requestUri = $requestUri;
        } else {
            $this->setRequestUri();
        }
        if (null !== $baseUri) {
            $this->_baseUri = $baseUri;
        } else {
            $this->setBaseUri();
        }
        //this will set the current method
        $this->getMethod();
    }

    private function __clone()
    {
        //clone is not possible to do
    }

    /**
     * Magic method get
     * @param string $key
     * @return mixed
     */
    public function __get($name)
    {
        return $this->get($name);
    }

   /**
     * Access values contained in the superglobals as public members
     * Order of precedence: 1. GET, 2. POST, 3. COOKIE, 4. SERVER, 5. ENV
     *
     * @param string $name
     * @return mixed
     */
    public function get($name, $default=null)
    {
        switch (true) {
            case isset($this->_params[$name]):
                return $this->_params[$name];
            case isset($_GET[$name]):
                return $_GET[$name];
            case isset($_POST[$name]):
                return $_POST[$name];
            case isset($_COOKIE[$name]):
                return $_COOKIE[$name];
            case ($name == 'REQUEST_URI'):
                return $this->getRequestUri();
            case ($name == 'PATH_INFO'):
                return $this->getPathInfo();
            case isset($_SERVER[$name]):
                return $_SERVER[$name];
            case isset($_ENV[$name]):
                return $_ENV[$name];
            default:
                return $default;
        }
    }

    public function __set($name, $value)
    {
        throw new Exception(
            'Use setParam to set a parameter of request'
        );
    }

    /**
     * Check to see if a property is set
     *
     * @param string $key
     * @return boolean
     */
    public function __isset($key)
    {
        switch (true) {
            case isset($this->_params[$key]):
                return true;
            case isset($_GET[$key]):
                return true;
            case isset($_POST[$key]):
                return true;
            case isset($_COOKIE[$key]):
                return true;
            case isset($_SERVER[$key]):
                return true;
            case isset($_ENV[$key]):
                return true;
            default:
                return false;
        }
    }

    /**
     * Retrieve a member of the $_GET superglobal
     *
     * If no $name is passed, returns the entire $_GET array.
     *
     * @param string $name
     * @param mixed $default Default value to use if key not found
     * @return mixed Returns null if key does not exist
     */
    public function getQuery($name = null, $default = null)
    {
        if (null === $name) {
            return $_GET;
        }

        return (isset($_GET[$name])) ? $_GET[$name] : $default;
    }

    /**
     * Retrieve a member of the $_POST superglobal
     *
     * If no $name is passed, returns the entire $_POST array.
     *
     * @param string $name
     * @param mixed $default Default value to use if key not found
     * @return mixed Returns null if key does not exist
     */
    public function getPost($name = null, $default = null)
    {
        if (null === $name) {
            return $_POST;
        }
        return (isset($_POST[$name])) ? $_POST[$name] : $default;
    }

    /**
     * Retrieve a member of the $_COOKIE superglobal
     *
     * If no $name is passed, returns the entire $_COOKIE array.
     *
     * @param string $name
     * @param mixed $default Default value to use if key not found
     * @return mixed Returns null if key does not exist
     */
    public function getCookie($name = null, $default = null)
    {
        if (null === $name) {
            return $_COOKIE;
        }
        return (isset($_COOKIE[$name])) ? $_COOKIE[$name] : $default;
    }

    /**
     * Retrieve a member of the $_FILES superglobal
     *
     * If no $name is passed, returns the entire $_FILES array.
     *
     * @param string $name
     * @param mixed $default Default value to use if key not found
     * @return mixed Returns null if key does not exist
     */
    public function getFiles($name = null, $default = null)
    {
        if (null === $name) {
            return $_FILES;
        }
        return (isset($_FILES[$name])) ? $_FILES[$name] : $default;
    }
    /**
     * Retrieve a member of the $_REQUEST superglobal
     *
     * If no $name is passed, returns the entire $_REQUEST array.
     *
     * @param string $name
     * @param mixed $default Default value to use if key not found
     * @return mixed Returns null if key does not exist
     */
    public function getRequest($name = null, $default = null)
    {
        if (null === $name) {
            return $_REQUEST;
        }
        return (isset($_REQUEST[$name])) ? $_REQUEST[$name] : $default;
    }


    /**
     * Returns the REQUEST_URI taking into account
     * platform differences between Apache and IIS
     *
     * @return string
     */
    public function getRequestUri()
    {
        if (empty($this->_requestUri)) {
            $this->setRequestUri();
        }

        return $this->_requestUri;
    }

    /**
     * Everything in REQUEST_URI before PATH_INFO
     * <form action="<?=$baseUrl?>/news/submit" method="POST"/>
     *
     * @return string
     */
    public function getBaseUri()
    {
        if (null === $this->_baseUri) {
            $this->setBaseUri();
        }
        return $this->_baseUri;

    }

    /**
     * Set the base URL of the request; i.e.,
     * the segment leading to the script name
     *
     * E.g.:
     * - /admin
     * - /myapp
     * - /subdir/index.php
     *
     * Do not use the full URI when providing the base. The following are
     * examples of what not to use:
     * - http://example.com/admin (should be just /admin)
     * - http://example.com/subdir/index.php (should be just /subdir/index.php)
     *
     * If no $baseUrl is provided, attempts to determine the base URL from the
     * environment, using SCRIPT_FILENAME, SCRIPT_NAME, PHP_SELF, and
     * ORIG_SCRIPT_NAME in its determination.
     *
     * @param mixed $baseUrl
     * @return Yaf_Request_Abstract
     */
    public function setBaseUri($baseUri = null)
    {
        if ((null !== $baseUri) && !is_string($baseUri)) {
            return $this;
        }

        if ($baseUri === null) {
            $filename = (isset($_SERVER['SCRIPT_FILENAME']))
            ? basename($_SERVER['SCRIPT_FILENAME']) : '';

            if (
                isset($_SERVER['SCRIPT_NAME'])
                && basename($_SERVER['SCRIPT_NAME']) === $filename
            ) {
                $baseUri = $_SERVER['SCRIPT_NAME'];
            } elseif (
                isset($_SERVER['PHP_SELF'])
                && basename($_SERVER['PHP_SELF']) === $filename
            ) {
                $baseUri = $_SERVER['PHP_SELF'];
            } elseif (
                isset($_SERVER['ORIG_SCRIPT_NAME'])
                && basename($_SERVER['ORIG_SCRIPT_NAME']) === $filename
            ) {
                $baseUri = $_SERVER['ORIG_SCRIPT_NAME'];
                // 1and1 shared hosting compatibility
            } else {
                // Backtrack up the script_filename to find the portion matching
                // php_self
                $path    = isset($_SERVER['PHP_SELF'])
                    ? $_SERVER['PHP_SELF'] : '';
                $file    = isset($_SERVER['SCRIPT_FILENAME'])
                    ? $_SERVER['SCRIPT_FILENAME'] : '';
                $segs    = explode('/', trim($file, '/'));
                $segs    = array_reverse($segs);
                $index   = 0;
                $last    = count($segs);
                $baseUri = '';
                do {
                    $seg     = $segs[$index];
                    $baseUri = '/' . $seg . $baseUri;
                    ++$index;
                } while (
                    ($last > $index)
                    && (false !== ($pos = strpos($path, $baseUri)))
                    && (0 != $pos)
                );
            }

            // Does the baseUrl have anything in common with the request_uri?
            $requestUri = $this->getRequestUri();

            if (0 === strpos($requestUri, $baseUri)) {
                // full $baseUrl matches
                $this->_baseUri = $baseUri;
                return $this;
            }

            if (0 === strpos($requestUri, dirname($baseUri))) {
                // directory portion of $baseUrl matches
                $this->_baseUri = dirname($baseUri);
                return $this;
            }

            $truncatedRequestUri = $requestUri;
            if (($pos = strpos($requestUri, '?')) !== false) {
                $truncatedRequestUri = substr($requestUri, 0, $pos);
            }

            $basename = basename($baseUri);
            if (empty($basename) || !strpos($truncatedRequestUri, $basename)) {
                // no match whatsoever; set it blank
                $this->_baseUri = '';
                return $this;
            }

            // If using mod_rewrite or ISAPI_Rewrite strip the script filename
            // out of baseUrl. $pos !== 0 makes sure it is not matching a value
            // from PATH_INFO or QUERY_STRING
            if (
                (strlen($requestUri) >= strlen($baseUri))
                && ((false !== ($pos = strpos($requestUri, $baseUri)))
                && ($pos !== 0))
            ) {
                $baseUri = substr($requestUri, 0, $pos + strlen($baseUri));
            }
        }

        $this->_baseUri = $baseUri;
        return $this;
    }

    /**
     * Set the REQUEST_URI on which the instance operates
     *
     * If no request URI is passed, uses the value in $_SERVER['REQUEST_URI'],
     * $_SERVER['HTTP_X_REWRITE_URL'],
     * or $_SERVER['ORIG_PATH_INFO'] + $_SERVER['QUERY_STRING'].
     *
     * @param string $requestUri
     * @return Yaf_Request_Http
     */
    public function setRequestUri($requestUri = null)
    {
        if ($requestUri === null) {
            if (isset($_SERVER['HTTP_X_REWRITE_URL'])) {
                // check this first so IIS will catch
                $requestUri = $_SERVER['HTTP_X_REWRITE_URL'];
            } elseif (
                // IIS7 with URL Rewrite: make sure we
                // get the unencoded url (double slash problem)
                isset($_SERVER['IIS_WasUrlRewritten'])
                && $_SERVER['IIS_WasUrlRewritten'] == '1'
                && isset($_SERVER['UNENCODED_URL'])
                && $_SERVER['UNENCODED_URL'] != ''
                ) {
                $requestUri = $_SERVER['UNENCODED_URL'];
            } elseif (isset($_SERVER['REQUEST_URI'])) {
                $requestUri = $_SERVER['REQUEST_URI'];
                // Http proxy reqs setup request uri with
                // scheme and host [and port] + the url path, only use url path
                $schemeAndHttpHost = $this->getScheme() .
                    '://' . $this->getHttpHost();
                if (strpos($requestUri, $schemeAndHttpHost) === 0) {
                    $requestUri = substr(
                        $requestUri, strlen($schemeAndHttpHost)
                    );
                }
            } elseif (isset($_SERVER['ORIG_PATH_INFO'])) {
                // IIS 5.0, PHP as CGI
                $requestUri = $_SERVER['ORIG_PATH_INFO'];
                if (!empty($_SERVER['QUERY_STRING'])) {
                    $requestUri .= '?' . $_SERVER['QUERY_STRING'];
                }
            } else {
                return $this;
            }
        } elseif (!is_string($requestUri)) {
            return $this;
        } else {
        }

        $this->_requestUri = $requestUri;
        return $this;
    }

//new methods which had to be added

    /**
     * Get the request URI scheme
     *
     * @return string
     */
    public function getScheme()
    {
        return ($this->getServer('HTTPS') == 'on') ?
            self::SCHEME_HTTPS : self::SCHEME_HTTP;
    }
    /**
     * Get the HTTP host.
     *
     * "Host" ":" host [ ":" port ] ; Section 3.2.2
     * Note the HTTP Host header is not the same as the URI host.
     * It includes the port while the URI host doesn't.
     *
     * @return string
     */
    public function getHttpHost()
    {
        $host = $this->getServer('HTTP_HOST');
        if (!empty($host)) {
            return $host;
        }

        $scheme = $this->getScheme();
        $name   = $this->getServer('SERVER_NAME');
        $port   = $this->getServer('SERVER_PORT');

        if (null === $name) {
            return '';
        } elseif (
            ($scheme == self::SCHEME_HTTP && $port == 80)
            ||
            ($scheme == self::SCHEME_HTTPS && $port == 443)
        ) {
            return $name;
        } else {
            return $name . ':' . $port;
        }
    }

}
