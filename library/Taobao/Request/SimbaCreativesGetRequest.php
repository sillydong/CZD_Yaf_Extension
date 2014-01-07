<?php

/**
 * TOP API: taobao.simba.creatives.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_SimbaCreativesGetRequest {
	/**
	 * 推广组Id
	 **/
	private $adgroupId;

	/**
	 * 创意Id数组，最多200个
	 **/
	private $creativeIds;

	/**
	 * 主人昵称
	 **/
	private $nick;

	private $apiParas = array();

	public function setAdgroupId($adgroupId) {
		$this->adgroupId = $adgroupId;
		$this->apiParas["adgroup_id"] = $adgroupId;
	}

	public function getAdgroupId() {
		return $this->adgroupId;
	}

	public function setCreativeIds($creativeIds) {
		$this->creativeIds = $creativeIds;
		$this->apiParas["creative_ids"] = $creativeIds;
	}

	public function getCreativeIds() {
		return $this->creativeIds;
	}

	public function setNick($nick) {
		$this->nick = $nick;
		$this->apiParas["nick"] = $nick;
	}

	public function getNick() {
		return $this->nick;
	}

	public function getApiMethodName() {
		return "taobao.simba.creatives.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkMaxListSize($this->creativeIds, 200, "creativeIds");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
