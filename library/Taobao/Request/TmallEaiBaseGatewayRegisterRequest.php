<?php

/**
 * TOP API: tmall.eai.base.gateway.register request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TmallEaiBaseGatewayRegisterRequest {
	/**
	 * 用户应用的回调URL,若是普通OPEN-API用户(user_type=0)这个字段可以不填。但是若是JIP用户注册，也就是(user_type=1)时,则此字段必填。否则调用不会成功。
	 **/
	private $callBackUrl;

	/**
	 * 字符集编码GBK,UTF-8默认,GB2312
	 **/
	private $charSet;

	/**
	 * 用户所在的城市
	 **/
	private $city;

	/**
	 * 数据格式:XML,JSON。
	 * 默认:JSON
	 **/
	private $contentType;

	/**
	 * 接入方式描述，为了更好的方便我们为您服务请务必详细描述下您的APP情况。
	 **/
	private $description;

	/**
	 * 用户所在区域
	 **/
	private $district;

	/**
	 * 用户的联系邮箱
	 **/
	private $email;

	/**
	 * 暂时还没有支持
	 **/
	private $maxFlow;

	/**
	 * 用户手机号码
	 **/
	private $mobile;

	/**
	 * 用户通知接收方式,邮件,电话或者其他。
	 * email:邮件;
	 * message:短信;
	 * aliwangwang:阿里旺旺弹出消息。
	 **/
	private $notifyType;

	/**
	 * 联系人姓名
	 **/
	private $principal;

	/**
	 * 用户联系电话-座机
	 **/
	private $telephone;

	/**
	 * 接口/api名称:
	 * 天猫退款消息可选值为:
	 * tmall.eai.order.refund.refundBill.push
	 * tmall.eai.order.refund.refundStatus.push
	 **/
	private $topic;

	/**
	 * Topic组.暂时还不能支持.
	 **/
	private $topicGroup;

	/**
	 * url协议
	 * HTTP默认
	 **/
	private $urlProtocal;

	/**
	 * 0:普通TOP-OPEN-API用户;
	 * 1:JIP用户。
	 **/
	private $userType;

	private $apiParas = array();

	public function setCallBackUrl($callBackUrl) {
		$this->callBackUrl = $callBackUrl;
		$this->apiParas["call_back_url"] = $callBackUrl;
	}

	public function getCallBackUrl() {
		return $this->callBackUrl;
	}

	public function setCharSet($charSet) {
		$this->charSet = $charSet;
		$this->apiParas["char_set"] = $charSet;
	}

	public function getCharSet() {
		return $this->charSet;
	}

	public function setCity($city) {
		$this->city = $city;
		$this->apiParas["city"] = $city;
	}

	public function getCity() {
		return $this->city;
	}

	public function setContentType($contentType) {
		$this->contentType = $contentType;
		$this->apiParas["content_type"] = $contentType;
	}

	public function getContentType() {
		return $this->contentType;
	}

	public function setDescription($description) {
		$this->description = $description;
		$this->apiParas["description"] = $description;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDistrict($district) {
		$this->district = $district;
		$this->apiParas["district"] = $district;
	}

	public function getDistrict() {
		return $this->district;
	}

	public function setEmail($email) {
		$this->email = $email;
		$this->apiParas["email"] = $email;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setMaxFlow($maxFlow) {
		$this->maxFlow = $maxFlow;
		$this->apiParas["max_flow"] = $maxFlow;
	}

	public function getMaxFlow() {
		return $this->maxFlow;
	}

	public function setMobile($mobile) {
		$this->mobile = $mobile;
		$this->apiParas["mobile"] = $mobile;
	}

	public function getMobile() {
		return $this->mobile;
	}

	public function setNotifyType($notifyType) {
		$this->notifyType = $notifyType;
		$this->apiParas["notify_type"] = $notifyType;
	}

	public function getNotifyType() {
		return $this->notifyType;
	}

	public function setPrincipal($principal) {
		$this->principal = $principal;
		$this->apiParas["principal"] = $principal;
	}

	public function getPrincipal() {
		return $this->principal;
	}

	public function setTelephone($telephone) {
		$this->telephone = $telephone;
		$this->apiParas["telephone"] = $telephone;
	}

	public function getTelephone() {
		return $this->telephone;
	}

	public function setTopic($topic) {
		$this->topic = $topic;
		$this->apiParas["topic"] = $topic;
	}

	public function getTopic() {
		return $this->topic;
	}

	public function setTopicGroup($topicGroup) {
		$this->topicGroup = $topicGroup;
		$this->apiParas["topic_group"] = $topicGroup;
	}

	public function getTopicGroup() {
		return $this->topicGroup;
	}

	public function setUrlProtocal($urlProtocal) {
		$this->urlProtocal = $urlProtocal;
		$this->apiParas["url_protocal"] = $urlProtocal;
	}

	public function getUrlProtocal() {
		return $this->urlProtocal;
	}

	public function setUserType($userType) {
		$this->userType = $userType;
		$this->apiParas["user_type"] = $userType;
	}

	public function getUserType() {
		return $this->userType;
	}

	public function getApiMethodName() {
		return "tmall.eai.base.gateway.register";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->callBackUrl, "callBackUrl");
		Taobao_RequestCheckUtil::checkNotNull($this->city, "city");
		Taobao_RequestCheckUtil::checkNotNull($this->description, "description");
		Taobao_RequestCheckUtil::checkNotNull($this->email, "email");
		Taobao_RequestCheckUtil::checkNotNull($this->mobile, "mobile");
		Taobao_RequestCheckUtil::checkNotNull($this->principal, "principal");
		Taobao_RequestCheckUtil::checkNotNull($this->topic, "topic");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
