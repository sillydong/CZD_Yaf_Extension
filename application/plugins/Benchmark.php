<?php

/**
 * chenzhidong
 * 2013-5-31
 */
class BenchmarkPlugin extends Yaf_Plugin_Abstract {
	public function routerStartup(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {
		Yaf_Registry::set('benchmark_start', microtime(true));
	}

	public function routerShutdown(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {
	}

	public function dispatchLoopStartup(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {

	}

	public function preDispatch(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {

	}

	public function postDispatch(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {

	}

	public function dispatchLoopShutdown(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {
		$start = Yaf_Registry::get('benchmark_start');
		Yaf_Registry::del('benchmark_start');
		$time = microtime(true) - (float)$start;
		if ($time > 1)
		{
			Log::out('benchmark', 'I', $request->getRequestUri() . ':' . $time . ':' . (memory_get_usage(true) / 1024) . 'kb');
		}
	}
}
