<?php

/**
 * TOP API: taobao.sellercenter.subusers.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_SellercenterSubusersGetRequest {
	/**
	 * 表示卖家昵称
	 **/
	private $nick;

	private $apiParas = array();

	public function setNick($nick) {
		$this->nick = $nick;
		$this->apiParas["nick"] = $nick;
	}

	public function getNick() {
		return $this->nick;
	}

	public function getApiMethodName() {
		return "taobao.sellercenter.subusers.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->nick, "nick");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
