<?php

/**
 * TOP API: taobao.hanoi.action.get.single request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HanoiActionGetSingleRequest {
	/**
	 * action的code
	 **/
	private $actionCode;

	/**
	 * action的id
	 **/
	private $id;

	/**
	 * action的name
	 **/
	private $name;

	private $apiParas = array();

	public function setActionCode($actionCode) {
		$this->actionCode = $actionCode;
		$this->apiParas["action_code"] = $actionCode;
	}

	public function getActionCode() {
		return $this->actionCode;
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

	public function getApiMethodName() {
		return "taobao.hanoi.action.get.single";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
