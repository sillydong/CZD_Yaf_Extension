<?php

/**
 * TOP API: taobao.hanoi.action.get.list request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HanoiActionGetListRequest {
	/**
	 * 分页查询当前查询的页数；
	 **/
	private $currentPage;

	/**
	 * action的状态（0：审核中 1：审核通过，正常）
	 **/
	private $status;

	private $apiParas = array();

	public function setCurrentPage($currentPage) {
		$this->currentPage = $currentPage;
		$this->apiParas["current_page"] = $currentPage;
	}

	public function getCurrentPage() {
		return $this->currentPage;
	}

	public function setStatus($status) {
		$this->status = $status;
		$this->apiParas["status"] = $status;
	}

	public function getStatus() {
		return $this->status;
	}

	public function getApiMethodName() {
		return "taobao.hanoi.action.get.list";
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
