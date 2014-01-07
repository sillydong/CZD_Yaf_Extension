<?php

/**
 * TOP API: taobao.simba.adgroup.catmatchforecast.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_SimbaAdgroupCatmatchforecastGetRequest {
	/**
	 * 推广组ID
	 **/
	private $adgroupId;

	/**
	 * 类目出价,出价范围在5-9999之间,单位分
	 **/
	private $catmatchPrice;

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

	public function setCatmatchPrice($catmatchPrice) {
		$this->catmatchPrice = $catmatchPrice;
		$this->apiParas["catmatch_price"] = $catmatchPrice;
	}

	public function getCatmatchPrice() {
		return $this->catmatchPrice;
	}

	public function setNick($nick) {
		$this->nick = $nick;
		$this->apiParas["nick"] = $nick;
	}

	public function getNick() {
		return $this->nick;
	}

	public function getApiMethodName() {
		return "taobao.simba.adgroup.catmatchforecast.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->adgroupId, "adgroupId");
		Taobao_RequestCheckUtil::checkNotNull($this->catmatchPrice, "catmatchPrice");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
