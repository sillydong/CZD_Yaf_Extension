<?php

/**
 * TOP API: taobao.inventory.store.query request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_InventoryStoreQueryRequest {
	/**
	 * 商家的仓库编码
	 **/
	private $storeCode;

	private $apiParas = array();

	public function setStoreCode($storeCode) {
		$this->storeCode = $storeCode;
		$this->apiParas["store_code"] = $storeCode;
	}

	public function getStoreCode() {
		return $this->storeCode;
	}

	public function getApiMethodName() {
		return "taobao.inventory.store.query";
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
