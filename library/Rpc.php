<?php

/**
 * Created by IntelliJ IDEA.
 * User: chenzhidong
 * Date: 14-1-15
 * Time: 下午5:05
 */
class Rpc {
	private $name;
	private $secret;

	function __construct($name, $secret) {
		$this->name = $name;
		$this->secret = $secret;
	}

	/**
	 * 向远程提交数据
	 *
	 * @param $host
	 * @param $port
	 * @param $path
	 * @param $data
	 *
	 * @return array|bool
	 */
	public function send($host, $port, $path, $data) {
		$data = json_encode($data, JSON_UNESCAPED_UNICODE);
		$fp = fsockopen($host, $port);
		$content = gzcompress('name=' . $this->name . '&sig=' . $this->sig($host, $data) . '&data=' . $this->encode($data, $this->secret));
		$request = "POST {$path} HTTP/1.0\r\nUser_Agent: CZD_Yaf_Extension_RPC\r\nHost: {$host}\r\nContent-Type: application/x-www-form-urlencoded; charset=utf-8\r\nContent-Length: " . strlen($content) . "\r\n\r\n{$content}";
		if (!fputs($fp, $request, strlen($request)))
			return false;
		else
		{
			$result = "";
			while (!feof($fp))
				$result .= fgets($fp);
			if ($result)
			{
				$cookies = array();
				$newheaders = array();
				list($header, $body) = explode("\r\n\r\n", $result, 2);
				if ($header && is_string($header))
				{
					$header = str_replace("\r\n", "\n", $header);
					$header = preg_replace('/\n[ \t]/', ' ', $header);
					$header = explode("\n", $header);
					$response = array('code' => 0, 'message' => '');

					foreach ($header as $tempheader)
					{
						if (empty($tempheader))
							continue;

						if (false === strpos($tempheader, ':'))
						{
							list(, $iResponseCode, $strResponseMsg) = explode(' ', $tempheader, 3);
							$response['code'] = $iResponseCode;
							$response['message'] = $strResponseMsg;
							continue;
						}

						list($key, $value) = explode(':', $tempheader, 2);

						if (!empty($value))
						{
							$key = strtolower($key);
							if (isset($newheaders[$key]))
								$newheaders[$key] = array($newheaders[$key], trim($value));
							else
								$newheaders[$key] = trim($value);
							if ('set-cookie' == $key)
								$cookies[] = $value;
						}
					}
					$newheaders['cookies'] = $cookies;
				}
				fclose($fp);

				return array('header' => $newheaders, 'body' => $body);
			}

		}
		fclose($fp);

		return false;
	}

	/**
	 * 解析远程提交的数据
	 *
	 * @return bool
	 */
	public function read() {
		$data = @gzuncompress(file_get_contents('php://input'));
		if ($data)
		{
			$datas = explode('&', $data);
			$content = array();
			$t = '';
			foreach ($datas as $data)
			{
				list($key, $value) = explode('=', $data);
				if ($key == 'sig' || $key == 'name')
					$content[$key] = $value;
				elseif ($key == 'data')
				{
					$t = $this->decode($value, $this->secret);
					$content['data'] = json_decode($t);
				}
			}
			$sign = $this->sig($_SERVER['HTTP_HOST'], $t);
			if ($content['name'] == $this->name && $sign == $content['sig'])
				return $content['data'];
		}

		return false;
	}

	/*
	 * 签名
	 */
	private function sig($host, $data) {
		return substr(strtoupper(md5($this->secret . '¤' . $host . '¤' . crc32($data) . '¤' . time() . '¤' . $this->name)), 12, 8);
	}

	/*
	 * 加密内容
	 */
	private function encode($txt, $key) {
		srand((double)microtime() * 1000000);
		$encrypt_key = md5(rand(0, 32000));
		$ctr = 0;
		$tmp = '';
		for ($i = 0; $i < strlen($txt); $i++)
		{
			$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
			$tmp .= $encrypt_key[$ctr] . ($txt[$i] ^ $encrypt_key[$ctr++]);
		}

		return base64_encode(self::key($tmp, $key));
	}

	/*
	 * 解密内容
	 */
	private function decode($string, $key) {
		$txt = $this->key(base64_decode($string), $key);

		$tmp = '';

		for ($i = 0; $i < strlen($txt); $i++)
			$tmp .= $txt[$i] ^ $txt[++$i];

		return $tmp;
	}

	private function key($txt, $encrypt_key) {
		$encrypt_key = md5($encrypt_key);
		$ctr = 0;
		$tmp = '';
		for ($i = 0; $i < strlen($txt); $i++)
		{
			$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
			$tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
		}

		return $tmp;
	}
}
