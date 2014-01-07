<?php

/**
 * TOP API: taobao.crm.members.search request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_CrmMembersSearchRequest {
	/**
	 * 买家昵称
	 **/
	private $buyerNick;

	/**
	 * 城市
	 **/
	private $city;

	/**
	 * 显示第几页的会员，如果输入的页码大于总共的页码数，例如总共10页，但是current_page的值为11，则返回空白页，最小页数为1.最大1000页
	 **/
	private $currentPage;

	/**
	 * 会员等级，0：店铺客户，1：普通客户，2：高级会员，3：VIP会员, 4：至尊VIP会员
	 **/
	private $grade;

	/**
	 * 分组id
	 **/
	private $groupId;

	/**
	 * 最大平均客单价，单位为元
	 **/
	private $maxAvgPrice;

	/**
	 * 最大交易关闭笔数
	 **/
	private $maxCloseTradeNum;

	/**
	 * 最大交易宝贝件数
	 **/
	private $maxItemNum;

	/**
	 * 最迟上次交易时间
	 **/
	private $maxLastTradeTime;

	/**
	 * 最大交易额，单位为元
	 **/
	private $maxTradeAmount;

	/**
	 * 最大交易量
	 **/
	private $maxTradeCount;

	/**
	 * 最少平均客单价，单位为元
	 **/
	private $minAvgPrice;

	/**
	 * 最小交易关闭的笔数
	 **/
	private $minCloseTradeNum;

	/**
	 * 最小交易宝贝件数
	 **/
	private $minItemNum;

	/**
	 * 最早上次交易时间
	 **/
	private $minLastTradeTime;

	/**
	 * 最小交易额，单位为元
	 **/
	private $minTradeAmount;

	/**
	 * 最小交易量
	 **/
	private $minTradeCount;

	/**
	 * 每页显示的会员数量，page_size的最大值不能超过100，最小值不能小于1
	 **/
	private $pageSize;

	/**
	 * 北京=1,天津=2,河北省=3,山西省=4,内蒙古自治区=5,辽宁省=6,吉林省=7,黑龙江省=8,上海=9,江苏省=10,浙江省=11,安徽省=12,福建省=13,江西省=14,山东省=15,河南省=16,湖北省=17,湖南省=18, 广东省=19,广西壮族自治区=20,海南省=21,重庆=22,四川省=23,贵州省=24,云南省=25,西藏自治区26,陕西省=27,甘肃省=28,青海省=29,宁夏回族自治区=30,新疆维吾尔自治区=31,台湾省=32,香港特别行政区=33,澳门特别行政区=34,海外=35
	 **/
	private $province;

	/**
	 * 关系来源，1交易成功，2未成交，3卖家手动吸纳
	 **/
	private $relationSource;

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

	public function setCurrentPage($currentPage) {
		$this->currentPage = $currentPage;
		$this->apiParas["current_page"] = $currentPage;
	}

	public function getCurrentPage() {
		return $this->currentPage;
	}

	public function setGrade($grade) {
		$this->grade = $grade;
		$this->apiParas["grade"] = $grade;
	}

	public function getGrade() {
		return $this->grade;
	}

	public function setGroupId($groupId) {
		$this->groupId = $groupId;
		$this->apiParas["group_id"] = $groupId;
	}

	public function getGroupId() {
		return $this->groupId;
	}

	public function setMaxAvgPrice($maxAvgPrice) {
		$this->maxAvgPrice = $maxAvgPrice;
		$this->apiParas["max_avg_price"] = $maxAvgPrice;
	}

	public function getMaxAvgPrice() {
		return $this->maxAvgPrice;
	}

	public function setMaxCloseTradeNum($maxCloseTradeNum) {
		$this->maxCloseTradeNum = $maxCloseTradeNum;
		$this->apiParas["max_close_trade_num"] = $maxCloseTradeNum;
	}

	public function getMaxCloseTradeNum() {
		return $this->maxCloseTradeNum;
	}

	public function setMaxItemNum($maxItemNum) {
		$this->maxItemNum = $maxItemNum;
		$this->apiParas["max_item_num"] = $maxItemNum;
	}

	public function getMaxItemNum() {
		return $this->maxItemNum;
	}

	public function setMaxLastTradeTime($maxLastTradeTime) {
		$this->maxLastTradeTime = $maxLastTradeTime;
		$this->apiParas["max_last_trade_time"] = $maxLastTradeTime;
	}

	public function getMaxLastTradeTime() {
		return $this->maxLastTradeTime;
	}

	public function setMaxTradeAmount($maxTradeAmount) {
		$this->maxTradeAmount = $maxTradeAmount;
		$this->apiParas["max_trade_amount"] = $maxTradeAmount;
	}

	public function getMaxTradeAmount() {
		return $this->maxTradeAmount;
	}

	public function setMaxTradeCount($maxTradeCount) {
		$this->maxTradeCount = $maxTradeCount;
		$this->apiParas["max_trade_count"] = $maxTradeCount;
	}

	public function getMaxTradeCount() {
		return $this->maxTradeCount;
	}

	public function setMinAvgPrice($minAvgPrice) {
		$this->minAvgPrice = $minAvgPrice;
		$this->apiParas["min_avg_price"] = $minAvgPrice;
	}

	public function getMinAvgPrice() {
		return $this->minAvgPrice;
	}

	public function setMinCloseTradeNum($minCloseTradeNum) {
		$this->minCloseTradeNum = $minCloseTradeNum;
		$this->apiParas["min_close_trade_num"] = $minCloseTradeNum;
	}

	public function getMinCloseTradeNum() {
		return $this->minCloseTradeNum;
	}

	public function setMinItemNum($minItemNum) {
		$this->minItemNum = $minItemNum;
		$this->apiParas["min_item_num"] = $minItemNum;
	}

	public function getMinItemNum() {
		return $this->minItemNum;
	}

	public function setMinLastTradeTime($minLastTradeTime) {
		$this->minLastTradeTime = $minLastTradeTime;
		$this->apiParas["min_last_trade_time"] = $minLastTradeTime;
	}

	public function getMinLastTradeTime() {
		return $this->minLastTradeTime;
	}

	public function setMinTradeAmount($minTradeAmount) {
		$this->minTradeAmount = $minTradeAmount;
		$this->apiParas["min_trade_amount"] = $minTradeAmount;
	}

	public function getMinTradeAmount() {
		return $this->minTradeAmount;
	}

	public function setMinTradeCount($minTradeCount) {
		$this->minTradeCount = $minTradeCount;
		$this->apiParas["min_trade_count"] = $minTradeCount;
	}

	public function getMinTradeCount() {
		return $this->minTradeCount;
	}

	public function setPageSize($pageSize) {
		$this->pageSize = $pageSize;
		$this->apiParas["page_size"] = $pageSize;
	}

	public function getPageSize() {
		return $this->pageSize;
	}

	public function setProvince($province) {
		$this->province = $province;
		$this->apiParas["province"] = $province;
	}

	public function getProvince() {
		return $this->province;
	}

	public function setRelationSource($relationSource) {
		$this->relationSource = $relationSource;
		$this->apiParas["relation_source"] = $relationSource;
	}

	public function getRelationSource() {
		return $this->relationSource;
	}

	public function getApiMethodName() {
		return "taobao.crm.members.search";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkMaxLength($this->buyerNick, 32, "buyerNick");
		Taobao_RequestCheckUtil::checkNotNull($this->currentPage, "currentPage");
		Taobao_RequestCheckUtil::checkMaxValue($this->currentPage, 1000, "currentPage");
		Taobao_RequestCheckUtil::checkMinValue($this->currentPage, 1, "currentPage");
		Taobao_RequestCheckUtil::checkMaxValue($this->grade, 4, "grade");
		Taobao_RequestCheckUtil::checkMinValue($this->grade, -1, "grade");
		Taobao_RequestCheckUtil::checkMinValue($this->maxCloseTradeNum, 0, "maxCloseTradeNum");
		Taobao_RequestCheckUtil::checkMinValue($this->maxItemNum, 0, "maxItemNum");
		Taobao_RequestCheckUtil::checkMinValue($this->maxTradeCount, 0, "maxTradeCount");
		Taobao_RequestCheckUtil::checkMinValue($this->minCloseTradeNum, 0, "minCloseTradeNum");
		Taobao_RequestCheckUtil::checkMinValue($this->minItemNum, 0, "minItemNum");
		Taobao_RequestCheckUtil::checkMinValue($this->minTradeCount, 0, "minTradeCount");
		Taobao_RequestCheckUtil::checkMaxValue($this->pageSize, 100, "pageSize");
		Taobao_RequestCheckUtil::checkMinValue($this->pageSize, 1, "pageSize");
		Taobao_RequestCheckUtil::checkMaxValue($this->province, 35, "province");
		Taobao_RequestCheckUtil::checkMinValue($this->province, 1, "province");
		Taobao_RequestCheckUtil::checkMaxValue($this->relationSource, 3, "relationSource");
		Taobao_RequestCheckUtil::checkMinValue($this->relationSource, 1, "relationSource");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
