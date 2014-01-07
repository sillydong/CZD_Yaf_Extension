<?php

/**
 * TOP API: taobao.user.seller.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_UserSellerGetRequest {
	/**
	 * 只返回user_id,nick,sex,seller_credit,type,has_more_pic,item_img_num,item_img_size,prop_img_num,prop_img_size,auto_repost,promoted_type,status,alipay_bind,consumer_protection,avatar,liangpin,sign_food_seller_promise,has_shop,is_lightning_consignment,has_sub_stock,is_golden_seller,vip_info,magazine_subscribe,vertical_market,online_gaming参数
	 **/
	private $fields;

	private $apiParas = array();

	public function setFields($fields) {
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields() {
		return $this->fields;
	}

	public function getApiMethodName() {
		return "taobao.user.seller.get";
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
