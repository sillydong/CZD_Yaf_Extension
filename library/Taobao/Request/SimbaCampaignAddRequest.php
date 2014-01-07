<?php

/**
 * TOP API: taobao.simba.campaign.add request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_SimbaCampaignAddRequest {
	/**
	 * 主人昵称
	 **/
	private $nick;

	/**
	 * 推广计划名称，不能多余20个汉字，不能和客户其他推广计划同名。
	 **/
	private $title;

	private $apiParas = array();

	public function setNick($nick) {
		$this->nick = $nick;
		$this->apiParas["nick"] = $nick;
	}

	public function getNick() {
		return $this->nick;
	}

	public function setTitle($title) {
		$this->title = $title;
		$this->apiParas["title"] = $title;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getApiMethodName() {
		return "taobao.simba.campaign.add";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->title, "title");
		Taobao_RequestCheckUtil::checkMaxLength($this->title, 20, "title");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
