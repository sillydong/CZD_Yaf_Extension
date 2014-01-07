<?php

/**
 * TOP API: taobao.itemcats.authorize.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_ItemcatsAuthorizeGetRequest {
	/**
	 * 需要返回的字段。目前支持有：
	 * brand.vid, brand.name,
	 * item_cat.cid, item_cat.name, item_cat.status,item_cat.sort_order,item_cat.parent_cid,item_cat.is_parent,
	 * xinpin_item_cat.cid,
	 * xinpin_item_cat.name,
	 * xinpin_item_cat.status,
	 * xinpin_item_cat.sort_order,
	 * xinpin_item_cat.parent_cid,
	 * xinpin_item_cat.is_parent
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
		return "taobao.itemcats.authorize.get";
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
