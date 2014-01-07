<?php

/**
 * TOP API: taobao.hanoi.template.update request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HanoiTemplateUpdateRequest {
	/**
	 * 认证信息
	 **/
	private $appName;

	/**
	 * 所使用的数据模板
	 **/
	private $dataTemplateId;

	/**
	 * 模板的描述
	 **/
	private $description;

	/**
	 * 模板的表达式
	 **/
	private $expression;

	/**
	 * 模板上次更新时间
	 **/
	private $gmtModified;

	/**
	 * 需要更新的模板id
	 **/
	private $id;

	/**
	 * 模板的名称
	 **/
	private $name;

	/**
	 * 模板的开放策略，默认为false，不开放
	 **/
	private $open;

	/**
	 * 设置表达式中参数的类型。ParaVO对象的json格式
	 **/
	private $paraList;

	/**
	 * 模板的源模板id，0表示没有源模板
	 **/
	private $sourceTemplateId;

	/**
	 * 模板的编码
	 **/
	private $templateCode;

	private $apiParas = array();

	public function setAppName($appName) {
		$this->appName = $appName;
		$this->apiParas["app_name"] = $appName;
	}

	public function getAppName() {
		return $this->appName;
	}

	public function setDataTemplateId($dataTemplateId) {
		$this->dataTemplateId = $dataTemplateId;
		$this->apiParas["data_template_id"] = $dataTemplateId;
	}

	public function getDataTemplateId() {
		return $this->dataTemplateId;
	}

	public function setDescription($description) {
		$this->description = $description;
		$this->apiParas["description"] = $description;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setExpression($expression) {
		$this->expression = $expression;
		$this->apiParas["expression"] = $expression;
	}

	public function getExpression() {
		return $this->expression;
	}

	public function setGmtModified($gmtModified) {
		$this->gmtModified = $gmtModified;
		$this->apiParas["gmt_modified"] = $gmtModified;
	}

	public function getGmtModified() {
		return $this->gmtModified;
	}

	public function setId($id) {
		$this->id = $id;
		$this->apiParas["id"] = $id;
	}

	public function getId() {
		return $this->id;
	}

	public function setName($name) {
		$this->name = $name;
		$this->apiParas["name"] = $name;
	}

	public function getName() {
		return $this->name;
	}

	public function setOpen($open) {
		$this->open = $open;
		$this->apiParas["open"] = $open;
	}

	public function getOpen() {
		return $this->open;
	}

	public function setParaList($paraList) {
		$this->paraList = $paraList;
		$this->apiParas["para_list"] = $paraList;
	}

	public function getParaList() {
		return $this->paraList;
	}

	public function setSourceTemplateId($sourceTemplateId) {
		$this->sourceTemplateId = $sourceTemplateId;
		$this->apiParas["source_template_id"] = $sourceTemplateId;
	}

	public function getSourceTemplateId() {
		return $this->sourceTemplateId;
	}

	public function setTemplateCode($templateCode) {
		$this->templateCode = $templateCode;
		$this->apiParas["template_code"] = $templateCode;
	}

	public function getTemplateCode() {
		return $this->templateCode;
	}

	public function getApiMethodName() {
		return "taobao.hanoi.template.update";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->appName, "appName");
		Taobao_RequestCheckUtil::checkNotNull($this->gmtModified, "gmtModified");
		Taobao_RequestCheckUtil::checkNotNull($this->id, "id");
		Taobao_RequestCheckUtil::checkMaxLength($this->templateCode, 50, "templateCode");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
