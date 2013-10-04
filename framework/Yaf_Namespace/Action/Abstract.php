<?php
/**
 * @todo check an example to see how does it work
 * Yaf Action Abstract
 */

/**
 * @namespace
 */
namespace Yaf;

abstract class Action_Abstract extends Controller_Abstract
{
    protected $_controller = null;
    public function execute()
    {

    }

    public function getController()
    {
        return $this->_controller;
    }
}
