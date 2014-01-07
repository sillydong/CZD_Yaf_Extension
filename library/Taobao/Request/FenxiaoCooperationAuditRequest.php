<?php

/**
 * TOP API: taobao.fenxiao.cooperation.audit request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_FenxiaoCooperationAuditRequest {
	/**
	 * 1:审批通过，审批通过后要加入授权产品线列表；
	 * 2:审批拒绝
	 **/
	private $auditResult;

	/**
	 * 当审批通过时需要指定授权产品线id列表(代销)，如果没传则表示不开通，且经销和代销的授权产品线列表至少传入一种，同时传入则表示都开通。
	 **/
	private $productLineListAgent;

	/**
	 * 当审批通过时需要指定授权产品线id列表(经销)，如果没传则表示不开通，且经销和代销的授权产品线列表至少传入一种，同时传入则表示都开通。
	 **/
	private $productLineListDealer;

	/**
	 * 备注
	 **/
	private $remark;

	/**
	 * 合作申请Id
	 **/
	private $requisitionId;

	private $apiParas = array();

	public function setAuditResult($auditResult) {
		$this->auditResult = $auditResult;
		$this->apiParas["audit_result"] = $auditResult;
	}

	public function getAuditResult() {
		return $this->auditResult;
	}

	public function setProductLineListAgent($productLineListAgent) {
		$this->productLineListAgent = $productLineListAgent;
		$this->apiParas["product_line_list_agent"] = $productLineListAgent;
	}

	public function getProductLineListAgent() {
		return $this->productLineListAgent;
	}

	public function setProductLineListDealer($productLineListDealer) {
		$this->productLineListDealer = $productLineListDealer;
		$this->apiParas["product_line_list_dealer"] = $productLineListDealer;
	}

	public function getProductLineListDealer() {
		return $this->productLineListDealer;
	}

	public function setRemark($remark) {
		$this->remark = $remark;
		$this->apiParas["remark"] = $remark;
	}

	public function getRemark() {
		return $this->remark;
	}

	public function setRequisitionId($requisitionId) {
		$this->requisitionId = $requisitionId;
		$this->apiParas["requisition_id"] = $requisitionId;
	}

	public function getRequisitionId() {
		return $this->requisitionId;
	}

	public function getApiMethodName() {
		return "taobao.fenxiao.cooperation.audit";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->auditResult, "auditResult");
		Taobao_RequestCheckUtil::checkNotNull($this->remark, "remark");
		Taobao_RequestCheckUtil::checkNotNull($this->requisitionId, "requisitionId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
