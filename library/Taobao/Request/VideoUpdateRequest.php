<?php

/**
 * TOP API: taobao.video.update request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_VideoUpdateRequest {
	/**
	 * 视频封面url,不能超过512个英文字母
	 **/
	private $coverUrl;

	/**
	 * 视频描述信息，不能超过256个汉字
	 **/
	private $description;

	/**
	 * 视频标签，以','隔开，且总长度不超过128个汉字
	 **/
	private $tags;

	/**
	 * 视频标题，不超过128个汉字。title, tags,cover_url和description至少必须传一个
	 **/
	private $title;

	/**
	 * 在淘宝视频中的应用key，该值向淘宝视频申请产生
	 **/
	private $videoAppKey;

	/**
	 * 视频id
	 **/
	private $videoId;

	private $apiParas = array();

	public function setCoverUrl($coverUrl) {
		$this->coverUrl = $coverUrl;
		$this->apiParas["cover_url"] = $coverUrl;
	}

	public function getCoverUrl() {
		return $this->coverUrl;
	}

	public function setDescription($description) {
		$this->description = $description;
		$this->apiParas["description"] = $description;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setTags($tags) {
		$this->tags = $tags;
		$this->apiParas["tags"] = $tags;
	}

	public function getTags() {
		return $this->tags;
	}

	public function setTitle($title) {
		$this->title = $title;
		$this->apiParas["title"] = $title;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setVideoAppKey($videoAppKey) {
		$this->videoAppKey = $videoAppKey;
		$this->apiParas["video_app_key"] = $videoAppKey;
	}

	public function getVideoAppKey() {
		return $this->videoAppKey;
	}

	public function setVideoId($videoId) {
		$this->videoId = $videoId;
		$this->apiParas["video_id"] = $videoId;
	}

	public function getVideoId() {
		return $this->videoId;
	}

	public function getApiMethodName() {
		return "taobao.video.update";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkMaxLength($this->coverUrl, 512, "coverUrl");
		Taobao_RequestCheckUtil::checkMaxLength($this->description, 512, "description");
		Taobao_RequestCheckUtil::checkMaxListSize($this->tags, 25, "tags");
		Taobao_RequestCheckUtil::checkMaxLength($this->tags, 256, "tags");
		Taobao_RequestCheckUtil::checkMaxLength($this->title, 256, "title");
		Taobao_RequestCheckUtil::checkNotNull($this->videoAppKey, "videoAppKey");
		Taobao_RequestCheckUtil::checkNotNull($this->videoId, "videoId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
