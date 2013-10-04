<?php
/**
 * Bootstrap is a mechanism used to do some intial config
 * before a Application run.
 * User may define their own Bootstrap class by inheriting
 * Yaf_Bootstrap_Abstract
 * Any method declared in Bootstrap class with leading "_init",
 * will be called by Yaf_Application::bootstrap()
 * one by one according to their defined order.
 *
 */
abstract class Yaf_Bootstrap_Abstract
{
    const YAF_DEFAULT_BOOTSTRAP = 'Bootstrap';
    const YAF_BOOTSTRAP_INITFUNC_PREFIX = '_init';

}