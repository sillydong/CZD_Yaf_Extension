<?php

/**
 * TOP API: taobao.fenxiao.cooperation.terminate request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_FenxiaoCooperationTerminateRequest {
	/**
	 * 合作编号
	 **/
	private $cooperateId;

	/**
	 * 终止天数，可选1,2,3,5,7,15，在多少天数内终止
	 **/
	private $endRemainDays;

	/**
	 * 终止说明（5-2000字）
	 **/
	private $endRemark;

	private $apiParas = array();

	public function setCooperateId($cooperateId) {
		$this->cooperateId = $cooperateId;
		$this->apiParas["cooperate_id"] = $cooperateId;
	}

	public function getCooperateId() {
		return $this->cooperateId;
	}

	public function setEndRemainDays($endRemainDays) {
		$this->endRemainDays = $endRemainDays;
		$this->apiParas["end_remain_days"] = $endRemainDays;
	}

	public function getEndRemainDays() {
		return $this->endRemainDays;
	}

	public function setEndRemark($endRemark) {
		$this->endRemark = $endRemark;
		$this->apiParas["end_remark"] = $endRemark;
	}

	public function getEndRemark() {
		return $this->endRemark;
	}

	public function getApiMethodName() {
		return "taobao.fenxiao.cooperation.terminate";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->cooperateId, "cooperateId");
		Taobao_RequestCheckUtil::checkNotNull($this->endRemainDays, "endRemainDays");
		Taobao_RequestCheckUtil::checkNotNull($this->endRemark, "endRemark");
		Taobao_RequestCheckUtil::checkMaxLength($this->endRemark, 2000, "endRemark");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
