<?php
/**
 * Yaf_Response_Cli
 *
 * CLI response for controllers
 *
 */
class Yaf_Response_Cli extends Yaf_Response_Abstract
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