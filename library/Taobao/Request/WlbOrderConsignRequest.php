<?php

/**
 * TOP API: taobao.wlb.order.consign request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_WlbOrderConsignRequest {
	/**
	 * 物流宝订单编号
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
		return "taobao.wlb.order.consign";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->wlbOrderCode, "wlbOrderCode");
		Taobao_RequestCheckUtil::checkMaxLength($this->wlbOrderCode, 64, "wlbOrderCode");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
