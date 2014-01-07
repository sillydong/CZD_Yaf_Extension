<?php

/**
 * TOP API: taobao.sellercenter.rolemembers.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_SellercenterRolemembersGetRequest {
	/**
	 * 角色id
	 **/
	private $roleId;

	private $apiParas = array();

	public function setRoleId($roleId) {
		$this->roleId = $roleId;
		$this->apiParas["role_id"] = $roleId;
	}

	public function getRoleId() {
		return $this->roleId;
	}

	public function getApiMethodName() {
		return "taobao.sellercenter.rolemembers.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->roleId, "roleId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
