<?php

/**
 * TOP API: taobao.videos.query request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_VideosQueryRequest {
	/**
	 * 需要返回的视频对象字段。VideoItem结构体中所有字段均可返回；多个字段用“,”分隔；其中video_play_info中的播放url可选择性返回，其余属性全部返回；如果想返回整个子对象中所有url，那字段为video_play_info，如果是想返回子对象里面的字段，那字段为video_play_info.web_url。
	 **/
	private $fields;

	/**
	 * 在淘宝视频中的应用key，该值向淘宝视频申请产生
	 **/
	private $videoAppKey;

	/**
	 * 视频id列表
	 **/
	private $videoIds;

	private $apiParas = array();

	public function setFields($fields) {
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields() {
		return $this->fields;
	}

	public function setVideoAppKey($videoAppKey) {
		$this->videoAppKey = $videoAppKey;
		$this->apiParas["video_app_key"] = $videoAppKey;
	}

	public function getVideoAppKey() {
		return $this->videoAppKey;
	}

	public function setVideoIds($videoIds) {
		$this->videoIds = $videoIds;
		$this->apiParas["video_ids"] = $videoIds;
	}

	public function getVideoIds() {
		return $this->videoIds;
	}

	public function getApiMethodName() {
		return "taobao.videos.query";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->fields, "fields");
		Taobao_RequestCheckUtil::checkNotNull($this->videoAppKey, "videoAppKey");
		Taobao_RequestCheckUtil::checkNotNull($this->videoIds, "videoIds");
		Taobao_RequestCheckUtil::checkMaxListSize($this->videoIds, 100, "videoIds");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
