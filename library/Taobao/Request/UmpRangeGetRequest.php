<?php

/**
 * TOP API: taobao.ump.range.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_UmpRangeGetRequest {
	/**
	 * 活动id
	 **/
	private $actId;

	private $apiParas = array();

	public function setActId($actId) {
		$this->actId = $actId;
		$this->apiParas["act_id"] = $actId;
	}

	public function getActId() {
		return $this->actId;
	}

	public function getApiMethodName() {
		return "taobao.ump.range.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->actId, "actId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
