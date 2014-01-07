<?php

/**
 * TOP API: taobao.hanoi.dataservice.read request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HanoiDataserviceReadRequest {
	/**
	 * 分配给调用方的名称信息，内部统计使用
	 **/
	private $appName;

	/**
	 * 要查询的属性的id(Long型)。以json的数组的形式。所有属性的querykey必须相同，如有不同的需要分多次查询。属性的taobao.hanoi.ranges.get不为空时，值为key的拼接
	 **/
	private $attrs;

	/**
	 * 查询的主键。如查询关系数据，主键是sellerId+buyerId，但sellerId是系统自动传过来的，所以只需要传"BUYERNICK"或"BUYERID"二选一。再例如查询类目数据，则需要传"CATEGORYID"。
	 **/
	private $pk;

	private $apiParas = array();

	public function setAppName($appName) {
		$this->appName = $appName;
		$this->apiParas["app_name"] = $appName;
	}

	public function getAppName() {
		return $this->appName;
	}

	public function setAttrs($attrs) {
		$this->attrs = $attrs;
		$this->apiParas["attrs"] = $attrs;
	}

	public function getAttrs() {
		return $this->attrs;
	}

	public function setPk($pk) {
		$this->pk = $pk;
		$this->apiParas["pk"] = $pk;
	}

	public function getPk() {
		return $this->pk;
	}

	public function getApiMethodName() {
		return "taobao.hanoi.dataservice.read";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->appName, "appName");
		Taobao_RequestCheckUtil::checkNotNull($this->attrs, "attrs");
		Taobao_RequestCheckUtil::checkNotNull($this->pk, "pk");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
