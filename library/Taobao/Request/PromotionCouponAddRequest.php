<?php

/**
 * TOP API: taobao.promotion.coupon.add request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_PromotionCouponAddRequest {
	/**
	 * 订单满多少元才能用这个优惠券，500就是满500元才能使用
	 **/
	private $condition;

	/**
	 * 优惠券的面额，必须是3，5，10，20，50，100
	 **/
	private $denominations;

	/**
	 * 优惠券的截止日期
	 **/
	private $endTime;

	/**
	 * 优惠券的生效时间
	 **/
	private $startTime;

	private $apiParas = array();

	public function setCondition($condition) {
		$this->condition = $condition;
		$this->apiParas["condition"] = $condition;
	}

	public function getCondition() {
		return $this->condition;
	}

	public function setDenominations($denominations) {
		$this->denominations = $denominations;
		$this->apiParas["denominations"] = $denominations;
	}

	public function getDenominations() {
		return $this->denominations;
	}

	public function setEndTime($endTime) {
		$this->endTime = $endTime;
		$this->apiParas["end_time"] = $endTime;
	}

	public function getEndTime() {
		return $this->endTime;
	}

	public function setStartTime($startTime) {
		$this->startTime = $startTime;
		$this->apiParas["start_time"] = $startTime;
	}

	public function getStartTime() {
		return $this->startTime;
	}

	public function getApiMethodName() {
		return "taobao.promotion.coupon.add";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->denominations, "denominations");
		Taobao_RequestCheckUtil::checkMaxValue($this->denominations, 100, "denominations");
		Taobao_RequestCheckUtil::checkMinValue($this->denominations, 3, "denominations");
		Taobao_RequestCheckUtil::checkNotNull($this->endTime, "endTime");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
