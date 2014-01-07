<?php

/**
 * TOP API: taobao.wlb.replenish.statistics request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_WlbReplenishStatisticsRequest {
	/**
	 * 商品编码
	 **/
	private $itemCode;

	/**
	 * 商品名称
	 **/
	private $name;

	/**
	 * 分页参数，默认第一页
	 **/
	private $pageNo;

	/**
	 * 分页每页页数，默认20，最大50
	 **/
	private $pageSize;

	/**
	 * 仓库编码
	 **/
	private $storeCode;

	private $apiParas = array();

	public function setItemCode($itemCode) {
		$this->itemCode = $itemCode;
		$this->apiParas["item_code"] = $itemCode;
	}

	public function getItemCode() {
		return $this->itemCode;
	}

	public function setName($name) {
		$this->name = $name;
		$this->apiParas["name"] = $name;
	}

	public function getName() {
		return $this->name;
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

	public function setStoreCode($storeCode) {
		$this->storeCode = $storeCode;
		$this->apiParas["store_code"] = $storeCode;
	}

	public function getStoreCode() {
		return $this->storeCode;
	}

	public function getApiMethodName() {
		return "taobao.wlb.replenish.statistics";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkMaxValue($this->pageSize, 50, "pageSize");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
