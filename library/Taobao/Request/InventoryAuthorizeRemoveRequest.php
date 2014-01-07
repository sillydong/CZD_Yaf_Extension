<?php

/**
 * TOP API: taobao.inventory.authorize.remove request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_InventoryAuthorizeRemoveRequest {
	/**
	 * 库存授权结果码
	 **/
	private $authorizeCode;

	/**
	 * 后端商品id
	 **/
	private $scItemId;

	/**
	 * 移除授权的目标用户昵称列表，用”,”隔开
	 **/
	private $userNickList;

	private $apiParas = array();

	public function setAuthorizeCode($authorizeCode) {
		$this->authorizeCode = $authorizeCode;
		$this->apiParas["authorize_code"] = $authorizeCode;
	}

	public function getAuthorizeCode() {
		return $this->authorizeCode;
	}

	public function setScItemId($scItemId) {
		$this->scItemId = $scItemId;
		$this->apiParas["sc_item_id"] = $scItemId;
	}

	public function getScItemId() {
		return $this->scItemId;
	}

	public function setUserNickList($userNickList) {
		$this->userNickList = $userNickList;
		$this->apiParas["user_nick_list"] = $userNickList;
	}

	public function getUserNickList() {
		return $this->userNickList;
	}

	public function getApiMethodName() {
		return "taobao.inventory.authorize.remove";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->authorizeCode, "authorizeCode");
		Taobao_RequestCheckUtil::checkNotNull($this->scItemId, "scItemId");
		Taobao_RequestCheckUtil::checkNotNull($this->userNickList, "userNickList");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
