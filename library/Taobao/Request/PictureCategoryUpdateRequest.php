<?php

/**
 * TOP API: taobao.picture.category.update request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_PictureCategoryUpdateRequest {
	/**
	 * 要更新的图片分类的id
	 **/
	private $categoryId;

	/**
	 * 图片分类的新名字，最大长度20字符，不能为空
	 **/
	private $categoryName;

	/**
	 * 图片分类的新父分类id
	 **/
	private $parentId;

	private $apiParas = array();

	public function setCategoryId($categoryId) {
		$this->categoryId = $categoryId;
		$this->apiParas["category_id"] = $categoryId;
	}

	public function getCategoryId() {
		return $this->categoryId;
	}

	public function setCategoryName($categoryName) {
		$this->categoryName = $categoryName;
		$this->apiParas["category_name"] = $categoryName;
	}

	public function getCategoryName() {
		return $this->categoryName;
	}

	public function setParentId($parentId) {
		$this->parentId = $parentId;
		$this->apiParas["parent_id"] = $parentId;
	}

	public function getParentId() {
		return $this->parentId;
	}

	public function getApiMethodName() {
		return "taobao.picture.category.update";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->categoryId, "categoryId");
		Taobao_RequestCheckUtil::checkMaxLength($this->categoryName, 20, "categoryName");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
