<?php

/**
 * TOP API: taobao.hanoi.attributes.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HanoiAttributesGetRequest {
	/**
	 * 属性编码
	 **/
	private $code;

	/**
	 * 分页时需要用。默认第一页。
	 **/
	private $currentPage;

	/**
	 * 属性的唯一标识
	 **/
	private $id;

	/**
	 * 是否支持模糊查询
	 **/
	private $indistinctQuery;

	/**
	 * 分页时 每页显示的条数。最小1 最大30 默认10页
	 **/
	private $pageSize;

	/**
	 * 属性名称
	 **/
	private $title;

	/**
	 * Top 的访问权限。按位与。1：可读，2：可写，4：可规则计算。如可读且可写的权限值为3。
	 **/
	private $topAccess;

	/**
	 * 类型 唯一标识
	 **/
	private $typeId;

	/**
	 * 类型名称
	 **/
	private $typeName;

	private $apiParas = array();

	public function setCode($code) {
		$this->code = $code;
		$this->apiParas["code"] = $code;
	}

	public function getCode() {
		return $this->code;
	}

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

	public function setIndistinctQuery($indistinctQuery) {
		$this->indistinctQuery = $indistinctQuery;
		$this->apiParas["indistinct_query"] = $indistinctQuery;
	}

	public function getIndistinctQuery() {
		return $this->indistinctQuery;
	}

	public function setPageSize($pageSize) {
		$this->pageSize = $pageSize;
		$this->apiParas["page_size"] = $pageSize;
	}

	public function getPageSize() {
		return $this->pageSize;
	}

	public function setTitle($title) {
		$this->title = $title;
		$this->apiParas["title"] = $title;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTopAccess($topAccess) {
		$this->topAccess = $topAccess;
		$this->apiParas["top_access"] = $topAccess;
	}

	public function getTopAccess() {
		return $this->topAccess;
	}

	public function setTypeId($typeId) {
		$this->typeId = $typeId;
		$this->apiParas["type_id"] = $typeId;
	}

	public function getTypeId() {
		return $this->typeId;
	}

	public function setTypeName($typeName) {
		$this->typeName = $typeName;
		$this->apiParas["type_name"] = $typeName;
	}

	public function getTypeName() {
		return $this->typeName;
	}

	public function getApiMethodName() {
		return "taobao.hanoi.attributes.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkMaxLength($this->code, 50, "code");
		Taobao_RequestCheckUtil::checkMaxValue($this->currentPage, 2147483647, "currentPage");
		Taobao_RequestCheckUtil::checkMinValue($this->currentPage, 1, "currentPage");
		Taobao_RequestCheckUtil::checkMaxValue($this->id, 9223372036854775807, "id");
		Taobao_RequestCheckUtil::checkMinValue($this->id, 1, "id");
		Taobao_RequestCheckUtil::checkMaxValue($this->pageSize, 30, "pageSize");
		Taobao_RequestCheckUtil::checkMinValue($this->pageSize, 1, "pageSize");
		Taobao_RequestCheckUtil::checkMaxLength($this->title, 50, "title");
		Taobao_RequestCheckUtil::checkMaxValue($this->topAccess, 7, "topAccess");
		Taobao_RequestCheckUtil::checkMinValue($this->topAccess, 0, "topAccess");
		Taobao_RequestCheckUtil::checkMaxValue($this->typeId, 9223372036854775807, "typeId");
		Taobao_RequestCheckUtil::checkMinValue($this->typeId, 1, "typeId");
		Taobao_RequestCheckUtil::checkMaxLength($this->typeName, 50, "typeName");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
