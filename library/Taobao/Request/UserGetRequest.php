<?php

/**
 * TOP API: taobao.user.get request
 *
 * @author auto create
 * @since  1.0, 2010-08-12 20:48:15.0
 */
class Taobao_Request_UserGetRequest {

	/**
	 * 需返回的字段列表。可选值：User结构体中的所有字段；以半角逗号(,)分隔。不支持：location.address,real_name,id_card,phone,mobile,email
	 **/
	private $fields;

	/**
	 * 用户昵称，如果昵称为中文，请使用UTF-8字符集对昵称进行URL编码。
	 **/
	private $nick;

	private $apiParas = array();

	public function getApiParas() {
		return $this->apiParas;
	}

	public function setFields($fields) {
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields() {
		return $this->fields;
	}

	public function setNick($nick) {
		$this->nick = $nick;
		$this->apiParas["nick"] = $nick;
	}

	public function getNick() {
		return $this->nick;
	}

	public function getApiMethodName() {
		return "taobao.user.get";
	}

	public function check() {
		Taobao_RequestCheckUtil::checkNotNull($this->fields, "fields");
		//Taobao_RequestCheckUtil::checkMinValue($this->nick , 12 , "nick");
	}
}
