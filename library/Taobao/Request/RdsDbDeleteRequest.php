<?php

/**
 * TOP API: taobao.rds.db.delete request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_RdsDbDeleteRequest {
	/**
	 * 数据库的name，可以通过 taobao.rds.db.get 获取
	 **/
	private $dbName;

	/**
	 * rds的实例名
	 **/
	private $instanceName;

	private $apiParas = array();

	public function setDbName($dbName) {
		$this->dbName = $dbName;
		$this->apiParas["db_name"] = $dbName;
	}

	public function getDbName() {
		return $this->dbName;
	}

	public function setInstanceName($instanceName) {
		$this->instanceName = $instanceName;
		$this->apiParas["instance_name"] = $instanceName;
	}

	public function getInstanceName() {
		return $this->instanceName;
	}

	public function getApiMethodName() {
		return "taobao.rds.db.delete";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->dbName, "dbName");
		Taobao_RequestCheckUtil::checkNotNull($this->instanceName, "instanceName");
		Taobao_RequestCheckUtil::checkMaxLength($this->instanceName, 30, "instanceName");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
