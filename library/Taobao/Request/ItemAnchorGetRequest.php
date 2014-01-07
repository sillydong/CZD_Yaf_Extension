<?php

/**
 * TOP API: taobao.item.anchor.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_ItemAnchorGetRequest {
	/**
	 * 对应类目编号
	 **/
	private $catId;

	/**
	 * 宝贝模板类型是人工打标还是自动打标：人工打标为1，自动打标为0.人工和自动打标为-1.
	 **/
	private $type;

	private $apiParas = array();

	public function setCatId($catId) {
		$this->catId = $catId;
		$this->apiParas["cat_id"] = $catId;
	}

	public function getCatId() {
		return $this->catId;
	}

	public function setType($type) {
		$this->type = $type;
		$this->apiParas["type"] = $type;
	}

	public function getType() {
		return $this->type;
	}

	public function getApiMethodName() {
		return "taobao.item.anchor.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->catId, "catId");
		Taobao_RequestCheckUtil::checkNotNull($this->type, "type");
		Taobao_RequestCheckUtil::checkMaxValue($this->type, 1, "type");
		Taobao_RequestCheckUtil::checkMinValue($this->type, -1, "type");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
