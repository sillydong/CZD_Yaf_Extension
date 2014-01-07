<?php

/**
 * TOP API: taobao.hanoi.datatemplate.detail.add request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HanoiDatatemplateDetailAddRequest {
	/**
	 * appName
	 **/
	private $appName;

	/**
	 * attr: 将AttributeVO转换成JSON格式
	 * name: 详情的名称
	 **/
	private $dataTemplateDetails;

	/**
	 * id:数据模板唯一标识
	 **/
	private $dataTemplateVo;

	private $apiParas = array();

	public function setAppName($appName) {
		$this->appName = $appName;
		$this->apiParas["app_name"] = $appName;
	}

	public function getAppName() {
		return $this->appName;
	}

	public function setDataTemplateDetails($dataTemplateDetails) {
		$this->dataTemplateDetails = $dataTemplateDetails;
		$this->apiParas["data_template_details"] = $dataTemplateDetails;
	}

	public function getDataTemplateDetails() {
		return $this->dataTemplateDetails;
	}

	public function setDataTemplateVo($dataTemplateVo) {
		$this->dataTemplateVo = $dataTemplateVo;
		$this->apiParas["data_template_vo"] = $dataTemplateVo;
	}

	public function getDataTemplateVo() {
		return $this->dataTemplateVo;
	}

	public function getApiMethodName() {
		return "taobao.hanoi.datatemplate.detail.add";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->appName, "appName");
		Taobao_RequestCheckUtil::checkNotNull($this->dataTemplateDetails, "dataTemplateDetails");
		Taobao_RequestCheckUtil::checkNotNull($this->dataTemplateVo, "dataTemplateVo");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
