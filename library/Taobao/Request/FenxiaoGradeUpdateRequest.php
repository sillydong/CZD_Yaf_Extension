<?php

/**
 * TOP API: taobao.fenxiao.grade.update request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_FenxiaoGradeUpdateRequest {
	/**
	 * 等级ID
	 **/
	private $gradeId;

	/**
	 * 等级名称，等级名称不可重复
	 **/
	private $name;

	private $apiParas = array();

	public function setGradeId($gradeId) {
		$this->gradeId = $gradeId;
		$this->apiParas["grade_id"] = $gradeId;
	}

	public function getGradeId() {
		return $this->gradeId;
	}

	public function setName($name) {
		$this->name = $name;
		$this->apiParas["name"] = $name;
	}

	public function getName() {
		return $this->name;
	}

	public function getApiMethodName() {
		return "taobao.fenxiao.grade.update";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->gradeId, "gradeId");
		Taobao_RequestCheckUtil::checkNotNull($this->name, "name");
		Taobao_RequestCheckUtil::checkMaxLength($this->name, 20, "name");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
