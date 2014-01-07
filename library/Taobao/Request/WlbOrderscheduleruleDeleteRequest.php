<?php

/**
 * TOP API: taobao.wlb.orderschedulerule.delete request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_WlbOrderscheduleruleDeleteRequest {
	/**
	 * 订单调度规则ID
	 **/
	private $id;

	/**
	 * 商品userNick
	 **/
	private $userNick;

	private $apiParas = array();

	public function setId($id) {
		$this->id = $id;
		$this->apiParas["id"] = $id;
	}

	public function getId() {
		return $this->id;
	}

	public function setUserNick($userNick) {
		$this->userNick = $userNick;
		$this->apiParas["user_nick"] = $userNick;
	}

	public function getUserNick() {
		return $this->userNick;
	}

	public function getApiMethodName() {
		return "taobao.wlb.orderschedulerule.delete";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->id, "id");
		Taobao_RequestCheckUtil::checkNotNull($this->userNick, "userNick");
		Taobao_RequestCheckUtil::checkMaxLength($this->userNick, 64, "userNick");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
