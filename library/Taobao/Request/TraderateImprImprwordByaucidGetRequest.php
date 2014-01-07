<?php

/**
 * TOP API: taobao.traderate.impr.imprword.byaucid.get request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_TraderateImprImprwordByaucidGetRequest {
	/**
	 * 淘宝的商品id
	 **/
	private $auctionId;

	private $apiParas = array();

	public function setAuctionId($auctionId) {
		$this->auctionId = $auctionId;
		$this->apiParas["auction_id"] = $auctionId;
	}

	public function getAuctionId() {
		return $this->auctionId;
	}

	public function getApiMethodName() {
		return "taobao.traderate.impr.imprword.byaucid.get";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->auctionId, "auctionId");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
