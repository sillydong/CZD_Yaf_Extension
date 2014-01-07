<?php

/**
 * TOP API: taobao.simba.campaign.budget.update request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_SimbaCampaignBudgetUpdateRequest {
	/**
	 * 如果为空则取消限额；否则必须为整数，单位是元，不得小于30；
	 **/
	private $budget;

	/**
	 * 推广计划Id
	 **/
	private $campaignId;

	/**
	 * 主人昵称
	 **/
	private $nick;

	/**
	 * 是否平滑消耗：false-否，true-是
	 **/
	private $useSmooth;

	private $apiParas = array();

	public function setBudget($budget) {
		$this->budget = $budget;
		$this->apiParas["budget"] = $budget;
	}

	public function getBudget() {
		return $this->budget;
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

	public function setUseSmooth($useSmooth) {
		$this->useSmooth = $useSmooth;
		$this->apiParas["use_smooth"] = $useSmooth;
	}

	public function getUseSmooth() {
		return $this->useSmooth;
	}

	public function getApiMethodName() {
		return "taobao.simba.campaign.budget.update";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkMaxValue($this->budget, 99999, "budget");
		Taobao_RequestCheckUtil::checkMinValue($this->budget, 30, "budget");
		Taobao_RequestCheckUtil::checkNotNull($this->campaignId, "campaignId");
		Taobao_RequestCheckUtil::checkNotNull($this->useSmooth, "useSmooth");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
