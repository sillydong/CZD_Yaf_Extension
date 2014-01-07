<?php

/**
 * TOP API: taobao.product.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_ProductGetRequest {
	/**
	 * 商品类目id.调用taobao.itemcats.get获取;必须是叶子类目id,如果没有传product_id,那么cid和props必须要传.
	 **/
	private $cid;

	/**
	 * 用户自定义关键属性,结构：pid1:value1;pid2:value2，如果有型号，系列等子属性用: 隔开 例如：“20000:优衣库:型号:001;632501:1234”，表示“品牌:优衣库:型号:001;货号:1234”
	 **/
	private $customerProps;

	/**
	 * 需返回的字段列表.可选值:Product数据结构中的所有字段;多个字段之间用","分隔.
	 **/
	private $fields;

	/**
	 * 市场ID，1为取C2C市场的产品信息， 2为取B2C市场的产品信息。
	 * 不填写此值则默认取C2C的产品信息。
	 **/
	private $marketId;

	/**
	 * Product的id.两种方式来查看一个产品:1.传入product_id来查询 2.传入cid和props来查询
	 **/
	private $productId;

	/**
	 * 比如:诺基亚N73这个产品的关键属性列表就是:品牌:诺基亚;型号:N73,对应的PV值就是10005:10027;10006:29729.
	 **/
	private $props;

	private $apiParas = array();

	public function setCid($cid) {
		$this->cid = $cid;
		$this->apiParas["cid"] = $cid;
	}

	public function getCid() {
		return $this->cid;
	}

	public function setCustomerProps($customerProps) {
		$this->customerProps = $customerProps;
		$this->apiParas["customer_props"] = $customerProps;
	}

	public function getCustomerProps() {
		return $this->customerProps;
	}

	public function setFields($fields) {
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields() {
		return $this->fields;
	}

	public function setMarketId($marketId) {
		$this->marketId = $marketId;
		$this->apiParas["market_id"] = $marketId;
	}

	public function getMarketId() {
		return $this->marketId;
	}

	public function setProductId($productId) {
		$this->productId = $productId;
		$this->apiParas["product_id"] = $productId;
	}

	public function getProductId() {
		return $this->productId;
	}

	public function setProps($props) {
		$this->props = $props;
		$this->apiParas["props"] = $props;
	}

	public function getProps() {
		return $this->props;
	}

	public function getApiMethodName() {
		return "taobao.product.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->fields, "fields");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
