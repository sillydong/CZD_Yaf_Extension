<?php

/**
 * TOP API: taobao.simba.insight.wordsanalysis.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_SimbaInsightWordsanalysisGetRequest {
	/**
	 * 主人昵称
	 **/
	private $nick;

	/**
	 * 结果过滤。
	 * AREA：  返回地域占比；
	 * SOURCE：返回来源占比；
	 * HPRICE：返回竞价分布。
	 * stu只能是AREA、SOURCE或HPRICE中的一个
	 **/
	private $stu;

	/**
	 * 查询词组，最大长度200
	 **/
	private $words;

	private $apiParas = array();

	public function setNick($nick) {
		$this->nick = $nick;
		$this->apiParas["nick"] = $nick;
	}

	public function getNick() {
		return $this->nick;
	}

	public function setStu($stu) {
		$this->stu = $stu;
		$this->apiParas["stu"] = $stu;
	}

	public function getStu() {
		return $this->stu;
	}

	public function setWords($words) {
		$this->words = $words;
		$this->apiParas["words"] = $words;
	}

	public function getWords() {
		return $this->words;
	}

	public function getApiMethodName() {
		return "taobao.simba.insight.wordsanalysis.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->stu, "stu");
		Taobao_RequestCheckUtil::checkNotNull($this->words, "words");
		Taobao_RequestCheckUtil::checkMaxListSize($this->words, 200, "words");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
