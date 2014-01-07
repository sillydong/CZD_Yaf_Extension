<?php

/**
 * TOP API: taobao.simba.nonsearch.adgroupplaces.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_SimbaNonsearchAdgroupplacesGetRequest {
	/**
	 * 推广组ID数组
	 **/
	private $adgroupIds;

	/**
	 * 推广计划ID
	 **/
	private $campaignId;

	/**
	 * 主人昵称
	 **/
	private $nick;

	private $apiParas = array();

	public function setAdgroupIds($adgroupIds) {
		$this->adgroupIds = $adgroupIds;
		$this->apiParas["adgroup_ids"] = $adgroupIds;
	}

	public function getAdgroupIds() {
		return $this->adgroupIds;
	}

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

	public function getApiMethodName() {
		return "taobao.simba.nonsearch.adgroupplaces.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->adgroupIds, "adgroupIds");
		Taobao_RequestCheckUtil::checkMaxListSize($this->adgroupIds, 200, "adgroupIds");
		Taobao_RequestCheckUtil::checkNotNull($this->campaignId, "campaignId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
