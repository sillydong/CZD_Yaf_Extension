<?php

/**
 * TOP API: taobao.promotion.coupon.send request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_PromotionCouponSendRequest {
	/**
	 * 买家昵称用半角','号分割
	 **/
	private $buyerNick;

	/**
	 * 优惠券的id
	 **/
	private $couponId;

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

	public function getApiMethodName() {
		return "taobao.promotion.coupon.send";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->buyerNick, "buyerNick");
		Taobao_RequestCheckUtil::checkMaxListSize($this->buyerNick, 100, "buyerNick");
		Taobao_RequestCheckUtil::checkNotNull($this->couponId, "couponId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
