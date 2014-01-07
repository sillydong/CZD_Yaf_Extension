<?php

/**
 * TOP API: tmall.eai.order.refund.message.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TmallEaiOrderRefundMessageGetRequest {
	/**
	 * 页码。取值范围:大于零的整数; 默认值:1
	 **/
	private $pageNo;

	/**
	 * 每页条数。取值范围:大于零的整数; 默认值:40;最大值:100
	 **/
	private $pageSize;

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

	public function setPageNo($pageNo) {
		$this->pageNo = $pageNo;
		$this->apiParas["page_no"] = $pageNo;
	}

	public function getPageNo() {
		return $this->pageNo;
	}

	public function setPageSize($pageSize) {
		$this->pageSize = $pageSize;
		$this->apiParas["page_size"] = $pageSize;
	}

	public function getPageSize() {
		return $this->pageSize;
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
		return "tmall.eai.order.refund.message.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkMinValue($this->pageNo, 1, "pageNo");
		Taobao_RequestCheckUtil::checkMaxValue($this->pageSize, 100, "pageSize");
		Taobao_RequestCheckUtil::checkMinValue($this->pageSize, 1, "pageSize");
		Taobao_RequestCheckUtil::checkNotNull($this->refundId, "refundId");
		Taobao_RequestCheckUtil::checkNotNull($this->refundPhase, "refundPhase");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
