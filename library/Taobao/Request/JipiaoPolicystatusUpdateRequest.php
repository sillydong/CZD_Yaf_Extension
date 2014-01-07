<?php

/**
 * TOP API: taobao.jipiao.policystatus.update request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_JipiaoPolicystatusUpdateRequest {
	/**
	 * type为0，表示机票政策id；type为1，表示机票政策out_product_id；最大支持政策数100，注意不要如果不要超出字符串的长度限制，超出的话，请调小批量的个数
	 **/
	private $policyId;

	/**
	 * 政策的状态: 0，挂起；1，解挂；2，删除
	 **/
	private $status;

	/**
	 * 0，表示按政策id进行查询；1，表示按政策外部id进行查询
	 **/
	private $type;

	private $apiParas = array();

	public function setPolicyId($policyId) {
		$this->policyId = $policyId;
		$this->apiParas["policy_id"] = $policyId;
	}

	public function getPolicyId() {
		return $this->policyId;
	}

	public function setStatus($status) {
		$this->status = $status;
		$this->apiParas["status"] = $status;
	}

	public function getStatus() {
		return $this->status;
	}

	public function setType($type) {
		$this->type = $type;
		$this->apiParas["type"] = $type;
	}

	public function getType() {
		return $this->type;
	}

	public function getApiMethodName() {
		return "taobao.jipiao.policystatus.update";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->policyId, "policyId");
		Taobao_RequestCheckUtil::checkMaxListSize($this->policyId, 100, "policyId");
		Taobao_RequestCheckUtil::checkMaxLength($this->policyId, 6500, "policyId");
		Taobao_RequestCheckUtil::checkNotNull($this->status, "status");
		Taobao_RequestCheckUtil::checkNotNull($this->type, "type");
		Taobao_RequestCheckUtil::checkMaxValue($this->type, 1, "type");
		Taobao_RequestCheckUtil::checkMinValue($this->type, 0, "type");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
