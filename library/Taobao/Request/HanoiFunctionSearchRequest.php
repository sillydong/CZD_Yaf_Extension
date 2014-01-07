<?php

/**
 * TOP API: taobao.hanoi.function.search request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HanoiFunctionSearchRequest {
	/**
	 * 分配给调用方的名称信息，内部统计使用
	 **/
	private $appName;

	/**
	 * FunctionQuery的json格式
	 **/
	private $sdata;

	private $apiParas = array();

	public function setAppName($appName) {
		$this->appName = $appName;
		$this->apiParas["app_name"] = $appName;
	}

	public function getAppName() {
		return $this->appName;
	}

	public function setSdata($sdata) {
		$this->sdata = $sdata;
		$this->apiParas["sdata"] = $sdata;
	}

	public function getSdata() {
		return $this->sdata;
	}

	public function getApiMethodName() {
		return "taobao.hanoi.function.search";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->appName, "appName");
		Taobao_RequestCheckUtil::checkNotNull($this->sdata, "sdata");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
