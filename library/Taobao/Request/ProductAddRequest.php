<?php

/**
 * TOP API: taobao.product.add request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_ProductAddRequest {
	/**
	 * 非关键属性结构:pid:vid;pid:vid.<br>
	 * 非关键属性<font color=red>不包含</font>关键属性、销售属性、用户自定义属性、商品属性;
	 * <br>调用taobao.itemprops.get获取pid,调用taobao.itempropvalues.get获取vid.<br><font color=red>注:支持最大长度为512字节</font>
	 **/
	private $binds;

	/**
	 * 商品类目ID.调用taobao.itemcats.get获取;注意:必须是叶子类目 id.
	 **/
	private $cid;

	/**
	 * 用户自定义属性,结构：pid1:value1;pid2:value2，如果有型号，系列等子属性用: 隔开 例如：“20000:优衣库:型号:001;632501:1234”，表示“品牌:优衣库:型号:001;货号:1234”
	 * <br><font color=red>注：包含所有自定义属性的传入</font>
	 **/
	private $customerProps;

	/**
	 * 产品描述.最大25000个字节
	 **/
	private $desc;

	/**
	 * 存放产品扩展信息，由List(ProductExtraInfo)转化成jsonArray存入.
	 **/
	private $extraInfo;

	/**
	 * 产品主图片.最大1M,目前仅支持GIF,JPG.
	 **/
	private $image;

	/**
	 * 是不是主图
	 **/
	private $major;

	/**
	 * 市场ID，1为新增C2C市场的产品信息， 2为新增B2C市场的产品信息。
	 * 不填写此值则C用户新增B2C市场的产品信息，B用户新增B2C市场的产品信息。
	 **/
	private $marketId;

	/**
	 * 上市时间。目前只支持鞋城类目传入此参数
	 **/
	private $marketTime;

	/**
	 * 产品名称,最大60个字节.
	 **/
	private $name;

	/**
	 * 外部产品ID
	 **/
	private $outerId;

	/**
	 * 包装清单。注意，在管控类目下，包装清单不能为空，同时保证清单的格式为：
	 * 名称:数字;名称:数字;
	 * 其中，名称不能违禁、不能超过60字符，数字不能超过999
	 **/
	private $packingList;

	/**
	 * 产品市场价.精确到2位小数;单位为元.如：200.07
	 **/
	private $price;

	/**
	 * 销售属性值别名。格式为pid1:vid1:alias1;pid1:vid2:alia2。只有少数销售属性值支持传入别名，比如颜色和尺寸
	 **/
	private $propertyAlias;

	/**
	 * 关键属性 结构:pid:vid;pid:vid.调用taobao.itemprops.get获取pid,调用taobao.itempropvalues.get获取vid;如果碰到用户自定义属性,请用customer_props.
	 **/
	private $props;

	/**
	 * 销售属性结构:pid:vid;pid:vid.调用taobao.itemprops.get获取is_sale_prop＝true的pid,调用taobao.itempropvalues.get获取vid.
	 **/
	private $saleProps;

	/**
	 * 商品卖点描述，长度限制为20个汉字
	 **/
	private $sellPt;

	private $apiParas = array();

	public function setBinds($binds) {
		$this->binds = $binds;
		$this->apiParas["binds"] = $binds;
	}

	public function getBinds() {
		return $this->binds;
	}

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

	public function setDesc($desc) {
		$this->desc = $desc;
		$this->apiParas["desc"] = $desc;
	}

	public function getDesc() {
		return $this->desc;
	}

	public function setExtraInfo($extraInfo) {
		$this->extraInfo = $extraInfo;
		$this->apiParas["extra_info"] = $extraInfo;
	}

	public function getExtraInfo() {
		return $this->extraInfo;
	}

	public function setImage($image) {
		$this->image = $image;
		$this->apiParas["image"] = $image;
	}

	public function getImage() {
		return $this->image;
	}

	public function setMajor($major) {
		$this->major = $major;
		$this->apiParas["major"] = $major;
	}

	public function getMajor() {
		return $this->major;
	}

	public function setMarketId($marketId) {
		$this->marketId = $marketId;
		$this->apiParas["market_id"] = $marketId;
	}

	public function getMarketId() {
		return $this->marketId;
	}

	public function setMarketTime($marketTime) {
		$this->marketTime = $marketTime;
		$this->apiParas["market_time"] = $marketTime;
	}

	public function getMarketTime() {
		return $this->marketTime;
	}

	public function setName($name) {
		$this->name = $name;
		$this->apiParas["name"] = $name;
	}

	public function getName() {
		return $this->name;
	}

	public function setOuterId($outerId) {
		$this->outerId = $outerId;
		$this->apiParas["outer_id"] = $outerId;
	}

	public function getOuterId() {
		return $this->outerId;
	}

	public function setPackingList($packingList) {
		$this->packingList = $packingList;
		$this->apiParas["packing_list"] = $packingList;
	}

	public function getPackingList() {
		return $this->packingList;
	}

	public function setPrice($price) {
		$this->price = $price;
		$this->apiParas["price"] = $price;
	}

	public function getPrice() {
		return $this->price;
	}

	public function setPropertyAlias($propertyAlias) {
		$this->propertyAlias = $propertyAlias;
		$this->apiParas["property_alias"] = $propertyAlias;
	}

	public function getPropertyAlias() {
		return $this->propertyAlias;
	}

	public function setProps($props) {
		$this->props = $props;
		$this->apiParas["props"] = $props;
	}

	public function getProps() {
		return $this->props;
	}

	public function setSaleProps($saleProps) {
		$this->saleProps = $saleProps;
		$this->apiParas["sale_props"] = $saleProps;
	}

	public function getSaleProps() {
		return $this->saleProps;
	}

	public function setSellPt($sellPt) {
		$this->sellPt = $sellPt;
		$this->apiParas["sell_pt"] = $sellPt;
	}

	public function getSellPt() {
		return $this->sellPt;
	}

	public function getApiMethodName() {
		return "taobao.product.add";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkMaxLength($this->binds, 512, "binds");
		Taobao_RequestCheckUtil::checkNotNull($this->cid, "cid");
		Taobao_RequestCheckUtil::checkMaxLength($this->extraInfo, 25000, "extraInfo");
		Taobao_RequestCheckUtil::checkNotNull($this->image, "image");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
