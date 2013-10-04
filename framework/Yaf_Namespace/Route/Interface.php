<?php
/**
 * Yaf Route Interface
 */

/**
 * @namespace
 */
namespace Yaf;

interface Route_Interface
{
    /**
     * Processes a request and sets its controller and action.  If
     * no route was possible, default route is set.
     *
     * @param  Yaf_Request_Abstract
     * @return Yaf_Request_Abstract|boolean
     */
    public function route(Request_Abstract $request);

}