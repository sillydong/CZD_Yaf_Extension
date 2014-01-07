<?php

/**
 * TOP API: taobao.sellercenter.roles.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_SellercenterRolesGetRequest {
	/**
	 * 卖家昵称(只允许查询自己的信息：当前登陆者)
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
		return "taobao.sellercenter.roles.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->nick, "nick");
		Taobao_RequestCheckUtil::checkMaxLength($this->nick, 500, "nick");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
