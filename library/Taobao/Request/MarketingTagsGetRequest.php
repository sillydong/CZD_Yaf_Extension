<?php

/**
 * TOP API: taobao.marketing.tags.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_MarketingTagsGetRequest {
	/**
	 * 需要的返回字段，可选值为UserTag中所有字段
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
		return "taobao.marketing.tags.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->fields, "fields");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
