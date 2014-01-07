<?php

/**
 * TOP API: taobao.hanoi.datatemplate.detail.query request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HanoiDatatemplateDetailQueryRequest {
	/**
	 * appName
	 **/
	private $appName;

	/**
	 * attrId(Long):AttributeVO的唯一标识<br/>
	 * templateId(Long):数据模板的唯一标识<br/>
	 * name(String):数据模板详情的名称<br/>
	 * id(Long):根据模板唯一标识去查询<br/>
	 * pageSize:分页大小（最大值30）<br/>
	 * currentPage:当前页码<br/>
	 * needRetPage(Boolean 默认False):是否返回总条数<br/>
	 * justQueryParamNotInput（Boolean 默认False）:是否只查询每天如PK的详情列表<br/>
	 **/
	private $parameter;

	private $apiParas = array();

	public function setAppName($appName) {
		$this->appName = $appName;
		$this->apiParas["app_name"] = $appName;
	}

	public function getAppName() {
		return $this->appName;
	}

	public function setParameter($parameter) {
		$this->parameter = $parameter;
		$this->apiParas["parameter"] = $parameter;
	}

	public function getParameter() {
		return $this->parameter;
	}

	public function getApiMethodName() {
		return "taobao.hanoi.datatemplate.detail.query";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->appName, "appName");
		Taobao_RequestCheckUtil::checkNotNull($this->parameter, "parameter");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
