<?php
/**
 * Yaf_Response_Cli
 *
 * CLI response for controllers
 *
 */

/**
 * @namespace
 */
namespace Yaf\Response;

class Cli extends \Yaf\Response_Abstract
{

    /**
     * Magic __toString functionality
     *
     * @return string
     */
    public function __toString()
    {
        return $this->_body;
    }
}