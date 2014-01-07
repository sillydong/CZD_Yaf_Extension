<?php

/**
 * TOP API: taobao.wangwang.eservice.noreplynum.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_WangwangEserviceNoreplynumGetRequest {
	/**
	 * 结束日期
	 **/
	private $endDate;

	/**
	 * 客服人员id：cntaobao+淘宝nick，例如cntaobaotest
	 **/
	private $serviceStaffId;

	/**
	 * 开始日期
	 **/
	private $startDate;

	private $apiParas = array();

	public function setEndDate($endDate) {
		$this->endDate = $endDate;
		$this->apiParas["end_date"] = $endDate;
	}

	public function getEndDate() {
		return $this->endDate;
	}

	public function setServiceStaffId($serviceStaffId) {
		$this->serviceStaffId = $serviceStaffId;
		$this->apiParas["service_staff_id"] = $serviceStaffId;
	}

	public function getServiceStaffId() {
		return $this->serviceStaffId;
	}

	public function setStartDate($startDate) {
		$this->startDate = $startDate;
		$this->apiParas["start_date"] = $startDate;
	}

	public function getStartDate() {
		return $this->startDate;
	}

	public function getApiMethodName() {
		return "taobao.wangwang.eservice.noreplynum.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->endDate, "endDate");
		Taobao_RequestCheckUtil::checkNotNull($this->serviceStaffId, "serviceStaffId");
		Taobao_RequestCheckUtil::checkMaxLength($this->serviceStaffId, 1900, "serviceStaffId");
		Taobao_RequestCheckUtil::checkNotNull($this->startDate, "startDate");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
