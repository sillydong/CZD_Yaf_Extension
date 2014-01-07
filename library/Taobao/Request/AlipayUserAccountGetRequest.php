<?php

/**
 * TOP API: alipay.user.account.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_AlipayUserAccountGetRequest {

	private $apiParas = array();

	public function getApiMethodName() {
		return "alipay.user.account.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
