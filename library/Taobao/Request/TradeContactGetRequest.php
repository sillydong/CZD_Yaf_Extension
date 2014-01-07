<?php

/**
 * TOP API: taobao.trade.contact.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TradeContactGetRequest {
	/**
	 * buyer_email,buyer_area,receiver_name,receiver_state,receiver_city,receiver_district,<br/>
	 * receiver_address,receiver_zip,receiver_mobile,receiver_phone,seller_mobile,seller_phone,seller_name,seller_email
	 **/
	private $fields;

	/**
	 * 交易编号
	 **/
	private $tid;

	private $apiParas = array();

	public function setFields($fields) {
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields() {
		return $this->fields;
	}

	public function setTid($tid) {
		$this->tid = $tid;
		$this->apiParas["tid"] = $tid;
	}

	public function getTid() {
		return $this->tid;
	}

	public function getApiMethodName() {
		return "taobao.trade.contact.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->fields, "fields");
		Taobao_RequestCheckUtil::checkNotNull($this->tid, "tid");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
