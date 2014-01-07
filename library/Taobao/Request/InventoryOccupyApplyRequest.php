<?php

/**
 * TOP API: taobao.inventory.occupy.apply request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_InventoryOccupyApplyRequest {
	/**
	 * 外部订单类型, BALANCE:盘点、NON_TAOBAO_TRADE:非淘宝交易、ALLOCATE:调拨、OTHERS:其他
	 **/
	private $bizType;

	/**
	 * 商家外部定单号
	 **/
	private $bizUniqueCode;

	/**
	 * 渠道编号
	 **/
	private $channelFlags;

	/**
	 * 商品库存预留信息： [{"scItemId":"商品后端ID，如果有传scItemCode,参数可以为0","scItemCode":"商品商家编码","inventoryType":"库存类型  1：正常,2：损坏,3：冻结,10：质押",11-20:商家自定义,”inventoryTypeName”:”库存类型名称,可选”,"occupyQuantity":"数量"}]
	 **/
	private $items;

	/**
	 * 天数，默认5天，最大15天
	 **/
	private $occupyTime;

	/**
	 * 占用类型
	 * 参数定义
	 * AUTO_CALCULATE:自动计算可供占用，如果库存不够返回失败 ClIENT_FORCE：强制要求最大化占用，有多少占用多少
	 **/
	private $occupyType;

	/**
	 * 商家仓库编码
	 **/
	private $storeCode;

	private $apiParas = array();

	public function setBizType($bizType) {
		$this->bizType = $bizType;
		$this->apiParas["biz_type"] = $bizType;
	}

	public function getBizType() {
		return $this->bizType;
	}

	public function setBizUniqueCode($bizUniqueCode) {
		$this->bizUniqueCode = $bizUniqueCode;
		$this->apiParas["biz_unique_code"] = $bizUniqueCode;
	}

	public function getBizUniqueCode() {
		return $this->bizUniqueCode;
	}

	public function setChannelFlags($channelFlags) {
		$this->channelFlags = $channelFlags;
		$this->apiParas["channel_flags"] = $channelFlags;
	}

	public function getChannelFlags() {
		return $this->channelFlags;
	}

	public function setItems($items) {
		$this->items = $items;
		$this->apiParas["items"] = $items;
	}

	public function getItems() {
		return $this->items;
	}

	public function setOccupyTime($occupyTime) {
		$this->occupyTime = $occupyTime;
		$this->apiParas["occupy_time"] = $occupyTime;
	}

	public function getOccupyTime() {
		return $this->occupyTime;
	}

	public function setOccupyType($occupyType) {
		$this->occupyType = $occupyType;
		$this->apiParas["occupy_type"] = $occupyType;
	}

	public function getOccupyType() {
		return $this->occupyType;
	}

	public function setStoreCode($storeCode) {
		$this->storeCode = $storeCode;
		$this->apiParas["store_code"] = $storeCode;
	}

	public function getStoreCode() {
		return $this->storeCode;
	}

	public function getApiMethodName() {
		return "taobao.inventory.occupy.apply";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->bizType, "bizType");
		Taobao_RequestCheckUtil::checkNotNull($this->bizUniqueCode, "bizUniqueCode");
		Taobao_RequestCheckUtil::checkNotNull($this->items, "items");
		Taobao_RequestCheckUtil::checkNotNull($this->occupyTime, "occupyTime");
		Taobao_RequestCheckUtil::checkNotNull($this->occupyType, "occupyType");
		Taobao_RequestCheckUtil::checkNotNull($this->storeCode, "storeCode");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
