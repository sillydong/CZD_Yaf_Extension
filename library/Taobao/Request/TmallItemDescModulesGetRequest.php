<?php

/**
 * TOP API: tmall.item.desc.modules.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TmallItemDescModulesGetRequest {
	/**
	 * 叶子类目id
	 **/
	private $catId;

	/**
	 * 商家主帐号id
	 **/
	private $usrId;

	private $apiParas = array();

	public function setCatId($catId) {
		$this->catId = $catId;
		$this->apiParas["cat_id"] = $catId;
	}

	public function getCatId() {
		return $this->catId;
	}

	public function setUsrId($usrId) {
		$this->usrId = $usrId;
		$this->apiParas["usr_id"] = $usrId;
	}

	public function getUsrId() {
		return $this->usrId;
	}

	public function getApiMethodName() {
		return "tmall.item.desc.modules.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->catId, "catId");
		Taobao_RequestCheckUtil::checkNotNull($this->usrId, "usrId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
