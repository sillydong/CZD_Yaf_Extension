<?php

/**
 * chenzhidong
 * 2013-1-9
 */
class Taobao {
	private static $appkey = APP_KEY;
	private static $appsecret = APP_SECRET;
	private static $outercode = "cye";

	protected static $client;

	function __construct() {
		self::$client = new Taobao_TopClient();
		self::$client->appkey = self::$appkey;
		self::$client->secretKey = self::$appsecret;
	}

	protected static function getInstance() {
		if (self::$client == null)
		{
			new Taobao();
		}

		return self::$client;
	}

	public static function ItemGet($id_taobao, $fields = 'all') {
		$req = new Taobao_Request_ItemGetRequest();
		if ($fields == 'all')
		{
			$req->setFields("detail_url,num_iid,title,nick,skus,created,auction_point,property_alias,is_xinpin,food_security,desc_module_info,item_weight,item_size,with_hold_quantity,cid,seller_cids,props,input_pids,input_str,pic_url,num,valid_thru,list_time,delist_time,stuff_status,location,price,post_fee,express_fee,ems_fee,has_discount,freight_payer,has_invoice,has_warranty,has_showcase,modified,approve_status,product_id,item_imgs,prop_imgs,outer_id,is_virtual,is_timing,violation,wap_desc,wap_detail_url");
		}
		else
		{
			$req->setFields($fields);
		}
		$req->setNumIid($id_taobao);

		//$req->setTrackIid();
		return self::getInstance()->execute($req);
	}

}
