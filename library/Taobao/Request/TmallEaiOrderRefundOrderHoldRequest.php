<?php

/**
 * TOP API: tmall.eai.order.refund.order.hold request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TmallEaiOrderRefundOrderHoldRequest {
	/**
	 * 1. 截停成功
	 * 2. 截停失败
	 **/
	private $holdResult;

	/**
	 * 截停环节
	 * 1. 订单处理环节
	 * 2. 发货环节
	 **/
	private $holdStep;

	/**
	 * 截单时间
	 **/
	private $holdTime;

	/**
	 * 退款单编号
	 **/
	private $refundId;

	/**
	 * 售中：onsale
	 * 售后：aftersale
	 **/
	private $refundPhase;

	private $apiParas = array();

	public function setHoldResult($holdResult) {
		$this->holdResult = $holdResult;
		$this->apiParas["hold_result"] = $holdResult;
	}

	public function getHoldResult() {
		return $this->holdResult;
	}

	public function setHoldStep($holdStep) {
		$this->holdStep = $holdStep;
		$this->apiParas["hold_step"] = $holdStep;
	}

	public function getHoldStep() {
		return $this->holdStep;
	}

	public function setHoldTime($holdTime) {
		$this->holdTime = $holdTime;
		$this->apiParas["hold_time"] = $holdTime;
	}

	public function getHoldTime() {
		return $this->holdTime;
	}

	public function setRefundId($refundId) {
		$this->refundId = $refundId;
		$this->apiParas["refund_id"] = $refundId;
	}

	public function getRefundId() {
		return $this->refundId;
	}

	public function setRefundPhase($refundPhase) {
		$this->refundPhase = $refundPhase;
		$this->apiParas["refund_phase"] = $refundPhase;
	}

	public function getRefundPhase() {
		return $this->refundPhase;
	}

	public function getApiMethodName() {
		return "tmall.eai.order.refund.order.hold";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->holdResult, "holdResult");
		Taobao_RequestCheckUtil::checkNotNull($this->holdStep, "holdStep");
		Taobao_RequestCheckUtil::checkNotNull($this->holdTime, "holdTime");
		Taobao_RequestCheckUtil::checkNotNull($this->refundId, "refundId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
