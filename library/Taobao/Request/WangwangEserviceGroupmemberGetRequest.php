<?php

/**
 * TOP API: taobao.wangwang.eservice.groupmember.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_WangwangEserviceGroupmemberGetRequest {
	/**
	 * 主帐号ID：cntaobao+淘宝nick，例如cntaobaotest
	 **/
	private $managerId;

	private $apiParas = array();

	public function setManagerId($managerId) {
		$this->managerId = $managerId;
		$this->apiParas["manager_id"] = $managerId;
	}

	public function getManagerId() {
		return $this->managerId;
	}

	public function getApiMethodName() {
		return "taobao.wangwang.eservice.groupmember.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->managerId, "managerId");
		Taobao_RequestCheckUtil::checkMaxLength($this->managerId, 128, "managerId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
