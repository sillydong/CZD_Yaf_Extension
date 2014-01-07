<?php

/**
 * TOP API: tmall.selected.items.search request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TmallSelectedItemsSearchRequest {
	/**
	 * 后台类目ID，支持父类目或叶子类目，可以通过taobao.itemcats.get 获取到后台类目ID列表
	 **/
	private $cid;

	private $apiParas = array();

	public function setCid($cid) {
		$this->cid = $cid;
		$this->apiParas["cid"] = $cid;
	}

	public function getCid() {
		return $this->cid;
	}

	public function getApiMethodName() {
		return "tmall.selected.items.search";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->cid, "cid");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
