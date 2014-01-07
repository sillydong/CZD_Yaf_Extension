<?php

/**
 * TOP API: taobao.crm.grouptask.check request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_CrmGrouptaskCheckRequest {
	/**
	 * 分组id
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
		return "taobao.crm.grouptask.check";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->groupId, "groupId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
