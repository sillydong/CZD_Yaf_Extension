<?php

/**
 * TOP API: taobao.hanoi.group.filter request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HanoiGroupFilterRequest {
	/**
	 * 认证信息
	 **/
	private $appName;

	/**
	 * 买家的nick
	 **/
	private $buyerNick;

	/**
	 * 分组的id
	 **/
	private $groupId;

	/**
	 * 卖家nick
	 **/
	private $sellerNick;

	private $apiParas = array();

	public function setAppName($appName) {
		$this->appName = $appName;
		$this->apiParas["app_name"] = $appName;
	}

	public function getAppName() {
		return $this->appName;
	}

	public function setBuyerNick($buyerNick) {
		$this->buyerNick = $buyerNick;
		$this->apiParas["buyer_nick"] = $buyerNick;
	}

	public function getBuyerNick() {
		return $this->buyerNick;
	}

	public function setGroupId($groupId) {
		$this->groupId = $groupId;
		$this->apiParas["group_id"] = $groupId;
	}

	public function getGroupId() {
		return $this->groupId;
	}

	public function setSellerNick($sellerNick) {
		$this->sellerNick = $sellerNick;
		$this->apiParas["seller_nick"] = $sellerNick;
	}

	public function getSellerNick() {
		return $this->sellerNick;
	}

	public function getApiMethodName() {
		return "taobao.hanoi.group.filter";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->appName, "appName");
		Taobao_RequestCheckUtil::checkNotNull($this->buyerNick, "buyerNick");
		Taobao_RequestCheckUtil::checkNotNull($this->groupId, "groupId");
		Taobao_RequestCheckUtil::checkNotNull($this->sellerNick, "sellerNick");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
