<?php

/**
 * TOP API: tmall.eai.order.refund.billsum.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TmallEaiOrderRefundBillsumGetRequest {
	/**
	 * 查找数量的单据类型 refund_bill:退款单， return_bill:退货单
	 **/
	private $billType;

	/**
	 * 批量查询结束时间
	 **/
	private $endTime;

	/**
	 * 批量查询开始时间
	 **/
	private $startTime;

	/**
	 * 退货单 退款单状态
	 **/
	private $status;

	private $apiParas = array();

	public function setBillType($billType) {
		$this->billType = $billType;
		$this->apiParas["bill_type"] = $billType;
	}

	public function getBillType() {
		return $this->billType;
	}

	public function setEndTime($endTime) {
		$this->endTime = $endTime;
		$this->apiParas["end_time"] = $endTime;
	}

	public function getEndTime() {
		return $this->endTime;
	}

	public function setStartTime($startTime) {
		$this->startTime = $startTime;
		$this->apiParas["start_time"] = $startTime;
	}

	public function getStartTime() {
		return $this->startTime;
	}

	public function setStatus($status) {
		$this->status = $status;
		$this->apiParas["status"] = $status;
	}

	public function getStatus() {
		return $this->status;
	}

	public function getApiMethodName() {
		return "tmall.eai.order.refund.billsum.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->billType, "billType");
		Taobao_RequestCheckUtil::checkNotNull($this->endTime, "endTime");
		Taobao_RequestCheckUtil::checkNotNull($this->startTime, "startTime");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
