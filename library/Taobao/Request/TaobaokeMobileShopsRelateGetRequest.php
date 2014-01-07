<?php

/**
 * TOP API: taobao.taobaoke.mobile.shops.relate.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TaobaokeMobileShopsRelateGetRequest {
	/**
	 * 需返回的字段列表.可选值:TaobaokeShop淘宝客商品结构体中的user_id,seller_nick,shop_id,shop_title,seller_credit,shop_type,commission_rate,click_url,total_auction,auction_count,字段之间用","分隔
	 **/
	private $fields;

	/**
	 * 指定返回结果的最大条数,实际返回结果个数根据算法来确定
	 **/
	private $maxCount;

	/**
	 * 自定义输入串.格式:英文和数字组成;长度不能大于12个字符,区分不同的推广渠道,如:bbs,表示bbs为推广渠道;blog,表示blog为推广渠道
	 **/
	private $outerCode;

	/**
	 * 卖家id.seller_id和seller_nick不能同时为空,如果都有值,则以seller_id为主
	 **/
	private $sellerId;

	/**
	 * 卖家昵称
	 **/
	private $sellerNick;

	/**
	 * 店铺类型.所有:all,商城:b,集市:c
	 **/
	private $shopType;

	/**
	 * default(默认排序,关联推荐相关度),commissionRate_desc(佣金比率从高到低), commissionRate_asc(佣金比率从低到高),credit_desc(信用等级从高到低), credit_asc(信用等级从低到高)
	 **/
	private $sort;

	private $apiParas = array();

	public function setFields($fields) {
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields() {
		return $this->fields;
	}

	public function setMaxCount($maxCount) {
		$this->maxCount = $maxCount;
		$this->apiParas["max_count"] = $maxCount;
	}

	public function getMaxCount() {
		return $this->maxCount;
	}

	public function setOuterCode($outerCode) {
		$this->outerCode = $outerCode;
		$this->apiParas["outer_code"] = $outerCode;
	}

	public function getOuterCode() {
		return $this->outerCode;
	}

	public function setSellerId($sellerId) {
		$this->sellerId = $sellerId;
		$this->apiParas["seller_id"] = $sellerId;
	}

	public function getSellerId() {
		return $this->sellerId;
	}

	public function setSellerNick($sellerNick) {
		$this->sellerNick = $sellerNick;
		$this->apiParas["seller_nick"] = $sellerNick;
	}

	public function getSellerNick() {
		return $this->sellerNick;
	}

	public function setShopType($shopType) {
		$this->shopType = $shopType;
		$this->apiParas["shop_type"] = $shopType;
	}

	public function getShopType() {
		return $this->shopType;
	}

	public function setSort($sort) {
		$this->sort = $sort;
		$this->apiParas["sort"] = $sort;
	}

	public function getSort() {
		return $this->sort;
	}

	public function getApiMethodName() {
		return "taobao.taobaoke.mobile.shops.relate.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->fields, "fields");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
