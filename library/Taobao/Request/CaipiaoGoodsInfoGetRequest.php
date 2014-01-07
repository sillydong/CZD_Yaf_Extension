<?php

/**
 * TOP API: taobao.caipiao.goods.info.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_CaipiaoGoodsInfoGetRequest {

	private $apiParas = array();

	public function getApiMethodName() {
		return "taobao.caipiao.goods.info.get";
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
