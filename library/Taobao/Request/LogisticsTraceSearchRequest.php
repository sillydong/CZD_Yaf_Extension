<?php

/**
 * TOP API: taobao.logistics.trace.search request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_LogisticsTraceSearchRequest {
	/**
	 * 表明是否是拆单，默认值0，1表示拆单
	 **/
	private $isSplit;

	/**
	 * 卖家昵称
	 **/
	private $sellerNick;

	/**
	 * 拆单子订单列表，对应的数据是：子订单号的列表。可以不传，但是如果传了则必须符合传递的规则。子订单必须是操作的物流订单的子订单的真子集
	 **/
	private $subTid;

	/**
	 * 淘宝交易号，请勿传非淘宝交易号
	 **/
	private $tid;

	private $apiParas = array();

	public function setIsSplit($isSplit) {
		$this->isSplit = $isSplit;
		$this->apiParas["is_split"] = $isSplit;
	}

	public function getIsSplit() {
		return $this->isSplit;
	}

	public function setSellerNick($sellerNick) {
		$this->sellerNick = $sellerNick;
		$this->apiParas["seller_nick"] = $sellerNick;
	}

	public function getSellerNick() {
		return $this->sellerNick;
	}

	public function setSubTid($subTid) {
		$this->subTid = $subTid;
		$this->apiParas["sub_tid"] = $subTid;
	}

	public function getSubTid() {
		return $this->subTid;
	}

	public function setTid($tid) {
		$this->tid = $tid;
		$this->apiParas["tid"] = $tid;
	}

	public function getTid() {
		return $this->tid;
	}

	public function getApiMethodName() {
		return "taobao.logistics.trace.search";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->sellerNick, "sellerNick");
		Taobao_RequestCheckUtil::checkMaxListSize($this->subTid, 50, "subTid");
		Taobao_RequestCheckUtil::checkNotNull($this->tid, "tid");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
