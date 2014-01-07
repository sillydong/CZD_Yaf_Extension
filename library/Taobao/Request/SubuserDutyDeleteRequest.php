<?php

/**
 * TOP API: taobao.subuser.duty.delete request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_SubuserDutyDeleteRequest {
	/**
	 * 职务ID
	 **/
	private $dutyId;

	/**
	 * 主账号用户名
	 **/
	private $userNick;

	private $apiParas = array();

	public function setDutyId($dutyId) {
		$this->dutyId = $dutyId;
		$this->apiParas["duty_id"] = $dutyId;
	}

	public function getDutyId() {
		return $this->dutyId;
	}

	public function setUserNick($userNick) {
		$this->userNick = $userNick;
		$this->apiParas["user_nick"] = $userNick;
	}

	public function getUserNick() {
		return $this->userNick;
	}

	public function getApiMethodName() {
		return "taobao.subuser.duty.delete";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->dutyId, "dutyId");
		Taobao_RequestCheckUtil::checkNotNull($this->userNick, "userNick");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
