<?php

/**
 * TOP API: taobao.itempropvalues.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_ItempropvaluesGetRequest {
	/**
	 * 属性的Key，支持多条，以“,”分隔
	 **/
	private $attrKeys;

	/**
	 * 叶子类目ID ,通过taobao.itemcats.get获得叶子类目ID
	 **/
	private $cid;

	/**
	 * 需要返回的字段。目前支持有：cid,pid,prop_name,vid,name,name_alias,status,sort_order
	 **/
	private $fields;

	/**
	 * 属性和属性值 id串，格式例如(pid1;pid2)或(pid1:vid1;pid2:vid2)或(pid1;pid2:vid2)
	 **/
	private $pvs;

	/**
	 * 获取类目的类型：1代表集市、2代表天猫
	 **/
	private $type;

	private $apiParas = array();

	public function setAttrKeys($attrKeys) {
		$this->attrKeys = $attrKeys;
		$this->apiParas["attr_keys"] = $attrKeys;
	}

	public function getAttrKeys() {
		return $this->attrKeys;
	}

	public function setCid($cid) {
		$this->cid = $cid;
		$this->apiParas["cid"] = $cid;
	}

	public function getCid() {
		return $this->cid;
	}

	public function setFields($fields) {
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields() {
		return $this->fields;
	}

	public function setPvs($pvs) {
		$this->pvs = $pvs;
		$this->apiParas["pvs"] = $pvs;
	}

	public function getPvs() {
		return $this->pvs;
	}

	public function setType($type) {
		$this->type = $type;
		$this->apiParas["type"] = $type;
	}

	public function getType() {
		return $this->type;
	}

	public function getApiMethodName() {
		return "taobao.itempropvalues.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->cid, "cid");
		Taobao_RequestCheckUtil::checkNotNull($this->fields, "fields");
		Taobao_RequestCheckUtil::checkMaxValue($this->type, 2, "type");
		Taobao_RequestCheckUtil::checkMinValue($this->type, 1, "type");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
