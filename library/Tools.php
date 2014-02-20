<?php

class Tools {

	const FLAG_NUMERIC = 1;
	const FLAG_NO_NUMERIC = 2;
	const FLAG_ALPHANUMERIC = 3;

	/**
	 * 生成随机密码
	 *
	 * @param integer $length Desired length (optional)
	 * @param string  $flag   Output type (NUMERIC, ALPHANUMERIC, NO_NUMERIC)
	 *
	 * @return string Password
	 */
	public static function passwdGen($length = 8, $flag = self::FLAG_NO_NUMERIC) {
		switch ($flag)
		{
			case self::FLAG_NUMERIC:
				$str = '0123456789';
				break;
			case self::FLAG_NO_NUMERIC:
				$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			case self::FLAG_ALPHANUMERIC:
			default:
				$str = 'abcdefghijkmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
		}

		for ($i = 0, $passwd = ''; $i < $length; $i++)
			$passwd .= Tools::substr($str, mt_rand(0, Tools::strlen($str) - 1), 1);

		return $passwd;
	}

	/**
	 * 替换第一次出现的字符串
	 *
	 * @param     $search
	 * @param     $replace
	 * @param     $subject
	 * @param int $cur
	 *
	 * @return mixed
	 */
	public static function strReplaceFirst($search, $replace, $subject, $cur = 0) {
		return (strpos($subject, $search, $cur)) ? substr_replace($subject, $replace, (int)strpos($subject, $search, $cur), strlen($search)) : $subject;
	}

	/**
	 * 跳转
	 *
	 * @param      $url
	 * @param null $headers
	 */
	public static function redirect($url, $headers = null) {
		if (!empty($url))
		{
			if ($headers)
			{
				if (!is_array($headers))
					$headers = array($headers);

				foreach ($headers as $header)
					header($header);
			}

			header('Location: ' . $url);
			exit;
		}
	}

	/**
	 * 清理URL中的http头
	 *
	 * @param      $url
	 * @param bool $cleanall
	 *
	 * @return mixed|string
	 */
	public static function cleanUrl($url, $cleanall = true) {
		if (strpos($url, 'http://') !== false)
		{
			if ($cleanall)
			{
				return '/';
			}
			else
			{
				return str_replace('http://', '', $url);
			}
		}

		return $url;
	}

	/**
	 * 获取当前域名
	 *
	 * @param bool $http
	 * @param bool $entities
	 *
	 * @return string
	 */
	public static function getHttpHost($http = false, $entities = false) {
		$host = (isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER['HTTP_HOST']);
		if ($entities)
			$host = htmlspecialchars($host, ENT_COMPAT, 'UTF-8');
		if ($http)
		{
			$host = self::getCurrentUrlProtocolPrefix() . $host;
		}

		return $host;
	}

	/**
	 * 获取当前服务器名
	 *
	 * @return mixed
	 */
	public static function getServerName() {
		if (isset($_SERVER['HTTP_X_FORWARDED_SERVER']) && $_SERVER['HTTP_X_FORWARDED_SERVER'])
			return $_SERVER['HTTP_X_FORWARDED_SERVER'];

		return $_SERVER['SERVER_NAME'];
	}

