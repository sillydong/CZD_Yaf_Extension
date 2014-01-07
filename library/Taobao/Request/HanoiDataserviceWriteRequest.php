<?php

/**
 * TOP API: taobao.hanoi.dataservice.write request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HanoiDataserviceWriteRequest {
	/**
	 * 分配给调用方的名称信息，内部统计使用
	 **/
	private $appName;

	/**
	 * json对象，key为属性ID，值为需要回写的内容,如果属性值域不为空（通过taobao.hanoi.ranges.get获取）则需要把值转成key回写，并以逗号","隔开拼接成字符串
	 **/
	private $data;

	/**
	 * 回流数据的主键或上下文环境，如卖家id，类目id等。
	 **/
	private $params;

	private $apiParas = array();

	public function setAppName($appName) {
		$this->appName = $appName;
		$this->apiParas["app_name"] = $appName;
	}

	public function getAppName() {
		return $this->appName;
	}

	public function setData($data) {
		$this->data = $data;
		$this->apiParas["data"] = $data;
	}

	public function getData() {
		return $this->data;
	}

	public function setParams($params) {
		$this->params = $params;
		$this->apiParas["params"] = $params;
	}

	public function getParams() {
		return $this->params;
	}

	public function getApiMethodName() {
		return "taobao.hanoi.dataservice.write";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->appName, "appName");
		Taobao_RequestCheckUtil::checkNotNull($this->data, "data");
		Taobao_RequestCheckUtil::checkNotNull($this->params, "params");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
