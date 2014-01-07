<?php

/**
 * TOP API: taobao.logistics.address.remove request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_LogisticsAddressRemoveRequest {
	/**
	 * 地址库ID
	 **/
	private $contactId;

	private $apiParas = array();

	public function setContactId($contactId) {
		$this->contactId = $contactId;
		$this->apiParas["contact_id"] = $contactId;
	}

	public function getContactId() {
		return $this->contactId;
	}

	public function getApiMethodName() {
		return "taobao.logistics.address.remove";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->contactId, "contactId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
