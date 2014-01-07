<?php

/**
 * TOP API: taobao.logistics.consign.resend request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_LogisticsConsignResendRequest {
	/**
	 * 物流公司代码.如"POST"就代表中国邮政,"ZJS"就代表宅急送.调用 taobao.logistics.companies.get 获取。
	 * <br><font color='red'>如果是货到付款订单，选择的物流公司必须支持货到付款发货方式</font>
	 **/
	private $companyCode;

	/**
	 * feature参数格式<br>
	 * 范例: identCode=tid1:识别码1,识别码2|tid2:识别码3;machineCode=tid3:3C机器号A,3C机器号B<br>
	 * identCode为识别码的KEY,machineCode为3C的KEY,多个key之间用”;”分隔<br>
	 * “tid1:识别码1,识别码2|tid2:识别码3”为identCode对应的value。
	 * "|"不同商品间的分隔符。<br>
	 * 例1商品和2商品，之间就用"|"分开。<br>
	 * TID就是商品代表的子订单号，对应taobao.trade.fullinfo.get 接口获得的oid字段。(通过OID可以唯一定位到当前商品上)<br>
	 * ":"TID和具体传入参数间的分隔符。冒号前表示TID,之后代表该商品的参数属性。<br>
	 * "," 属性间分隔符。（对应商品数量，当存在一个商品的数量超过1个时，用逗号分开）。<br>
	 * 具体:当订单中A商品的数量为2个，其中手机串号分别为"12345","67890"。<br>
	 * 参数格式：identCode=TIDA:12345,67890。
	 * TIDA对应了A宝贝，冒号后用逗号分隔的"12345","67890".说明本订单A宝贝的数量为2，值分别为"12345","67890"。<br>
	 * 当存在"|"时，就说明订单中存在多个商品，商品间用"|"分隔了开来。|"之后的内容含义同上。
	 **/
	private $feature;

	/**
	 * 表明是否是拆单，默认值0，1表示拆单
	 **/
	private $isSplit;

	/**
	 * 运单号.具体一个物流公司的真实运单号码。淘宝官方物流会校验，请谨慎传入；
	 **/
	private $outSid;

	/**
	 * 商家的IP地址
	 **/
	private $sellerIp;

	/**
	 * 拆单子订单列表，对应的数据是：子订单号的列表。可以不传，但是如果传了则必须符合传递的规则。子订单必须是操作的物流订单的子订单的真子集！
	 **/
	private $subTid;

	/**
	 * 淘宝交易ID
	 **/
	private $tid;

	private $apiParas = array();

	public function setCompanyCode($companyCode) {
		$this->companyCode = $companyCode;
		$this->apiParas["company_code"] = $companyCode;
	}

	public function getCompanyCode() {
		return $this->companyCode;
	}

	public function setFeature($feature) {
		$this->feature = $feature;
		$this->apiParas["feature"] = $feature;
	}

	public function getFeature() {
		return $this->feature;
	}

	public function setIsSplit($isSplit) {
		$this->isSplit = $isSplit;
		$this->apiParas["is_split"] = $isSplit;
	}

	public function getIsSplit() {
		return $this->isSplit;
	}

	public function setOutSid($outSid) {
		$this->outSid = $outSid;
		$this->apiParas["out_sid"] = $outSid;
	}

	public function getOutSid() {
		return $this->outSid;
	}

	public function setSellerIp($sellerIp) {
		$this->sellerIp = $sellerIp;
		$this->apiParas["seller_ip"] = $sellerIp;
	}

	public function getSellerIp() {
		return $this->sellerIp;
	}

	public function setSubTid($subTid) {
		$this->subTid = $subTid;
		$this->apiParas["sub_tid"] = $subTid;
	}

	public function getSubTid() {
		return $this->subTid;
	}

	public function setTid($tid) {
		$this->tid = $tid;
		$this->apiParas["tid"] = $tid;
	}

	public function getTid() {
		return $this->tid;
	}

	public function getApiMethodName() {
		return "taobao.logistics.consign.resend";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->companyCode, "companyCode");
		Taobao_RequestCheckUtil::checkNotNull($this->outSid, "outSid");
		Taobao_RequestCheckUtil::checkMaxListSize($this->subTid, 50, "subTid");
		Taobao_RequestCheckUtil::checkNotNull($this->tid, "tid");
		Taobao_RequestCheckUtil::checkMinValue($this->tid, 1000, "tid");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
