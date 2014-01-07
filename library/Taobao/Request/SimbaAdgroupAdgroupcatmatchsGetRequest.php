<?php

/**
 * TOP API: taobao.simba.adgroup.adgroupcatmatchs.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_SimbaAdgroupAdgroupcatmatchsGetRequest {
	/**
	 * 推广组Id列表
	 **/
	private $adgroupIds;

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

	public function setNick($nick) {
		$this->nick = $nick;
		$this->apiParas["nick"] = $nick;
	}

	public function getNick() {
		return $this->nick;
	}

	public function getApiMethodName() {
		return "taobao.simba.adgroup.adgroupcatmatchs.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->adgroupIds, "adgroupIds");
		Taobao_RequestCheckUtil::checkMaxListSize($this->adgroupIds, 200, "adgroupIds");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
