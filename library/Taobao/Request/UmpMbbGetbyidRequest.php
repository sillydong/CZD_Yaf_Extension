<?php

/**
 * TOP API: taobao.ump.mbb.getbyid request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_UmpMbbGetbyidRequest {
	/**
	 * 积木块的id
	 **/
	private $id;

	private $apiParas = array();

	public function setId($id) {
		$this->id = $id;
		$this->apiParas["id"] = $id;
	}

	public function getId() {
		return $this->id;
	}

	public function getApiMethodName() {
		return "taobao.ump.mbb.getbyid";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->id, "id");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
