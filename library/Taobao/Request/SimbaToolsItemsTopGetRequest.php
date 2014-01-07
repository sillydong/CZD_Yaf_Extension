<?php

/**
 * TOP API: taobao.simba.tools.items.top.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_SimbaToolsItemsTopGetRequest {
	/**
	 * 输入的必须是一个符合ipv4或者ipv6格式的IP地址
	 **/
	private $ip;

	/**
	 * 关键词
	 **/
	private $keyword;

	/**
	 * 主人昵称
	 **/
	private $nick;

	private $apiParas = array();

	public function setIp($ip) {
		$this->ip = $ip;
		$this->apiParas["ip"] = $ip;
	}

	public function getIp() {
		return $this->ip;
	}

	public function setKeyword($keyword) {
		$this->keyword = $keyword;
		$this->apiParas["keyword"] = $keyword;
	}

	public function getKeyword() {
		return $this->keyword;
	}

	public function setNick($nick) {
		$this->nick = $nick;
		$this->apiParas["nick"] = $nick;
	}

	public function getNick() {
		return $this->nick;
	}

	public function getApiMethodName() {
		return "taobao.simba.tools.items.top.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->ip, "ip");
		Taobao_RequestCheckUtil::checkNotNull($this->keyword, "keyword");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