	/**
	 * 获取用户IP地址
	 *
	 * @return mixed
	 */
	public static function getRemoteAddr() {
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && (!isset($_SERVER['REMOTE_ADDR']) || preg_match('/^127\..*/i', trim($_SERVER['REMOTE_ADDR'])) || preg_match('/^172\.16.*/i', trim($_SERVER['REMOTE_ADDR'])) || preg_match('/^192\.168\.*/i', trim($_SERVER['REMOTE_ADDR'])) || preg_match('/^10\..*/i', trim($_SERVER['REMOTE_ADDR']))))
		{
			if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ','))
			{
				$ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

				return $ips[0];
			}
			else
				return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}

		return $_SERVER['REMOTE_ADDR'];
	}

	/**
	 * 获取用户来源地址
	 *
	 * @return null
	 */
	public static function getReferer() {
		if (isset($_SERVER['HTTP_REFERER']))
		{
			return $_SERVER['HTTP_REFERER'];
		}
		else
		{
			return null;
		}
	}

	/**
	 * 判断是否使用了HTTPS
	 *
	 * @return bool
	 */
	public static function usingSecureMode() {
		if (isset($_SERVER['HTTPS']))
			return ($_SERVER['HTTPS'] == 1 || strtolower($_SERVER['HTTPS']) == 'on');
		if (isset($_SERVER['SSL']))
			return ($_SERVER['SSL'] == 1 || strtolower($_SERVER['SSL']) == 'on');

		return false;
	}

	/**
	 * 获取当前URL协议
	 *
	 * @return string
	 */
	public static function getCurrentUrlProtocolPrefix() {
		if (Tools::usingSecureMode())
			return 'https://';
		else
			return 'http://';
	}

	/**
	 * 判断是否本站链接
	 *
	 * @param $referrer
	 *
	 * @return string
	 */
	public static function secureReferrer($referrer) {
		if (preg_match('/^http[s]?:\/\/' . Tools::getServerName() . '(:443)?\/.*$/Ui', $referrer))
			return $referrer;

		return '/';
	}

	/**
	 * 获取POST或GET的指定字段内容
	 *
	 * @param      $key
	 * @param bool $default_value
	 *
	 * @return bool|string
	 */
	public static function getValue($key, $default_value = false) {
		if (!isset($key) || empty($key) || !is_string($key))
			return false;
		$ret = (isset($_POST[$key]) ? $_POST[$key] : (isset($_GET[$key]) ? $_GET[$key] : $default_value));

		if (is_string($ret) === true)
			$ret = trim(urldecode(preg_replace('/((\%5C0+)|(\%00+))/i', '', urlencode($ret))));

		return !is_string($ret) ? $ret : stripslashes($ret);
	}

	/**
	 * 判断POST或GET中是否包含指定字段
	 *
	 * @param $key
	 *
	 * @return bool
	 */
	public static function getIsset($key) {
		if (!isset($key) || empty($key) || !is_string($key))
			return false;

		return isset($_POST[$key]) ? true : (isset($_GET[$key]) ? true : false);
	}

	/**
	 * 判断是否为提交操作
	 *
	 * @param $submit
	 *
	 * @return bool
	 */
	public static function isSubmit($submit) {
		return (isset($_POST[$submit]) || isset($_POST[$submit . '_x']) || isset($_POST[$submit . '_y']) || isset($_GET[$submit]) || isset($_GET[$submit . '_x']) || isset($_GET[$submit . '_y']));
	}

	/**
	 * 过滤HTML内容后返回
	 *
	 * @param      $string
	 * @param bool $html
	 *
	 * @return array|string
	 */
	public static function safeOutput($string, $html = false) {
		if (!$html)
			$string = strip_tags($string);

		return @Tools::htmlentitiesUTF8($string, ENT_QUOTES);
	}

	public static function htmlentitiesUTF8($string, $type = ENT_QUOTES) {
		if (is_array($string))
			return array_map(array('Tools', 'htmlentitiesUTF8'), $string);

		return htmlentities((string)$string, $type, 'utf-8');
	}

	public static function htmlentitiesDecodeUTF8($string) {
		if (is_array($string))
			return array_map(array('Tools', 'htmlentitiesDecodeUTF8'), $string);

		return html_entity_decode((string)$string, ENT_QUOTES, 'utf-8');
	}

	/**
	 * 对POST内容进行处理
	 *
	 * @return array
	 */
	public static function safePostVars() {
		if (!is_array($_POST))
			return array();
		$_POST = array_map(array('Tools', 'htmlentitiesUTF8'), $_POST);
	}

	/**
	 * 删除文件夹
	 *
	 * @param      $dirname
	 * @param bool $delete_self
	 */
	public static function deleteDirectory($dirname, $delete_self = true) {
		$dirname = rtrim($dirname, '/') . '/';
		if (is_dir($dirname))
		{
			$files = scandir($dirname);
			foreach ($files as $file)
				if ($file != '.' && $file != '..' && $file != '.svn')
				{
					if (is_dir($dirname . $file))
						Tools::deleteDirectory($dirname . $file, true);
					elseif (file_exists($dirname . $file))
						unlink($dirname . $file);
				}
			if ($delete_self)
				rmdir($dirname);
		}
	}

	/**
	 * 显示错误信息
	 *
	 * @param string $string
	 * @param array  $error
	 * @param bool   $htmlentities
	 *
	 * @return mixed|string
	 */
	public static function displayError($string = 'Fatal error', $error = array(), $htmlentities = true) {
		if (DEBUG_MODE)
		{
			if (!is_array($error) || empty($error))
				return str_replace('"', '&quot;', $string) . ('<pre>' . print_r(debug_backtrace(), true) . '</pre>');
			$key = md5(str_replace('\'', '\\\'', $string));
			$str = (isset($error) AND is_array($error) AND key_exists($key, $error)) ? ($htmlentities ? htmlentities($error[$key], ENT_COMPAT, 'UTF-8') : $error[$key]) : $string;

			return str_replace('"', '&quot;', stripslashes($str));
		}
		else
		{
			return str_replace('"', '&quot;', $string);
		}
	}

	/**
	 * 打印出对象的内容
	 *
	 * @param      $object
	 * @param bool $kill
	 *
	 * @return mixed
	 */
	public static function dieObject($object, $kill = true) {
		echo '<pre style="text-align: left;">';
		print_r($object);
		echo '</pre><br />';
		if ($kill)
			die('END');

		return ($object);
	}

	public static function encrypt($passwd) {
		return md5(_COOKIE_KEY_ . $passwd);
	}

	public static function getToken($string) {
		return !empty($string) ? Tools::encrypt($string) : false;
	}

	/**
	 * 截取字符串，支持中文
	 *
	 * @param        $str
	 * @param        $max_length
	 * @param string $suffix
	 *
	 * @return string
	 */
	public static function truncate($str, $max_length, $suffix = '...') {
		if (Tools::strlen($str) <= $max_length)
			return $str;
		$str = utf8_decode($str);

		return (utf8_encode(substr($str, 0, $max_length - Tools::strlen($suffix)) . $suffix));
	}

	public static function replaceAccentedChars($str) {
		$patterns = array( /* Lowercase */
						   '/[\x{0105}\x{00E0}\x{00E1}\x{00E2}\x{00E3}\x{00E4}\x{00E5}]/u',
						   '/[\x{00E7}\x{010D}\x{0107}]/u',
						   '/[\x{010F}]/u',
						   '/[\x{00E8}\x{00E9}\x{00EA}\x{00EB}\x{011B}\x{0119}]/u',
						   '/[\x{00EC}\x{00ED}\x{00EE}\x{00EF}]/u',
						   '/[\x{0142}\x{013E}\x{013A}]/u',
						   '/[\x{00F1}\x{0148}]/u',
						   '/[\x{00F2}\x{00F3}\x{00F4}\x{00F5}\x{00F6}\x{00F8}]/u',
						   '/[\x{0159}\x{0155}]/u',
						   '/[\x{015B}\x{0161}]/u',
						   '/[\x{00DF}]/u',
						   '/[\x{0165}]/u',
						   '/[\x{00F9}\x{00FA}\x{00FB}\x{00FC}\x{016F}]/u',
						   '/[\x{00FD}\x{00FF}]/u',
						   '/[\x{017C}\x{017A}\x{017E}]/u',
						   '/[\x{00E6}]/u',
						   '/[\x{0153}]/u',
						   /* Uppercase */
						   '/[\x{0104}\x{00C0}\x{00C1}\x{00C2}\x{00C3}\x{00C4}\x{00C5}]/u',
						   '/[\x{00C7}\x{010C}\x{0106}]/u',
						   '/[\x{010E}]/u',
						   '/[\x{00C8}\x{00C9}\x{00CA}\x{00CB}\x{011A}\x{0118}]/u',
						   '/[\x{0141}\x{013D}\x{0139}]/u',
						   '/[\x{00D1}\x{0147}]/u',
						   '/[\x{00D3}]/u',
						   '/[\x{0158}\x{0154}]/u',
						   '/[\x{015A}\x{0160}]/u',
						   '/[\x{0164}]/u',
						   '/[\x{00D9}\x{00DA}\x{00DB}\x{00DC}\x{016E}]/u',
						   '/[\x{017B}\x{0179}\x{017D}]/u',
						   '/[\x{00C6}]/u',
						   '/[\x{0152}]/u'
		);

		$replacements = array(
				'a',
				'c',
				'd',
				'e',
				'i',
				'l',
				'n',
				'o',
				'r',
				's',
				'ss',
				't',
				'u',
				'y',
				'z',
				'ae',
				'oe',
				'A',
				'C',
				'D',
				'E',
				'L',
				'N',
				'O',
				'R',
				'S',
				'T',
				'U',
				'Z',
				'AE',
				'OE'
		);

		return preg_replace($patterns, $replacements, $str);
	}

	public static function cleanNonUnicodeSupport($pattern) {
		if (!defined('PREG_BAD_UTF8_OFFSET'))
			return $pattern;

		return preg_replace('/\\\[px]\{[a-z]\}{1,2}|(\/[a-z]*)u([a-z]*)$/i', "$1$2", $pattern);
	}

	/**
	 * 生成年份
	 *
	 * @return array
	 */
	public static function dateYears() {
		$tab = array();

		for ($i = date('Y') - 10; $i >= 1900; $i--)
			$tab[] = $i;

		return $tab;
	}

	/**
	 * 生成日
	 *
	 * @return array
	 */
	public static function dateDays() {
		$tab = array();

		for ($i = 1; $i != 32; $i++)
			$tab[] = $i;

		return $tab;
	}

	/**
	 * 生成月
	 *
	 * @return array
	 */
	public static function dateMonths() {
		$tab = array();

		for ($i = 1; $i != 13; $i++)
			$tab[$i] = date('F', mktime(0, 0, 0, $i, date('m'), date('Y')));

		return $tab;
	}

	/**
	 * 根据时分秒生成时间字符串
	 *
	 * @param $hours
	 * @param $minutes
	 * @param $seconds
	 *
	 * @return string
	 */
	public static function hourGenerate($hours, $minutes, $seconds) {
		return implode(':', array($hours, $minutes, $seconds));
	}

	/**
	 * 一日之初
	 *
	 * @param $date
	 *
	 * @return string
	 */
	public static function dateFrom($date) {
		$tab = explode(' ', $date);
		if (!isset($tab[1]))
			$date .= ' ' . self::hourGenerate(0, 0, 0);

		return $date;
	}

	/**
	 * 一日之终
	 *
	 * @param $date
	 *
	 * @return string
	 */
	public static function dateTo($date) {
		$tab = explode(' ', $date);
		if (!isset($tab[1]))
			$date .= ' ' . self::hourGenerate(23, 59, 59);

		return $date;
	}

	/**
	 * 获取精准的时间
	 *
	 * @return int
	 */
	public static function getExactTime() {
		return microtime(true);
	}

	/**
	 * 转换成小写字符，支持中文
	 *
	 * @param $str
	 *
	 * @return bool|string
	 */
	public static function strtolower($str) {
		if (is_array($str))
			return false;
		if (function_exists('mb_strtolower'))
			return mb_strtolower($str, 'utf-8');

		return strtolower($str);
	}

	/**
	 * 转换为int类型
	 *
	 * @param $val
	 *
	 * @return int
	 */
	public static function intval($val) {
		if (is_int($val))
			return $val;
		if (is_string($val))
			return (int)$val;

		return (int)(string)$val;
	}

	/**
	 * 计算字符串长度
	 *
	 * @param        $str
	 * @param string $encoding
	 *
	 * @return bool|int
	 */
	public static function strlen($str, $encoding = 'UTF-8') {
		if (is_array($str) || is_object($str))
			return false;
		$str = html_entity_decode($str, ENT_COMPAT, 'UTF-8');
		if (function_exists('mb_strlen'))
			return mb_strlen($str, $encoding);

		return strlen($str);
	}

	public static function stripslashes($string) {
		if (get_magic_quotes_gpc())
			$string = stripslashes($string);

		return $string;
	}

	/**
	 * 转换成大写字符串
	 *
	 * @param $str
	 *
	 * @return bool|string
	 */
	public static function strtoupper($str) {
		if (is_array($str))
			return false;
		if (function_exists('mb_strtoupper'))
			return mb_strtoupper($str, 'utf-8');

		return strtoupper($str);
	}

	/**
	 * 截取字符串
	 *
	 * @param        $str
	 * @param        $start
	 * @param bool   $length
	 * @param string $encoding
	 *
	 * @return bool|string
	 */
	public static function substr($str, $start, $length = false, $encoding = 'utf-8') {
		if (is_array($str) || is_object($str))
			return false;
		if (function_exists('mb_substr'))
			return mb_substr($str, intval($start), ($length === false ? self::strlen($str) : intval($length)), $encoding);

		return substr($str, $start, ($length === false ? Tools::strlen($str) : intval($length)));
	}

	/**首字母大写
	 *
	 * @param $str
	 *
	 * @return string
	 */
	public static function ucfirst($str) {
		return self::strtoupper(self::substr($str, 0, 1)) . self::substr($str, 1);
	}

	public static function nl2br($str) {
		return preg_replace("/((<br ?\/?>)+)/i", "<br />", str_replace(array("\r\n", "\r", "\n"), "<br />", $str));
	}

	public static function br2nl($str) {
		return str_replace("<br />", "\n", $str);
	}

	/**
	 * 判断是否真为空
	 *
	 * @param $field
	 *
	 * @return bool
	 */
	public static function isEmpty($field) {
		return ($field === '' || $field === null);
	}

	public static function ceilf($value, $precision = 0) {
		$precisionFactor = $precision == 0 ? 1 : pow(10, $precision);
		$tmp = $value * $precisionFactor;
		$tmp2 = (string)$tmp;
		// If the current value has already the desired precision
		if (strpos($tmp2, '.') === false)
			return ($value);
		if ($tmp2[strlen($tmp2) - 1] == 0)
			return $value;

		return ceil($tmp) / $precisionFactor;
	}

	public static function floorf($value, $precision = 0) {
		$precisionFactor = $precision == 0 ? 1 : pow(10, $precision);
		$tmp = $value * $precisionFactor;
		$tmp2 = (string)$tmp;
		// If the current value has already the desired precision
		if (strpos($tmp2, '.') === false)
			return ($value);
		if ($tmp2[strlen($tmp2) - 1] == 0)
			return $value;

		return floor($tmp) / $precisionFactor;
	}

	public static function replaceSpace($url) {
		return urlencode(strtolower(preg_replace('/[ ]+/', '-', trim($url, ' -/,.?'))));
	}

	/**
	 * 获取日期
	 *
	 * @param null $timestamp
	 *
	 * @return bool|string
	 */
	public static function getSimpleDate($timestamp = null) {
		if ($timestamp == null)
		{
			return date('Y-m-d');
		}
		else
		{
			return date('Y-m-d', $timestamp);
		}
	}

	/**
	 * 获取完整时间
	 *
	 * @param null $timestamp
	 *
	 * @return bool|string
	 */
	public static function getFullDate($timestamp = null) {
		if ($timestamp == null)
		{
			return date('Y-m-d H:i:s');
		}
		else
		{
			return date('Y-m-d H:i:s', $timestamp);
		}
	}

	/**
	 * 判断是否64位架构
	 *
	 * @return bool
	 */
	public static function isX86_64arch() {
		return (PHP_INT_MAX == '9223372036854775807');
	}

	/**
	 * 获取服务器配置允许最大上传文件大小
	 *
	 * @param int $max_size
	 *
	 * @return mixed
	 */
	public static function getMaxUploadSize($max_size = 0) {
		$post_max_size = Tools::convertBytes(ini_get('post_max_size'));
		$upload_max_filesize = Tools::convertBytes(ini_get('upload_max_filesize'));
		if ($max_size > 0)
			$result = min($post_max_size, $upload_max_filesize, $max_size);
		else
			$result = min($post_max_size, $upload_max_filesize);

		return $result;
	}

	public static function convertBytes($value) {
		if (is_numeric($value))
			return $value;
		else
		{
			$value_length = strlen($value);
			$qty = (int)substr($value, 0, $value_length - 1);
			$unit = strtolower(substr($value, $value_length - 1));
			switch ($unit)
			{
				case 'k':
					$qty *= 1024;
					break;
				case 'm':
					$qty *= 1048576;
					break;
				case 'g':
					$qty *= 1073741824;
					break;
			}

			return $qty;
		}
	}

	/**
	 * 获取内存限制
	 *
	 * @return int
	 */
	public static function getMemoryLimit() {
		$memory_limit = @ini_get('memory_limit');

		return Tools::getOctets($memory_limit);
	}

	public static function getOctets($option) {
		if (preg_match('/[0-9]+k/i', $option))
			return 1024 * (int)$option;

		if (preg_match('/[0-9]+m/i', $option))
			return 1024 * 1024 * (int)$option;

		if (preg_match('/[0-9]+g/i', $option))
			return 1024 * 1024 * 1024 * (int)$option;

		return $option;
	}

	/**
	 * 从array中取出指定字段
	 *
	 * @param $array
	 * @param $key
	 *
	 * @return array|null
	 */
	public static function simpleArray($array, $key) {
		if (!empty($array) && is_array($array))
		{
			$result = array();
			foreach ($array as $k => $item)
			{
				$result[$k] = $item[$key];
			}

			return $result;
		}

		return null;
	}

	public static function object2array(&$object) {
		return json_decode(json_encode($object), true);
	}

	public static function getmicrotime() {
		list($usec, $sec) = explode(" ", microtime());

		return floor($sec + $usec * 1000000);
	}

	/**
	 * 根据时间生成图片名
	 *
	 * @param string $image_type
	 *
	 * @return float|string
	 */
	public static function getTimeImageName($image_type = "image/jpeg") {
		if ($image_type == "image/jpeg" || $image_type == "image/pjpeg")
		{
			return self::getmicrotime() . ".jpg";
		}
		elseif ($image_type == "image/gif")
		{
			return self::getmicrotime() . ".gif";
		}
		elseif ($image_type == "image/png")
		{
			return self::getmicrotime() . ".png";
		}
		else
		{
			return self::getmicrotime();
		}
	}

	/**
	 * 日期计算
	 *
	 * @param $interval
	 * @param $step
	 * @param $date
	 *
	 * @return bool|string
	 */
	public static function dateadd($interval, $step, $date) {
		list($year, $month, $day) = explode('-', $date);
		if (strtolower($interval) == 'y')
		{
			return date('Y-m-d', mktime(0, 0, 0, $month, $day, intval($year) + intval($step)));
		}
		elseif (strtolower($interval) == 'm')
		{
			return date('Y-m-d', mktime(0, 0, 0, intval($month) + intval($step), $day, $year));
		}
		elseif (strtolower($interval) == 'd')
		{
			return date('Y-m-d', mktime(0, 0, 0, $month, intval($day) + intval($step), $year));
		}

		return date('Y-m-d');
	}

	public static function echo_microtime($tag) {
		list($usec, $sec) = explode(' ', microtime());
		echo $tag . ':' . ((float)$usec + (float)$sec) . "\n";
	}

	public static function redirectTo($link) {
		if (strpos($link, 'http') !== false)
		{
			header('Location: ' . $link);
		}
		else
		{
			header('Location: ' . Tools::getHttpHost(true) . '/' . $link);
		}
		exit;
	}

	public static function returnAjaxJson($array) {
		if (!headers_sent())
		{
			header("Content-Type: application/json; charset=utf-8");
		}
		echo(json_encode($array));
		ob_end_flush();
		exit;
	}

	public static function cmpWord($a, $b) {
		if ($a['word'] > $b['word'])
		{
			return 1;
		}
		elseif ($a['word'] == $b['word'])
		{
			return 0;
		}
		else
		{
			return -1;
		}
	}

	/**
	 * HackNews热度计算公式
	 *
	 * @param $time
	 * @param $viewcount
	 *
	 * @return float|int
	 */
	public static function getGravity($time, $viewcount) {
		$timegap = ($_SERVER['REQUEST_TIME'] - strtotime($time)) / 3600;
		if ($timegap <= 24)
		{
			return 999999;
		}

		return round((pow($viewcount, 0.8) / pow(($timegap + 24), 1.2)), 3) * 1000;
	}

	public static function getGravityS($stime, $viewcount) {
		$timegap = ($_SERVER['REQUEST_TIME'] - $stime) / 3600;
		if ($timegap <= 24)
		{
			return 999999;
		}

		return round((pow($viewcount, 0.8) / pow(($timegap + 24), 1.2)), 3) * 1000;
	}

	/**
	 * 优化的file_get_contents操作，超时关闭
	 *
	 * @param      $url
	 * @param bool $use_include_path
	 * @param null $stream_context
	 * @param int  $curl_timeout
	 *
	 * @return bool|mixed|string
	 */
	public static function file_get_contents($url, $use_include_path = false, $stream_context = null, $curl_timeout = 8) {
		if ($stream_context == null && preg_match('/^https?:\/\//', $url))
			$stream_context = @stream_context_create(array('http' => array('timeout' => $curl_timeout)));
		if (in_array(ini_get('allow_url_fopen'), array('On', 'on', '1')) || !preg_match('/^https?:\/\//', $url))
			return @file_get_contents($url, $use_include_path, $stream_context);
		elseif (function_exists('curl_init'))
		{
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($curl, CURLOPT_TIMEOUT, $curl_timeout);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			$opts = stream_context_get_options($stream_context);
			if (isset($opts['http']['method']) && Tools::strtolower($opts['http']['method']) == 'post')
			{
				curl_setopt($curl, CURLOPT_POST, true);
				if (isset($opts['http']['content']))
				{
					parse_str($opts['http']['content'], $datas);
					curl_setopt($curl, CURLOPT_POSTFIELDS, $datas);
				}
			}
			$content = curl_exec($curl);
			curl_close($curl);

			return $content;
		}
		else
			return false;
	}

	public static function ZipTest($from_file) {
		$zip = new PclZip($from_file);

		return ($zip->privCheckFormat() === true);
		/*
		if (class_exists('ZipArchive', false)) {
			$zip = new ZipArchive();
			return ($zip->open($from_file, ZIPARCHIVE::CHECKCONS) === true);
		}
		else {
			$zip = new PclZip($from_file);
			return ($zip->privCheckFormat() === true);
		}
		*/
	}

	public static function ZipExtract($from_file, $to_dir) {
		if (!file_exists($to_dir))
			mkdir($to_dir, 0777);
		$zip = new PclZip($from_file);
		$list = $zip->extract(PCLZIP_OPT_PATH, $to_dir);

		return $list;
		/*
		if (class_exists('ZipArchive', false)) {
			$zip = new ZipArchive();
			if ($zip->open($from_file) === true && $zip->extractTo($to_dir) && $zip->close())
				return true;
			return false;
		}
		else {
			$zip = new PclZip($from_file);
			$list = $zip->extract(PCLZIP_OPT_PATH, $to_dir);
			foreach ($list as $file)
				if ($file['status'] != 'ok' && $file['status'] != 'already_a_directory')
					return false;
			return true;
		}
		*/
	}

	/**
	 * 获取文件扩展名
	 *
	 * @param $file
	 *
	 * @return mixed|string
	 */
	public static function getFileExtension($file) {
		if (is_uploaded_file($file))
		{
			return "unknown";
		}

		return pathinfo($file, PATHINFO_EXTENSION);
	}

	/**
	 * 以固定格式将数据及状态码返回手机端
	 *
	 * @param      $code
	 * @param      $data
	 * @param bool $native
	 */
	public static function returnMobileJson($code, $data, $native = false) {
		if (!headers_sent())
		{
			header("Content-Type: application/json; charset=utf-8");
		}
		if (is_array($data) && $native)
		{
			self::walkArray($data, 'urlencode', true);
			echo(urldecode(json_encode(array('code' => $code, 'data' => $data))));
		}
		elseif (is_string($data) && $native)
		{
			echo(urldecode(json_encode(array('code' => $code, 'data' => urlencode($data)))));
		}
		else
		{
			echo(json_encode(array('code' => $code, 'data' => $data)));
		}
		ob_end_flush();
		exit;
	}

	/**
	 * 遍历数组
	 *
	 * @param      $array
	 * @param      $function
	 * @param bool $keys
	 */
	public static function walkArray(&$array, $function, $keys = false) {
		foreach ($array as $key => $value)
		{
			if (is_array($value))
			{
				self::walkArray($array[$key], $function, $keys);
			}
			elseif (is_string($value))
			{
				$array[$key] = $function($value);
			}

			if ($keys && is_string($key))
			{
				$newkey = $function($key);
				if ($newkey != $key)
				{
					$array[$newkey] = $array[$key];
					unset($array[$key]);
				}
			}
		}
	}

	/**
	 * 遍历路径
	 *
	 * @param        $path
	 * @param string $ext
	 * @param string $dir
	 * @param bool   $recursive
	 *
	 * @return array
	 */
	public static function scandir($path, $ext = 'php', $dir = '', $recursive = false) {
		$path = rtrim(rtrim($path, '\\'), '/') . '/';
		$real_path = rtrim(rtrim($path . $dir, '\\'), '/') . '/';
		$files = scandir($real_path);
		if (!$files)
			return array();

		$filtered_files = array();

		$real_ext = false;
		if (!empty($ext))
			$real_ext = '.' . $ext;
		$real_ext_length = strlen($real_ext);

		$subdir = ($dir) ? $dir . '/' : '';
		foreach ($files as $file)
		{
			if (!$real_ext || (strpos($file, $real_ext) && strpos($file, $real_ext) == (strlen($file) - $real_ext_length)))
				$filtered_files[] = $subdir . $file;

			if ($recursive && $file[0] != '.' && is_dir($real_path . $file))
				foreach (Tools::scandir($path, $ext, $subdir . $file, $recursive) as $subfile)
					$filtered_files[] = $subfile;
		}

		return $filtered_files;
	}

	public static function arrayUnique($array) {
		if (version_compare(phpversion(), '5.2.9', '<'))
			return array_unique($array);
		else
			return array_unique($array, SORT_REGULAR);
	}

	public static function arrayUnique2d($array, $keepkeys = true) {
		$output = array();
		if (!empty($array) && is_array($array))
		{
			$stArr = array_keys($array);
			$ndArr = array_keys(end($array));

			$tmp = array();
			foreach ($array as $i)
			{
				$i = join("¤", $i);
				$tmp[] = $i;
			}

			$tmp = array_unique($tmp);

			foreach ($tmp as $k => $v)
			{
				if ($keepkeys)
					$k = $stArr[$k];
				if ($keepkeys)
				{
					$tmpArr = explode("¤", $v);
					foreach ($tmpArr as $ndk => $ndv)
					{
						$output[$k][$ndArr[$ndk]] = $ndv;
					}
				}
				else
				{
					$output[$k] = explode("¤", $v);
				}
			}
		}

		return $output;
	}

	public static function sys_get_temp_dir() {
		if (function_exists('sys_get_temp_dir'))
		{
			return sys_get_temp_dir();
		}
		if ($temp = getenv('TMP'))
		{
			return $temp;
		}
		if ($temp = getenv('TEMP'))
		{
			return $temp;
		}
		if ($temp = getenv('TMPDIR'))
		{
			return $temp;
		}
		$temp = tempnam(__FILE__, '');
		if (file_exists($temp))
		{
			unlink($temp);

			return dirname($temp);
		}

		return null;
	}

	/**
	 * XSS
	 *
	 * @param $str
	 *
	 * @return mixed
	 */
	public static function removeXSS($str) {
		$str = str_replace('<!--  -->', '', $str);
		$str = preg_replace('~/\*[ ]+\*/~i', '', $str);
		$str = preg_replace('/\\\0{0,4}4[0-9a-f]/is', '', $str);
		$str = preg_replace('/\\\0{0,4}5[0-9a]/is', '', $str);
		$str = preg_replace('/\\\0{0,4}6[0-9a-f]/is', '', $str);
		$str = preg_replace('/\\\0{0,4}7[0-9a]/is', '', $str);
		$str = preg_replace('/&#x0{0,8}[0-9a-f]{2};/is', '', $str);
		$str = preg_replace('/&#0{0,8}[0-9]{2,3};/is', '', $str);
		$str = preg_replace('/&#0{0,8}[0-9]{2,3};/is', '', $str);

		$str = htmlspecialchars($str);
		//$str = preg_replace('/&lt;/i', '<', $str);
		//$str = preg_replace('/&gt;/i', '>', $str);

		// 非成对标签
		$lone_tags = array("img", "param", "br", "hr");
		foreach ($lone_tags as $key => $val)
		{
			$val = preg_quote($val);
			$str = preg_replace('/&lt;' . $val . '(.*)(\/?)&gt;/isU', '<' . $val . "\\1\\2>", $str);
			$str = self::transCase($str);
			$str = preg_replace_callback('/<' . $val . '(.+?)>/i', create_function('$temp', 'return str_replace("&quot;","\"",$temp[0]);'), $str);
		}
		$str = preg_replace('/&amp;/i', '&', $str);

		// 成对标签
		$double_tags = array("table", "tr", "td", "font", "a", "object", "embed", "p", "strong", "em", "u", "ol", "ul", "li", "div", "tbody", "span", "blockquote", "pre", "b", "font");
		foreach ($double_tags as $key => $val)
		{
			$val = preg_quote($val);
			$str = preg_replace('/&lt;' . $val . '(.*)&gt;/isU', '<' . $val . "\\1>", $str);
			$str = self::transCase($str);
			$str = preg_replace_callback('/<' . $val . '(.+?)>/i', create_function('$temp', 'return str_replace("&quot;","\"",$temp[0]);'), $str);
			$str = preg_replace('/&lt;\/' . $val . '&gt;/is', '</' . $val . ">", $str);
		}
		// 清理js
		$tags = Array(
				'javascript',
				'vbscript',
				'expression',
				'applet',
				'meta',
				'xml',
				'behaviour',
				'blink',
				'link',
				'style',
				'script',
				'embed',
				'object',
				'iframe',
				'frame',
				'frameset',
				'ilayer',
				'layer',
				'bgsound',
				'title',
				'base',
				'font'
		);

		foreach ($tags as $tag)
		{
			$tag = preg_quote($tag);
			$str = preg_replace('/' . $tag . '\(.*\)/isU', '\\1', $str);
			$str = preg_replace('/' . $tag . '\s*:/isU', $tag . '\:', $str);
		}

		$str = preg_replace('/[\s]+on[\w]+[\s]*=/is', '', $str);

		Return $str;
	}

	public static function transCase($str) {
		$str = preg_replace('/(e|ｅ|Ｅ)(x|ｘ|Ｘ)(p|ｐ|Ｐ)(r|ｒ|Ｒ)(e|ｅ|Ｅ)(s|ｓ|Ｓ)(s|ｓ|Ｓ)(i|ｉ|Ｉ)(o|ｏ|Ｏ)(n|ｎ|Ｎ)/is', 'expression', $str);

		Return $str;
	}

	/**
	 * @param        $url
	 * @param string $method
	 * @param null   $postFields
	 * @param null   $header
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public static function curl($url, $method = 'GET', $postFields = null, $header = null) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($ch, CURLOPT_FAILONERROR, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);

		if (strlen($url) > 5 && strtolower(substr($url, 0, 5)) == "https")
		{
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		}

		switch ($method)
		{
			case 'POST':
				curl_setopt($ch, CURLOPT_POST, true);
				if (!empty($postFields))
				{
					if (is_array($postFields) || is_object($postFields))
					{
						if (is_object($postFields))
							$postFields = Tools::object2array($postFields);
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
						if ($postMultipart)
						{
							curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
						}
						else
						{
							curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString, 0, -1));
						}
					}
					else
					{
						curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
					}

				}
				break;
			default:
				if (!empty($postFields) && is_array($postFields))
					$url .= (strpos($url, '?') === false ? '?' : '&') . http_build_query($postFields);
				break;
		}
		curl_setopt($ch, CURLOPT_URL, $url);

		if (!empty($header) && is_array($header))
		{
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		}
		$response = curl_exec($ch);
		if (curl_errno($ch))
		{
			throw new Exception(curl_error($ch), 0);
		}
		curl_close($ch);

		return $response;
	}

	/**
	 * 下载文件保存到指定位置
	 *
	 * @param $url
	 * @param $filepath
	 *
	 * @return bool
	 */
	public static function saveFile($url, $filepath) {
		if (Validate::isAbsoluteUrl($url) && !empty($filepath))
		{
			$file = self::file_get_contents($url);
			$fp = @fopen($filepath, 'w');
			if ($fp)
			{
				@fwrite($fp, $file);
				@fclose($fp);

				return $filepath;
			}
		}

		return false;
	}

	/**
	 * 文件复制
	 *
	 * @param $source
	 * @param $dest
	 *
	 * @return bool
	 */
	public static function copyFile($source, $dest) {
		if (file_exists($dest) || is_dir($dest))
		{
			return false;
		}

		return copy($source, $dest);
	}

	/**
	 * 判断是否爬虫，范围略大
	 *
	 * @return bool
	 */
	public static function isSpider() {
		if(isset($_SERVER['HTTP_USER_AGENT']))
		{
			$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
			$spiders = array('spider', 'bot');
			foreach ($spiders as $spider)
			{
				if (strpos($ua, $spider) !== false)
				{
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * 判断是否命令行执行
	 *
	 * @return bool
	 */
	public static function isCli() {
		if (isset($_SERVER['SHELL']) && !isset($_SERVER['HTTP_HOST']))
		{
			return true;
		}

		return false;
	}

	public static function sendToBrowser($file, $delaftersend = true, $exitaftersend = true) {
		if (file_exists($file) && is_readable($file))
		{
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment;filename = ' . basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check = 0, pre-check = 0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			if ($delaftersend)
			{
				unlink($file);
			}
			if ($exitaftersend)
			{
				exit;
			}
		}
	}

}

?>
