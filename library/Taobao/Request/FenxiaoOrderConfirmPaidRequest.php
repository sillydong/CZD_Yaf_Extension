<?php

/**
 * TOP API: taobao.fenxiao.order.confirm.paid request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_FenxiaoOrderConfirmPaidRequest {
	/**
	 * 确认支付信息（字数小于100）
	 **/
	private $confirmRemark;

	/**
	 * 采购单编号。
	 **/
	private $purchaseOrderId;

	private $apiParas = array();

	public function setConfirmRemark($confirmRemark) {
		$this->confirmRemark = $confirmRemark;
		$this->apiParas["confirm_remark"] = $confirmRemark;
	}

	public function getConfirmRemark() {
		return $this->confirmRemark;
	}

	public function setPurchaseOrderId($purchaseOrderId) {
		$this->purchaseOrderId = $purchaseOrderId;
		$this->apiParas["purchase_order_id"] = $purchaseOrderId;
	}

	public function getPurchaseOrderId() {
		return $this->purchaseOrderId;
	}

	public function getApiMethodName() {
		return "taobao.fenxiao.order.confirm.paid";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->purchaseOrderId, "purchaseOrderId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
