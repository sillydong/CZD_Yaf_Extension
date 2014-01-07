<?php

/**
 * TOP API: taobao.favorite.search request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_FavoriteSearchRequest {
	/**
	 * ITEM表示宝贝，SHOP表示商铺，collect_type只能为这两者之一
	 **/
	private $collectType;

	/**
	 * 页码。取值范围:大于零的整数; 默认值:1。一页20条记录。
	 **/
	private $pageNo;

	private $apiParas = array();

	public function setCollectType($collectType) {
		$this->collectType = $collectType;
		$this->apiParas["collect_type"] = $collectType;
	}

	public function getCollectType() {
		return $this->collectType;
	}

	public function setPageNo($pageNo) {
		$this->pageNo = $pageNo;
		$this->apiParas["page_no"] = $pageNo;
	}

	public function getPageNo() {
		return $this->pageNo;
	}

	public function getApiMethodName() {
		return "taobao.favorite.search";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->collectType, "collectType");
		Taobao_RequestCheckUtil::checkMaxLength($this->collectType, 4, "collectType");
		Taobao_RequestCheckUtil::checkNotNull($this->pageNo, "pageNo");
		Taobao_RequestCheckUtil::checkMaxValue($this->pageNo, 100, "pageNo");
		Taobao_RequestCheckUtil::checkMinValue($this->pageNo, 1, "pageNo");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
