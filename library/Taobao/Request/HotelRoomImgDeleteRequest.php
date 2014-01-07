<?php

/**
 * TOP API: taobao.hotel.room.img.delete request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HotelRoomImgDeleteRequest {
	/**
	 * 酒店房间商品gid。必须为数字。
	 **/
	private $gid;

	/**
	 * 图片序号，可选值：1，2，3，4，5。
	 * 如果原图片个数小于等于1，则报错，不能删除图片。
	 * 如果原图片个数小于待删除的图片序号，则报错，图片序号错误。
	 **/
	private $position;

	private $apiParas = array();

	public function setGid($gid) {
		$this->gid = $gid;
		$this->apiParas["gid"] = $gid;
	}

	public function getGid() {
		return $this->gid;
	}

	public function setPosition($position) {
		$this->position = $position;
		$this->apiParas["position"] = $position;
	}

	public function getPosition() {
		return $this->position;
	}

	public function getApiMethodName() {
		return "taobao.hotel.room.img.delete";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->gid, "gid");
		Taobao_RequestCheckUtil::checkNotNull($this->position, "position");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
