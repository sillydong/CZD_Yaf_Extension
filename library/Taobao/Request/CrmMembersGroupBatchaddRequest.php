<?php

/**
 * TOP API: taobao.crm.members.group.batchadd request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_CrmMembersGroupBatchaddRequest {
	/**
	 * 会员的id（一次最多传入10个）
	 **/
	private $buyerIds;

	/**
	 * 分组id
	 **/
	private $groupIds;

	private $apiParas = array();

	public function setBuyerIds($buyerIds) {
		$this->buyerIds = $buyerIds;
		$this->apiParas["buyer_ids"] = $buyerIds;
	}

	public function getBuyerIds() {
		return $this->buyerIds;
	}

	public function setGroupIds($groupIds) {
		$this->groupIds = $groupIds;
		$this->apiParas["group_ids"] = $groupIds;
	}

	public function getGroupIds() {
		return $this->groupIds;
	}

	public function getApiMethodName() {
		return "taobao.crm.members.group.batchadd";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->buyerIds, "buyerIds");
		Taobao_RequestCheckUtil::checkMaxListSize($this->buyerIds, 10, "buyerIds");
		Taobao_RequestCheckUtil::checkNotNull($this->groupIds, "groupIds");
		Taobao_RequestCheckUtil::checkMaxListSize($this->groupIds, 10, "groupIds");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
