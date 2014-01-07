<?php

/**
 * TOP API: taobao.wlb.wlborder.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_WlbWlborderGetRequest {
	/**
	 * 物流宝订单编码
	 **/
	private $wlbOrderCode;

	private $apiParas = array();

	public function setWlbOrderCode($wlbOrderCode) {
		$this->wlbOrderCode = $wlbOrderCode;
		$this->apiParas["wlb_order_code"] = $wlbOrderCode;
	}

	public function getWlbOrderCode() {
		return $this->wlbOrderCode;
	}

	public function getApiMethodName() {
		return "taobao.wlb.wlborder.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->wlbOrderCode, "wlbOrderCode");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
