<?php

/**
 * TOP API: taobao.crm.group.add request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_CrmGroupAddRequest {
	/**
	 * 分组名称，每个卖家最多可以拥有100个分组
	 **/
	private $groupName;

	private $apiParas = array();

	public function setGroupName($groupName) {
		$this->groupName = $groupName;
		$this->apiParas["group_name"] = $groupName;
	}

	public function getGroupName() {
		return $this->groupName;
	}

	public function getApiMethodName() {
		return "taobao.crm.group.add";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->groupName, "groupName");
		Taobao_RequestCheckUtil::checkMaxLength($this->groupName, 15, "groupName");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
