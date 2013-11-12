<?php
/**
 * chenzhidong
 * 2013-6-6
 */

class WeiXin {
	const MSG_TYPE_TEXT = 'text';
	const MSG_TYPE_LOCATION = 'location';
	const MSG_TYPE_IMAGE = 'image';
	const MSG_TYPE_LINK = 'link';
	const MSG_TYPE_EVENT = 'event';

	const MSG_EVENT_SUBSCRIBE = 'subscribe';
	const MSG_EVENT_UNSUBSCRIBE = 'unsubscribe';
	const MSG_EVENT_CLICK = 'CLICK';

	const REPLY_TYPE_TEXT = 'text';
	const REPLY_TYPE_MUSIC = 'music';
	const REPLY_TYPE_NEWS = 'news';

	private $token;
	private $postStr;
	private $postObj;

	public function __construct($token) {
		$this->token = $token;
		if ($this->checkSignature()) {
			$this->handleRequest();
		}
		else {
			die("Invalid request");
		}
	}

	private function checkSignature() {
		if (!isset($_GET['signature']) || !isset($_GET['timestamp']) || !isset($_GET['nonce'])) {
			return false;
		}
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];

		$tmpArr = array($this->token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);

		if ($tmpStr == $signature) {
			return true;
		}
		else {
			return false;
		}
	}

	private function handleRequest() {
		if (isset($_GET['echostr'])) {
			echo $_GET['echostr'];
			exit;
		}
		else {
			$this->postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
			if (!empty($this->postStr)) {
				$this->postObj = simplexml_load_string($this->postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			}
			if (empty($this->postObj)) {
				Log::simpleappend('fail', $this->postStr);
				echo "";
				exit;
			}
		}
	}

	public function getToUserName() {
		return $this->postObj->ToUserName;
	}

	public function getFromUserName() {
		return $this->postObj->FromUserName;
	}

	public function getPostObj() {
		return $this->postObj;
	}

	public function getPostStr() {
		return $this->postStr;
	}

	public function requestTime() {
		return strval($this->postObj->CreateTime);
	}

	public function isTextMessage() {
		return $this->postObj->MsgType == self::MSG_TYPE_TEXT;
	}

	public function requestText() {
		return strval($this->postObj->Content);
	}

	public function isLocationMessage() {
		return $this->postObj->MsgType == self::MSG_TYPE_LOCATION;
	}

	public function requestLocation() {
		$location = array();
		$location['Location_X'] = strval($this->postObj->Location_X);
		$location['Location_Y'] = strval($this->postObj->Location_Y);
		$location['Scale'] = strval($this->postObj->Scale);
		$location['Label'] = strval($this->postObj->Label);
		return $location;
	}

	public function isImageMessage() {
		return $this->postObj->MsgType == self::MSG_TYPE_IMAGE;
	}

	public function requestImage() {
		return strval($this->postObj->PicUrl);
	}

	public function isLinkMessage() {
		return $this->postObj->MsgType == self::MSG_TYPE_LINK;
	}

	public function requestLink() {
		$link = array();
		$link['Title'] = strval($this->postObj->Title);
		$link['Description'] = strval($this->postObj->Description);
		$link['Url'] = strval($this->postObj->Url);
		return $link;
	}

	public function isSubscribe() {
		return $this->postObj->MsgType == self::MSG_TYPE_EVENT && $this->postObj->Event == self::MSG_EVENT_SUBSCRIBE;
	}

	public function isUnSubscribe() {
		return $this->postObj->MsgType == self::MSG_TYPE_EVENT && $this->postObj->Event == self::MSG_EVENT_UNSUBSCRIBE;
	}

	public function isMenuClick() {
		return $this->postObj->MsgType == self::MSG_TYPE_EVENT && $this->postObj->Event == self::MSG_EVENT_CLICK;
	}

	public function requestMenuKey() {
		return strval($this->postObj->EventKey);
	}

	public function responseTextMessage($content) {
		$textTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[%s]]></MsgType>
		<Content><![CDATA[%s]]></Content>
		<FuncFlag>0</FuncFlag>
		</xml>";
		$resultStr = sprintf($textTpl, $this->postObj->FromUserName, $this->postObj->ToUserName, $_SERVER['REQUEST_TIME'], self::REPLY_TYPE_TEXT, $content);
		if (!headers_sent()) {
			header('Content-Type: application/xml; charset=utf-8');
		}
		echo $resultStr;
	}

	public function responseNewsMessage($items) {
		$textTpl = '<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[%s]]></MsgType>
		<ArticleCount>%d</ArticleCount>
		<Articles>%s</Articles>
		</xml>';

		$itemTpl = '<item>
		<Title><![CDATA[%s]]></Title>
		<Discription><![CDATA[%s]]></Discription>
		<PicUrl><![CDATA[%s]]></PicUrl>
		<Url><![CDATA[%s]]></Url>
		</item>';

		$articles = '';
		foreach ($items as $item) {
			if (is_array($item) && isset($item['Title']) && isset($item['Description']) && isset($item['PicUrl']) && isset($item['Url'])) {
				$articles .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
			}
			else {
				throw new Exception("item => array('Title'=>'','Description'=>'','PicUrl'=>'','Url'=>'')");
			}
		}

		$resultStr = sprintf($textTpl, $this->postObj->FromUserName, $this->postObj->ToUserName, $_SERVER['REQUEST_TIME'], self::REPLY_TYPE_NEWS, count($items), $articles);
		if (!headers_sent()) {
			header('Content-Type: application/xml; charset=utf-8');
		}
		echo $resultStr;
	}

	public function responseMusicMessage($title, $description, $url, $hq_url = null) {
		$textTpl = '<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[%s]]></MsgType>
		<Music>
		<Title><![CDATA[%s]]></Title>
		<Description><![CDATA[%s]]></Description>
		<MusicUrl><![CDATA[%s]]></MusicUrl>
		<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
		</Music>
		</xml>';
		$resultStr = sprintf($textTpl, $this->postObj->FromUserName, $this->postObj->ToUserName, $_SERVER['REQUEST_TIME'], self::REPLY_TYPE_MUSIC, $title, $description, $url, ($hq_url == null ? $url : $hq_url));
		if (!headers_sent()) {
			header('Content-Type: application/xml; charset=utf-8');
		}
		echo $resultStr;
	}

}
