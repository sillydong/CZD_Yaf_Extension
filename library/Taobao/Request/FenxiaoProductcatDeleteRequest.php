<?php

/**
 * TOP API: taobao.fenxiao.productcat.delete request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_FenxiaoProductcatDeleteRequest {
	/**
	 * 产品线ID
	 **/
	private $productLineId;

	private $apiParas = array();

	public function setProductLineId($productLineId) {
		$this->productLineId = $productLineId;
		$this->apiParas["product_line_id"] = $productLineId;
	}

	public function getProductLineId() {
		return $this->productLineId;
	}

	public function getApiMethodName() {
		return "taobao.fenxiao.productcat.delete";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->productLineId, "productLineId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
