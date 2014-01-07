<?php

/**
 * TOP API: taobao.promotionmisc.activity.range.add request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_PromotionmiscActivityRangeAddRequest {
	/**
	 * 活动id。
	 **/
	private $activityId;

	/**
	 * 商品id,多个id用逗号隔开，一次不超过50个。
	 **/
	private $ids;

	private $apiParas = array();

	public function setActivityId($activityId) {
		$this->activityId = $activityId;
		$this->apiParas["activity_id"] = $activityId;
	}

	public function getActivityId() {
		return $this->activityId;
	}

	public function setIds($ids) {
		$this->ids = $ids;
		$this->apiParas["ids"] = $ids;
	}

	public function getIds() {
		return $this->ids;
	}

	public function getApiMethodName() {
		return "taobao.promotionmisc.activity.range.add";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->activityId, "activityId");
		Taobao_RequestCheckUtil::checkMinValue($this->activityId, 0, "activityId");
		Taobao_RequestCheckUtil::checkNotNull($this->ids, "ids");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
