<?php

/**
 * TOP API: taobao.taobaoke.rebate.auth.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TaobaokeRebateAuthGetRequest {
	/**
	 * nick或seller_id或num_iid，最大输入40个.格式如:"value1,value2,value3" 用","号分隔
	 **/
	private $params;

	/**
	 * 类型：1-按nick查询，2-按seller_id查询，3-按num_iid查询
	 **/
	private $type;

	private $apiParas = array();

	public function setParams($params) {
		$this->params = $params;
		$this->apiParas["params"] = $params;
	}

	public function getParams() {
		return $this->params;
	}

	public function setType($type) {
		$this->type = $type;
		$this->apiParas["type"] = $type;
	}

	public function getType() {
		return $this->type;
	}

	public function getApiMethodName() {
		return "taobao.taobaoke.rebate.auth.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->params, "params");
		Taobao_RequestCheckUtil::checkMaxListSize($this->params, 40, "params");
		Taobao_RequestCheckUtil::checkNotNull($this->type, "type");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
