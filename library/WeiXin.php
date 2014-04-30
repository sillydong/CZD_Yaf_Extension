<?php

/**
 * chenzhidong
 * 2013-6-6
 */
class WeiXin {
	const MSG_TYPE_TEXT = 'text';
	const MSG_TYPE_IMAGE = 'image';
	const MSG_TYPE_VOICE = 'voice';
	const MSG_TYPE_VIDEO = 'video';
	const MSG_TYPE_LOCATION = 'location';
	const MSG_TYPE_LINK = 'link';
	const MSG_TYPE_EVENT = 'event';

	const MSG_EVENT_SUBSCRIBE = 'subscribe';
	const MSG_EVENT_UNSUBSCRIBE = 'unsubscribe';
	const MSG_EVENT_SCAN = 'scan';
	const MSG_EVENT_LOCATION = 'LOCATION';
	const MSG_EVENT_CLICK = 'CLICK';

	const REPLY_TYPE_TEXT = 'text';
	const REPLY_TYPE_IMAGE = 'image';
	const REPLY_TYPE_VOICE = 'voice';
	const REPLY_TYPE_VIDEO = 'video';
	const REPLY_TYPE_MUSIC = 'music';
	const REPLY_TYPE_NEWS = 'news';

	const MEDIA_TYPE_IMAGE = "image";
	const MEDIA_TYPE_VOICE = 'voice';
	const MEDIA_TYPE_VIDEO = 'video';
	const MEDIA_TYPE_THUMB = 'thumb';

	const SCOPE_REDIRECT = "snsapi_base";
	const SCOPE_POP = "snsapi_userinfo";

	private static $links = array(
			'message' => "https://api.weixin.qq.com/cgi-bin/message/custom/send",
			'group_create' => "https://api.weixin.qq.com/cgi-bin/groups/create",
			'group_get' => "https://api.weixin.qq.com/cgi-bin/groups/get",
			'group_getid' => "https://api.weixin.qq.com/cgi-bin/groups/getid",
			'group_rename' => "https://api.weixin.qq.com/cgi-bin/groups/update",
			'group_move' => "https://api.weixin.qq.com/cgi-bin/groups/members/update",
			'user_info' => "https://api.weixin.qq.com/cgi-bin/user/info",
			'user_get' => 'https://api.weixin.qq.com/cgi-bin/user/get',
			'menu_create' => 'https://api.weixin.qq.com/cgi-bin/menu/create',
			'menu_get' => 'https://api.weixin.qq.com/cgi-bin/menu/get',
			'menu_delete' => 'https://api.weixin.qq.com/cgi-bin/menu/delete',
			'qrcode' => 'https://api.weixin.qq.com/cgi-bin/qrcode/create',
			'showqrcode' => 'https://mp.weixin.qq.com/cgi-bin/showqrcode',
			'media_download' => 'http://file.api.weixin.qq.com/cgi-bin/media/get',
			'media_upload' => 'http://file.api.weixin.qq.com/cgi-bin/media/upload',
			'oauth_code' => 'https://open.weixin.qq.com/connect/oauth2/authorize',
			'oauth_access_token' => 'https://api.weixin.qq.com/sns/oauth2/access_token',
			'oauth_refresh' => 'https://api.weixin.qq.com/sns/oauth2/refresh_token',
			'oauth_userinfo' => 'https://api.weixin.qq.com/sns/userinfo'
	);

