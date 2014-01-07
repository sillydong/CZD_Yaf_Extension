<?php

/**
 * TOP API: taobao.wlb.item.synchronize request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_WlbItemSynchronizeRequest {
	/**
	 * 外部实体ID
	 **/
	private $extEntityId;

	/**
	 * 外部实体类型.存如下值
	 * IC_ITEM   --表示IC商品
	 * IC_SKU    --表示IC最小单位商品
	 * 若输入其他值，则按IC_ITEM处理
	 **/
	private $extEntityType;

	/**
	 * 商品ID
	 **/
	private $itemId;

	/**
	 * 商品所有人淘宝nick
	 **/
	private $userNick;

	private $apiParas = array();

	public function setExtEntityId($extEntityId) {
		$this->extEntityId = $extEntityId;
		$this->apiParas["ext_entity_id"] = $extEntityId;
	}

	public function getExtEntityId() {
		return $this->extEntityId;
	}

	public function setExtEntityType($extEntityType) {
		$this->extEntityType = $extEntityType;
		$this->apiParas["ext_entity_type"] = $extEntityType;
	}

	public function getExtEntityType() {
		return $this->extEntityType;
	}

	public function setItemId($itemId) {
		$this->itemId = $itemId;
		$this->apiParas["item_id"] = $itemId;
	}

	public function getItemId() {
		return $this->itemId;
	}

	public function setUserNick($userNick) {
		$this->userNick = $userNick;
		$this->apiParas["user_nick"] = $userNick;
	}

	public function getUserNick() {
		return $this->userNick;
	}

	public function getApiMethodName() {
		return "taobao.wlb.item.synchronize";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->extEntityId, "extEntityId");
		Taobao_RequestCheckUtil::checkNotNull($this->extEntityType, "extEntityType");
		Taobao_RequestCheckUtil::checkNotNull($this->itemId, "itemId");
		Taobao_RequestCheckUtil::checkNotNull($this->userNick, "userNick");
		Taobao_RequestCheckUtil::checkMaxLength($this->userNick, 64, "userNick");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
