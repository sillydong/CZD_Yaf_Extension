<?php

/**
 * TOP API: taobao.wlb.orderstatus.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_WlbOrderstatusGetRequest {
	/**
	 * 物流宝订单编码
	 **/
	private $orderCode;

	private $apiParas = array();

	public function setOrderCode($orderCode) {
		$this->orderCode = $orderCode;
		$this->apiParas["order_code"] = $orderCode;
	}

	public function getOrderCode() {
		return $this->orderCode;
	}

	public function getApiMethodName() {
		return "taobao.wlb.orderstatus.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->orderCode, "orderCode");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
