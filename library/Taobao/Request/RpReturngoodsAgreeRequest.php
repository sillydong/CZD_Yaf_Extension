<?php

/**
 * TOP API: taobao.rp.returngoods.agree request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_RpReturngoodsAgreeRequest {
	/**
	 * 卖家提供的退货地址
	 **/
	private $address;

	/**
	 * 卖家手机
	 **/
	private $mobile;

	/**
	 * 卖家姓名
	 **/
	private $name;

	/**
	 * 卖家提供的退货地址的邮编
	 **/
	private $post;

	/**
	 * 退款编号
	 **/
	private $refundId;

	/**
	 * 卖家退货留言
	 **/
	private $remark;

	/**
	 * 卖家座机
	 **/
	private $tel;

	private $apiParas = array();

	public function setAddress($address) {
		$this->address = $address;
		$this->apiParas["address"] = $address;
	}

	public function getAddress() {
		return $this->address;
	}

	public function setMobile($mobile) {
		$this->mobile = $mobile;
		$this->apiParas["mobile"] = $mobile;
	}

	public function getMobile() {
		return $this->mobile;
	}

	public function setName($name) {
		$this->name = $name;
		$this->apiParas["name"] = $name;
	}

	public function getName() {
		return $this->name;
	}

	public function setPost($post) {
		$this->post = $post;
		$this->apiParas["post"] = $post;
	}

	public function getPost() {
		return $this->post;
	}

	public function setRefundId($refundId) {
		$this->refundId = $refundId;
		$this->apiParas["refund_id"] = $refundId;
	}

	public function getRefundId() {
		return $this->refundId;
	}

	public function setRemark($remark) {
		$this->remark = $remark;
		$this->apiParas["remark"] = $remark;
	}

	public function getRemark() {
		return $this->remark;
	}

	public function setTel($tel) {
		$this->tel = $tel;
		$this->apiParas["tel"] = $tel;
	}

	public function getTel() {
		return $this->tel;
	}

	public function getApiMethodName() {
		return "taobao.rp.returngoods.agree";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->address, "address");
		Taobao_RequestCheckUtil::checkNotNull($this->mobile, "mobile");
		Taobao_RequestCheckUtil::checkNotNull($this->name, "name");
		Taobao_RequestCheckUtil::checkNotNull($this->post, "post");
		Taobao_RequestCheckUtil::checkNotNull($this->refundId, "refundId");
		Taobao_RequestCheckUtil::checkNotNull($this->tel, "tel");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
