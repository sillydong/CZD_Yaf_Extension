<?php

/**
 * TOP API: taobao.ump.details.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_UmpDetailsGetRequest {
	/**
	 * 营销活动id
	 **/
	private $actId;

	/**
	 * 分页的页码
	 **/
	private $pageNo;

	/**
	 * 每页的最大条数
	 **/
	private $pageSize;

	private $apiParas = array();

	public function setActId($actId) {
		$this->actId = $actId;
		$this->apiParas["act_id"] = $actId;
	}

	public function getActId() {
		return $this->actId;
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

	public function getApiMethodName() {
		return "taobao.ump.details.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->actId, "actId");
		Taobao_RequestCheckUtil::checkNotNull($this->pageNo, "pageNo");
		Taobao_RequestCheckUtil::checkMinValue($this->pageNo, 0, "pageNo");
		Taobao_RequestCheckUtil::checkNotNull($this->pageSize, "pageSize");
		Taobao_RequestCheckUtil::checkMaxValue($this->pageSize, 50, "pageSize");
		Taobao_RequestCheckUtil::checkMinValue($this->pageSize, 1, "pageSize");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
