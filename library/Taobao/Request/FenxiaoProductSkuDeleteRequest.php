<?php

/**
 * TOP API: taobao.fenxiao.product.sku.delete request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_FenxiaoProductSkuDeleteRequest {
	/**
	 * 产品id
	 **/
	private $productId;

	/**
	 * sku属性
	 **/
	private $properties;

	private $apiParas = array();

	public function setProductId($productId) {
		$this->productId = $productId;
		$this->apiParas["product_id"] = $productId;
	}

	public function getProductId() {
		return $this->productId;
	}

	public function setProperties($properties) {
		$this->properties = $properties;
		$this->apiParas["properties"] = $properties;
	}

	public function getProperties() {
		return $this->properties;
	}

	public function getApiMethodName() {
		return "taobao.fenxiao.product.sku.delete";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->productId, "productId");
		Taobao_RequestCheckUtil::checkNotNull($this->properties, "properties");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
