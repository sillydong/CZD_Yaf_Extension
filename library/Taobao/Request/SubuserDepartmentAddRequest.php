<?php

/**
 * TOP API: taobao.subuser.department.add request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_SubuserDepartmentAddRequest {
	/**
	 * 部门名称
	 **/
	private $departmentName;

	/**
	 * 父部门ID 如果是最高部门则传入0
	 **/
	private $parentId;

	/**
	 * 主账号用户名
	 **/
	private $userNick;

	private $apiParas = array();

	public function setDepartmentName($departmentName) {
		$this->departmentName = $departmentName;
		$this->apiParas["department_name"] = $departmentName;
	}

	public function getDepartmentName() {
		return $this->departmentName;
	}

	public function setParentId($parentId) {
		$this->parentId = $parentId;
		$this->apiParas["parent_id"] = $parentId;
	}

	public function getParentId() {
		return $this->parentId;
	}

	public function setUserNick($userNick) {
		$this->userNick = $userNick;
		$this->apiParas["user_nick"] = $userNick;
	}

	public function getUserNick() {
		return $this->userNick;
	}

	public function getApiMethodName() {
		return "taobao.subuser.department.add";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->departmentName, "departmentName");
		Taobao_RequestCheckUtil::checkNotNull($this->parentId, "parentId");
		Taobao_RequestCheckUtil::checkNotNull($this->userNick, "userNick");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
