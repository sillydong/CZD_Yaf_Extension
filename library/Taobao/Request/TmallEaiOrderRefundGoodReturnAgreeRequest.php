<?php

/**
 * TOP API: tmall.eai.order.refund.good.return.agree request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TmallEaiOrderRefundGoodReturnAgreeRequest {
	/**
	 * 同意退货留言
	 **/
	private $message;

	/**
	 * 退款单编号
	 **/
	private $refundId;

	/**
	 * 售中：onsale
	 * 售后：aftersale
	 **/
	private $refundPhase;

	/**
	 * 退款版本号
	 **/
	private $refundVersion;

	/**
	 * 卖家收货地址编号
	 **/
	private $sellerLogisticsAddressId;

	private $apiParas = array();

	public function setMessage($message) {
		$this->message = $message;
		$this->apiParas["message"] = $message;
	}

	public function getMessage() {
		return $this->message;
	}

	public function setRefundId($refundId) {
		$this->refundId = $refundId;
		$this->apiParas["refund_id"] = $refundId;
	}

	public function getRefundId() {
		return $this->refundId;
	}

	public function setRefundPhase($refundPhase) {
		$this->refundPhase = $refundPhase;
		$this->apiParas["refund_phase"] = $refundPhase;
	}

	public function getRefundPhase() {
		return $this->refundPhase;
	}

	public function setRefundVersion($refundVersion) {
		$this->refundVersion = $refundVersion;
		$this->apiParas["refund_version"] = $refundVersion;
	}

	public function getRefundVersion() {
		return $this->refundVersion;
	}

	public function setSellerLogisticsAddressId($sellerLogisticsAddressId) {
		$this->sellerLogisticsAddressId = $sellerLogisticsAddressId;
		$this->apiParas["seller_logistics_address_id"] = $sellerLogisticsAddressId;
	}

	public function getSellerLogisticsAddressId() {
		return $this->sellerLogisticsAddressId;
	}

	public function getApiMethodName() {
		return "tmall.eai.order.refund.good.return.agree";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->message, "message");
		Taobao_RequestCheckUtil::checkNotNull($this->refundId, "refundId");
		Taobao_RequestCheckUtil::checkNotNull($this->refundPhase, "refundPhase");
		Taobao_RequestCheckUtil::checkNotNull($this->refundVersion, "refundVersion");
		Taobao_RequestCheckUtil::checkNotNull($this->sellerLogisticsAddressId, "sellerLogisticsAddressId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
