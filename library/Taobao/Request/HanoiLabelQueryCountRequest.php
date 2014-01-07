<?php

/**
 * TOP API: taobao.hanoi.label.query.count request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HanoiLabelQueryCountRequest {
	/**
	 * 认证信息
	 **/
	private $appName;

	/**
	 * 模板业务状态 1 审核 0 创建
	 **/
	private $bizStatus;

	/**
	 * 模板的编码
	 **/
	private $code;

	/**
	 * 根据时间查询 创建时间结束点
	 **/
	private $gmtCreateEnd;

	/**
	 * 根据时间查询 创建时间截止点
	 **/
	private $gmtCreateStart;

	/**
	 * 根据时间查询，最近修改时间截止
	 **/
	private $gmtModifiedEnd;

	/**
	 * 根据时间查询，最近修改时间起点
	 **/
	private $gmtModifiedStart;

	/**
	 * 模板id
	 **/
	private $id;

	/**
	 * 模板名称
	 **/
	private $name;

	/**
	 * 开放策略
	 **/
	private $open;

	/**
	 * 使用场景
	 **/
	private $scene;

	/**
	 * 标签的源模板id
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

	public function setBizStatus($bizStatus) {
		$this->bizStatus = $bizStatus;
		$this->apiParas["biz_status"] = $bizStatus;
	}

	public function getBizStatus() {
		return $this->bizStatus;
	}

	public function setCode($code) {
		$this->code = $code;
		$this->apiParas["code"] = $code;
	}

	public function getCode() {
		return $this->code;
	}

	public function setGmtCreateEnd($gmtCreateEnd) {
		$this->gmtCreateEnd = $gmtCreateEnd;
		$this->apiParas["gmt_create_end"] = $gmtCreateEnd;
	}

	public function getGmtCreateEnd() {
		return $this->gmtCreateEnd;
	}

	public function setGmtCreateStart($gmtCreateStart) {
		$this->gmtCreateStart = $gmtCreateStart;
		$this->apiParas["gmt_create_start"] = $gmtCreateStart;
	}

	public function getGmtCreateStart() {
		return $this->gmtCreateStart;
	}

	public function setGmtModifiedEnd($gmtModifiedEnd) {
		$this->gmtModifiedEnd = $gmtModifiedEnd;
		$this->apiParas["gmt_modified_end"] = $gmtModifiedEnd;
	}

	public function getGmtModifiedEnd() {
		return $this->gmtModifiedEnd;
	}

	public function setGmtModifiedStart($gmtModifiedStart) {
		$this->gmtModifiedStart = $gmtModifiedStart;
		$this->apiParas["gmt_modified_start"] = $gmtModifiedStart;
	}

	public function getGmtModifiedStart() {
		return $this->gmtModifiedStart;
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
		return "taobao.hanoi.label.query.count";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->appName, "appName");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
