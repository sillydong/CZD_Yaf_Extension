<?php

/**
 * chenzhidong
 * 2013-6-14
 */
class Encoder {
	private static function passKey($string, $key) {
		$key = md5($key);

		$ctr = 0;
		$tmp = '';
		$len_s = strlen($string);
		$len_k = strlen($key);

		for ($i = 0; $i < $len_s; $i++)
		{
			$ctr = $ctr == $len_k ? 0 : $ctr;
			$tmp .= $string[$i] ^ $key[$ctr++];
		}

		return $tmp;
	}

	/**
	 * 加密
	 *
	 * @param $string
	 * @param $key
	 *
	 * @return string
	 */
	public static function encode($string, $key) {
		$encrypt_key = md5(microtime());

		// 变量初始化
		$ctr = 0;
		$tmp = '';
		$len_s = strlen($string);

		for ($i = 0; $i < $len_s; $i++)
		{
			$ctr = $ctr == 32 ? 0 : $ctr;
			$tmp .= $encrypt_key[$ctr] . ($string[$i] ^ $encrypt_key[$ctr++]);
		}

		return base64_encode(self::passKey($tmp, $key));
	}

	/**
	 * 解密
	 *
	 * @param $string
	 * @param $key
	 *
	 * @return string
	 */
	public static function decode($string, $key) {
		$string = self::passKey(base64_decode($string), $key);

		$tmp = '';
		$len_s = strlen($string);

		for ($i = 0; $i < $len_s; $i++)
		{
			$tmp .= $string[$i] ^ $string[++$i];
		}

		return $tmp;
	}

	/**
	 * 源自Discuz的加密算法，可设置加密内容的有效期
	 *
	 * @param     $string
	 * @param     $operation
	 * @param     $key
	 * @param int $expire
	 *
	 * @return string
	 */
	public static function discuz($string, $operation, $key, $expire = 3600) {
		$ckey_length = 4;

		$key = md5($key ? $key : 'key');
		$keya = md5(substr($key, 0, 16));
		$keyb = md5(substr($key, 16, 16));
		$keyc = $ckey_length ? ($operation == 'D' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';

		$cryptkey = $keya . md5($keya . $keyc);
		$key_length = strlen($cryptkey);

		$string = $operation == 'D' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expire ? $expire + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
		$string_length = strlen($string);

		$result = '';
		$box = range(0, 255);

		$rndkey = array();
		for ($i = 0; $i <= 255; $i++)
		{
			$rndkey [$i] = ord($cryptkey [$i % $key_length]);
		}

		for ($j = $i = 0; $i < 256; $i++)
		{
			$j = ($j + $box [$i] + $rndkey [$i]) % 256;
			$tmp = $box [$i];
			$box [$i] = $box [$j];
			$box [$j] = $tmp;
		}

		for ($a = $j = $i = 0; $i < $string_length; $i++)
		{
			$a = ($a + 1) % 256;
			$j = ($j + $box [$a]) % 256;
			$tmp = $box [$a];
			$box [$a] = $box [$j];
			$box [$j] = $tmp;
			$result .= chr(ord($string [$i]) ^ ($box [($box [$a] + $box [$j]) % 256]));
		}

		if ($operation == 'D')
		{
			if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16))
			{
				return substr($result, 26);
			}
			else
			{
				return '';
			}
		}
		else
		{
			return $keyc . str_replace('=', '', base64_encode($result));
		}
	}
}
