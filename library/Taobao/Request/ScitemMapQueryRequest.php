<?php

/**
 * TOP API: taobao.scitem.map.query request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_ScitemMapQueryRequest {
	/**
	 * map_type为1：前台ic商品id
	 * map_type为2：分销productid
	 **/
	private $itemId;

	/**
	 * map_type为1：前台ic商品skuid
	 * map_type为2：分销商品的skuid
	 **/
	private $skuId;

	private $apiParas = array();

	public function setItemId($itemId) {
		$this->itemId = $itemId;
		$this->apiParas["item_id"] = $itemId;
	}

	public function getItemId() {
		return $this->itemId;
	}

	public function setSkuId($skuId) {
		$this->skuId = $skuId;
		$this->apiParas["sku_id"] = $skuId;
	}

	public function getSkuId() {
		return $this->skuId;
	}

	public function getApiMethodName() {
		return "taobao.scitem.map.query";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->itemId, "itemId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
