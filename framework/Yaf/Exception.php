<?php
/**
 * Yaf Exception
 */
class Yaf_Exception extends Exception
{
    public static function trigger_error($errmsg='', $errtype=0)
    {
        $app = Yaf_Application::app();
        if ($app!=null) {
            $app->setErrorNo($errtype);
            $app->setErrorMsg($errmsg);
        }
        trigger_error($errmsg, $errtype);
    }
}