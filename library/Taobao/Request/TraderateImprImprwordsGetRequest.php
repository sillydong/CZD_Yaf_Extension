<?php

/**
 * TOP API: taobao.traderate.impr.imprwords.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TraderateImprImprwordsGetRequest {
	/**
	 * 淘宝叶子类目id
	 **/
	private $catLeafId;

	/**
	 * 淘宝一级类目id
	 **/
	private $catRootId;

	private $apiParas = array();

	public function setCatLeafId($catLeafId) {
		$this->catLeafId = $catLeafId;
		$this->apiParas["cat_leaf_id"] = $catLeafId;
	}

	public function getCatLeafId() {
		return $this->catLeafId;
	}

	public function setCatRootId($catRootId) {
		$this->catRootId = $catRootId;
		$this->apiParas["cat_root_id"] = $catRootId;
	}

	public function getCatRootId() {
		return $this->catRootId;
	}

	public function getApiMethodName() {
		return "taobao.traderate.impr.imprwords.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->catRootId, "catRootId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
