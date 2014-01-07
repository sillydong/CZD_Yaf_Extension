<?php

/**
 * TOP API: tmall.brandcat.propinput.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TmallBrandcatPropinputGetRequest {
	/**
	 * 品牌ID，如果类目没有品牌，指定null
	 **/
	private $brandId;

	/**
	 * 类目ID
	 **/
	private $cid;

	/**
	 * 属性ID，如果属性有子属性，请指定最后一级子属性ID，tmall.brandcat.propinput.get返回的即为的该属性ID对应的输入特征，对于有子属性模板的情况指定顶级属性ID即可
	 **/
	private $pid;

	private $apiParas = array();

	public function setBrandId($brandId) {
		$this->brandId = $brandId;
		$this->apiParas["brand_id"] = $brandId;
	}

	public function getBrandId() {
		return $this->brandId;
	}

	public function setCid($cid) {
		$this->cid = $cid;
		$this->apiParas["cid"] = $cid;
	}

	public function getCid() {
		return $this->cid;
	}

	public function setPid($pid) {
		$this->pid = $pid;
		$this->apiParas["pid"] = $pid;
	}

	public function getPid() {
		return $this->pid;
	}

	public function getApiMethodName() {
		return "tmall.brandcat.propinput.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->brandId, "brandId");
		Taobao_RequestCheckUtil::checkNotNull($this->cid, "cid");
		Taobao_RequestCheckUtil::checkNotNull($this->pid, "pid");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
