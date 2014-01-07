<?php

/**
 * TOP API: taobao.crm.memberinfo.update request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_CrmMemberinfoUpdateRequest {
	/**
	 * 买家昵称
	 **/
	private $buyerNick;

	/**
	 * 城市
	 **/
	private $city;

	/**
	 * 交易关闭金额，单位：分
	 **/
	private $closeTradeAmount;

	/**
	 * 交易关闭次数
	 **/
	private $closeTradeCount;

	/**
	 * 会员等级，1：普通客户，2：高级会员，3：高级会员 ，4：至尊vip
	 *
	 * 只有正常会员才给予升级，对于status 为delete或者blacklist的会员 升级无效
	 **/
	private $grade;

	/**
	 * 分组的id集合字符串
	 **/
	private $groupIds;

	/**
	 * 宝贝件数
	 **/
	private $itemNum;

	/**
	 * 北京=1,天津=2,河北省=3,山西省=4,内蒙古自治区=5,辽宁省=6,吉林省=7,黑龙江省=8,上海=9,江苏省=10,浙江省=11,安徽省=12,福建省=13,江西省=14,山东省=15,河南省=16,湖北省=17,湖南省=18, 广东省=19,广西壮族自治区=20,海南省=21,重庆=22,四川省=23,贵州省=24,云南省=25,西藏自治区=26,陕西省=27,甘肃省=28,青海省=29,宁夏回族自治区=30,新疆维吾尔自治区=31,台湾省=32,香港特别行政区=33,澳门特别行政区=34,海外=35，约定36为清除Province设置
	 **/
	private $province;

	/**
	 * 用于描述会员的状态，normal表示正常，blacklist表示黑名单，delete表示删除会员(只有潜在未交易成功的会员才能删除)
	 **/
	private $status;

	/**
	 * 交易金额，单位：分
	 **/
	private $tradeAmount;

	/**
	 * 交易笔数
	 **/
	private $tradeCount;

	private $apiParas = array();

	public function setBuyerNick($buyerNick) {
		$this->buyerNick = $buyerNick;
		$this->apiParas["buyer_nick"] = $buyerNick;
	}

	public function getBuyerNick() {
		return $this->buyerNick;
	}

	public function setCity($city) {
		$this->city = $city;
		$this->apiParas["city"] = $city;
	}

	public function getCity() {
		return $this->city;
	}

	public function setCloseTradeAmount($closeTradeAmount) {
		$this->closeTradeAmount = $closeTradeAmount;
		$this->apiParas["close_trade_amount"] = $closeTradeAmount;
	}

	public function getCloseTradeAmount() {
		return $this->closeTradeAmount;
	}

	public function setCloseTradeCount($closeTradeCount) {
		$this->closeTradeCount = $closeTradeCount;
		$this->apiParas["close_trade_count"] = $closeTradeCount;
	}

	public function getCloseTradeCount() {
		return $this->closeTradeCount;
	}

	public function setGrade($grade) {
		$this->grade = $grade;
		$this->apiParas["grade"] = $grade;
	}

	public function getGrade() {
		return $this->grade;
	}

	public function setGroupIds($groupIds) {
		$this->groupIds = $groupIds;
		$this->apiParas["group_ids"] = $groupIds;
	}

	public function getGroupIds() {
		return $this->groupIds;
	}

	public function setItemNum($itemNum) {
		$this->itemNum = $itemNum;
		$this->apiParas["item_num"] = $itemNum;
	}

	public function getItemNum() {
		return $this->itemNum;
	}

	public function setProvince($province) {
		$this->province = $province;
		$this->apiParas["province"] = $province;
	}

	public function getProvince() {
		return $this->province;
	}

	public function setStatus($status) {
		$this->status = $status;
		$this->apiParas["status"] = $status;
	}

	public function getStatus() {
		return $this->status;
	}

	public function setTradeAmount($tradeAmount) {
		$this->tradeAmount = $tradeAmount;
		$this->apiParas["trade_amount"] = $tradeAmount;
	}

	public function getTradeAmount() {
		return $this->tradeAmount;
	}

	public function setTradeCount($tradeCount) {
		$this->tradeCount = $tradeCount;
		$this->apiParas["trade_count"] = $tradeCount;
	}

	public function getTradeCount() {
		return $this->tradeCount;
	}

	public function getApiMethodName() {
		return "taobao.crm.memberinfo.update";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->buyerNick, "buyerNick");
		Taobao_RequestCheckUtil::checkMaxLength($this->buyerNick, 32, "buyerNick");
		Taobao_RequestCheckUtil::checkMaxValue($this->grade, 4, "grade");
		Taobao_RequestCheckUtil::checkMinValue($this->grade, 1, "grade");
		Taobao_RequestCheckUtil::checkNotNull($this->status, "status");
		Taobao_RequestCheckUtil::checkMaxLength($this->status, 32, "status");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
