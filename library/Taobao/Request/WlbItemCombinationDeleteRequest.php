<?php

/**
 * TOP API: taobao.wlb.item.combination.delete request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_WlbItemCombinationDeleteRequest {
	/**
	 * 组合商品的id列表
	 **/
	private $destItemList;

	/**
	 * 组合关系的商品id
	 **/
	private $itemId;

	private $apiParas = array();

	public function setDestItemList($destItemList) {
		$this->destItemList = $destItemList;
		$this->apiParas["dest_item_list"] = $destItemList;
	}

	public function getDestItemList() {
		return $this->destItemList;
	}

	public function setItemId($itemId) {
		$this->itemId = $itemId;
		$this->apiParas["item_id"] = $itemId;
	}

	public function getItemId() {
		return $this->itemId;
	}

	public function getApiMethodName() {
		return "taobao.wlb.item.combination.delete";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->destItemList, "destItemList");
		Taobao_RequestCheckUtil::checkNotNull($this->itemId, "itemId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
