<?php

/**
 * TOP API: taobao.delivery.template.delete request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_DeliveryTemplateDeleteRequest {
	/**
	 * 运费模板ID
	 **/
	private $templateId;

	private $apiParas = array();

	public function setTemplateId($templateId) {
		$this->templateId = $templateId;
		$this->apiParas["template_id"] = $templateId;
	}

	public function getTemplateId() {
		return $this->templateId;
	}

	public function getApiMethodName() {
		return "taobao.delivery.template.delete";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->templateId, "templateId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
