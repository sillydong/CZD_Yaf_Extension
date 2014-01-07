<?php

/**
 * TOP API: tmall.product.spec.add request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TmallProductSpecAddRequest {
	/**
	 * 产品二维码
	 **/
	private $barcode;

	/**
	 * 存放产品规格认证类型-认证图片url映射信息，格式为k:v;k:v;，其中key为认证类型数字id，value为调用tmall.product.spec.pic.upload返回的认证图片url文本
	 **/
	private $certifiedPicStr;

	/**
	 * 存放产品规格认证类型-认证文本映射信息，格式为k:v;k:v;，其中key为认证类型数字id，value为认证文本值
	 **/
	private $certifiedTxtStr;

	/**
	 * 产品基础色，数据格式为：pid:vid:rvid1,rvid2,rvid3;pid:vid:rvid1
	 **/
	private $changeProp;

	/**
	 * 用户自定义销售属性，结构：pid1:value1;pid2:value2。在
	 **/
	private $customerSpecProps;

	/**
	 * 产品图片
	 **/
	private $image;

	/**
	 * 产品规格吊牌价，以分为单位，无默认值，上限999999999
	 **/
	private $labelPrice;

	/**
	 * 产品上市时间
	 **/
	private $marketTime;

	/**
	 * 产品货号
	 **/
	private $productCode;

	/**
	 * 产品ID
	 **/
	private $productId;

	/**
	 * 产品的规格属性
	 **/
	private $specProps;

	/**
	 * 规格属性别名,只允许传颜色别名
	 **/
	private $specPropsAlias;

	private $apiParas = array();

	public function setBarcode($barcode) {
		$this->barcode = $barcode;
		$this->apiParas["barcode"] = $barcode;
	}

	public function getBarcode() {
		return $this->barcode;
	}

	public function setCertifiedPicStr($certifiedPicStr) {
		$this->certifiedPicStr = $certifiedPicStr;
		$this->apiParas["certified_pic_str"] = $certifiedPicStr;
	}

	public function getCertifiedPicStr() {
		return $this->certifiedPicStr;
	}

	public function setCertifiedTxtStr($certifiedTxtStr) {
		$this->certifiedTxtStr = $certifiedTxtStr;
		$this->apiParas["certified_txt_str"] = $certifiedTxtStr;
	}

	public function getCertifiedTxtStr() {
		return $this->certifiedTxtStr;
	}

	public function setChangeProp($changeProp) {
		$this->changeProp = $changeProp;
		$this->apiParas["change_prop"] = $changeProp;
	}

	public function getChangeProp() {
		return $this->changeProp;
	}

	public function setCustomerSpecProps($customerSpecProps) {
		$this->customerSpecProps = $customerSpecProps;
		$this->apiParas["customer_spec_props"] = $customerSpecProps;
	}

	public function getCustomerSpecProps() {
		return $this->customerSpecProps;
	}

	public function setImage($image) {
		$this->image = $image;
		$this->apiParas["image"] = $image;
	}

	public function getImage() {
		return $this->image;
	}

	public function setLabelPrice($labelPrice) {
		$this->labelPrice = $labelPrice;
		$this->apiParas["label_price"] = $labelPrice;
	}

	public function getLabelPrice() {
		return $this->labelPrice;
	}

	public function setMarketTime($marketTime) {
		$this->marketTime = $marketTime;
		$this->apiParas["market_time"] = $marketTime;
	}

	public function getMarketTime() {
		return $this->marketTime;
	}

	public function setProductCode($productCode) {
		$this->productCode = $productCode;
		$this->apiParas["product_code"] = $productCode;
	}

	public function getProductCode() {
		return $this->productCode;
	}

	public function setProductId($productId) {
		$this->productId = $productId;
		$this->apiParas["product_id"] = $productId;
	}

	public function getProductId() {
		return $this->productId;
	}

	public function setSpecProps($specProps) {
		$this->specProps = $specProps;
		$this->apiParas["spec_props"] = $specProps;
	}

	public function getSpecProps() {
		return $this->specProps;
	}

	public function setSpecPropsAlias($specPropsAlias) {
		$this->specPropsAlias = $specPropsAlias;
		$this->apiParas["spec_props_alias"] = $specPropsAlias;
	}

	public function getSpecPropsAlias() {
		return $this->specPropsAlias;
	}

	public function getApiMethodName() {
		return "tmall.product.spec.add";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->image, "image");
		Taobao_RequestCheckUtil::checkMaxValue($this->labelPrice, 999999999, "labelPrice");
		Taobao_RequestCheckUtil::checkMinValue($this->labelPrice, 0, "labelPrice");
		Taobao_RequestCheckUtil::checkNotNull($this->productId, "productId");
		Taobao_RequestCheckUtil::checkMaxLength($this->specPropsAlias, 60, "specPropsAlias");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
