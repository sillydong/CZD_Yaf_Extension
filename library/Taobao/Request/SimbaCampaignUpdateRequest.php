<?php

/**
 * TOP API: taobao.simba.campaign.update request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_SimbaCampaignUpdateRequest {
	/**
	 * 推广计划Id
	 **/
	private $campaignId;

	/**
	 * 主人昵称
	 **/
	private $nick;

	/**
	 * 用户设置的上下限状态；offline-下线；online-上线；
	 **/
	private $onlineStatus;

	/**
	 * 推广计划名称，不能多余20个字符，不能和客户其他推广计划同名。
	 **/
	private $title;

	private $apiParas = array();

	public function setCampaignId($campaignId) {
		$this->campaignId = $campaignId;
		$this->apiParas["campaign_id"] = $campaignId;
	}

	public function getCampaignId() {
		return $this->campaignId;
	}

	public function setNick($nick) {
		$this->nick = $nick;
		$this->apiParas["nick"] = $nick;
	}

	public function getNick() {
		return $this->nick;
	}

	public function setOnlineStatus($onlineStatus) {
		$this->onlineStatus = $onlineStatus;
		$this->apiParas["online_status"] = $onlineStatus;
	}

	public function getOnlineStatus() {
		return $this->onlineStatus;
	}

	public function setTitle($title) {
		$this->title = $title;
		$this->apiParas["title"] = $title;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getApiMethodName() {
		return "taobao.simba.campaign.update";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->campaignId, "campaignId");
		Taobao_RequestCheckUtil::checkNotNull($this->onlineStatus, "onlineStatus");
		Taobao_RequestCheckUtil::checkNotNull($this->title, "title");
		Taobao_RequestCheckUtil::checkMaxLength($this->title, 20, "title");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
