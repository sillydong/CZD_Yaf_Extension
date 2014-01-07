<?php

/**
 * TOP API: taobao.crm.group.delete request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_CrmGroupDeleteRequest {
	/**
	 * 要删除的分组id
	 **/
	private $groupId;

	private $apiParas = array();

	public function setGroupId($groupId) {
		$this->groupId = $groupId;
		$this->apiParas["group_id"] = $groupId;
	}

	public function getGroupId() {
		return $this->groupId;
	}

	public function getApiMethodName() {
		return "taobao.crm.group.delete";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->groupId, "groupId");
		Taobao_RequestCheckUtil::checkMinValue($this->groupId, 1, "groupId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
