<?php

/**
 * TOP API: taobao.taobaoke.mobile.items.elite.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TaobaokeMobileItemsEliteGetRequest {
	/**
	 * 商品所在地，只作为权重
	 **/
	private $area;

	/**
	 * 后台类目,逗号分隔
	 **/
	private $ecat;

	/**
	 * 可选值和start_credit一样.start_credit的值一定要小于或等于end_credit的值。注：end_credit与start_credit一起使用才生效
	 **/
	private $endCredit;

	/**
	 * 折扣比率上限，如：2345表示23.45%。注：start_discount_rate和end_discount_rate一起设置才有效。
	 **/
	private $endDiscountRate;

	/**
	 * 最高价格
	 **/
	private $endPrice;

	/**
	 * 需返回的字段列表.可选值:num_iid,title,nick,pic_url,price,click_url,commission,commission_rate,commission_num,commission_volume,shop_click_url,seller_credit_score,item_location,volume
	 * ;字段之间用","分隔
	 **/
	private $fields;

	/**
	 * 自定义输入串.格式:英文和数字组成;长度不能大于12个字符,区分不同的推广渠道,如:bbs,表示bbs为推广渠道;blog,表示blog为推广渠道.
	 **/
	private $outerCode;

	/**
	 * 获取精品库商品数量
	 **/
	private $pageSize;

	/**
	 * 是否免邮费，设置为true都是免邮费商品，设置false只作为权重
	 **/
	private $postageFree;

	/**
	 * 关键词,使用逗号分割；q和ecat都存在以q为主
	 **/
	private $q;

	/**
	 * 店铺类型.所有:all,商城:b,集市:c
	 **/
	private $shopType;

	/**
	 * 图片大小。默认160x160。
	 **/
	private $size;

	/**
	 * 卖家信用:
	 *
	 * 1heart(一心)
	 * 2heart (两心)
	 * 3heart(三心)
	 * 4heart(四心)
	 * 5heart(五心)
	 * 1diamond(一钻)
	 * 2diamond(两钻)
	 * 3diamond(三钻)
	 * 4diamond(四钻)
	 * 5diamond(五钻)
	 * 1crown(一冠)
	 * 2crown(两冠)
	 * 3crown(三冠)
	 * 4crown(四冠)
	 * 5crown(五冠)
	 * 1goldencrown(一黄冠)
	 * 2goldencrown(二黄冠)
	 * 3goldencrown(三黄冠)
	 * 4goldencrown(四黄冠)
	 * 5goldencrown(五黄冠)
	 **/
	private $startCredit;

	/**
	 * 折扣比率下限，如：1234表示12.34%
	 **/
	private $startDiscountRate;

	/**
	 * 起始价格.传入价格参数时,需注意起始价格和最高价格必须一起传入,并且 start_price <= end_price；价格范围只是作为权重，不作为过滤条件，在价格范围内优先展现。
	 **/
	private $startPrice;

	private $apiParas = array();

	public function setArea($area) {
		$this->area = $area;
		$this->apiParas["area"] = $area;
	}

	public function getArea() {
		return $this->area;
	}

	public function setEcat($ecat) {
		$this->ecat = $ecat;
		$this->apiParas["ecat"] = $ecat;
	}

	public function getEcat() {
		return $this->ecat;
	}

	public function setEndCredit($endCredit) {
		$this->endCredit = $endCredit;
		$this->apiParas["end_credit"] = $endCredit;
	}

	public function getEndCredit() {
		return $this->endCredit;
	}

	public function setEndDiscountRate($endDiscountRate) {
		$this->endDiscountRate = $endDiscountRate;
		$this->apiParas["end_discount_rate"] = $endDiscountRate;
	}

	public function getEndDiscountRate() {
		return $this->endDiscountRate;
	}

	public function setEndPrice($endPrice) {
		$this->endPrice = $endPrice;
		$this->apiParas["end_price"] = $endPrice;
	}

	public function getEndPrice() {
		return $this->endPrice;
	}

	public function setFields($fields) {
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields() {
		return $this->fields;
	}

	public function setOuterCode($outerCode) {
		$this->outerCode = $outerCode;
		$this->apiParas["outer_code"] = $outerCode;
	}

	public function getOuterCode() {
		return $this->outerCode;
	}

	public function setPageSize($pageSize) {
		$this->pageSize = $pageSize;
		$this->apiParas["page_size"] = $pageSize;
	}

	public function getPageSize() {
		return $this->pageSize;
	}

	public function setPostageFree($postageFree) {
		$this->postageFree = $postageFree;
		$this->apiParas["postage_free"] = $postageFree;
	}

	public function getPostageFree() {
		return $this->postageFree;
	}

	public function setQ($q) {
		$this->q = $q;
		$this->apiParas["q"] = $q;
	}

	public function getQ() {
		return $this->q;
	}

	public function setShopType($shopType) {
		$this->shopType = $shopType;
		$this->apiParas["shop_type"] = $shopType;
	}

	public function getShopType() {
		return $this->shopType;
	}

	public function setSize($size) {
		$this->size = $size;
		$this->apiParas["size"] = $size;
	}

	public function getSize() {
		return $this->size;
	}

	public function setStartCredit($startCredit) {
		$this->startCredit = $startCredit;
		$this->apiParas["start_credit"] = $startCredit;
	}

	public function getStartCredit() {
		return $this->startCredit;
	}

	public function setStartDiscountRate($startDiscountRate) {
		$this->startDiscountRate = $startDiscountRate;
		$this->apiParas["start_discount_rate"] = $startDiscountRate;
	}

	public function getStartDiscountRate() {
		return $this->startDiscountRate;
	}

	public function setStartPrice($startPrice) {
		$this->startPrice = $startPrice;
		$this->apiParas["start_price"] = $startPrice;
	}

	public function getStartPrice() {
		return $this->startPrice;
	}

	public function getApiMethodName() {
		return "taobao.taobaoke.mobile.items.elite.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->fields, "fields");
		Taobao_RequestCheckUtil::checkMaxValue($this->pageSize, 40, "pageSize");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
