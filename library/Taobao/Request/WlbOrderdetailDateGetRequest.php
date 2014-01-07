<?php

/**
 * TOP API: taobao.wlb.orderdetail.date.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_WlbOrderdetailDateGetRequest {
	/**
	 * 查询条件截止日期
	 **/
	private $endTime;

	/**
	 * 分页查询参数，指定查询页数，默认为1
	 **/
	private $pageNo;

	/**
	 * 分页查询参数，每页查询数量，默认20，最大值50,大于50时按照50条查询
	 **/
	private $pageSize;

	/**
	 * 查询起始日期
	 **/
	private $startTime;

	private $apiParas = array();

	public function setEndTime($endTime) {
		$this->endTime = $endTime;
		$this->apiParas["end_time"] = $endTime;
	}

	public function getEndTime() {
		return $this->endTime;
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

	public function setStartTime($startTime) {
		$this->startTime = $startTime;
		$this->apiParas["start_time"] = $startTime;
	}

	public function getStartTime() {
		return $this->startTime;
	}

	public function getApiMethodName() {
		return "taobao.wlb.orderdetail.date.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->endTime, "endTime");
		Taobao_RequestCheckUtil::checkNotNull($this->startTime, "startTime");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
