<?php

/**
 * TOP API: taobao.taobaoke.mobile.items.convert request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TaobaokeMobileItemsConvertRequest {
	/**
	 * 需返回的字段列表.可选值:num_iid,title,nick,pic_url,price,click_url,commission,commission_rate,commission_num,commission_volume,shop_click_url,seller_credit_score,item_location,volume
	 * ;字段之间用","分隔.
	 **/
	private $fields;

	/**
	 * 淘宝客商品数字id串.最大输入40个.格式如:"value1,value2,value3" 用" , "号分隔商品数字id
	 **/
	private $numIids;

	/**
	 * 自定义输入串.格式:英文和数字组成;长度不能大于12个字符,区分不同的推广渠道,如:bbs,表示bbs为推广渠道;blog,表示blog为推广渠道.
	 **/
	private $outerCode;

	private $apiParas = array();

	public function setFields($fields) {
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields() {
		return $this->fields;
	}

	public function setNumIids($numIids) {
		$this->numIids = $numIids;
		$this->apiParas["num_iids"] = $numIids;
	}

	public function getNumIids() {
		return $this->numIids;
	}

	public function setOuterCode($outerCode) {
		$this->outerCode = $outerCode;
		$this->apiParas["outer_code"] = $outerCode;
	}

	public function getOuterCode() {
		return $this->outerCode;
	}

	public function getApiMethodName() {
		return "taobao.taobaoke.mobile.items.convert";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->fields, "fields");
		Taobao_RequestCheckUtil::checkNotNull($this->numIids, "numIids");
		Taobao_RequestCheckUtil::checkMaxListSize($this->numIids, 40, "numIids");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
