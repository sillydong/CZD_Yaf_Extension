<?php

/**
 * TOP API: taobao.promotion.coupondetail.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_PromotionCoupondetailGetRequest {
	/**
	 * 买家昵称
	 **/
	private $buyerNick;

	/**
	 * 优惠券的id
	 **/
	private $couponId;

	/**
	 * 传入优惠券截止时间，即失效时间。查询输入日期向前15天的数据；不传则查询当前日期向前15天的数据。比如查询明天才失效的优惠卷，要传入明天之后15天内的日期，才能查询到该优惠卷。
	 **/
	private $endTime;

	/**
	 * 这是一个扩展字段 供版本升级用
	 * 当前如果新版本的话 可以传入new字符串
	 **/
	private $extendParams;

	/**
	 * 查询的页号，结果集是分页返回的，每页20条
	 **/
	private $pageNo;

	/**
	 * 每页行数
	 **/
	private $pageSize;

	/**
	 * 优惠券使用情况unused：代表未使用using：代表使用中used：代表已使用。必须是unused，using，used
	 **/
	private $state;

	private $apiParas = array();

	public function setBuyerNick($buyerNick) {
		$this->buyerNick = $buyerNick;
		$this->apiParas["buyer_nick"] = $buyerNick;
	}

	public function getBuyerNick() {
		return $this->buyerNick;
	}

	public function setCouponId($couponId) {
		$this->couponId = $couponId;
		$this->apiParas["coupon_id"] = $couponId;
	}

	public function getCouponId() {
		return $this->couponId;
	}

	public function setEndTime($endTime) {
		$this->endTime = $endTime;
		$this->apiParas["end_time"] = $endTime;
	}

	public function getEndTime() {
		return $this->endTime;
	}

	public function setExtendParams($extendParams) {
		$this->extendParams = $extendParams;
		$this->apiParas["extend_params"] = $extendParams;
	}

	public function getExtendParams() {
		return $this->extendParams;
	}

	public function setPageNo($pageNo) {
		$this->pageNo = $pageNo;
		$this->apiParas["page_no"] = $pageNo;
	}

	public function getPageNo() {
		return $this->pageNo;
	}

	public function setPageSize($pageSize) {
		$this->pageSize = $pageSize;
		$this->apiParas["page_size"] = $pageSize;
	}

	public function getPageSize() {
		return $this->pageSize;
	}

	public function setState($state) {
		$this->state = $state;
		$this->apiParas["state"] = $state;
	}

	public function getState() {
		return $this->state;
	}

	public function getApiMethodName() {
		return "taobao.promotion.coupondetail.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->couponId, "couponId");
		Taobao_RequestCheckUtil::checkMaxValue($this->pageSize, 20, "pageSize");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
