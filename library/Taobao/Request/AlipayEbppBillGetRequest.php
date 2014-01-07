<?php

/**
 * TOP API: alipay.ebpp.bill.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_AlipayEbppBillGetRequest {
	/**
	 * 支付宝授权凭证，如果有淘宝的session可以不传
	 **/
	private $authToken;

	/**
	 * 输出机构的业务流水号，需要保证唯一性。
	 **/
	private $merchantOrderNo;

	/**
	 * 支付宝订单类型。公共事业缴纳JF,信用卡还款HK
	 **/
	private $orderType;

	private $apiParas = array();

	public function setAuthToken($authToken) {
		$this->authToken = $authToken;
		$this->apiParas["auth_token"] = $authToken;
	}

	public function getAuthToken() {
		return $this->authToken;
	}

	public function setMerchantOrderNo($merchantOrderNo) {
		$this->merchantOrderNo = $merchantOrderNo;
		$this->apiParas["merchant_order_no"] = $merchantOrderNo;
	}

	public function getMerchantOrderNo() {
		return $this->merchantOrderNo;
	}

	public function setOrderType($orderType) {
		$this->orderType = $orderType;
		$this->apiParas["order_type"] = $orderType;
	}

	public function getOrderType() {
		return $this->orderType;
	}

	public function getApiMethodName() {
		return "alipay.ebpp.bill.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->merchantOrderNo, "merchantOrderNo");
		Taobao_RequestCheckUtil::checkMaxLength($this->merchantOrderNo, 32, "merchantOrderNo");
		Taobao_RequestCheckUtil::checkNotNull($this->orderType, "orderType");
		Taobao_RequestCheckUtil::checkMaxLength($this->orderType, 10, "orderType");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
