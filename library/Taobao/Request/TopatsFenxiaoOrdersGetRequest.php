<?php

/**
 * TOP API: taobao.topats.fenxiao.orders.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TopatsFenxiaoOrdersGetRequest {
	/**
	 * 结束时间 格式 yyyyMMdd表示yyyy-MM-dd 00:00:00.开始与结束时间不能超过90天。
	 **/
	private $endCreated;

	/**
	 * 多个字段用","分隔。
	 *
	 * fields
	 * 如果为空：返回所有采购单对象(purchase_orders)字段。
	 * 如果不为空：返回指定采购单对象(purchase_orders)字段。
	 *
	 * 例1：
	 * sub_purchase_orders.tc_order_id 表示只返回tc_order_id
	 * 例2：
	 * sub_purchase_orders表示只返回子采购单列表
	 **/
	private $fields;

	/**
	 * 起始时间 格式 yyyyMMdd表示yyyy-MM-dd 00:00:00.开始与结束时间不能超过90天且开始时间不能为90天前
	 **/
	private $startCreated;

	/**
	 * 交易状态，不传默认查询所有采购单根据身份选择自身状态可选值:<br> *供应商：<br> WAIT_SELLER_SEND_GOODS(等待发货)<br> WAIT_SELLER_CONFIRM_PAY(待确认收款)<br> WAIT_BUYER_PAY(等待付款)<br> WAIT_BUYER_CONFIRM_GOODS(已发货)<br> TRADE_REFUNDING(退款中)<br> TRADE_FINISHED(采购成功)<br> TRADE_CLOSED(已关闭)<br> *分销商：<br> WAIT_BUYER_PAY(等待付款)<br> WAIT_BUYER_CONFIRM_GOODS(待收货确认)<br> TRADE_FOR_PAY(已付款)<br> TRADE_REFUNDING(退款中)<br> TRADE_FINISHED(采购成功)<br> TRADE_CLOSED(已关闭)<br>
	 **/
	private $status;

	private $apiParas = array();

	public function setEndCreated($endCreated) {
		$this->endCreated = $endCreated;
		$this->apiParas["end_created"] = $endCreated;
	}

	public function getEndCreated() {
		return $this->endCreated;
	}

	public function setFields($fields) {
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields() {
		return $this->fields;
	}

	public function setStartCreated($startCreated) {
		$this->startCreated = $startCreated;
		$this->apiParas["start_created"] = $startCreated;
	}

	public function getStartCreated() {
		return $this->startCreated;
	}

	public function setStatus($status) {
		$this->status = $status;
		$this->apiParas["status"] = $status;
	}

	public function getStatus() {
		return $this->status;
	}

	public function getApiMethodName() {
		return "taobao.topats.fenxiao.orders.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->endCreated, "endCreated");
		Taobao_RequestCheckUtil::checkNotNull($this->startCreated, "startCreated");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
