<?php

/**
 * TOP API: taobao.scitem.map.batch.query request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_ScitemMapBatchQueryRequest {
	/**
	 * 后端商品的商家编码
	 **/
	private $outerCode;

	/**
	 * 当前页码数
	 **/
	private $pageIndex;

	/**
	 * 分页记录个数，如果用户输入的记录数大于50，则一页显示50条记录
	 **/
	private $pageSize;

	/**
	 * 后端商品id
	 **/
	private $scItemId;

	private $apiParas = array();

	public function setOuterCode($outerCode) {
		$this->outerCode = $outerCode;
		$this->apiParas["outer_code"] = $outerCode;
	}

	public function getOuterCode() {
		return $this->outerCode;
	}

	public function setPageIndex($pageIndex) {
		$this->pageIndex = $pageIndex;
		$this->apiParas["page_index"] = $pageIndex;
	}

	public function getPageIndex() {
		return $this->pageIndex;
	}

	public function setPageSize($pageSize) {
		$this->pageSize = $pageSize;
		$this->apiParas["page_size"] = $pageSize;
	}

	public function getPageSize() {
		return $this->pageSize;
	}

	public function setScItemId($scItemId) {
		$this->scItemId = $scItemId;
		$this->apiParas["sc_item_id"] = $scItemId;
	}

	public function getScItemId() {
		return $this->scItemId;
	}

	public function getApiMethodName() {
		return "taobao.scitem.map.batch.query";
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
