<?php

/**
 * TOP API: taobao.simba.insight.catstopword.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_SimbaInsightCatstopwordGetRequest {
	/**
	 * 类目id数组，最大长度200
	 **/
	private $categoryIds;

	/**
	 * 主人昵称
	 **/
	private $nick;

	/**
	 * 最大返回数量(1-100)
	 **/
	private $resultNum;

	private $apiParas = array();

	public function setCategoryIds($categoryIds) {
		$this->categoryIds = $categoryIds;
		$this->apiParas["category_ids"] = $categoryIds;
	}

	public function getCategoryIds() {
		return $this->categoryIds;
	}

	public function setNick($nick) {
		$this->nick = $nick;
		$this->apiParas["nick"] = $nick;
	}

	public function getNick() {
		return $this->nick;
	}

	public function setResultNum($resultNum) {
		$this->resultNum = $resultNum;
		$this->apiParas["result_num"] = $resultNum;
	}

	public function getResultNum() {
		return $this->resultNum;
	}

	public function getApiMethodName() {
		return "taobao.simba.insight.catstopword.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->categoryIds, "categoryIds");
		Taobao_RequestCheckUtil::checkMaxListSize($this->categoryIds, 200, "categoryIds");
		Taobao_RequestCheckUtil::checkNotNull($this->resultNum, "resultNum");
		Taobao_RequestCheckUtil::checkMaxValue($this->resultNum, 100, "resultNum");
		Taobao_RequestCheckUtil::checkMinValue($this->resultNum, 1, "resultNum");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
