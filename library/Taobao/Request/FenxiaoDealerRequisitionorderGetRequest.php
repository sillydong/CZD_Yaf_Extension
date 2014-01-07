<?php

/**
 * TOP API: taobao.fenxiao.dealer.requisitionorder.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_FenxiaoDealerRequisitionorderGetRequest {
	/**
	 * 采购申请/经销采购单最迟修改时间。与start_date字段的最大时间间隔不能超过30天
	 **/
	private $endDate;

	/**
	 * 多个字段用","分隔。 fields 如果为空：返回所有采购申请/经销采购单对象(dealer_orders)字段。 如果不为空：返回指定采购单对象(dealer_orders)字段。 例1： dealer_order_details.product_id 表示只返回product_id 例2： dealer_order_details 表示只返回明细列表
	 **/
	private $fields;

	/**
	 * 查询者自己在所要查询的采购申请/经销采购单中的身份。
	 * 1：供应商。
	 * 2：分销商。
	 * 注：填写其他值当做错误处理。
	 **/
	private $identity;

	/**
	 * 采购申请/经销采购单状态。
	 * 0：全部状态。
	 * 1：分销商提交申请，待供应商审核。
	 * 2：供应商驳回申请，待分销商确认。
	 * 3：供应商修改后，待分销商确认。
	 * 4：分销商拒绝修改，待供应商再审核。
	 * 5：审核通过下单成功，待分销商付款。
	 * 7：付款成功，待供应商发货。
	 * 8：供应商发货，待分销商收货。
	 * 9：分销商收货，交易成功。
	 * 10：采购申请/经销采购单关闭。
	 *
	 * 注：无值按默认值0计，超出状态范围返回错误信息。
	 **/
	private $orderStatus;

	/**
	 * 页码（大于0的整数。无值或小于1的值按默认值1计）
	 **/
	private $pageNo;

	/**
	 * 每页条数（大于0但小于等于50的整数。无值或大于50或小于1的值按默认值50计）
	 **/
	private $pageSize;

	/**
	 * 采购申请/经销采购单最早修改时间
	 **/
	private $startDate;

	private $apiParas = array();

	public function setEndDate($endDate) {
		$this->endDate = $endDate;
		$this->apiParas["end_date"] = $endDate;
	}

	public function getEndDate() {
		return $this->endDate;
	}

	public function setFields($fields) {
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields() {
		return $this->fields;
	}

	public function setIdentity($identity) {
		$this->identity = $identity;
		$this->apiParas["identity"] = $identity;
	}

	public function getIdentity() {
		return $this->identity;
	}

	public function setOrderStatus($orderStatus) {
		$this->orderStatus = $orderStatus;
		$this->apiParas["order_status"] = $orderStatus;
	}

	public function getOrderStatus() {
		return $this->orderStatus;
	}

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

	public function setStartDate($startDate) {
		$this->startDate = $startDate;
		$this->apiParas["start_date"] = $startDate;
	}

	public function getStartDate() {
		return $this->startDate;
	}

	public function getApiMethodName() {
		return "taobao.fenxiao.dealer.requisitionorder.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->endDate, "endDate");
		Taobao_RequestCheckUtil::checkNotNull($this->identity, "identity");
		Taobao_RequestCheckUtil::checkNotNull($this->startDate, "startDate");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
