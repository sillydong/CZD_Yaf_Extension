<?php

/**
 * TOP API: taobao.jipiao.policy.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_JipiaoPolicyGetRequest {
	/**
	 * type外0，表示机票政策id；type为1，表示机票政策out_product_id
	 **/
	private $policyId;

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

	public function setType($type) {
		$this->type = $type;
		$this->apiParas["type"] = $type;
	}

	public function getType() {
		return $this->type;
	}

	public function getApiMethodName() {
		return "taobao.jipiao.policy.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->policyId, "policyId");
		Taobao_RequestCheckUtil::checkMaxLength($this->policyId, 64, "policyId");
		Taobao_RequestCheckUtil::checkNotNull($this->type, "type");
		Taobao_RequestCheckUtil::checkMaxValue($this->type, 1, "type");
		Taobao_RequestCheckUtil::checkMinValue($this->type, 0, "type");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
