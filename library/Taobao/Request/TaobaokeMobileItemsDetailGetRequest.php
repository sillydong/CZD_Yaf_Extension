<?php

/**
 * TOP API: taobao.taobaoke.mobile.items.detail.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TaobaokeMobileItemsDetailGetRequest {
	/**
	 * 需返回的字段列表.可选值:TaobaokeItemDetail淘宝客商品结构体中的所有字段;字段之间用","分隔。item_detail需要设置到Item模型下的字段,如设置:num_iid,detail_url等; 只设置item_detail,则不返回的Item下的所有信息.注：item结构中的skus、videos、props_name不返回
	 **/
	private $fields;

	/**
	 * 淘宝客商品数字id串.最大输入10个.格式如:"value1,value2,value3" 用" , "号分隔商品id.
	 **/
	private $numIids;

	/**
	 * 自定义输入串.格式:英文和数字组成;长度不能大于12个字符,区分不同的推广渠道,如:bbs,表示bbs为推广渠道;blog,表示blog为推广渠道.
	 **/
	private $outerCode;

	/**
	 * 点击串跳转类型，1：单品，2：单品中间页（无线暂无）
	 **/
	private $referType;

	/**
	 * 商品track_iid串（带有追踪效果的商品id),最大输入10个,与num_iids必填其一
	 **/
	private $trackIids;

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

	public function setReferType($referType) {
		$this->referType = $referType;
		$this->apiParas["refer_type"] = $referType;
	}

	public function getReferType() {
		return $this->referType;
	}

	public function setTrackIids($trackIids) {
		$this->trackIids = $trackIids;
		$this->apiParas["track_iids"] = $trackIids;
	}

	public function getTrackIids() {
		return $this->trackIids;
	}

	public function getApiMethodName() {
		return "taobao.taobaoke.mobile.items.detail.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->fields, "fields");
		Taobao_RequestCheckUtil::checkMaxListSize($this->numIids, 10, "numIids");
		Taobao_RequestCheckUtil::checkMaxLength($this->outerCode, 12, "outerCode");
		Taobao_RequestCheckUtil::checkMaxListSize($this->trackIids, 10, "trackIids");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
