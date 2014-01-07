<?php

/**
 * TOP API: taobao.taobaoke.mobile.listurl.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TaobaokeMobileListurlGetRequest {
	/**
	 * 关键词
	 **/
	private $q;

	private $apiParas = array();

	public function setQ($q) {
		$this->q = $q;
		$this->apiParas["q"] = $q;
	}

	public function getQ() {
		return $this->q;
	}

	public function getApiMethodName() {
		return "taobao.taobaoke.mobile.listurl.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->q, "q");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
