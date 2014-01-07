<?php

/**
 * TOP API: taobao.jipiao.policies.fulladd request
 *
 * @author auto create
 * @since  1.0, 2013-09-13 16:51:03
 */
class Taobao_Request_JipiaoPoliciesFulladdRequest {
	/**
	 * (ZIP压缩UTF-8编码JSON)，压缩前格式为:[{数据结构BatchPolicy的json格式},{数据结构BatchPolicy的json格式},...] 示例：
	 * [{
	 * "attributes": "rfc=1;ipt=1;fdtod=0000;ldtod=2359",
	 * "source": null,
	 * "airline": "CZ",
	 * "arrAirports": "CSX,CTU,CAN",
	 * "autoHkFlag": true,
	 * "autoTicketFlag": true,
	 * "cabinRules": "[{\"matcher\":{\"mode\":\"ALL\",\"list\":[\"Y\"]},\"priceStrategy\":{\"mode\":\"DISCOUNT\",\"modeBaseValue\":null,\"retention\":5000,\"rebase\":-5},\"backMatcher\":null}]",
	 * "changeRule": null,
	 * "dayOfWeeks": "1234",
	 * "depAirports": "PEK",
	 * "ei": "ei",
	 * "excludeDate": null,
	 * "firstSaleAdvanceDay": null,
	 * "flags": null,
	 * "flightInfo": "+CA1234,CZ2345",
	 * "lastSaleAdvanceDay": null,
	 * "memo": "memoUpdate",
	 * "officeId": "RRR003",
	 * "outProductId": "46f9b762-ea50-4c71-877b-45fa2936277e",
	 * "policyType": 8,
	 * "refundRule": null,
	 * "reissueRule": null,
	 * "saleEndDate": "2013-06-19 00:00:00",
	 * "saleStartDate": "2013-06-09 00:00:00",
	 * "seatInfo": null,
	 * "shareSupport": false,
	 * "specialRule": null,
	 * "travelEndDate": "2013-06-19 00:00:00",
	 * "travelStartDate": "2013-06-09 00:00:00"
	 * }
	 * ]
	 **/
	private $compressedPolicies;

	private $apiParas = array();

	public function setCompressedPolicies($compressedPolicies) {
		$this->compressedPolicies = $compressedPolicies;
		$this->apiParas["compressed_policies"] = $compressedPolicies;
	}

	public function getCompressedPolicies() {
		return $this->compressedPolicies;
	}

	public function getApiMethodName() {
		return "taobao.jipiao.policies.fulladd";
	}

	public function getApiParas() {
		return $this->apiParas;
	}

	public function check() {

		Taobao_RequestCheckUtil::checkNotNull($this->compressedPolicies, "compressedPolicies");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
