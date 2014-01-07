<?php

/**
 * TOP API: taobao.ump.activities.list.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_UmpActivitiesListGetRequest {
	/**
	 * 营销活动id列表。
	 **/
	private $ids;

	private $apiParas = array();

	public function setIds($ids) {
		$this->ids = $ids;
		$this->apiParas["ids"] = $ids;
	}

	public function getIds() {
		return $this->ids;
	}

	public function getApiMethodName() {
		return "taobao.ump.activities.list.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->ids, "ids");
		Taobao_RequestCheckUtil::checkMaxListSize($this->ids, 40, "ids");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
