<?php

/**
 * TOP API: tmall.brandcat.salespro.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TmallBrandcatSalesproGetRequest {
	/**
	 * 被管控的品牌Id
	 **/
	private $brandId;

	/**
	 * 被管控的类目Id
	 **/
	private $catId;

	private $apiParas = array();

	public function setBrandId($brandId) {
		$this->brandId = $brandId;
		$this->apiParas["brand_id"] = $brandId;
	}

	public function getBrandId() {
		return $this->brandId;
	}

	public function setCatId($catId) {
		$this->catId = $catId;
		$this->apiParas["cat_id"] = $catId;
	}

	public function getCatId() {
		return $this->catId;
	}

	public function getApiMethodName() {
		return "tmall.brandcat.salespro.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->brandId, "brandId");
		Taobao_RequestCheckUtil::checkNotNull($this->catId, "catId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
