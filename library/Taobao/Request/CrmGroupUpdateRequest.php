<?php

/**
 * TOP API: taobao.crm.group.update request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_CrmGroupUpdateRequest {
	/**
	 * 分组的id
	 **/
	private $groupId;

	/**
	 * 新的分组名，分组名称不能包含|或者：
	 **/
	private $newGroupName;

	private $apiParas = array();

	public function setGroupId($groupId) {
		$this->groupId = $groupId;
		$this->apiParas["group_id"] = $groupId;
	}

	public function getGroupId() {
		return $this->groupId;
	}

	public function setNewGroupName($newGroupName) {
		$this->newGroupName = $newGroupName;
		$this->apiParas["new_group_name"] = $newGroupName;
	}

	public function getNewGroupName() {
		return $this->newGroupName;
	}

	public function getApiMethodName() {
		return "taobao.crm.group.update";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->groupId, "groupId");
		Taobao_RequestCheckUtil::checkMinValue($this->groupId, 1, "groupId");
		Taobao_RequestCheckUtil::checkNotNull($this->newGroupName, "newGroupName");
		Taobao_RequestCheckUtil::checkMaxLength($this->newGroupName, 15, "newGroupName");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
