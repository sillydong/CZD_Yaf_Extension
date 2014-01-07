<?php

/**
 * TOP API: taobao.simba.keywordsbykeywordids.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_SimbaKeywordsbykeywordidsGetRequest {
	/**
	 * 关键词Id数组，最多200个；
	 **/
	private $keywordIds;

	/**
	 * 主人昵称
	 **/
	private $nick;

	private $apiParas = array();

	public function setKeywordIds($keywordIds) {
		$this->keywordIds = $keywordIds;
		$this->apiParas["keyword_ids"] = $keywordIds;
	}

	public function getKeywordIds() {
		return $this->keywordIds;
	}

	public function setNick($nick) {
		$this->nick = $nick;
		$this->apiParas["nick"] = $nick;
	}

	public function getNick() {
		return $this->nick;
	}

	public function getApiMethodName() {
		return "taobao.simba.keywordsbykeywordids.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkMaxListSize($this->keywordIds, 200, "keywordIds");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
