<?php

/**
 * TOP API: taobao.hanoi.label.add.pap request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HanoiLabelAddPapRequest {
	/**
	 * 认证信息
	 **/
	private $appName;

	/**
	 * 针对标签的一个简单描述
	 **/
	private $description;

	/**
	 * 标签的编码，用于检索
	 **/
	private $labelCode;

	/**
	 * 标签的名称
	 **/
	private $name;

	/**
	 * 标签是否开放
	 **/
	private $open;

	/**
	 * 针对模板表达式中需要设置的参数的一个实例化，List<ParameterVO>对象的json格式
	 **/
	private $paras;

	/**
	 * 标签的使用场景
	 **/
	private $scene;

	/**
	 * 标签对应的模板id
	 **/
	private $templateId;

	private $apiParas = array();

	public function setAppName($appName) {
		$this->appName = $appName;
		$this->apiParas["app_name"] = $appName;
	}

	public function getAppName() {
		return $this->appName;
	}

	public function setDescription($description) {
		$this->description = $description;
		$this->apiParas["description"] = $description;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setLabelCode($labelCode) {
		$this->labelCode = $labelCode;
		$this->apiParas["label_code"] = $labelCode;
	}

	public function getLabelCode() {
		return $this->labelCode;
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

	public function setParas($paras) {
		$this->paras = $paras;
		$this->apiParas["paras"] = $paras;
	}

	public function getParas() {
		return $this->paras;
	}

	public function setScene($scene) {
		$this->scene = $scene;
		$this->apiParas["scene"] = $scene;
	}

	public function getScene() {
		return $this->scene;
	}

	public function setTemplateId($templateId) {
		$this->templateId = $templateId;
		$this->apiParas["template_id"] = $templateId;
	}

	public function getTemplateId() {
		return $this->templateId;
	}

	public function getApiMethodName() {
		return "taobao.hanoi.label.add.pap";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->appName, "appName");
		Taobao_RequestCheckUtil::checkNotNull($this->labelCode, "labelCode");
		Taobao_RequestCheckUtil::checkNotNull($this->name, "name");
		Taobao_RequestCheckUtil::checkNotNull($this->templateId, "templateId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
