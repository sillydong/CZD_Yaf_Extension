<?php

/**
 * TOP API: taobao.trip.jipiao.agent.order.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TripJipiaoAgentOrderGetRequest {
	/**
	 * 淘宝政策id列表，当前支持列表长度为1，即当前只支持单个订单详情查询
	 **/
	private $orderIds;

	private $apiParas = array();

	public function setOrderIds($orderIds) {
		$this->orderIds = $orderIds;
		$this->apiParas["order_ids"] = $orderIds;
	}

	public function getOrderIds() {
		return $this->orderIds;
	}

	public function getApiMethodName() {
		return "taobao.trip.jipiao.agent.order.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->orderIds, "orderIds");
		Taobao_RequestCheckUtil::checkMaxListSize($this->orderIds, 1, "orderIds");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
