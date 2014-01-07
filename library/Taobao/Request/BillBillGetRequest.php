<?php

/**
 * TOP API: taobao.bill.bill.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_BillBillGetRequest {
	/**
	 * 账单编号
	 **/
	private $bid;

	/**
	 * 传入需要返回的字段
	 **/
	private $fields;

	private $apiParas = array();

	public function setBid($bid) {
		$this->bid = $bid;
		$this->apiParas["bid"] = $bid;
	}

	public function getBid() {
		return $this->bid;
	}

	public function setFields($fields) {
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields() {
		return $this->fields;
	}

	public function getApiMethodName() {
		return "taobao.bill.bill.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->bid, "bid");
		Taobao_RequestCheckUtil::checkNotNull($this->fields, "fields");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
