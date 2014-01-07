<?php

class CacheApc extends Cache {
	public function __construct() {
		$this->keys = array();
		$cache_info = apc_cache_info('user');
		foreach ($cache_info['cache_list'] as $entry)
			$this->keys[$entry['info']] = $entry['ttl'];
	}

	protected function _set($key, $value, $ttl = 0) {
		return apc_store($key, $value, $ttl);
	}

	protected function _get($key) {
		return apc_fetch($key);
	}


	protected function _exists($key) {
		return isset($this->keys[$key]);
	}

	protected function _delete($key) {
		return apc_delete($key);
	}

	protected function _writeKeys() {
	}

	public function flush() {
		return apc_clear_cache();
	}
}
