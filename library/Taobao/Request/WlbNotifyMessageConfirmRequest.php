<?php

/**
 * TOP API: taobao.wlb.notify.message.confirm request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_WlbNotifyMessageConfirmRequest {
	/**
	 * 物流宝通知消息的id，通过taobao.wlb.notify.message.page.get接口得到的WlbMessage数据结构中的id字段
	 **/
	private $messageId;

	private $apiParas = array();

	public function setMessageId($messageId) {
		$this->messageId = $messageId;
		$this->apiParas["message_id"] = $messageId;
	}

	public function getMessageId() {
		return $this->messageId;
	}

	public function getApiMethodName() {
		return "taobao.wlb.notify.message.confirm";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->messageId, "messageId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
