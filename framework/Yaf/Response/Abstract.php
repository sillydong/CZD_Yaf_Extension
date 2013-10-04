<?php
/**
 * Yaf_Response_Abstract
 *
 * Base class for Yaf_Controller responses
 *
 */
abstract class Yaf_Response_Abstract
{
    /**
     * Body content
     * @var array
     */
    protected $_body = '';

    /**
     * Array of headers. Each header is an array with keys 'name' and 'value'
     * @var array
     */
    protected $_headers = array();

    /**
     * Determine to send the headers or not
     * @var unknown_type
     */
    protected $_sendheader = false;

    /**
     * Append content to the body content
     *
     * @param string $content
     * @return Yaf_Response_Abstract
     */
    public function appendBody($body)
    {
        $this->_body .= (string) $body;
        return $this;
    }

    /**
     * Clear the entire body
     *
     * @return boolean
     */
    public function clearBody()
    {
        $this->_body = '';
        return true;
    }

    /**
     * Clear headers
     *
     * @return Yaf_Response_Abstract
     */
    public function clearHeaders()
    {
        $this->_headers = array();
        return $this;
    }

    private function __clone()
    {
        //close is not possible
    }

    public function __construct()
    {
    }

    public function __destruct()
    {
    }
    /**
     * Return the body content
     *
     * @return string
     */
    public function getBody()
    {
        return $this->_body;
    }
    /**
     * Return array of headers; see {@link $_headers} for format
     *
     * @return array
     */
    public function getHeader()
    {
        return $this->_headers;
    }
    /**
     * Prepend content the body
     *
     * @param string $body
     * @return Yaf_Response_Abstract
     */
    public function prependBody($body)
    {
        $this->_body = $body . $this->_body;
        return $this;
    }
    /**
     * Send the response, including all headers
     *
     * @return void
     */
    public function response()
    {
        if ($this->_sendheader == true) {
            $this->sendHeaders();
        }
        echo $this->_body;
    }

    private function setAllHeaders()
    {
        //did not found what should this do
    }
    /**
     * Set body content
     *
     * @param string $body
     * @return Yaf_Response_Abstract
     */
    public function setBody($body)
    {
        $this->_body = (string) $body;
        return $this;
    }

    /**
     * Set a header
     *
     * If $replace is true, replaces any headers already defined with that
     * $name.
     *
     * @param string $name
     * @param string $value
     * @param boolean $replace
     * @return Yaf_Response_Abstract
     */
    public function setHeader($name, $value, $replace = false)
    {
        $name  = $this->_normalizeHeader($name);
        $value = (string) $value;

        if ($replace) {
            foreach ($this->_headers as $key => $header) {
                if ($name == $header['name']) {
                    unset($this->_headers[$key]);
                }
            }
        }

        $this->_headers[] = array(
            'name'    => $name,
            'value'   => $value,
            'replace' => $replace
        );

        return $this;
    }

    /**
     * Set redirect URL
     *
     * Sets Location header. Forces replacement of any prior redirects.
     *
     * @param string $url
     * @return Yaf_Response_Abstract
     */
    public function setRedirect($url)
    {
        $this->setHeader('Location', $url, true);
        return $this;
    }

    /**
     * Magic __toString functionality
     *
     * Returns response value as string
     * using output buffering.
     *
     * @return string
     */
    public function __toString()
    {
        ob_start();
        $this->response();
        return ob_get_clean();
    }



//method added to be possible
  /**
     * Normalize a header name
     *
     * Normalizes a header name to X-Capitalized-Names
     *
     * @param  string $name
     * @return string
     */
    protected function _normalizeHeader($name)
    {
        $filtered = str_replace(array('-', '_'), ' ', (string) $name);
        $filtered = ucwords(strtolower($filtered));
        $filtered = str_replace(' ', '-', $filtered);
        return $filtered;
    }

   /**
     * Send all headers
     *
     * Sends any headers specified.
     * If an {@link setHttpResponseCode() HTTP response code}
     * has been specified, it is sent with the first header.
     *
     * @return Yaf_Response_Abstract
     */
    protected function sendHeaders()
    {
        foreach ($this->_headers as $header) {
            header(
                $header['name'] . ': ' . $header['value'],
                $header['replace']
            );
        }
        return $this;
    }

}
