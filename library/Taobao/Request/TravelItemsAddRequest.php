<?php

/**
 * TOP API: taobao.travel.items.add request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TravelItemsAddRequest {
	/**
	 * 商品上传后的状态。可选值:onsale(出售中),instock(仓库中);默认值:onsale。
	 **/
	private $approveStatus;

	/**
	 * 商品的积分返点比例。如:5,表示:返点比例0.5%. 注意：返点比例必须是>0的整数.B商家在发布非虚拟商品时，这个字段必须设置，返点必须是 5的倍数，即0.5%的倍数。注意该字段值最高值不超过500，即50%。
	 **/
	private $auctionPoint;

	/**
	 * 发布电子凭证宝贝时候表示是否使用邮寄 0: 代表不使用邮寄； 1：代表使用邮寄；如果不设置这个值，代表不使用邮寄。
	 **/
	private $chooseLogis;

	/**
	 * 商品所属叶子类目ID。
	 **/
	private $cid;

	/**
	 * 宝贝所在地市。
	 **/
	private $city;

	/**
	 * Json串：{"combos":[{"combo_name":"套餐一","price_calendar":[{"child_num":100,"child_price":100,"date":"2012-06-08","diff_price":1000,"man_num":100,"man_price":1000},{"child_num":100,"child_price":100,"date":"2012-06-09","diff_price":1000,"man_num":100,"man_price":1000}]}]}
	 **/
	private $comboPriceCalendar;

	/**
	 * 商品描述，不超过50000个字符。
	 **/
	private $desc;

	/**
	 * 最晚成团提前天数，最小0天，最大为300天。
	 **/
	private $duration;

	/**
	 * 电子交易凭证有效期，目前此字段只涉及到的信息为有效期; 如果有效期为起止日期类型，此值为2012-08-06,2012-08-16 如果有效期为【购买成功日 至】类型则格式为2012-08-16 如果有效期为天数类型则格式为15。
	 **/
	private $expirydate;

	/**
	 * 费用包含，不超过1500个字符。
	 **/
	private $feeInclude;

	/**
	 * 费用不包，不超过1500个字符。
	 **/
	private $feeNotInclude;

	/**
	 * 机票信息，不超过1500字符
	 **/
	private $flightInfo;

	/**
	 * 集合地，不超过30个字符。
	 **/
	private $gatheringPlace;

	/**
	 * 支持会员打折。可选值:true,false;默认值:false(不打折)。
	 **/
	private $hasDiscount;

	/**
	 * 是否有发票。可选值:true,false (商城卖家此字段必须为true);默认值:false(无发票)。
	 **/
	private $hasInvoice;

	/**
	 * 橱窗推荐。可选值:true,false;默认值:false(不推荐)，B商家不用设置该字段，均为true。
	 **/
	private $hasShowcase;

	/**
	 * 酒店信息，不超过1500字符
	 **/
	private $hotelInfo;

	/**
	 * 商品主图。类型:JPG,GIF;最大长度:500k，支持的文件类型：gif,jpg,jpeg,png。
	 **/
	private $image;

	/**
	 * 用户自行输入的类目属性ID串。结构："pid1,pid2,pid3"，如："2000"（表示品牌） 注：通常一个类目下用户可输入的关键属性不超过1个。在度假线路类目中，该属性ID为“自由行包含元素”或“一日游包含元素”属性ID。
	 **/
	private $inputPids;

	/**
	 * 用户自行输入的子属性名和属性值，如“自定义自由行包含元素”。
	 **/
	private $inputStr;

	/**
	 * 是否为铁定出游商品的参数设置为true，那么该商品为铁定出游商品；设置为false，那么该商品为非铁定出游商品。默认为false
	 **/
	private $isTdcy;

	/**
	 * 定时上架时间。(时间格式：yyyy-MM-dd HH:mm:ss)
	 **/
	private $listTime;

	/**
	 * 码商信息，格式为 码商id:nick。
	 **/
	private $merchant;

	/**
	 * 网点ID。
	 **/
	private $networkId;

	/**
	 * 商品库存。如果发布旅游度假线路宝贝，该字段可以忽略。
	 **/
	private $num;

	/**
	 * 电子凭证售中自动退款比例，百分比%前的数字，介于1-100之间的整数。(暂未使用)
	 **/
	private $onsaleAutoRefundRatio;

	/**
	 * 预定须知，不超过1500个字符。
	 **/
	private $orderInfo;

	/**
	 * 商家的外部编码，最大为512字节。
	 **/
	private $outerId;

	/**
	 * 自费项目，不超过1500个字符。
	 **/
	private $ownExpense;

	/**
	 * 商品主图需要关联的图片空间的相对url。这个url所对应的图片必须要属于当前用户。pic_path和image只需要传入一个,如果两个都传，默认选择pic_path。
	 **/
	private $picPath;

	/**
	 * 商品一口价。如果发布旅游度假线路的宝贝，该字段可以忽略。
	 **/
	private $price;

	/**
	 * 商品属性列表。格式为：pid:vid;pid:vid。例如发布度假线路商品，那么这里就需要填写：出发地属性id:城市id;目的地市属性id:目的地市id;……等等。
	 **/
	private $props;

	/**
	 * 宝贝所在地省份。
	 **/
	private $prov;

	/**
	 * 退款比例，百分比%前的数字,1-100的正整数值。
	 **/
	private $refundRatio;

	/**
	 * 退改规定，不超过1500个字符。
	 **/
	private $refundRegulation;

	/**
	 * 商品秒杀三个值：可选类型web_only(只能通过web网络秒杀)，wap_only(只能通过wap网络秒杀)，web_and_wap(既能通过web秒杀也能通过wap秒杀)。
	 **/
	private $secondKill;

	/**
	 * 关联商品与店铺类目，结构:",cid1,cid2,...,"，如果店铺类目存在二级类目，必须传入子类目cids。
	 **/
	private $sellerCids;

	/**
	 * 购物店信息，不超过1500个字符。
	 **/
	private $shopingInfo;

	/**
	 * sku销售属性串对应的价格，精确到分，每一个属性串都会对应一个价格，单位为分。sku_prices的数组大小应该和sku_properties的数组大小一致。如果发布线路的商品，该字段可以忽略。
	 **/
	private $skuPrices;

	/**
	 * Sku销售属性串，调用taobao.travel.itemsprops.get接口获取商品销售属性code，然后拼接成pid:vid;pid:vid格式。如果发布线路的商品，该字段可以忽略。
	 **/
	private $skuProperties;

	/**
	 * Sku销售属性串对应的库存，每一个属性串都会对应一个库存，显然sku_quantities的数组大小应该和sku_properties的数组大小一致。如果发布线路的商品，该字段可以忽略。
	 **/
	private $skuQuantities;

	/**
	 * 商品是否支持拍下减库存:1支持;2取消支持(付款减库存);0(默认)不更改，集市卖家默认拍下减库存;商城卖家默认付款减库存。
	 **/
	private $subStock;

	/**
	 * 门票信息，不超过1500字符
	 **/
	private $ticketInfo;

	/**
	 * 商品标题。
	 **/
	private $title;

	/**
	 * 核销打款 1代表核销打款 0代表非核销打款。
	 **/
	private $verification;

	private $apiParas = array();

	public function setApproveStatus($approveStatus) {
		$this->approveStatus = $approveStatus;
		$this->apiParas["approve_status"] = $approveStatus;
	}

	public function getApproveStatus() {
		return $this->approveStatus;
	}

	public function setAuctionPoint($auctionPoint) {
		$this->auctionPoint = $auctionPoint;
		$this->apiParas["auction_point"] = $auctionPoint;
	}

	public function getAuctionPoint() {
		return $this->auctionPoint;
	}

	public function setChooseLogis($chooseLogis) {
		$this->chooseLogis = $chooseLogis;
		$this->apiParas["choose_logis"] = $chooseLogis;
	}

	public function getChooseLogis() {
		return $this->chooseLogis;
	}

	public function setCid($cid) {
		$this->cid = $cid;
		$this->apiParas["cid"] = $cid;
	}

	public function getCid() {
		return $this->cid;
	}

	public function setCity($city) {
		$this->city = $city;
		$this->apiParas["city"] = $city;
	}

	public function getCity() {
		return $this->city;
	}

	public function setComboPriceCalendar($comboPriceCalendar) {
		$this->comboPriceCalendar = $comboPriceCalendar;
		$this->apiParas["combo_price_calendar"] = $comboPriceCalendar;
	}

	public function getComboPriceCalendar() {
		return $this->comboPriceCalendar;
	}

	public function setDesc($desc) {
		$this->desc = $desc;
		$this->apiParas["desc"] = $desc;
	}

	public function getDesc() {
		return $this->desc;
	}

	public function setDuration($duration) {
		$this->duration = $duration;
		$this->apiParas["duration"] = $duration;
	}

	public function getDuration() {
		return $this->duration;
	}

	public function setExpirydate($expirydate) {
		$this->expirydate = $expirydate;
		$this->apiParas["expirydate"] = $expirydate;
	}

	public function getExpirydate() {
		return $this->expirydate;
	}

	public function setFeeInclude($feeInclude) {
		$this->feeInclude = $feeInclude;
		$this->apiParas["fee_include"] = $feeInclude;
	}

	public function getFeeInclude() {
		return $this->feeInclude;
	}

	public function setFeeNotInclude($feeNotInclude) {
		$this->feeNotInclude = $feeNotInclude;
		$this->apiParas["fee_not_include"] = $feeNotInclude;
	}

	public function getFeeNotInclude() {
		return $this->feeNotInclude;
	}

	public function setFlightInfo($flightInfo) {
		$this->flightInfo = $flightInfo;
		$this->apiParas["flight_info"] = $flightInfo;
	}

	public function getFlightInfo() {
		return $this->flightInfo;
	}

	public function setGatheringPlace($gatheringPlace) {
		$this->gatheringPlace = $gatheringPlace;
		$this->apiParas["gathering_place"] = $gatheringPlace;
	}

	public function getGatheringPlace() {
		return $this->gatheringPlace;
	}

	public function setHasDiscount($hasDiscount) {
		$this->hasDiscount = $hasDiscount;
		$this->apiParas["has_discount"] = $hasDiscount;
	}

	public function getHasDiscount() {
		return $this->hasDiscount;
	}

	public function setHasInvoice($hasInvoice) {
		$this->hasInvoice = $hasInvoice;
		$this->apiParas["has_invoice"] = $hasInvoice;
	}

	public function getHasInvoice() {
		return $this->hasInvoice;
	}

	public function setHasShowcase($hasShowcase) {
		$this->hasShowcase = $hasShowcase;
		$this->apiParas["has_showcase"] = $hasShowcase;
	}

	public function getHasShowcase() {
		return $this->hasShowcase;
	}

	public function setHotelInfo($hotelInfo) {
		$this->hotelInfo = $hotelInfo;
		$this->apiParas["hotel_info"] = $hotelInfo;
	}

	public function getHotelInfo() {
		return $this->hotelInfo;
	}

	public function setImage($image) {
		$this->image = $image;
		$this->apiParas["image"] = $image;
	}

	public function getImage() {
		return $this->image;
	}

	public function setInputPids($inputPids) {
		$this->inputPids = $inputPids;
		$this->apiParas["input_pids"] = $inputPids;
	}

	public function getInputPids() {
		return $this->inputPids;
	}

	public function setInputStr($inputStr) {
		$this->inputStr = $inputStr;
		$this->apiParas["input_str"] = $inputStr;
	}

	public function getInputStr() {
		return $this->inputStr;
	}

	public function setIsTdcy($isTdcy) {
		$this->isTdcy = $isTdcy;
		$this->apiParas["is_tdcy"] = $isTdcy;
	}

	public function getIsTdcy() {
		return $this->isTdcy;
	}

	public function setListTime($listTime) {
		$this->listTime = $listTime;
		$this->apiParas["list_time"] = $listTime;
	}

	public function getListTime() {
		return $this->listTime;
	}

	public function setMerchant($merchant) {
		$this->merchant = $merchant;
		$this->apiParas["merchant"] = $merchant;
	}

	public function getMerchant() {
		return $this->merchant;
	}

	public function setNetworkId($networkId) {
		$this->networkId = $networkId;
		$this->apiParas["network_id"] = $networkId;
	}

	public function getNetworkId() {
		return $this->networkId;
	}

	public function setNum($num) {
		$this->num = $num;
		$this->apiParas["num"] = $num;
	}

	public function getNum() {
		return $this->num;
	}

	public function setOnsaleAutoRefundRatio($onsaleAutoRefundRatio) {
		$this->onsaleAutoRefundRatio = $onsaleAutoRefundRatio;
		$this->apiParas["onsale_auto_refund_ratio"] = $onsaleAutoRefundRatio;
	}

	public function getOnsaleAutoRefundRatio() {
		return $this->onsaleAutoRefundRatio;
	}

	public function setOrderInfo($orderInfo) {
		$this->orderInfo = $orderInfo;
		$this->apiParas["order_info"] = $orderInfo;
	}

	public function getOrderInfo() {
		return $this->orderInfo;
	}

	public function setOuterId($outerId) {
		$this->outerId = $outerId;
		$this->apiParas["outer_id"] = $outerId;
	}

	public function getOuterId() {
		return $this->outerId;
	}

	public function setOwnExpense($ownExpense) {
		$this->ownExpense = $ownExpense;
		$this->apiParas["own_expense"] = $ownExpense;
	}

	public function getOwnExpense() {
		return $this->ownExpense;
	}

	public function setPicPath($picPath) {
		$this->picPath = $picPath;
		$this->apiParas["pic_path"] = $picPath;
	}

	public function getPicPath() {
		return $this->picPath;
	}

	public function setPrice($price) {
		$this->price = $price;
		$this->apiParas["price"] = $price;
	}

	public function getPrice() {
		return $this->price;
	}

	public function setProps($props) {
		$this->props = $props;
		$this->apiParas["props"] = $props;
	}

	public function getProps() {
		return $this->props;
	}

	public function setProv($prov) {
		$this->prov = $prov;
		$this->apiParas["prov"] = $prov;
	}

	public function getProv() {
		return $this->prov;
	}

	public function setRefundRatio($refundRatio) {
		$this->refundRatio = $refundRatio;
		$this->apiParas["refund_ratio"] = $refundRatio;
	}

	public function getRefundRatio() {
		return $this->refundRatio;
	}

	public function setRefundRegulation($refundRegulation) {
		$this->refundRegulation = $refundRegulation;
		$this->apiParas["refund_regulation"] = $refundRegulation;
	}

	public function getRefundRegulation() {
		return $this->refundRegulation;
	}

	public function setSecondKill($secondKill) {
		$this->secondKill = $secondKill;
		$this->apiParas["second_kill"] = $secondKill;
	}

	public function getSecondKill() {
		return $this->secondKill;
	}

	public function setSellerCids($sellerCids) {
		$this->sellerCids = $sellerCids;
		$this->apiParas["seller_cids"] = $sellerCids;
	}

	public function getSellerCids() {
		return $this->sellerCids;
	}

	public function setShopingInfo($shopingInfo) {
		$this->shopingInfo = $shopingInfo;
		$this->apiParas["shoping_info"] = $shopingInfo;
	}

	public function getShopingInfo() {
		return $this->shopingInfo;
	}

	public function setSkuPrices($skuPrices) {
		$this->skuPrices = $skuPrices;
		$this->apiParas["sku_prices"] = $skuPrices;
	}

	public function getSkuPrices() {
		return $this->skuPrices;
	}

	public function setSkuProperties($skuProperties) {
		$this->skuProperties = $skuProperties;
		$this->apiParas["sku_properties"] = $skuProperties;
	}

	public function getSkuProperties() {
		return $this->skuProperties;
	}

	public function setSkuQuantities($skuQuantities) {
		$this->skuQuantities = $skuQuantities;
		$this->apiParas["sku_quantities"] = $skuQuantities;
	}

	public function getSkuQuantities() {
		return $this->skuQuantities;
	}

	public function setSubStock($subStock) {
		$this->subStock = $subStock;
		$this->apiParas["sub_stock"] = $subStock;
	}

	public function getSubStock() {
		return $this->subStock;
	}

	public function setTicketInfo($ticketInfo) {
		$this->ticketInfo = $ticketInfo;
		$this->apiParas["ticket_info"] = $ticketInfo;
	}

	public function getTicketInfo() {
		return $this->ticketInfo;
	}

	public function setTitle($title) {
		$this->title = $title;
		$this->apiParas["title"] = $title;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setVerification($verification) {
		$this->verification = $verification;
		$this->apiParas["verification"] = $verification;
	}

	public function getVerification() {
		return $this->verification;
	}

	public function getApiMethodName() {
		return "taobao.travel.items.add";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->cid, "cid");
		Taobao_RequestCheckUtil::checkNotNull($this->city, "city");
		Taobao_RequestCheckUtil::checkNotNull($this->comboPriceCalendar, "comboPriceCalendar");
		Taobao_RequestCheckUtil::checkNotNull($this->desc, "desc");
		Taobao_RequestCheckUtil::checkNotNull($this->duration, "duration");
		Taobao_RequestCheckUtil::checkNotNull($this->props, "props");
		Taobao_RequestCheckUtil::checkNotNull($this->prov, "prov");
		Taobao_RequestCheckUtil::checkNotNull($this->refundRegulation, "refundRegulation");
		Taobao_RequestCheckUtil::checkMaxListSize($this->sellerCids, 20, "sellerCids");
		Taobao_RequestCheckUtil::checkMaxLength($this->sellerCids, 256, "sellerCids");
		Taobao_RequestCheckUtil::checkMaxListSize($this->skuPrices, 380, "skuPrices");
		Taobao_RequestCheckUtil::checkMaxListSize($this->skuProperties, 380, "skuProperties");
		Taobao_RequestCheckUtil::checkMaxListSize($this->skuQuantities, 380, "skuQuantities");
		Taobao_RequestCheckUtil::checkNotNull($this->title, "title");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
