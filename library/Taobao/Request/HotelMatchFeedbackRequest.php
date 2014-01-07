<?php

/**
 * TOP API: taobao.hotel.match.feedback request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HotelMatchFeedbackRequest {
	/**
	 * 需进行匹配的酒店id
	 **/
	private $haid;

	/**
	 * 匹配命中的酒店id
	 **/
	private $hid;

	/**
	 * 匹配结果 0:未匹配，1:匹配
	 **/
	private $matchResult;

	private $apiParas = array();

	public function setHaid($haid) {
		$this->haid = $haid;
		$this->apiParas["haid"] = $haid;
	}

	public function getHaid() {
		return $this->haid;
	}

	public function setHid($hid) {
		$this->hid = $hid;
		$this->apiParas["hid"] = $hid;
	}

	public function getHid() {
		return $this->hid;
	}

	public function setMatchResult($matchResult) {
		$this->matchResult = $matchResult;
		$this->apiParas["match_result"] = $matchResult;
	}

	public function getMatchResult() {
		return $this->matchResult;
	}

	public function getApiMethodName() {
		return "taobao.hotel.match.feedback";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->haid, "haid");
		Taobao_RequestCheckUtil::checkMinValue($this->haid, 1, "haid");
		Taobao_RequestCheckUtil::checkMinValue($this->hid, 0, "hid");
		Taobao_RequestCheckUtil::checkNotNull($this->matchResult, "matchResult");
		Taobao_RequestCheckUtil::checkMaxValue($this->matchResult, 1, "matchResult");
		Taobao_RequestCheckUtil::checkMinValue($this->matchResult, 0, "matchResult");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
