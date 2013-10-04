<?php
/**
 * @todo check an example to see how does it work
 * Yaf Action Abstract
 */
abstract class Yaf_Action_Abstract extends Yaf_Controller_Abstract
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
