<?php

/**
 * TOP API: tmall.eai.order.refund.examine.cancel request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TmallEaiOrderRefundExamineCancelRequest {
	/**
	 * 反审核留言
	 **/
	private $message;

	/**
	 * 反审核人姓名
	 **/
	private $operator;

	/**
	 * 退款单编号
	 **/
	private $refundId;

	/**
	 * 售中：onsale
	 * 售后：aftersale
	 **/
	private $refundPhase;

	/**
	 * 退款版本号
	 **/
	private $refundVersion;

	private $apiParas = array();

	public function setMessage($message) {
		$this->message = $message;
		$this->apiParas["message"] = $message;
	}

	public function getMessage() {
		return $this->message;
	}

	public function setOperator($operator) {
		$this->operator = $operator;
		$this->apiParas["operator"] = $operator;
	}

	public function getOperator() {
		return $this->operator;
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

	public function setRefundVersion($refundVersion) {
		$this->refundVersion = $refundVersion;
		$this->apiParas["refund_version"] = $refundVersion;
	}

	public function getRefundVersion() {
		return $this->refundVersion;
	}

	public function getApiMethodName() {
		return "tmall.eai.order.refund.examine.cancel";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->message, "message");
		Taobao_RequestCheckUtil::checkNotNull($this->refundId, "refundId");
		Taobao_RequestCheckUtil::checkNotNull($this->refundPhase, "refundPhase");
		Taobao_RequestCheckUtil::checkNotNull($this->refundVersion, "refundVersion");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