	private static $errors = array(
			'-1' => '系统繁忙',
			'0' => '请求成功',
			'40001' => '获取access_token时AppSecret错误，或者access_token无效',
			'40002' => '不合法的凭证类型',
			'40003' => '不合法的OpenID',
			'40004' => '不合法的媒体文件类型',
			'40005' => '不合法的文件类型',
			'40006' => '不合法的文件大小',
			'40007' => '不合法的媒体文件id',
			'40008' => '不合法的消息类型',
			'40009' => '不合法的图片文件大小',
			'40010' => '不合法的语音文件大小',
			'40011' => '不合法的视频文件大小',
			'40012' => '不合法的缩略图文件大小',
			'40013' => '不合法的APPID',
			'40014' => '不合法的access_token',
			'40015' => '不合法的菜单类型',
			'40016' => '不合法的按钮个数',
			'40017' => '不合法的按钮个数',
			'40018' => '不合法的按钮名字长度',
			'40019' => '不合法的按钮KEY长度',
			'40020' => '不合法的按钮URL长度',
			'40021' => '不合法的菜单版本号',
			'40022' => '不合法的子菜单级数',
			'40023' => '不合法的子菜单按钮个数',
			'40024' => '不合法的子菜单按钮类型',
			'40025' => '不合法的子菜单按钮名字长度',
			'40026' => '不合法的子菜单按钮KEY长度',
			'40027' => '不合法的子菜单按钮URL长度',
			'40028' => '不合法的自定义菜单使用用户',
			'40029' => '不合法的oauth_code',
			'40030' => '不合法的refresh_token',
			'40031' => '不合法的openid列表',
			'40032' => '不合法的openid列表长度',
			'40033' => '不合法的请求字符，不能包含\uxxxx格式的字符',
			'40035' => '不合法的参数',
			'40038' => '不合法的请求格式',
			'40039' => '不合法的URL长度',
			'40050' => '不合法的分组id',
			'40051' => '分组名字不合法',
			'41001' => '缺少access_token参数',
			'41002' => '缺少appid参数',
			'41003' => '缺少refresh_token参数',
			'41004' => '缺少secret参数',
			'41005' => '缺少多媒体文件数据',
			'41006' => '缺少media_id参数',
			'41007' => '缺少子菜单数据',
			'41008' => '缺少oauth code',
			'41009' => '缺少openid',
			'42001' => 'access_token超时',
			'42002' => 'refresh_token超时',
			'42003' => 'oauth_code超时',
			'43001' => '需要GET请求',
			'43002' => '需要POST请求',
			'43003' => '需要HTTPS请求',
			'43004' => '需要接收者关注',
			'43005' => '需要好友关系',
			'44001' => '多媒体文件为空',
			'44002' => 'POST的数据包为空',
			'44003' => '图文消息内容为空',
			'44004' => '文本消息内容为空',
			'45001' => '多媒体文件大小超过限制',
			'45002' => '消息内容超过限制',
			'45003' => '标题字段超过限制',
			'45004' => '描述字段超过限制',
			'45005' => '链接字段超过限制',
			'45006' => '图片链接字段超过限制',
			'45007' => '语音播放时间超过限制',
			'45008' => '图文消息超过限制',
			'45009' => '接口调用超过限制',
			'45010' => '创建菜单个数超过限制',
			'45015' => '回复时间超过限制',
			'45016' => '系统分组，不允许修改',
			'45017' => '分组名字过长',
			'45018' => '分组数量超过上限',
			'46001' => '不存在媒体数据',
			'46002' => '不存在的菜单版本',
			'46003' => '不存在的菜单数据',
			'46004' => '不存在的用户',
			'47001' => '解析JSON/XML内容错误',
			'48001' => 'api功能未授权',
			'50001' => '用户未授权该api'
	);

	private static $debug = false;

	private $token;
	private $postStr;
	private $postObj;

	private $appid;
	private $appsecret;
	private $access_token;
	private $valid = 0;

	/**
	 * @param      $token
	 * @param null $appid
	 * @param null $appsecret
	 * @param bool $debug
	 */
	public function __construct($token, $appid = null, $appsecret = null, $debug = false) {
		$this->token = $token;
		self::$debug = $debug;
		if (!empty($_GET) && $this->checkSignature())
			$this->handleRequest();
		$this->appid = $appid;
		$this->appsecret = $appsecret;

	}

	/**
	 * 检查签名
	 *
	 * @return bool
	 */
	private function checkSignature() {
		if (self::$debug)
			return true;
		if (!isset($_GET['signature']) || !isset($_GET['timestamp']) || !isset($_GET['nonce']))
			return false;
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];

		$tmpArr = array($this->token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);

