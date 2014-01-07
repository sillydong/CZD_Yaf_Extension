<?php

/**
 * TOP API: taobao.hanoi.group.update.pap request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HanoiGroupUpdatePapRequest {
	/**
	 * 认证信息
	 **/
	private $appName;

	/**
	 * 分组的描述
	 **/
	private $description;

	/**
	 * 分组上次更新时间
	 **/
	private $gmtModified;

	/**
	 * 分组的编码
	 **/
	private $groupCode;

	/**
	 * 需要更新的分组id
	 **/
	private $id;

	/**
	 * 分组的名称
	 **/
	private $name;

	/**
	 * 开放策略（true 开放，默认为false）
	 **/
	private $open;

	/**
	 * 使用场景
	 **/
	private $scene;

	/**
	 * 分组的类型，0 互斥，1 共存，默认为0
	 **/
	private $type;

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

	public function setGroupCode($groupCode) {
		$this->groupCode = $groupCode;
		$this->apiParas["group_code"] = $groupCode;
	}

	public function getGroupCode() {
		return $this->groupCode;
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

	public function setType($type) {
		$this->type = $type;
		$this->apiParas["type"] = $type;
	}

	public function getType() {
		return $this->type;
	}

	public function getApiMethodName() {
		return "taobao.hanoi.group.update.pap";
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
