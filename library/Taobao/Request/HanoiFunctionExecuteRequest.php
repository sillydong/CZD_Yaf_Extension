<?php

/**
 * TOP API: taobao.hanoi.function.execute request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HanoiFunctionExecuteRequest {
	/**
	 * 分配给调用方的名称信息，内部统计使用
	 **/
	private $appName;

	/**
	 * Param的json格式，map中通常包括functionId,strategy 等所需业务参数
	 **/
	private $para;

	private $apiParas = array();

	public function setAppName($appName) {
		$this->appName = $appName;
		$this->apiParas["app_name"] = $appName;
	}

	public function getAppName() {
		return $this->appName;
	}

	public function setPara($para) {
		$this->para = $para;
		$this->apiParas["para"] = $para;
	}

	public function getPara() {
		return $this->para;
	}

	public function getApiMethodName() {
		return "taobao.hanoi.function.execute";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->appName, "appName");
		Taobao_RequestCheckUtil::checkNotNull($this->para, "para");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
