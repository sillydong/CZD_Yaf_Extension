<?php

/**
 * TOP API: taobao.fuwu.scores.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_FuwuScoresGetRequest {
	/**
	 * 当前页
	 **/
	private $currentPage;

	/**
	 * 评价日期，查询某一天的评价
	 **/
	private $date;

	/**
	 * 每页获取条数。默认值40，最小值1，最大值100。
	 **/
	private $pageSize;

	private $apiParas = array();

	public function setCurrentPage($currentPage) {
		$this->currentPage = $currentPage;
		$this->apiParas["current_page"] = $currentPage;
	}

	public function getCurrentPage() {
		return $this->currentPage;
	}

	public function setDate($date) {
		$this->date = $date;
		$this->apiParas["date"] = $date;
	}

	public function getDate() {
		return $this->date;
	}

	public function setPageSize($pageSize) {
		$this->pageSize = $pageSize;
		$this->apiParas["page_size"] = $pageSize;
	}

	public function getPageSize() {
		return $this->pageSize;
	}

	public function getApiMethodName() {
		return "taobao.fuwu.scores.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->currentPage, "currentPage");
		Taobao_RequestCheckUtil::checkNotNull($this->date, "date");
		Taobao_RequestCheckUtil::checkMaxValue($this->pageSize, 100, "pageSize");
		Taobao_RequestCheckUtil::checkMinValue($this->pageSize, 1, "pageSize");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
