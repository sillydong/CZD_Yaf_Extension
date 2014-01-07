<?php

/**
 * TOP API: taobao.hanoi.types.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HanoiTypesGetRequest {
	/**
	 * 分页时需要用。默认第一页。
	 **/
	private $currentPage;

	/**
	 * 类型的唯一标识
	 **/
	private $id;

	/**
	 * 类型的名称
	 **/
	private $name;

	/**
	 * 分页时 每页显示的条数。最小1 最大30 默认10页
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

	public function setId($id) {
		$this->id = $id;
		$this->apiParas["id"] = $id;
	}

	public function getId() {
		return $this->id;
	}

	public function setName($name) {
		$this->name = $name;
		$this->apiParas["name"] = $name;
	}

	public function getName() {
		return $this->name;
	}

	public function setPageSize($pageSize) {
		$this->pageSize = $pageSize;
		$this->apiParas["page_size"] = $pageSize;
	}

	public function getPageSize() {
		return $this->pageSize;
	}

	public function getApiMethodName() {
		return "taobao.hanoi.types.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkMaxValue($this->currentPage, 2147483647, "currentPage");
		Taobao_RequestCheckUtil::checkMinValue($this->currentPage, 1, "currentPage");
		Taobao_RequestCheckUtil::checkMaxValue($this->id, 9223372036854775807, "id");
		Taobao_RequestCheckUtil::checkMinValue($this->id, 1, "id");
		Taobao_RequestCheckUtil::checkMaxLength($this->name, 50, "name");
		Taobao_RequestCheckUtil::checkMaxValue($this->pageSize, 30, "pageSize");
		Taobao_RequestCheckUtil::checkMinValue($this->pageSize, 1, "pageSize");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
