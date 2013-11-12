<?php
/**
 * chenzhidong
 * 2013-6-1
 */

class Captcha {

	/**
	 * 生成验证码字符串，写入SESSION，将字符串图片返回给浏览器
	 * @param $len
	 * @param int $width
	 * @param int $height
	 * @param int $font_size
	 */
	public static function generate($len, $width = 108, $height = 30, $font_size = 18) {
		$charecters = "123456789abcdefghijklmnpqrstuvwxyz";
		$sizes = array('18' => array('width' => 25, 'height' => 25));
		$word_len = $len;
		$session_key = 'captcha';

		$font_config = array('spacing' => -17, 'font' => '5.ttf');

		$words = "";
		$max = strlen($charecters) - 1;
		for ($i = 0; $i < $word_len; $i++) {
			$words .= $charecters[rand(0, $max)];
		}

		session_start();
		$_SESSION[$session_key] = strtolower($words);

		$image = ImageManager::createWhiteImage($width, $height);

		$font_path = dirname(__FILE__) . '/font/' . $font_config['font'];

		$color = imagecolorallocate($image, mt_rand(0, 100), mt_rand(20, 120), mt_rand(50, 150));
		$rand = 0;
		$w = $sizes[$font_size]['width'] * $len;
		$h = $sizes[$font_size]['height'];
		$x = round(($width - $w) / 2);
		$y = round(($height + $h) / 2) - 6;

		/*
		if($rand>0||$rand<0){
			$a=abs($w*sin(deg2rad($rand)));
			$b=abs($w*cos(deg2rad($rand)));
			$c=abs($h*sin(deg2rad($rand)));
			$d=abs($h*cos(deg2rad($rand)));
			if($a+$d>$height || $b+$c>$width){
				var_dump($a+$d);
				var_dump($b+$c);
				$x=round(($width-$w)/2);
				$y=round(($height+$h)/2)-6;
				$rand=0;
			}
			else{
				if($rand>0){
					$x=round(($width-$b+$c)/2);
					$y=round(($height+$a+$d)/2)-6;
				}
				else{
					$x=round(($width-$b-$c)/2);
					$y=round(($height-$a+$d)/2)-6;
				}
			}
		}
		else{
			$x=round(($width-$w)/2);
			$y=round(($height+$h)/2)-6;
		}
		*/

		$coors = imagettftext($image, $font_size, $rand, $x, $y, $color, $font_path, $words);
		if ($coors) {
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

	/**
	 * 验证是否是合法的验证码
	 * @param $captcha
	 * @param int $size
	 * @return int
	 */
	public static function isCaptcha($captcha, $size = 4) {
		return (bool) preg_match('/^[123456789abcdefghijklmnpqrstuvwxyz]{' . $size . '}$/ui', $captcha);
	}
}
