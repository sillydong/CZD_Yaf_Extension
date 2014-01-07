<?php

/**
 * TOP API: taobao.wlb.item.authorization.delete request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_WlbItemAuthorizationDeleteRequest {
	/**
	 * 授权关系ID
	 **/
	private $authorizeId;

	private $apiParas = array();

	public function setAuthorizeId($authorizeId) {
		$this->authorizeId = $authorizeId;
		$this->apiParas["authorize_id"] = $authorizeId;
	}

	public function getAuthorizeId() {
		return $this->authorizeId;
	}

	public function getApiMethodName() {
		return "taobao.wlb.item.authorization.delete";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->authorizeId, "authorizeId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
