<?php

/**
 * TOP API: taobao.fenxiao.dealer.requisitionorder.agree request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_FenxiaoDealerRequisitionorderAgreeRequest {
	/**
	 * 采购申请/经销采购单编号
	 **/
	private $dealerOrderId;

	private $apiParas = array();

	public function setDealerOrderId($dealerOrderId) {
		$this->dealerOrderId = $dealerOrderId;
		$this->apiParas["dealer_order_id"] = $dealerOrderId;
	}

	public function getDealerOrderId() {
		return $this->dealerOrderId;
	}

	public function getApiMethodName() {
		return "taobao.fenxiao.dealer.requisitionorder.agree";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->dealerOrderId, "dealerOrderId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
