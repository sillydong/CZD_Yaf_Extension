<?php

/**
 * TOP API: taobao.hanoi.proxy.value.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HanoiProxyValueGetRequest {
	/**
	 * app的密匙
	 **/
	private $appName;

	/**
	 * 结构化数据组装参数。
	 **/
	private $data;

	private $apiParas = array();

	public function setAppName($appName) {
		$this->appName = $appName;
		$this->apiParas["app_name"] = $appName;
	}

	public function getAppName() {
		return $this->appName;
	}

	public function setData($data) {
		$this->data = $data;
		$this->apiParas["data"] = $data;
	}

	public function getData() {
		return $this->data;
	}

	public function getApiMethodName() {
		return "taobao.hanoi.proxy.value.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->appName, "appName");
		Taobao_RequestCheckUtil::checkNotNull($this->data, "data");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
