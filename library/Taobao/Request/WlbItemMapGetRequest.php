<?php

/**
 * TOP API: taobao.wlb.item.map.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_WlbItemMapGetRequest {
	/**
	 * 要查询映射关系的物流宝商品id
	 **/
	private $itemId;

	private $apiParas = array();

	public function setItemId($itemId) {
		$this->itemId = $itemId;
		$this->apiParas["item_id"] = $itemId;
	}

	public function getItemId() {
		return $this->itemId;
	}

	public function getApiMethodName() {
		return "taobao.wlb.item.map.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->itemId, "itemId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
