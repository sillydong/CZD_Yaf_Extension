<?php

/**
 * TOP API: taobao.simba.keyword.keywordforecast.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_SimbaKeywordKeywordforecastGetRequest {
	/**
	 * 词的出价,范围在5-9999之间,单位分
	 **/
	private $bidwordPrice;

	/**
	 * 词ID
	 **/
	private $keywordId;

	/**
	 * 经典名表行
	 **/
	private $nick;

	private $apiParas = array();

	public function setBidwordPrice($bidwordPrice) {
		$this->bidwordPrice = $bidwordPrice;
		$this->apiParas["bidword_price"] = $bidwordPrice;
	}

	public function getBidwordPrice() {
		return $this->bidwordPrice;
	}

	public function setKeywordId($keywordId) {
		$this->keywordId = $keywordId;
		$this->apiParas["keyword_id"] = $keywordId;
	}

	public function getKeywordId() {
		return $this->keywordId;
	}

	public function setNick($nick) {
		$this->nick = $nick;
		$this->apiParas["nick"] = $nick;
	}

	public function getNick() {
		return $this->nick;
	}

	public function getApiMethodName() {
		return "taobao.simba.keyword.keywordforecast.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->bidwordPrice, "bidwordPrice");
		Taobao_RequestCheckUtil::checkNotNull($this->keywordId, "keywordId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
