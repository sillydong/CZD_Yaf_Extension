<?php

/**
 * TOP API: taobao.promotionmisc.mjs.activity.list.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_PromotionmiscMjsActivityListGetRequest {
	/**
	 * 活动类型： 1表示商品级别的活动；2表示店铺级别的活动。
	 **/
	private $activityType;

	/**
	 * 页码。
	 **/
	private $pageNo;

	/**
	 * 每页记录数，最大支持50 。
	 **/
	private $pageSize;

	private $apiParas = array();

	public function setActivityType($activityType) {
		$this->activityType = $activityType;
		$this->apiParas["activity_type"] = $activityType;
	}

	public function getActivityType() {
		return $this->activityType;
	}

	public function setPageNo($pageNo) {
		$this->pageNo = $pageNo;
		$this->apiParas["page_no"] = $pageNo;
	}

	public function getPageNo() {
		return $this->pageNo;
	}

	public function setPageSize($pageSize) {
		$this->pageSize = $pageSize;
		$this->apiParas["page_size"] = $pageSize;
	}

	public function getPageSize() {
		return $this->pageSize;
	}

	public function getApiMethodName() {
		return "taobao.promotionmisc.mjs.activity.list.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->activityType, "activityType");
		Taobao_RequestCheckUtil::checkMaxValue($this->activityType, 2, "activityType");
		Taobao_RequestCheckUtil::checkMinValue($this->activityType, 1, "activityType");
		Taobao_RequestCheckUtil::checkNotNull($this->pageNo, "pageNo");
		Taobao_RequestCheckUtil::checkMinValue($this->pageNo, 1, "pageNo");
		Taobao_RequestCheckUtil::checkNotNull($this->pageSize, "pageSize");
		Taobao_RequestCheckUtil::checkMinValue($this->pageSize, 1, "pageSize");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
