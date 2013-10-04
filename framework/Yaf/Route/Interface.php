<?php
/**
 * Yaf Route Interface
 */
interface Yaf_Route_Interface
{
    /**
     * Processes a request and sets its controller and action.  If
     * no route was possible, default route is set.
     *
     * @param  Yaf_Request_Abstract
     * @return Yaf_Request_Abstract|boolean
     */
    public function route(Yaf_Request_Abstract $request);

}