<?php

/**
 * TOP API: taobao.crm.groups.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_CrmGroupsGetRequest {
	/**
	 * 显示第几页的分组，如果输入的页码大于总共的页码数，例如总共10页，但是current_page的值为11，则返回空白页，最小页码为1
	 **/
	private $currentPage;

	/**
	 * 每页显示的记录数，其最大值不能超过100条，最小值为1，默认20条
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

	public function setPageSize($pageSize) {
		$this->pageSize = $pageSize;
		$this->apiParas["page_size"] = $pageSize;
	}

	public function getPageSize() {
		return $this->pageSize;
	}

	public function getApiMethodName() {
		return "taobao.crm.groups.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->currentPage, "currentPage");
		Taobao_RequestCheckUtil::checkMaxValue($this->currentPage, 1000000, "currentPage");
		Taobao_RequestCheckUtil::checkMinValue($this->currentPage, 1, "currentPage");
		Taobao_RequestCheckUtil::checkMaxValue($this->pageSize, 100, "pageSize");
		Taobao_RequestCheckUtil::checkMinValue($this->pageSize, 1, "pageSize");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
