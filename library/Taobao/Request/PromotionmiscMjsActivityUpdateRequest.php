<?php

/**
 * TOP API: taobao.promotionmisc.mjs.activity.update request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_PromotionmiscMjsActivityUpdateRequest {
	/**
	 * 活动id。
	 **/
	private $activityId;

	/**
	 * 减多少钱。当is_decrease_money为true时，该值才有意义。注意：该值单位为分，即100表示1元。
	 **/
	private $decreaseAmount;

	/**
	 * 折扣值。当is_discount为true时，该值才有意义。注意：800表示8折。
	 **/
	private $discountRate;

	/**
	 * 活动结束时间。
	 **/
	private $endTime;

	/**
	 * 免邮的排除地区，即，除指定地区外，其他地区包邮。当is_free_post为true时，该值才有意义。代码使用*链接，代码为行政区划代码。
	 **/
	private $excludeArea;

	/**
	 * 礼品id，当is_send_gift为true时，该值才有意义。 1）只有填写真实的淘宝商品id时，才能生成物流单，并且在确定订单的页面上可以点击该商品名称跳转到商品详情页面。2）当礼物为实物商品时(有宝贝id),礼物必须为上架商品,不能为虚拟商品,不能为拍卖商品,不能有sku,不符合条件的,不做为礼物。
	 **/
	private $giftId;

	/**
	 * 礼品名称。当is_send_gift为true时，该值才有意义。
	 **/
	private $giftName;

	/**
	 * 商品详情的url，当is_send_gift为true时，该值才有效。
	 **/
	private $giftUrl;

	/**
	 * 满元是否上不封顶。当is_amount_over为true时，该值才有意义。当该值为true时，表示满元上不封顶，例如满100元减10元，当满200时，则减20元。。。默认为false。
	 **/
	private $isAmountMultiple;

	/**
	 * 是否有满元条件。
	 **/
	private $isAmountOver;

	/**
	 * 是否有减钱行为。
	 **/
	private $isDecreaseMoney;

	/**
	 * 是否有打折行为。
	 **/
	private $isDiscount;

	/**
	 * 是否有免邮行为。
	 **/
	private $isFreePost;

	/**
	 * 是否有满件条件。
	 **/
	private $isItemCountOver;

	/**
	 * 满件是否上不封顶。当is_amount_multiple为true时，该值才有意义。当该值为true时，表示满件上不封顶，例如满10件减2元，当满20件时，则减4元。。。 默认为false。
	 **/
	private $isItemMultiple;

	/**
	 * 是否有送礼品行为。
	 **/
	private $isSendGift;

	/**
	 * 是否有店铺会员等级条件。
	 **/
	private $isShopMember;

	/**
	 * 是否指定用户标签。
	 **/
	private $isUserTag;

	/**
	 * 满多少件。当is_item_count_over为true时，该值才有意义。
	 **/
	private $itemCount;

	/**
	 * 活动名称。
	 **/
	private $name;

	/**
	 * 活动范围：0表示全部参与； 1表示部分商品参与。
	 **/
	private $participateRange;

	/**
	 * 店铺会员等级，当is_shop_member为true时，该值才有意义。0：店铺客户；1：普通客户；2：高级会员；3：VIP会员； 4：至尊VIP会员。
	 **/
	private $shopMemberLevel;

	/**
	 * 活动开始时间。
	 **/
	private $startTime;

	/**
	 * 满多少元。当is_amount_over为true时，该才字段有意义。注意：单位是分，即10000表示100元。
	 **/
	private $totalPrice;

	/**
	 * 用户标签。当is_user_tag为true时，该值才有意义。
	 **/
	private $userTag;

	private $apiParas = array();

	public function setActivityId($activityId) {
		$this->activityId = $activityId;
		$this->apiParas["activity_id"] = $activityId;
	}

	public function getActivityId() {
		return $this->activityId;
	}

	public function setDecreaseAmount($decreaseAmount) {
		$this->decreaseAmount = $decreaseAmount;
		$this->apiParas["decrease_amount"] = $decreaseAmount;
	}

	public function getDecreaseAmount() {
		return $this->decreaseAmount;
	}

	public function setDiscountRate($discountRate) {
		$this->discountRate = $discountRate;
		$this->apiParas["discount_rate"] = $discountRate;
	}

	public function getDiscountRate() {
		return $this->discountRate;
	}

	public function setEndTime($endTime) {
		$this->endTime = $endTime;
		$this->apiParas["end_time"] = $endTime;
	}

	public function getEndTime() {
		return $this->endTime;
	}

	public function setExcludeArea($excludeArea) {
		$this->excludeArea = $excludeArea;
		$this->apiParas["exclude_area"] = $excludeArea;
	}

	public function getExcludeArea() {
		return $this->excludeArea;
	}

	public function setGiftId($giftId) {
		$this->giftId = $giftId;
		$this->apiParas["gift_id"] = $giftId;
	}

	public function getGiftId() {
		return $this->giftId;
	}

	public function setGiftName($giftName) {
		$this->giftName = $giftName;
		$this->apiParas["gift_name"] = $giftName;
	}

	public function getGiftName() {
		return $this->giftName;
	}

	public function setGiftUrl($giftUrl) {
		$this->giftUrl = $giftUrl;
		$this->apiParas["gift_url"] = $giftUrl;
	}

	public function getGiftUrl() {
		return $this->giftUrl;
	}

	public function setIsAmountMultiple($isAmountMultiple) {
		$this->isAmountMultiple = $isAmountMultiple;
		$this->apiParas["is_amount_multiple"] = $isAmountMultiple;
	}

	public function getIsAmountMultiple() {
		return $this->isAmountMultiple;
	}

	public function setIsAmountOver($isAmountOver) {
		$this->isAmountOver = $isAmountOver;
		$this->apiParas["is_amount_over"] = $isAmountOver;
	}

	public function getIsAmountOver() {
		return $this->isAmountOver;
	}

	public function setIsDecreaseMoney($isDecreaseMoney) {
		$this->isDecreaseMoney = $isDecreaseMoney;
		$this->apiParas["is_decrease_money"] = $isDecreaseMoney;
	}

	public function getIsDecreaseMoney() {
		return $this->isDecreaseMoney;
	}

	public function setIsDiscount($isDiscount) {
		$this->isDiscount = $isDiscount;
		$this->apiParas["is_discount"] = $isDiscount;
	}

	public function getIsDiscount() {
		return $this->isDiscount;
	}

	public function setIsFreePost($isFreePost) {
		$this->isFreePost = $isFreePost;
		$this->apiParas["is_free_post"] = $isFreePost;
	}

	public function getIsFreePost() {
		return $this->isFreePost;
	}

	public function setIsItemCountOver($isItemCountOver) {
		$this->isItemCountOver = $isItemCountOver;
		$this->apiParas["is_item_count_over"] = $isItemCountOver;
	}

	public function getIsItemCountOver() {
		return $this->isItemCountOver;
	}

	public function setIsItemMultiple($isItemMultiple) {
		$this->isItemMultiple = $isItemMultiple;
		$this->apiParas["is_item_multiple"] = $isItemMultiple;
	}

	public function getIsItemMultiple() {
		return $this->isItemMultiple;
	}

	public function setIsSendGift($isSendGift) {
		$this->isSendGift = $isSendGift;
		$this->apiParas["is_send_gift"] = $isSendGift;
	}

	public function getIsSendGift() {
		return $this->isSendGift;
	}

	public function setIsShopMember($isShopMember) {
		$this->isShopMember = $isShopMember;
		$this->apiParas["is_shop_member"] = $isShopMember;
	}

	public function getIsShopMember() {
		return $this->isShopMember;
	}

	public function setIsUserTag($isUserTag) {
		$this->isUserTag = $isUserTag;
		$this->apiParas["is_user_tag"] = $isUserTag;
	}

	public function getIsUserTag() {
		return $this->isUserTag;
	}

	public function setItemCount($itemCount) {
		$this->itemCount = $itemCount;
		$this->apiParas["item_count"] = $itemCount;
	}

	public function getItemCount() {
		return $this->itemCount;
	}

	public function setName($name) {
		$this->name = $name;
		$this->apiParas["name"] = $name;
	}

	public function getName() {
		return $this->name;
	}

	public function setParticipateRange($participateRange) {
		$this->participateRange = $participateRange;
		$this->apiParas["participate_range"] = $participateRange;
	}

	public function getParticipateRange() {
		return $this->participateRange;
	}

	public function setShopMemberLevel($shopMemberLevel) {
		$this->shopMemberLevel = $shopMemberLevel;
		$this->apiParas["shop_member_level"] = $shopMemberLevel;
	}

	public function getShopMemberLevel() {
		return $this->shopMemberLevel;
	}

	public function setStartTime($startTime) {
		$this->startTime = $startTime;
		$this->apiParas["start_time"] = $startTime;
	}

	public function getStartTime() {
		return $this->startTime;
	}

	public function setTotalPrice($totalPrice) {
		$this->totalPrice = $totalPrice;
		$this->apiParas["total_price"] = $totalPrice;
	}

	public function getTotalPrice() {
		return $this->totalPrice;
	}

	public function setUserTag($userTag) {
		$this->userTag = $userTag;
		$this->apiParas["user_tag"] = $userTag;
	}

	public function getUserTag() {
		return $this->userTag;
	}

	public function getApiMethodName() {
		return "taobao.promotionmisc.mjs.activity.update";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->activityId, "activityId");
		Taobao_RequestCheckUtil::checkMinValue($this->activityId, 0, "activityId");
		Taobao_RequestCheckUtil::checkMinValue($this->decreaseAmount, 0, "decreaseAmount");
		Taobao_RequestCheckUtil::checkMinValue($this->discountRate, 0, "discountRate");
		Taobao_RequestCheckUtil::checkNotNull($this->endTime, "endTime");
		Taobao_RequestCheckUtil::checkMaxLength($this->giftName, 32, "giftName");
		Taobao_RequestCheckUtil::checkMinValue($this->itemCount, 0, "itemCount");
		Taobao_RequestCheckUtil::checkNotNull($this->name, "name");
		Taobao_RequestCheckUtil::checkMaxLength($this->name, 32, "name");
		Taobao_RequestCheckUtil::checkNotNull($this->participateRange, "participateRange");
		Taobao_RequestCheckUtil::checkMaxValue($this->participateRange, 1, "participateRange");
		Taobao_RequestCheckUtil::checkMinValue($this->participateRange, 0, "participateRange");
		Taobao_RequestCheckUtil::checkMaxValue($this->shopMemberLevel, 9, "shopMemberLevel");
		Taobao_RequestCheckUtil::checkMinValue($this->shopMemberLevel, 0, "shopMemberLevel");
		Taobao_RequestCheckUtil::checkNotNull($this->startTime, "startTime");
		Taobao_RequestCheckUtil::checkMinValue($this->totalPrice, 0, "totalPrice");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
