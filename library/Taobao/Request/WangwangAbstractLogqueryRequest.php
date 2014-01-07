<?php

/**
 * TOP API: taobao.wangwang.abstract.logquery request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_WangwangAbstractLogqueryRequest {
	/**
	 * 传入参数的字符集
	 **/
	private $charset;

	/**
	 * 获取记录条数，默认值是1000
	 **/
	private $count;

	/**
	 * 东八区时间
	 **/
	private $endDate;

	/**
	 * 卖家id，有cntaobao前缀
	 **/
	private $fromId;

	/**
	 * 设置了这个值，那么聊天记录就从这个点开始查询
	 **/
	private $nextKey;

	/**
	 * 东八区时间
	 **/
	private $startDate;

	/**
	 * 买家id，有cntaobao前缀
	 **/
	private $toId;

	private $apiParas = array();

	public function setCharset($charset) {
		$this->charset = $charset;
		$this->apiParas["charset"] = $charset;
	}

	public function getCharset() {
		return $this->charset;
	}

	public function setCount($count) {
		$this->count = $count;
		$this->apiParas["count"] = $count;
	}

	public function getCount() {
		return $this->count;
	}

	public function setEndDate($endDate) {
		$this->endDate = $endDate;
		$this->apiParas["end_date"] = $endDate;
	}

	public function getEndDate() {
		return $this->endDate;
	}

	public function setFromId($fromId) {
		$this->fromId = $fromId;
		$this->apiParas["from_id"] = $fromId;
	}

	public function getFromId() {
		return $this->fromId;
	}

	public function setNextKey($nextKey) {
		$this->nextKey = $nextKey;
		$this->apiParas["next_key"] = $nextKey;
	}

	public function getNextKey() {
		return $this->nextKey;
	}

	public function setStartDate($startDate) {
		$this->startDate = $startDate;
		$this->apiParas["start_date"] = $startDate;
	}

	public function getStartDate() {
		return $this->startDate;
	}

	public function setToId($toId) {
		$this->toId = $toId;
		$this->apiParas["to_id"] = $toId;
	}

	public function getToId() {
		return $this->toId;
	}

	public function getApiMethodName() {
		return "taobao.wangwang.abstract.logquery";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkMinValue($this->count, 1, "count");
		Taobao_RequestCheckUtil::checkNotNull($this->endDate, "endDate");
		Taobao_RequestCheckUtil::checkNotNull($this->fromId, "fromId");
		Taobao_RequestCheckUtil::checkNotNull($this->startDate, "startDate");
		Taobao_RequestCheckUtil::checkNotNull($this->toId, "toId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
