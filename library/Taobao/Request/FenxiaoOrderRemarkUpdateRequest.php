<?php

/**
 * TOP API: taobao.fenxiao.order.remark.update request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_FenxiaoOrderRemarkUpdateRequest {
	/**
	 * 采购单编号
	 **/
	private $purchaseOrderId;

	/**
	 * 备注旗子(供应商操作)
	 **/
	private $supplierMemo;

	/**
	 * 旗子的标记，1-5之间的数字。非1-5之间，都采用1作为默认。
	 * 1:红色
	 * 2:黄色
	 * 3:绿色
	 * 4:蓝色
	 * 5:粉红色
	 **/
	private $supplierMemoFlag;

	private $apiParas = array();

	public function setPurchaseOrderId($purchaseOrderId) {
		$this->purchaseOrderId = $purchaseOrderId;
		$this->apiParas["purchase_order_id"] = $purchaseOrderId;
	}

	public function getPurchaseOrderId() {
		return $this->purchaseOrderId;
	}

	public function setSupplierMemo($supplierMemo) {
		$this->supplierMemo = $supplierMemo;
		$this->apiParas["supplier_memo"] = $supplierMemo;
	}

	public function getSupplierMemo() {
		return $this->supplierMemo;
	}

	public function setSupplierMemoFlag($supplierMemoFlag) {
		$this->supplierMemoFlag = $supplierMemoFlag;
		$this->apiParas["supplier_memo_flag"] = $supplierMemoFlag;
	}

	public function getSupplierMemoFlag() {
		return $this->supplierMemoFlag;
	}

	public function getApiMethodName() {
		return "taobao.fenxiao.order.remark.update";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->purchaseOrderId, "purchaseOrderId");
		Taobao_RequestCheckUtil::checkNotNull($this->supplierMemo, "supplierMemo");
		Taobao_RequestCheckUtil::checkMaxValue($this->supplierMemoFlag, 5, "supplierMemoFlag");
		Taobao_RequestCheckUtil::checkMinValue($this->supplierMemoFlag, 1, "supplierMemoFlag");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
