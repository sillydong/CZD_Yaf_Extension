<?php

/**
 * TOP API: taobao.caipiao.present.win.items.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_CaipiaoPresentWinItemsGetRequest {
	/**
	 * 查询日期，格式请严格遵守yyyy-MM-dd
	 **/
	private $date;

	/**
	 * 查询个数，最大值为500.如果为空、0和负数，则取默认值500
	 **/
	private $num;

	/**
	 * 查询页码，空，零，负的情况默认为1（注意每页数据量为50）
	 **/
	private $pageNo;

	/**
	 * 0：查询中奖订单，1：查询所有订单，默认为0，注意按列表数量查询只会查询中奖订单。
	 **/
	private $searchType;

	private $apiParas = array();

	public function setDate($date) {
		$this->date = $date;
		$this->apiParas["date"] = $date;
	}

	public function getDate() {
		return $this->date;
	}

	public function setNum($num) {
		$this->num = $num;
		$this->apiParas["num"] = $num;
	}

	public function getNum() {
		return $this->num;
	}

	public function setPageNo($pageNo) {
		$this->pageNo = $pageNo;
		$this->apiParas["page_no"] = $pageNo;
	}

	public function getPageNo() {
		return $this->pageNo;
	}

	public function setSearchType($searchType) {
		$this->searchType = $searchType;
		$this->apiParas["search_type"] = $searchType;
	}

	public function getSearchType() {
		return $this->searchType;
	}

	public function getApiMethodName() {
		return "taobao.caipiao.present.win.items.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
