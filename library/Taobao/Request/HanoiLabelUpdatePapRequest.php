<?php

/**
 * TOP API: taobao.hanoi.label.update.pap request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HanoiLabelUpdatePapRequest {
	/**
	 * 认证信息
	 **/
	private $appName;

	/**
	 * 针对标签的一个简单描述
	 **/
	private $description;

	/**
	 * 标签最近一次修改时间
	 **/
	private $gmtModified;

	/**
	 * 要修改的标签的id
	 **/
	private $id;

	/**
	 * 标签的编码，用于检索
	 **/
	private $labelCode;

	/**
	 * 标签的名称
	 **/
	private $name;

	/**
	 * 开放策略 true 开放
	 **/
	private $open;

	/**
	 * 针对模板表达式中需要设置的参数的一个实例化，List<ParameterVO>对象的json格式
	 **/
	private $paras;

	/**
	 * 场景字段
	 **/
	private $scene;

	/**
	 * 标签对应的模板id。修改了模板，必须同时修改标签的参数paras
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
		return "taobao.hanoi.label.update.pap";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->appName, "appName");
		Taobao_RequestCheckUtil::checkNotNull($this->gmtModified, "gmtModified");
		Taobao_RequestCheckUtil::checkNotNull($this->id, "id");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
