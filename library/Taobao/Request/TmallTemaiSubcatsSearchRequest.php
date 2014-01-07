<?php

/**
 * TOP API: tmall.temai.subcats.search request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TmallTemaiSubcatsSearchRequest {
	/**
	 * 父类目ID，固定是特卖前台一级类目id：50100982
	 **/
	private $cat;

	private $apiParas = array();

	public function setCat($cat) {
		$this->cat = $cat;
		$this->apiParas["cat"] = $cat;
	}

	public function getCat() {
		return $this->cat;
	}

	public function getApiMethodName() {
		return "tmall.temai.subcats.search";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->cat, "cat");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
