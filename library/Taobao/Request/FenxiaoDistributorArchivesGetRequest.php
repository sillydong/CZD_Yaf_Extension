<?php

/**
 * TOP API: taobao.fenxiao.distributor.archives.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_FenxiaoDistributorArchivesGetRequest {
	/**
	 * 分销商淘宝店主nick
	 **/
	private $distributorUserNick;

	private $apiParas = array();

	public function setDistributorUserNick($distributorUserNick) {
		$this->distributorUserNick = $distributorUserNick;
		$this->apiParas["distributor_user_nick"] = $distributorUserNick;
	}

	public function getDistributorUserNick() {
		return $this->distributorUserNick;
	}

	public function getApiMethodName() {
		return "taobao.fenxiao.distributor.archives.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->distributorUserNick, "distributorUserNick");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
