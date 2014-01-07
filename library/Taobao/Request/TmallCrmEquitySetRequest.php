<?php

/**
 * TOP API: tmall.crm.equity.set request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TmallCrmEquitySetRequest {
	/**
	 * 不免邮区域，只在包邮条件设置的时候生效。要和等级一一对应。包邮条件为false的时候不起作用。
	 **/
	private $excludeArea;

	/**
	 * 会员等级，用逗号分隔。买家会员级别0：店铺客户 1：普通会员 2 ：高级会员 3：VIP会员 4：至尊VIP
	 **/
	private $grade;

	/**
	 * 返几倍天猫积分，可以不设置。如果设置则要和等级一一对应。不设置代表清空。
	 **/
	private $point;

	/**
	 * 是否包邮，可以不设置，如果设置则要和等级一一对应。不设置代表清空
	 **/
	private $postage;

	private $apiParas = array();

	public function setExcludeArea($excludeArea) {
		$this->excludeArea = $excludeArea;
		$this->apiParas["exclude_area"] = $excludeArea;
	}

	public function getExcludeArea() {
		return $this->excludeArea;
	}

	public function setGrade($grade) {
		$this->grade = $grade;
		$this->apiParas["grade"] = $grade;
	}

	public function getGrade() {
		return $this->grade;
	}

	public function setPoint($point) {
		$this->point = $point;
		$this->apiParas["point"] = $point;
	}

	public function getPoint() {
		return $this->point;
	}

	public function setPostage($postage) {
		$this->postage = $postage;
		$this->apiParas["postage"] = $postage;
	}

	public function getPostage() {
		return $this->postage;
	}

	public function getApiMethodName() {
		return "tmall.crm.equity.set";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkMaxListSize($this->excludeArea, 4, "excludeArea");
		Taobao_RequestCheckUtil::checkNotNull($this->grade, "grade");
		Taobao_RequestCheckUtil::checkMaxListSize($this->grade, 4, "grade");
		Taobao_RequestCheckUtil::checkMaxListSize($this->point, 4, "point");
		Taobao_RequestCheckUtil::checkMaxListSize($this->postage, 4, "postage");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
