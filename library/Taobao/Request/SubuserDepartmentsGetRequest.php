<?php

/**
 * TOP API: taobao.subuser.departments.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_SubuserDepartmentsGetRequest {
	/**
	 * 主账号用户名
	 **/
	private $userNick;

	private $apiParas = array();

	public function setUserNick($userNick) {
		$this->userNick = $userNick;
		$this->apiParas["user_nick"] = $userNick;
	}

	public function getUserNick() {
		return $this->userNick;
	}

	public function getApiMethodName() {
		return "taobao.subuser.departments.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->userNick, "userNick");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
