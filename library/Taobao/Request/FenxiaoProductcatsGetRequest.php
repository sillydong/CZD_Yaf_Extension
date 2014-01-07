<?php

/**
 * TOP API: taobao.fenxiao.productcats.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_FenxiaoProductcatsGetRequest {
	/**
	 * 返回字段列表
	 **/
	private $fields;

	private $apiParas = array();

	public function setFields($fields) {
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields() {
		return $this->fields;
	}

	public function getApiMethodName() {
		return "taobao.fenxiao.productcats.get";
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
