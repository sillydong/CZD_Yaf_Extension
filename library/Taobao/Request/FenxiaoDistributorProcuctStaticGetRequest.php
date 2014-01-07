<?php

/**
 * TOP API: taobao.fenxiao.distributor.procuct.static.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_FenxiaoDistributorProcuctStaticGetRequest {
	/**
	 * 分销商淘宝店主nick
	 **/
	private $distributorUserNick;

	/**
	 * 供应商商品id，一次可以传多个，每次最多40个。
	 * 以,(英文)作为分隔符。
	 **/
	private $productIdArray;

	private $apiParas = array();

	public function setDistributorUserNick($distributorUserNick) {
		$this->distributorUserNick = $distributorUserNick;
		$this->apiParas["distributor_user_nick"] = $distributorUserNick;
	}

	public function getDistributorUserNick() {
		return $this->distributorUserNick;
	}

	public function setProductIdArray($productIdArray) {
		$this->productIdArray = $productIdArray;
		$this->apiParas["product_id_array"] = $productIdArray;
	}

	public function getProductIdArray() {
		return $this->productIdArray;
	}

	public function getApiMethodName() {
		return "taobao.fenxiao.distributor.procuct.static.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->distributorUserNick, "distributorUserNick");
		Taobao_RequestCheckUtil::checkNotNull($this->productIdArray, "productIdArray");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
