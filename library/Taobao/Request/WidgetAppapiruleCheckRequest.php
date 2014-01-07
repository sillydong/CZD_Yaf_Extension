<?php

/**
 * TOP API: taobao.widget.appapirule.check request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_WidgetAppapiruleCheckRequest {
	/**
	 * 要判断权限的api名称，如果指定的api不存在，报错invalid method
	 **/
	private $apiName;

	private $apiParas = array();

	public function setApiName($apiName) {
		$this->apiName = $apiName;
		$this->apiParas["api_name"] = $apiName;
	}

	public function getApiName() {
		return $this->apiName;
	}

	public function getApiMethodName() {
		return "taobao.widget.appapirule.check";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->apiName, "apiName");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
