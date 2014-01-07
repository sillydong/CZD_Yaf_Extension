<?php

/**
 * chenzhidong
 * 2013-6-1
 */
class Captcha {

	private static function words($len) {
		$charecters = "123456789abcdefghijklmnpqrstuvwxyz";
		$words = "";
		$max = strlen($charecters) - 1;
		for ($i = 0; $i < $len; $i++)
		{
			$words .= $charecters[rand(0, $max)];
		}

		return $words;
	}

	/**
	 * 生成验证码字符串，写入SESSION，将字符串图片返回给浏览器
	 *
	 * @param     $len
	 * @param int $width
	 * @param int $height
	 * @param int $font_size
	 */
	public static function generate($len, $width = 108, $height = 30, $font_size = 18) {
		$sizes = array('18' => array('width' => 25, 'height' => 25));
		$words = self::words($len);
		session_start();
		$session_key = 'captcha';
		$_SESSION[$session_key] = strtolower($words);

		$image = ImageManager::createWhiteImage($width, $height);

		$font_config = array('spacing' => -17, 'font' => '5.ttf');
		$font_path = dirname(__FILE__) . '/font/' . $font_config['font'];

		$color = imagecolorallocate($image, mt_rand(0, 100), mt_rand(20, 120), mt_rand(50, 150));
		$rand = 0;
		$w = $sizes[$font_size]['width'] * $len;
		$h = $sizes[$font_size]['height'];
		$x = round(($width - $w) / 2);
		$y = round(($height + $h) / 2) - 6;

		$coors = imagettftext($image, $font_size, $rand, $x, $y, $color, $font_path, $words);
		if ($coors)
		{
			header("Cache-Control: no-cache, must-revalidate");
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header("Pragma: no-cache");
			header("Cache-control: private");
			header('Content-Type: image/png');
			imagepng($image);
			imagedestroy($image);
		}
		exit;
	}

	public static function simple($len, $width = 48, $height = 22) {
		$words = self::words($len);
		session_start();
		$session_key = 'captcha';
		$_SESSION[$session_key] = strtolower($words);

		$width = ($len * 10 + 10) > $width ? $len * 10 + 10 : $width;
		$canvas = imagecreatetruecolor($width, $height);
		$r = Array(225, 255, 255, 223);
		$g = Array(225, 236, 237, 255);
		$b = Array(225, 236, 166, 125);
		$key = mt_rand(0, 3);

		$back = imagecolorallocate($canvas, $r[$key], $g[$key], $b[$key]);
		$border = imagecolorallocate($canvas, 100, 100, 100);

		imagefilledrectangle($canvas, 0, 0, $width - 1, $height - 1, $back);
		imagerectangle($canvas, 0, 0, $width - 1, $height - 1, $border);

		$string = imagecolorallocate($canvas, mt_rand(0, 200), mt_rand(0, 120), mt_rand(0, 120));

		for ($i = 0; $i < 10; $i++)
			imagearc($canvas, mt_rand(-10, $width), mt_rand(-10, $height), mt_rand(30, 200), mt_rand(20, 200), 55, 44, $string);
		for ($i = 0; $i < 25; $i++)
			imagesetpixel($canvas, mt_rand(0, $width), mt_rand(0, $height), $string);
		for ($i = 0; $i < $len; $i++)
			imagestring($canvas, 5, $i * 10 + 5, mt_rand(1, 8), $words{$i}, $string);
		if ($canvas)
		{
			header("Cache-Control: no-cache, must-revalidate");
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header("Pragma: no-cache");
			header("Cache-control: private");
			header('Content-Type: image/png');
			imagepng($canvas);
			imagedestroy($canvas);
		}
		exit;
	}

	/**
	 * 验证是否是合法的验证码
	 *
	 * @param     $captcha
	 * @param int $size
	 *
	 * @return int
	 */
	public static function isCaptcha($captcha, $size = 4) {
		return (bool)preg_match('/^[123456789abcdefghijklmnpqrstuvwxyz]{' . $size . '}$/ui', $captcha);
	}
}
