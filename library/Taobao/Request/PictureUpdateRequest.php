<?php

/**
 * TOP API: taobao.picture.update request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_PictureUpdateRequest {
	/**
	 * 新的图片名，最大长度50字符，不能为空
	 **/
	private $newName;

	/**
	 * 要更改名字的图片的id
	 **/
	private $pictureId;

	private $apiParas = array();

	public function setNewName($newName) {
		$this->newName = $newName;
		$this->apiParas["new_name"] = $newName;
	}

	public function getNewName() {
		return $this->newName;
	}

	public function setPictureId($pictureId) {
		$this->pictureId = $pictureId;
		$this->apiParas["picture_id"] = $pictureId;
	}

	public function getPictureId() {
		return $this->pictureId;
	}

	public function getApiMethodName() {
		return "taobao.picture.update";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->newName, "newName");
		Taobao_RequestCheckUtil::checkMaxLength($this->newName, 50, "newName");
		Taobao_RequestCheckUtil::checkNotNull($this->pictureId, "pictureId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
