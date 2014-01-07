<?php

/**
 * chenzhidong
 * 2013-1-9
 */
class Taobao_TopClient {
	public $appkey;
	public $secretKey;
	public $token;
	public $gatewayUrl = "http://gw.api.taobao.com/router/rest";
	public $format = "json";
	public $checkRequest = true;
	protected $signMethod = "md5";
	protected $apiVersion = "2.0";
	protected $sdkVersion = "top-sdk-php-20130913";

	protected function generateSign($params) {
		ksort($params);

		$stringToBeSigned = $this->secretKey;
		foreach ($params as $k => $v)
		{
			if ("@" != substr($v, 0, 1))
			{
				$stringToBeSigned .= "$k$v";
			}
		}
		unset($k, $v);
		$stringToBeSigned .= $this->secretKey;

		return strtoupper(md5($stringToBeSigned));
	}

	public function curl($url, $postFields = null) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FAILONERROR, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//https 请求
		if (strlen($url) > 5 && strtolower(substr($url, 0, 5)) == "https")
		{
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		}

		if (is_array($postFields) && 0 < count($postFields))
		{
			$postBodyString = "";
			$postMultipart = false;
			foreach ($postFields as $k => $v)
			{
				if ("@" != substr($v, 0, 1))
				{ //判断是不是文件上传
					$postBodyString .= "$k=" . urlencode($v) . "&";
				}
				else
				{ //文件上传用multipart/form-data，否则用www-form-urlencoded
					$postMultipart = true;
				}
			}
			unset($k, $v);
			curl_setopt($ch, CURLOPT_POST, true);
			if ($postMultipart)
			{
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
			}
			else
			{
				curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString, 0, -1));
			}
		}
		$reponse = curl_exec($ch);

		if (curl_errno($ch))
		{
			throw new Exception(curl_error($ch), 0);
		}
		else
		{
			$httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if (200 !== $httpStatusCode)
			{
				throw new Exception($reponse, $httpStatusCode);
			}
		}
		curl_close($ch);

		return $reponse;
	}

	protected function logCommunicationError($apiName, $requestUrl, $errorCode, $responseTxt) {
		$content = $apiName . '_' . $this->appkey . '_' . $requestUrl . '_' . $errorCode . '_' . str_replace("\n", "", $responseTxt);
		Log::out('taobao', 'E', $content);
	}

	public function execute($request, $session = null) {
		if ($this->checkRequest)
		{
			try
			{
				$request->check();
			} catch (Exception $e)
			{
				$result->code = $e->getCode();
				$result->msg = $e->getMessage();

				return $result;
			}
		}
		//组装系统参数
		$sysParams["app_key"] = $this->appkey;
		$sysParams["v"] = $this->apiVersion;
		$sysParams["format"] = $this->format;
		$sysParams["sign_method"] = $this->signMethod;
		$sysParams["method"] = $request->getApiMethodName();
		$sysParams["timestamp"] = date("Y-m-d H:i:s");
		$sysParams["partner_id"] = $this->sdkVersion;
		if (null != $session)
		{
			$sysParams["session"] = $session;
		}

		//获取业务参数
		$apiParams = $request->getApiParas();

		//签名
		$sysParams["sign"] = $this->generateSign(array_merge($apiParams, $sysParams));

		//系统参数放入GET请求串
		$requestUrl = $this->gatewayUrl . "?";
		foreach ($sysParams as $sysParamKey => $sysParamValue)
		{
			$requestUrl .= "$sysParamKey=" . urlencode($sysParamValue) . "&";
		}
		$requestUrl = substr($requestUrl, 0, -1);


		//发起HTTP请求
		try
		{
			$resp = $this->curl($requestUrl, $apiParams);
		} catch (Exception $e)
		{
			$this->logCommunicationError($sysParams["method"], $requestUrl, "HTTP_ERROR_" . $e->getCode(), $e->getMessage());
			$result->code = $e->getCode();
			$result->msg = $e->getMessage();

			return $result;
		}

		//解析TOP返回结果
		$respWellFormed = false;
		if ("json" == $this->format)
		{
			$respObject = json_decode($resp);
			if (null !== $respObject)
			{
				$respWellFormed = true;
				foreach ($respObject as $propKey => $propValue)
				{
					$respObject = $propValue;
				}
			}
		}
		else if ("xml" == $this->format)
		{
			$respObject = @simplexml_load_string($resp);
			if (false !== $respObject)
			{
				$respWellFormed = true;
			}
		}

		//返回的HTTP文本不是标准JSON或者XML，记下错误日志
		if (false === $respWellFormed)
		{
			$content = $sysParams['method'] . '_' . $requestUrl . '_HTTP_RESPONSE_NOT_WELL_FORMED_' . $resp;
			Log::out('taobao', 'E', $content);
			$result->code = 0;
			$result->msg = "HTTP_RESPONSE_NOT_WELL_FORMED";

			return $result;
		}

		//如果TOP返回了错误码，记录到业务错误日志中
		if (isset($respObject->code))
		{
			$content = $content = $sysParams['method'] . '_' . $requestUrl . '_' . $resp;
			Log::out('taobao', 'E', $content);
		}

		return $respObject;
	}

	public function exec($paramsArray) {
		if (!isset($paramsArray["method"]))
		{
			trigger_error("No api name passed");
		}
		$inflector = new LtInflector;
		$inflector->conf["separator"] = ".";
		$requestClassName = ucfirst($inflector->camelize(substr($paramsArray["method"], 7))) . "Request";
		if (!class_exists($requestClassName))
		{
			trigger_error("No such api: " . $paramsArray["method"]);
		}

		$session = isset($paramsArray["session"]) ? $paramsArray["session"] : null;

		$req = new $requestClassName;
		foreach ($paramsArray as $paraKey => $paraValue)
		{
			$inflector->conf["separator"] = "_";
			$setterMethodName = $inflector->camelize($paraKey);
			$inflector->conf["separator"] = ".";
			$setterMethodName = "set" . $inflector->camelize($setterMethodName);
			if (method_exists($req, $setterMethodName))
			{
				$req->$setterMethodName($paraValue);
			}
		}

		return $this->execute($req, $session);
	}
}
