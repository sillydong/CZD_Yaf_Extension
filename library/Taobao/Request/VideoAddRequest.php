<?php

/**
 * TOP API: taobao.video.add request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_VideoAddRequest {
	/**
	 * 视频封面url,不能为空且不能超过512个英文字母
	 **/
	private $coverUrl;

	/**
	 * 视频描述信息，不能为空且不能超过256个汉字
	 **/
	private $description;

	/**
	 * 视频标签，以','隔开，不能为空且总长度不超过128个汉字
	 **/
	private $tags;

	/**
	 * 视频标题，不能为空且不超过128个汉字
	 **/
	private $title;

	/**
	 * 上传唯一识别符,上传id
	 **/
	private $uploadId;

	/**
	 * 视频上传者数字id
	 **/
	private $uploaderId;

	/**
	 * 在淘宝视频中的应用key，该值向淘宝视频申请产生
	 **/
	private $videoAppKey;

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

	public function setUploadId($uploadId) {
		$this->uploadId = $uploadId;
		$this->apiParas["upload_id"] = $uploadId;
	}

	public function getUploadId() {
		return $this->uploadId;
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
		return "taobao.video.add";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->coverUrl, "coverUrl");
		Taobao_RequestCheckUtil::checkMaxLength($this->coverUrl, 512, "coverUrl");
		Taobao_RequestCheckUtil::checkNotNull($this->description, "description");
		Taobao_RequestCheckUtil::checkMaxLength($this->description, 512, "description");
		Taobao_RequestCheckUtil::checkNotNull($this->tags, "tags");
		Taobao_RequestCheckUtil::checkMaxListSize($this->tags, 25, "tags");
		Taobao_RequestCheckUtil::checkMaxLength($this->tags, 256, "tags");
		Taobao_RequestCheckUtil::checkNotNull($this->title, "title");
		Taobao_RequestCheckUtil::checkMaxLength($this->title, 256, "title");
		Taobao_RequestCheckUtil::checkNotNull($this->uploadId, "uploadId");
		Taobao_RequestCheckUtil::checkNotNull($this->uploaderId, "uploaderId");
		Taobao_RequestCheckUtil::checkNotNull($this->videoAppKey, "videoAppKey");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
