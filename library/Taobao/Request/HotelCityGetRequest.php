<?php

/**
 * TOP API: taobao.hotel.city.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_HotelCityGetRequest {
	/**
	 * 国家编码
	 **/
	private $country;

	private $apiParas = array();

	public function setCountry($country) {
		$this->country = $country;
		$this->apiParas["country"] = $country;
	}

	public function getCountry() {
		return $this->country;
	}

	public function getApiMethodName() {
		return "taobao.hotel.city.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->country, "country");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
