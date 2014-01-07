<?php

/**
 * TOP API: taobao.fenxiao.product.skus.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_FenxiaoProductSkusGetRequest {
	/**
	 * 产品ID
	 **/
	private $productId;

	private $apiParas = array();

	public function setProductId($productId) {
		$this->productId = $productId;
		$this->apiParas["product_id"] = $productId;
	}

	public function getProductId() {
		return $this->productId;
	}

	public function getApiMethodName() {
		return "taobao.fenxiao.product.skus.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->productId, "productId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
