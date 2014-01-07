<?php

/**
 * TOP API: taobao.videos.search request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_VideosSearchRequest {
	/**
	 * 页码。默认返回的数据是从第一页开始
	 **/
	private $currentPage;

	/**
	 * 需要返回的视频对象字段。VideoItem结构体中所有字段均可返回；多个字段用“,”分隔；其中video_play_info中的播放url可选择性返回，其余属性全部返回；如果想返回整个子对象中所有url，那字段为video_play_info，如果是想返回子对象里面的字段，那字段为video_play_info.web_url。
	 **/
	private $fields;

	/**
	 * 关键字(标题or标签，不能同时设置title,tag，否则冲突)
	 **/
	private $keywords;

	/**
	 * 每页条数，默认值是12
	 **/
	private $pageSize;

	/**
	 * 视频状态列表；视频状态：等待转码（1），转码中（2），转码失败（3），等待审核（4），未通过审核（5），通过审核（6）
	 **/
	private $states;

	/**
	 * 视频标签
	 **/
	private $tag;

	/**
	 * 视频标题
	 **/
	private $title;

	/**
	 * 视频上传者数字id
	 **/
	private $uploaderId;

	/**
	 * 在淘宝视频中的应用key，该值向淘宝视频申请产生
	 **/
	private $videoAppKey;

	private $apiParas = array();

	public function setCurrentPage($currentPage) {
		$this->currentPage = $currentPage;
		$this->apiParas["current_page"] = $currentPage;
	}

	public function getCurrentPage() {
		return $this->currentPage;
	}

	public function setFields($fields) {
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields() {
		return $this->fields;
	}

	public function setKeywords($keywords) {
		$this->keywords = $keywords;
		$this->apiParas["keywords"] = $keywords;
	}

	public function getKeywords() {
		return $this->keywords;
	}

	public function setPageSize($pageSize) {
		$this->pageSize = $pageSize;
		$this->apiParas["page_size"] = $pageSize;
	}

	public function getPageSize() {
		return $this->pageSize;
	}

	public function setStates($states) {
		$this->states = $states;
		$this->apiParas["states"] = $states;
	}

	public function getStates() {
		return $this->states;
	}

	public function setTag($tag) {
		$this->tag = $tag;
		$this->apiParas["tag"] = $tag;
	}

	public function getTag() {
		return $this->tag;
	}

	public function setTitle($title) {
		$this->title = $title;
		$this->apiParas["title"] = $title;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setUploaderId($uploaderId) {
		$this->uploaderId = $uploaderId;
		$this->apiParas["uploader_id"] = $uploaderId;
	}

	public function getUploaderId() {
		return $this->uploaderId;
	}

	public function setVideoAppKey($videoAppKey) {
		$this->videoAppKey = $videoAppKey;
		$this->apiParas["video_app_key"] = $videoAppKey;
	}

	public function getVideoAppKey() {
		return $this->videoAppKey;
	}

	public function getApiMethodName() {
		return "taobao.videos.search";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->fields, "fields");
		Taobao_RequestCheckUtil::checkMaxListSize($this->states, 10, "states");
		Taobao_RequestCheckUtil::checkMaxLength($this->tag, 256, "tag");
		Taobao_RequestCheckUtil::checkMaxLength($this->title, 256, "title");
		Taobao_RequestCheckUtil::checkNotNull($this->uploaderId, "uploaderId");
		Taobao_RequestCheckUtil::checkNotNull($this->videoAppKey, "videoAppKey");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
