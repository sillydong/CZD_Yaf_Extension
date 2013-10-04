<?php
/**
 * Yaf Plugin Abstract
 */

/**
 * @namespace
 */
namespace Yaf;

class Plugin_Abstract
{
    public function dispatchLoopShutdown (
        Request_Abstract $request ,
        Response_Abstract $response
    )
    {

    }

    public function dispatchLoopStartup (
        Request_Abstract $request ,
        Response_Abstract $response
    )
    {

    }
    public function postDispatch (
        Request_Abstract $request ,
        Response_Abstract $response
    )
    {

    }
    public function preDispatch (
        Request_Abstract $request ,
        Response_Abstract $response
    )
    {

    }
    public function routerShutdown (
        Request_Abstract $request ,
        Response_Abstract $response
    )
    {

    }
    public function routerStartup (
        Request_Abstract $request ,
        Response_Abstract $response
    )
    {

    }
}