		if ($tmpStr == $signature)
			return true;
		else
			return false;
	}

	/**
	 * 处理请求
	 */
	private function handleRequest() {
		if (isset($_GET['echostr']))
		{
			echo $_GET['echostr'];
			exit;
		}
		else
		{
			if($GLOBALS['HTTP_RAW_POST_DATA'])
			{
				$this->postStr=$GLOBALS['HTTP_RAW_POST_DATA'];
				$this->postObj = simplexml_load_string($this->postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			}
			elseif($_GET['HTTP_RAW_POST_DATA'])
			{
				$this->postStr=$_GET['HTTP_RAW_POST_DATA'];
				$this->postObj=json_decode($this->postStr);
			}
			else
			{
				Log::simpleappend('fail', $this->postStr);
				exit;
			}
		}
	}

	/**
	 * 获取高级接口的access_token
	 *
	 * @return bool
	 */
	private function getAccessToken() {
		if ($this->appid && $this->appsecret)
		{
			if ($this->valid <= time())
			{
				$access = json_decode(Tools::curl("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appid}&secret={$this->appsecret}"));
				if (isset($access->access_token) && isset($access->expires_in))
				{
					$this->access_token = $access->access_token;
					$this->valid = time() + $access->expires_in;
				}
				else
					return false;
			}

			return true;
		}

		return false;
	}

	/**
	 * 获取请求中的收信人OpenId，一般为公众账号自身
	 *
	 * @return mixed
	 */
	public function getToUserName() {
		return $this->postObj->ToUserName;
	}

	/**
	 * 请求中的发信人OpenId
	 *
	 * @return mixed
	 */
	public function getFromUserName() {
		return $this->postObj->FromUserName;
	}

	/**
	 * 获取Object格式的消息内容
	 *
	 * @return mixed
	 */
	public function getPostObj() {
		return $this->postObj;
	}

	/**
	 * 获取字符串格式的消息内容
	 *
	 * @return mixed
	 */
	public function getPostStr() {
		return $this->postStr;
	}

	/**
	 * 获取消息ID
	 *
	 * @return mixed
	 */
	public function getMsgId() {
		return $this->postObj->MsgId;
	}

	/**
	 * 消息创建时间
	 *
	 * @return string
	 */
	public function getCreateTime() {
		return strval($this->postObj->CreateTime);
	}

	//获取消息类型
	public function getMsgType() {
		return $this->postObj->MsgType;
	}

	/**
	 * 获取事件推送的时间类型,非事件的消息返回false
	 *
	 * @return mixed
	 */
	public function getEvent() {
		if ($this->postObj->MsgType == self::MSG_TYPE_EVENT)
		{
			return $this->postObj->Event;
		}

		return false;
	}

	/**
	 * 是否为文本消息
	 *
	 * @return bool
	 */
	public function isTextMessage() {
		return $this->postObj->MsgType == self::MSG_TYPE_TEXT;
	}

	/**
	 * 是否为图片消息
	 *
	 * @return bool
	 */
	public function isImageMessage() {
		return $this->postObj->MsgType == self::MSG_TYPE_IMAGE;
	}

	/**
	 * 是否为语音消息
	 *
	 * @return bool
	 */
	public function isVoiceMessage() {
		return $this->postObj->MsgType == self::MSG_TYPE_VOICE;
	}

	/**
	 * 是否为视频消息
	 *
	 * @return bool
	 */
	public function isVideoMessage() {
		return $this->postObj->MsgType == self::MSG_TYPE_VIDEO;
	}

	/**
	 * 是否为地理位置消息
	 *
	 * @return bool
	 */
	public function isLocationMessage() {
		return $this->postObj->MsgType == self::MSG_TYPE_LOCATION;
	}

	/**
	 * 是否为链接消息
	 *
	 * @return bool
	 */
	public function isLinkMessage() {
		return $this->postObj->MsgType == self::MSG_TYPE_LINK;
	}

	/**
	 * 是否为普通关注事件
	 *
	 * @return bool
	 */
	public function isEventSubscribe() {
		return $this->postObj->MsgType == self::MSG_TYPE_EVENT && $this->postObj->Event == self::MSG_EVENT_SUBSCRIBE && !isset($this->postObj->EventKey);
	}

	/**
	 * 是否为取消关注事件
	 *
	 * @return bool
	 */
	public function isEventUnSubscribe() {
		return $this->postObj->MsgType == self::MSG_TYPE_EVENT && $this->postObj->Event == self::MSG_EVENT_UNSUBSCRIBE;
	}

	/**
	 * 是否为扫描二维码关注事件
	 *
	 * @return bool
	 */
	public function isEventScanSubscript() {
		return $this->postObj->MsgType == self::MSG_TYPE_EVENT && $this->postObj->Event == self::MSG_EVENT_SUBSCRIBE && isset($this->postObj->EventKey);
	}

	/**
	 * 是否为已关注扫描二维码事件
	 *
	 * @return bool
	 */
	public function isEventScan() {
		return $this->postObj->MsgType == self::MSG_TYPE_EVENT && $this->postObj->Event == self::MSG_EVENT_SCAN;
	}

	/**
	 * 是否为上报地理位置事件
	 *
	 * @return bool
	 */
	public function isEventLocation() {
		return $this->postObj->MsgType == self::MSG_TYPE_EVENT && $this->postObj->Event == self::MSG_EVENT_LOCATION;
	}

	/**
	 * 是否为菜单点击事件
	 *
	 * @return bool
	 */
	public function isEventClick() {
		return $this->postObj->MsgType == self::MSG_TYPE_EVENT && $this->postObj->Event == self::MSG_EVENT_CLICK;
	}

	/**
	 * 获取文本消息内容
	 *
	 * @return string
	 */
	public function requestText() {
		return strval($this->postObj->Content);
	}

	/**
	 * 获取图片消息内容
	 *
	 * @return array
	 */
	public function requestImage() {
		$image = array();
		$image['PicUrl'] = strval($this->postObj->PicUrl);
		$image['MediaId'] = strval($this->postObj->MediaId);

		return $image;
	}

	/**
	 * 获取语音消息内容，可能包含语音识别结果
	 *
	 * @return array
	 */
	public function requestVoice() {
		$voice = array();
		$voice['MediaId'] = $this->postObj->MediaId;
		$voice['Format'] = $this->postObj->Format;
		if (isset($this->postObj->Recognition))
			$voice['Recognition'] = $this->postObj->Recognition;

		return $voice;
	}

	/**
	 * 获取视频消息内容
	 *
	 * @return array
	 */
	public function requestVideo() {
		$video = array();
		$video['MediaId'] = $this->postObj->MediaId;
		$video['ThumbMediaId'] = $this->postObj->ThumbMediaId;

		return $video;
	}

	/**
	 * 获取地理位置消息内容
	 *
	 * @return array
	 */
	public function requestLocation() {
		$location = array();
		$location['Location_X'] = strval($this->postObj->Location_X);
		$location['Location_Y'] = strval($this->postObj->Location_Y);
		$location['Scale'] = strval($this->postObj->Scale);
		$location['Label'] = strval($this->postObj->Label);

		return $location;
	}

	/**
	 * 获取链接消息内容
	 *
	 * @return array
	 */
	public function requestLink() {
		$link = array();
		$link['Title'] = strval($this->postObj->Title);
		$link['Description'] = strval($this->postObj->Description);
		$link['Url'] = strval($this->postObj->Url);

		return $link;
	}

	/**
	 * 获取扫描二维码事件内容
	 *
	 * @return array
	 */
	public function requestEventScan() {
		$info = array();
		$info['EventKey'] = $this->postObj->EventKey;
		$info['Ticket'] = $this->postObj->Ticket;
		$info['Scene_Id'] = str_replace('qrscene_', '', $this->postObj->EventKey);

		return $info;
	}

	/**
	 * 获取上报地理位置事件内容
	 *
	 * @return array
	 */
	public function requestEventLocation() {
		$location = array();
		$location['Latitude'] = $this->postObj->Latitude;
		$location['Longitude'] = $this->postObj->Longitude;
		$location['Precision'] = $this->postObj->Precision;

		return $location;
	}

	/**
	 * 获取菜单点击事件内容
	 *
	 * @return string
	 */
	public function requestEventClick() {
		return strval($this->postObj->EventKey);
	}

	/**
	 * GET方法
	 *
	 * @param $link
	 *
	 * @return mixed
	 */
	private static function get($link) {
		if (self::$debug)
			Log::out("weixin_debug", 'I', "get:" . $link);

		return json_decode(Tools::curl($link));
	}

	/**
	 * POST方法
	 *
	 * @param $link
	 * @param $data
	 *
	 * @return mixed
	 */
	private static function post($link, $data) {
		if (self::$debug)
			Log::out("weixin_debug", 'I', "post:", $link . ":" . serialize($data));

		return json_decode(Tools::curl($link, 'POST', $data));
	}

	/**
	 * 向微信服务器ECHO内容
	 *
	 * @param $content
	 */
	private static function response($content) {
		if (self::$debug)
			Log::out("weixin_debug", 'I', 'echo:' . $content);
		echo $content;
	}

	/**
	 * 获取错误代码中文描述
	 *
	 * @param $errorcode
	 *
	 * @return mixed
	 */
	public static function error($errorcode) {
		return self::$errors[$errorcode];
	}

	/**
	 * 回复文本消息
	 *
	 * @param $content
	 */
	public function responseTextMessage($content) {
		$textTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[%s]]></MsgType>
		<Content><![CDATA[%s]]></Content>
		</xml>";
		$resultStr = sprintf($textTpl, $this->postObj->FromUserName, $this->postObj->ToUserName, time(), self::REPLY_TYPE_TEXT, $content);
		if (!headers_sent())
			header('Content-Type: application/xml; charset=utf-8');
		self::response($resultStr);
	}

	/**
	 * 回复图片消息
	 *
	 * @param $mediaid
	 */
	public function responseImageMessage($mediaid) {
		$textTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[%s]]></MsgType>
		<Image>
		<MediaId><![CDATA[%s]]></MediaId>
		</Image>
		</xml>";
		$resultStr = sprintf($textTpl, $this->postObj->FromUserName, $this->postObj->ToUserName, time(), self::REPLY_TYPE_IMAGE, $mediaid);
		if (!headers_sent())
			header('Content-Type: application/xml; charset=utf-8');
		self::response($resultStr);
	}

	/**
	 * 回复语音消息
	 *
	 * @param $mediaid
	 */
	public function responseVoiceMessage($mediaid) {
		$textTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[%s]]></MsgType>
		<Voice>
		<MediaId><![CDATA[%s]]></MediaId>
		</Voice>
		</xml>";
		$resultStr = sprintf($textTpl, $this->postObj->FromUserName, $this->postObj->ToUserName, time(), self::REPLY_TYPE_VOICE, $mediaid);
		if (!headers_sent())
			header('Content-Type: application/xml; charset=utf-8');
		self::response($resultStr);
	}

	/**
	 * 回复视频消息
	 *
	 * @param        $mediaid
	 * @param string $title
	 * @param string $description
	 */
	public function responseVideoMessage($mediaid, $title = "", $description = "") {
		$textTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[%s]]></MsgType>
		<Video>
		<MediaId><![CDATA[%s]]></MediaId>
		<Title><![CDATA[%s]]></Title>
		<Description><![CDATA[%s]]></Description>
		</Video>
		</xml>";
		$resultStr = sprintf($textTpl, $this->postObj->FromUserName, $this->postObj->ToUserName, time(), self::REPLY_TYPE_VIDEO, $mediaid, $title, $description);
		if (!headers_sent())
			header('Content-Type: application/xml; charset=utf-8');
		self::response($resultStr);
	}

	/**
	 * 回复音乐消息
	 *
	 * @param string $title
	 * @param string $description
	 * @param string $url
	 * @param string $hq_url
	 */
	public function responseMusicMessage($title = '', $description = '', $url = '', $hq_url = '') {
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
		$resultStr = sprintf($textTpl, $this->postObj->FromUserName, $this->postObj->ToUserName, time(), self::REPLY_TYPE_MUSIC, $title, $description, $url, $hq_url);
		if (!headers_sent())
			header('Content-Type: application/xml; charset=utf-8');
		self::response($resultStr);
	}

	/**
	 * 回复图文消息
	 *
	 * @param $items
	 *
	 * @throws Exception
	 */
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
		<Description><![CDATA[%s]]></Description>
		<PicUrl><![CDATA[%s]]></PicUrl>
		<Url><![CDATA[%s]]></Url>
		</item>';

		$articles = '';
		if ($items && is_array($items))
		{
			foreach ($items as $item)
			{
				if (is_array($item) && (isset($item['Title']) || isset($item['Description']) || isset($item['PicUrl']) || isset($item['Url'])))
					$articles .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
				else
					throw new Exception("item => array('Title'=>'','Description'=>'','PicUrl'=>'','Url'=>'')");
			}
		}

		$resultStr = sprintf($textTpl, $this->postObj->FromUserName, $this->postObj->ToUserName, time(), self::REPLY_TYPE_NEWS, count($items), $articles);
		if (!headers_sent())
			header('Content-Type: application/xml; charset=utf-8');
		self::response($resultStr);
	}

	/**发送文本客服消息，需要access_token
	 *
	 * @param $openid
	 * @param $content
	 *
	 * @return bool|mixed
	 */
	public function sendTextMessage($openid, $content) {
		if ($this->getAccessToken())
		{
			$message = array();
			$message['touser'] = $openid;
			$message['msgtype'] = "text";
			$message['text']['content'] = $content;

			return self::post(self::$links['message'] . "?access_token={$this->access_token}", json_encode($message, JSON_UNESCAPED_UNICODE));
		}

		return false;
	}

	/**
	 * 发送图片客服消息，需要access_token
	 *
	 * @param $openid
	 * @param $mediaid
	 *
	 * @return bool|mixed
	 */
	public function sendImageMessage($openid, $mediaid) {
		if ($this->getAccessToken())
		{
			$message = array();
			$message['touser'] = $openid;
			$message['msgtype'] = "image";
			$message['image']['media_id'] = $mediaid;

			return self::post(self::$links['message'] . "?access_token={$this->access_token}", json_encode($message, JSON_UNESCAPED_UNICODE));
		}

		return false;
	}

	/**
	 * 发送语音客服消息，需要access_token
	 *
	 * @param $openid
	 * @param $media_id
	 *
	 * @return bool|mixed
	 */
	public function sendVoiceMessage($openid, $media_id) {
		if ($this->getAccessToken())
		{
			$message = array();
			$message['touser'] = $openid;
			$message['msgtype'] = "voice";
			$message['voice']['media_id'] = $media_id;

			return self::post(self::$links['message'] . "?access_token={$this->access_token}", json_encode($message, JSON_UNESCAPED_UNICODE));
		}

		return false;
	}

	/**
	 * 发送视频客服消息，需要access_token
	 *
	 * @param        $openid
	 * @param        $media_id
	 * @param string $title
	 * @param string $description
	 *
	 * @return bool|mixed
	 */
	public function sendVideoMessage($openid, $media_id, $title = "", $description = "") {
		if ($this->getAccessToken())
		{
			$message = array();
			$message['touser'] = $openid;
			$message['msgtype'] = "video";
			$message['video']['media_id'] = $media_id;
			$message['video']['title'] = $title;
			$message['video']['description'] = $description;

			return self::post(self::$links['message'] . "?access_token={$this->access_token}", json_encode($message, JSON_UNESCAPED_UNICODE));
		}

		return false;
	}

	/**
	 * 发送音乐客服消息，需要access_token
	 *
	 * @param        $openid
	 * @param        $url
	 * @param        $hq_url
	 * @param        $media_id
	 * @param string $title
	 * @param string $description
	 *
	 * @return bool|mixed
	 */
	public function sendMusicMessage($openid, $url, $hq_url, $media_id, $title = "", $description = "") {
		if ($this->getAccessToken())
		{
			$message = array();
			$message['touser'] = $openid;
			$message['msgtype'] = "music";
			$message['music']['title'] = $title;
			$message['music']['description'] = $description;
			$message['music']['musicurl'] = $url;
			$message['music']['hqmusicurl'] = $hq_url;
			$message['music']['thumb_media_id'] = $media_id;

			return self::post(self::$links['message'] . "?access_token={$this->access_token}", json_encode($message, JSON_UNESCAPED_UNICODE));
		}

		return false;
	}

	/**
	 * 发送图文客服消息，需要access_token
	 *
	 * @param $openid
	 * @param $items
	 *
	 * @return bool|mixed
	 * @throws Exception
	 */
	public function sendNewsMessage($openid, $items) {
		if ($this->getAccessToken())
		{
			$message = array();
			$message['touser'] = $openid;
			$message['msgtype'] = "news";
			if ($items && is_array($items))
			{
				foreach ($items as $item)
				{
					if (is_array($item) && (isset($item['Title']) || isset($item['Description']) || isset($item['PicUrl']) || isset($item['Url'])))
					{
						$it['title'] = isset($item['Title']) ? $item['Title'] : "";
						$it['description'] = isset($item['Description']) ? $item['Description'] : "";
						$it['url'] = isset($item['Url']) ? $item['Url'] : "";
						$it['picurl'] = isset($item['PicUrl']) ? $item['PicUrl'] : "";
						if ($it['title'] && $it['description'] && $it['url'] && $it['picurl'])
							$message['news']['articles'][] = $it;
					}
					else
						throw new Exception("item => array('Title'=>'','Description'=>'','PicUrl'=>'','Url'=>'')");
				}
			}

			return self::post(self::$links['message'] . "?access_token={$this->access_token}", json_encode($message, JSON_UNESCAPED_UNICODE));
		}

		return false;
	}

	/**
	 * 创建分组
	 *
	 * @param $name
	 *
	 * @return bool|mixed
	 */
	public function groupCreate($name) {
		if ($this->getAccessToken())
		{
			$message = array();
			$message['name'] = $name;

			return self::post(self::$links['group_create'] . "?access_token={$this->access_token}", json_encode($message, JSON_UNESCAPED_UNICODE));
		}

		return false;
	}

	/**
	 * 查询所有分组
	 *
	 * @return bool|mixed
	 */
	public function groupGetAll() {
		if ($this->getAccessToken())
		{
			return self::get(self::$links['group_get'] . "?access_token={$this->access_token}");
		}

		return false;
	}

	/**
	 * 查询用户所在分组
	 *
	 * @param $openid
	 *
	 * @return bool|mixed
	 */
	public function groupGet($openid) {
		if ($this->getAccessToken())
		{
			$message = array();
			$message['openid'] = $openid;

			return self::post(self::$links['group_getid'] . "?access_token={$this->access_token}", json_encode($message, JSON_UNESCAPED_UNICODE));
		}

		return false;
	}

	/**
	 * 修改分组名
	 *
	 * @param $groupid
	 * @param $name
	 *
	 * @return bool|mixed
	 */
	public function groupRename($groupid, $name) {
		if ($this->getAccessToken())
		{
			$message = array();
			$message['id'] = $groupid;
			$message['name'] = $name;

			return self::post(self::$links['group_rename'] . "?access_token={$this->access_token}", json_encode($message, JSON_UNESCAPED_UNICODE));
		}

		return false;
	}

	/**
	 * 移动用户分组
	 *
	 * @param $openid
	 * @param $to_groupid
	 *
	 * @return bool|mixed
	 */
	public function groupMove($openid, $to_groupid) {
		if ($this->getAccessToken())
		{
			$message = array();
			$message['openid'] = $openid;
			$message['to_groupid'] = $to_groupid;

			return self::post(self::$links['group_move'] . "?access_token={$this->access_token}", json_encode($message, JSON_UNESCAPED_UNICODE));
		}

		return false;
	}

	/**
	 * 获取用户基本信息
	 *
	 * @param $openid
	 *
	 * @return bool|mixed
	 */
	public function userInfo($openid) {
		if ($this->getAccessToken())
		{
			return self::get(self::$links['user_info'] . "?access_token={$this->access_token}&openid={$openid}");
		}

		return false;
	}

	/**
	 * 获取关注者列表
	 *
	 * @param null $next_openid
	 *
	 * @return bool|mixed
	 */
	public function userGet($next_openid = null) {
		if ($this->getAccessToken())
		{
			if ($next_openid)
				return self::get(self::$links['user_get'] . "?access_token={$this->access_token}&openid=");
			else
				return self::get(self::$links['user_get'] . "?access_token={$this->access_token}&next_openid={$next_openid}");
		}

		return false;
	}

	/**
	 * 创建自定义菜单
	 *
	 * @param $menus
	 *
	 * @return bool|mixed
	 */
	public function menuCreate($menus) {
		if ($this->getAccessToken())
		{
			$message = array();
			$message['button'] = $menus;

			return self::post(self::$links['menu_create'] . "?access_token={$this->access_token}", json_encode($message, JSON_UNESCAPED_UNICODE));
		}

		return false;
	}

	/**
	 * 获取自定义菜单
	 *
	 * @return bool|mixed
	 */
	public function menuGet() {
		if ($this->getAccessToken())
		{
			return self::get(self::$links['menu_get'] . "?access_token={$this->access_token}");
		}

		return false;
	}

	/**
	 * 删除自定义菜单
	 *
	 * @return bool|mixed
	 */
	public function menuDelete() {
		if ($this->getAccessToken())
		{
			return self::get(self::$links['menu_delete'] . "?access_token={$this->access_token}");
		}

		return false;
	}

	/**
	 * 生成带参数的二维码，通过expire_seconds可以设置临时二维码或永久二维码
	 *
	 * @param     $sceneid
	 * @param int $expire_seconds
	 *
	 * @return bool|mixed
	 */
	public function qrcodeCreate($sceneid, $expire_seconds = 0) {
		if ($this->getAccessToken())
		{
			$message = array();
			if ($expire_seconds > 0)
			{
				if ($expire_seconds > 1800)
					return false;
				$message['expire_seconds'] = $expire_seconds;
				$message['action_name'] = 'QR_SCENE';
			}
			else
				$message['action_name'] = 'QR_LIMIT_SCENE';
			$message['action_info']['scene']['scene_id'] = $sceneid;

			return self::post(self::$links['qrcode'] . "?access_token={$this->access_token}", json_encode($message, JSON_UNESCAPED_UNICODE));
		}

		return false;
	}

	/**
	 * 用ticket换取二维码图片，返回结果未图片，可以直接展示或者下载
	 *
	 * @param $ticket
	 *
	 * @return mixed
	 */
	public static function qrcodeGet($ticket) {
		return self::get(self::$links['showqrcode'] . "?tocket=" . urlencode($ticket));
	}

	/**
	 * 下载多媒体文件
	 *
	 * @param $mediaid
	 *
	 * @return mixed
	 */
	public function mediaDownload($mediaid) {
		return self::get(self::$links['media_download'] . "?access_token={$this->access_token}&media_id=" . $mediaid);
	}

	/**
	 * 上传多媒体文件
	 * 图片（image）: 128K，支持JPG格式
	 * 语音（voice）：256K，播放长度不超过60s，支持AMR\MP3格式
	 * 视频（video）：1MB，支持MP4格式
	 * 缩略图（thumb）：64KB，支持JPG格式
	 *
	 * @param $filetype
	 * @param $filepath
	 *
	 * @return bool|mixed
	 */
	public function mediaUpload($filetype, $filepath) {
		if ($this->getAccessToken() && file_exists($filepath))
		{
			$fileext = strtolower(Tools::getFileExtension($filepath));
			$filesize = filesize($filepath);
			switch ($filetype)
			{
				case self::MEDIA_TYPE_IMAGE:
					if ($fileext != 'jpg' || $filesize > 128 * 1024)
						return false;
					break;
				case self::MEDIA_TYPE_VOICE:
					if (!in_array($fileext, array('amr', 'mp3')) || $filesize > 256 * 1024)
						return false;
					break;
				case self::MEDIA_TYPE_VIDEO:
					if ($fileext != 'mp4' || $filesize > 1024 * 1024)
						return false;
					break;
				case self::MEDIA_TYPE_THUMB:
					if ($fileext != 'jpg' || $filesize > 64 * 1024)
						return false;
					break;
				default:
					return false;
					break;
			}
			$media = array();
			$media['access_token'] = $this->access_token;
			$media['type'] = $filetype;
			$media['media'] = '@' . $filepath;

			return self::post(self::$links['media_upload'], $media);
		}

		return false;
	}

	/**
	 * 第三方网页通过Oauth2.0获取用户授权
	 * 获取code
	 */
	public function oauthGetCode($redirect, $scope, $state) {
		return self::$links['oauth_code'] . "?appid={$this->appid}&redirect_uri={$redirect}&response_type=code&scope={$scope}&state={$state}#wechat_redirect";
	}

	/**
	 * 第三方网页通过Oauth2.0获取用户授权
	 * 通过code获取access_token
	 */
	public function oauthGetAccessToken($code) {
		return self::get(self::$links['oauth_access_token'] . "?appid={$this->appid}&secret={$this->appsecret}&code={$code}&grant_type=authorization_code");
	}

	/**
	 * 第三方网页通过Oauth2.0获取用户授权
	 * 刷新access_token
	 */
	public function oauthRefreshAccessToken($refresh_token) {
		return self::get(self::$links['oauth_refresh'] . "?appid={$this->appid}&grant_type=refresh_token&refresh_token={$refresh_token}");
	}

	/**
	 * 第三方网页通过Oauth2.0获取用户权限
	 * 获取用户信息，仅限scope为SCOPE_POP
	 */
	public function oauthUserInfo($access_token, $openid) {
		return self::get(self::$links['oauth_userinfo'] . "?access_token={$access_token}&openid={$openid}");
	}

	/**
	 * 返回js代码，隐藏微信中网页右上角按钮
	 *
	 * @return string
	 */
	public static function hideOptionMenu() {
		return <<<EOF
<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	WeixinJSBridge.call('hideOptionMenu');
});
</script>
EOF;
	}

	/**
	 * 返回js代码，隐藏微信中网页底部导航栏
	 *
	 * @return string
	 */
	public static function hideToolbar() {
		return <<<EOF
<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	WeixinJSBridge.call('hideToolbar');
});
</script>
EOF;
	}

	/**
	 * 返回js代码，网页获取用户网络状态
	 *
	 * @return string
	 */
	public static function getNetworkType() {
		return <<<EOF
<script type="text/javascript">
WeixinJSBridge.invoke('getNetworkType',{},
	function(e){
		WeixinJSBridge.log(e.err_msg);
	}
);
</script>
EOF;
	}
}
