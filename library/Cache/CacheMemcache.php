<?php

class CacheMemcache extends Cache {

	protected $memcache;

	protected $is_connected = false;

	public function __construct() {
		$this->connect();

		$this->keys = array();
		if ($this->is_connected)
		{
			$servers = self::getMemcachedServers();

			if (is_array($servers) && count($servers) > 0 && method_exists('Memcache', 'getStats'))
				$all_slabs = $this->memcache->getExtendedStats('slabs');

			if (isset($all_slabs) && is_array($all_slabs))
			{
				foreach ($all_slabs as $server => $slabs)
				{
					if (is_array($slabs))
					{
						foreach ($slabs as $slab_id => $slab_meta)
						{
							if (is_int($slab_id))
							{
								$dump = $this->memcache->getExtendedStats('cachedump', (int)$slab_id, (int)$slab_meta['used_chunks']);
								if ($dump && is_array($dump[$server]))
								{
									foreach ($dump[$server] as $key => $item)
									{
										$this->keys[$key] = $item[1];
									}
								}
							}
						}
					}
				}
			}
		}

	}

	public function __destruct() {
		$this->close();
	}

	public function connect() {
		if (extension_loaded('memcache') && class_exists('Memcache'))
		{
			$this->memcache = new Memcache();
		}
		else
		{
			return false;
		}
		$servers = self::getMemcachedServers();
		if (!$servers)
			return false;
		foreach ($servers as $server)
			$this->memcache->addServer($server['host'], $server['port'], true);
		$this->is_connected = true;

		return true;
	}

	protected function _set($key, $value, $ttl = 0) {
		if (!$this->is_connected)
			return false;

		return $this->memcache->set($key, $value, 0, $ttl);
	}

	protected function _get($key) {
		if (!$this->is_connected)
			return false;

		return $this->memcache->get($key);
	}

	protected function _exists($key) {
		if (!$this->is_connected)
			return false;

		return isset($this->keys[$key]);
	}

	protected function _delete($key) {
		if (!$this->is_connected)
			return false;

		return $this->memcache->delete($key);
	}

	protected function _writeKeys() {

	}

	public function flush() {
		if (!$this->is_connected)
			return false;

		return $this->memcache->flush();
	}

	protected function close() {
		if (!$this->is_connected)
			return false;

		return $this->memcache->close();
	}

	public static function getMemcachedServers() {
		if (Yaf_Registry::has('memcache_servers'))
		{
			return Yaf_Registry::get('memcache_servers');
		}
		else
		{
			$servers = array();
			$memcaches = Yaf_Registry::get('config')->cache->memcache;
			if (!empty($memcaches))
			{
				$hosts = explode('|', $memcaches->hosts);
				$ports = explode('|', $memcaches->ports);
				foreach ($hosts as $key => $host)
				{
					if (isset($ports[$key]))
					{
						$servers[] = array('host' => $host, 'port' => $ports[$key]);
					}
				}
				Yaf_Registry::set('memcache_servers', $servers);
			}

			return $servers;
		}

	}
}
