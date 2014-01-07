<?php

/**
 * TOP API: taobao.taobaoke.rebate.report.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TaobaokeRebateReportGetRequest {
	/**
	 * 需返回的字段列表.可选值:TaobaokePayment淘宝客订单构体中的所有字段;字段之间用","分隔.
	 **/
	private $fields;

	/**
	 * 当前页数
	 **/
	private $pageNo;

	/**
	 * 每页返回结果数，最小每页40条，默认每页40条，最大每页100条
	 **/
	private $pageSize;

	/**
	 * 查询报表的时间跨度，单位秒。
	 * 以用户输入的start_time时间为起始时间，start_time+span为结束时间，查询该时间段内的订单。span最小值为60秒，最大值为600秒，默认值为60秒
	 **/
	private $span;

	/**
	 * 需要查询报表的开始日期，有效的日期为从当前日期开始起90天以内的订单
	 **/
	private $startTime;

	private $apiParas = array();

	public function setFields($fields) {
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields() {
		return $this->fields;
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

	public function setSpan($span) {
		$this->span = $span;
		$this->apiParas["span"] = $span;
	}

	public function getSpan() {
		return $this->span;
	}

	public function setStartTime($startTime) {
		$this->startTime = $startTime;
		$this->apiParas["start_time"] = $startTime;
	}

	public function getStartTime() {
		return $this->startTime;
	}

	public function getApiMethodName() {
		return "taobao.taobaoke.rebate.report.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->fields, "fields");
		Taobao_RequestCheckUtil::checkMaxValue($this->pageNo, 100, "pageNo");
		Taobao_RequestCheckUtil::checkMinValue($this->pageNo, 1, "pageNo");
		Taobao_RequestCheckUtil::checkMaxValue($this->pageSize, 100, "pageSize");
		Taobao_RequestCheckUtil::checkNotNull($this->span, "span");
		Taobao_RequestCheckUtil::checkMaxValue($this->span, 600, "span");
		Taobao_RequestCheckUtil::checkMinValue($this->span, 60, "span");
		Taobao_RequestCheckUtil::checkNotNull($this->startTime, "startTime");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
