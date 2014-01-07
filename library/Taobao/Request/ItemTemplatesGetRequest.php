<?php

/**
 * TOP API: taobao.item.templates.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_ItemTemplatesGetRequest {

	private $apiParas = array();

	public function getApiMethodName() {
		return "taobao.item.templates.get";
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
