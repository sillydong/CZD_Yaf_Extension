<?php

/**
 * TOP API: taobao.hanoi.group.label.add request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HanoiGroupLabelAddRequest {
	/**
	 * 认证信息
	 **/
	private $appName;

	/**
	 * 分组的id
	 **/
	private $groupId;

	/**
	 * 标签的id
	 **/
	private $labelId;

	/**
	 * 标签的优先级。对于互斥分组必须填
	 **/
	private $level;

	private $apiParas = array();

	public function setAppName($appName) {
		$this->appName = $appName;
		$this->apiParas["app_name"] = $appName;
	}

	public function getAppName() {
		return $this->appName;
	}

	public function setGroupId($groupId) {
		$this->groupId = $groupId;
		$this->apiParas["group_id"] = $groupId;
	}

	public function getGroupId() {
		return $this->groupId;
	}

	public function setLabelId($labelId) {
		$this->labelId = $labelId;
		$this->apiParas["label_id"] = $labelId;
	}

	public function getLabelId() {
		return $this->labelId;
	}

	public function setLevel($level) {
		$this->level = $level;
		$this->apiParas["level"] = $level;
	}

	public function getLevel() {
		return $this->level;
	}

	public function getApiMethodName() {
		return "taobao.hanoi.group.label.add";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->appName, "appName");
		Taobao_RequestCheckUtil::checkNotNull($this->groupId, "groupId");
		Taobao_RequestCheckUtil::checkNotNull($this->labelId, "labelId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
