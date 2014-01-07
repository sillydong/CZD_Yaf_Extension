<?php

class CacheXcache extends Cache {
	public function __construct() {
		$this->keys = xcache_get(CACHE_KEY_PREFIX . self::KEYS_NAME);
		if (!is_array($this->keys))
			$this->keys = array();
	}

	protected function _set($key, $value, $ttl = 0) {
		return xcache_set($key, $value, $ttl);
	}

	protected function _get($key) {
		return xcache_isset($key) ? xcache_get($key) : false;
	}

	protected function _exists($key) {
		return xcache_isset($key);
	}

	protected function _delete($key) {
		return xcache_unset($key);
	}

	protected function _writeKeys() {
		xcache_set(CACHE_KEY_PREFIX . self::KEYS_NAME, $this->keys);
	}

	public function flush() {
		$this->delete('*');

		return true;
	}
}
