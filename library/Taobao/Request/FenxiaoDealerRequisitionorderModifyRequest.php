<?php

/**
 * TOP API: taobao.fenxiao.dealer.requisitionorder.modify request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_FenxiaoDealerRequisitionorderModifyRequest {
	/**
	 * 经销采购单编号
	 **/
	private $dealerOrderId;

	/**
	 * 要删除的商品明细id列表，多个id使用英文符号的逗号隔开
	 **/
	private $deleteDetailIds;

	/**
	 * 经销采购单的商品明细的新的采购价格。格式为商品明细id:价格修改值,商品明细id:价格修改值
	 **/
	private $detailIdPrices;

	/**
	 * 修改经销采购单的商品明细的新的库存。格式为商品明细id:库存修改值,商品明细id:库存修改值
	 **/
	private $detailIdQuantities;

	/**
	 * 新邮费（单位：分，示例值1005表示10.05元）。必须大于等于0。自提方式不可修改邮费。不提交该参数表示不修改邮费。
	 **/
	private $newPostFee;

	private $apiParas = array();

	public function setDealerOrderId($dealerOrderId) {
		$this->dealerOrderId = $dealerOrderId;
		$this->apiParas["dealer_order_id"] = $dealerOrderId;
	}

	public function getDealerOrderId() {
		return $this->dealerOrderId;
	}

	public function setDeleteDetailIds($deleteDetailIds) {
		$this->deleteDetailIds = $deleteDetailIds;
		$this->apiParas["delete_detail_ids"] = $deleteDetailIds;
	}

	public function getDeleteDetailIds() {
		return $this->deleteDetailIds;
	}

	public function setDetailIdPrices($detailIdPrices) {
		$this->detailIdPrices = $detailIdPrices;
		$this->apiParas["detail_id_prices"] = $detailIdPrices;
	}

	public function getDetailIdPrices() {
		return $this->detailIdPrices;
	}

	public function setDetailIdQuantities($detailIdQuantities) {
		$this->detailIdQuantities = $detailIdQuantities;
		$this->apiParas["detail_id_quantities"] = $detailIdQuantities;
	}

	public function getDetailIdQuantities() {
		return $this->detailIdQuantities;
	}

	public function setNewPostFee($newPostFee) {
		$this->newPostFee = $newPostFee;
		$this->apiParas["new_post_fee"] = $newPostFee;
	}

	public function getNewPostFee() {
		return $this->newPostFee;
	}

	public function getApiMethodName() {
		return "taobao.fenxiao.dealer.requisitionorder.modify";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->dealerOrderId, "dealerOrderId");
		Taobao_RequestCheckUtil::checkMaxListSize($this->deleteDetailIds, 50, "deleteDetailIds");
		Taobao_RequestCheckUtil::checkMaxListSize($this->detailIdPrices, 50, "detailIdPrices");
		Taobao_RequestCheckUtil::checkMaxListSize($this->detailIdQuantities, 50, "detailIdQuantities");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
