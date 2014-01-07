<?php

class CacheFs extends Cache {

	protected $depth;

	protected function __construct() {
		$this->depth = 2;

		$keys_filename = $this->getFilename(CACHE_KEY_PREFIX . self::KEYS_NAME);
		if (file_exists($keys_filename))
			$this->keys = unserialize(file_get_contents($keys_filename));
	}

	protected function _set($key, $value, $ttl = 0) {
		return (@file_put_contents($this->getFilename($key), serialize($value)));
	}

	protected function _get($key) {
		if ($this->keys[$key] > 0 && $this->keys[$key] < time())
		{
			$this->delete($key);

			return false;
		}

		$filename = $this->getFilename($key);
		if (!file_exists($filename))
		{
			unset($this->keys[$key]);
			$this->_writeKeys();

			return false;
		}
		$file = file_get_contents($filename);

		return unserialize($file);
	}

	protected function _exists($key) {
		if ($this->keys[$key] > 0 && $this->keys[$key] < time())
		{
			$this->delete($key);

			return false;
		}

		return isset($this->keys[$key]) && file_exists($this->getFilename($key));
	}

	protected function _delete($key) {
		$filename = $this->getFilename($key);
		if (!file_exists($filename))
			return true;

		return unlink($filename);
	}

	protected function _writeKeys() {
		@file_put_contents($this->getFilename(CACHE_KEY_PREFIX . self::KEYS_NAME), serialize($this->keys));
	}

	public function flush() {
		$this->delete('*');

		return true;
	}

	public static function deleteCacheDirectory() {
		Tools::deleteDirectory(CACHEFS_DIR, false);
	}

	public static function createCacheDirectories($level_depth, $directory = false) {
		if (!$directory)
			$directory = CACHEFS_DIR;
		$chars = '0123456789abcdef';
		for ($i = 0, $length = strlen($chars); $i < $length; $i++)
		{
			$new_dir = $directory . $chars[$i] . '/';
			if (mkdir($new_dir))
				if (chmod($new_dir, 0777))
					if ($level_depth - 1 > 0)
						CacheFs::createCacheDirectories($level_depth - 1, $new_dir);
		}
	}

	protected function getFilename($key) {
		$path = CACHEFS_DIR;
		for ($i = 0; $i < $this->depth; $i++)
			$path .= $key[$i] . '/';

		return $path . $key;
	}
}
