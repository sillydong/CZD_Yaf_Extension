<?php
/**
 * chenzhidong
 * 2013-5-25
 */

class ImageManager {
	/**
	 * 生成缩略图
	 * @param $image
	 * @param $cache_image
	 * @param $size
	 * @param string $image_type
	 * @return bool|string
	 */
	public static function thumbnail($image, $cache_image, $size, $image_type = 'jpg') {
		if (!file_exists($image)) {
			return '';
		}
		if (!file_exists(IMAGE_CACHE_DIR . $cache_image)) {
			$infos = getimagesize($image);

			if (!ImageManager::checkImageMemoryLimit($image)) {
				return false;
			}

			$x = $infos[0];
			$y = $infos[1];
			$max_x = $size * 3;

			if ($y < $size && $x <= $max_x) {
				copy($image, IMAGE_CACHE_DIR . $cache_image);
			}
			else {
				$ratio_x = $x / ($y / $size);
				if ($ratio_x > $max_x) {
					$ratio_x = $max_x;
					$size = $y / ($x / $max_x);
				}
				ImageManager::resize($image, IMAGE_CACHE_DIR . $cache_image, $ratio_x, $size, $image_type);
			}
		}
		return IMAGE_CACHE_DIR . $cache_image;
	}

	/**
	 * 检查内存占用
	 * @param $image
	 * @return bool
	 */
	public static function checkImageMemoryLimit($image) {
		$infos = @getimagesize($image);

		$memory_limit = Tools::getMemoryLimit();
		if (function_exists('memory_get_usage') && (int) $memory_limit != -1) {
			$current_memory = memory_get_usage();
			$channel = isset($infos['channels']) ? ($infos['channels'] / 8) : 1;
			if (($infos[0] * $infos[1] * $infos['bits'] * $channel + pow(2, 16)) * 1.8 + $current_memory > $memory_limit - 1024 * 1024) {
				return false;
			}
		}
		return true;
	}

	/**
	 * 检查文件名是否合法的图片文件名
	 * @param $filename
	 * @return bool
	 */
	public static function isCorrectImageFileExt($filename) {
		$authorized_extensions = array('gif', 'jpg', 'jpeg', 'png', 'bmp');
		if (strpos($filename, '.') !== false) {
			$name_explode = explode('.', $filename);
			if (count($name_explode) >= 2) {
				$current_extension = strtolower($name_explode[count($name_explode) - 1]);
				if (!in_array($current_extension, $authorized_extensions))
					return false;
			}
			else
				return false;
		}
		else {
			if (!in_array($filename, $authorized_extensions)) {
				return false;
			}
		}

		return true;
	}

	/**
	 * 将resource以指定图片类型写入文件
	 * @param $type
	 * @param $resource
	 * @param $filename
	 * @return bool
	 */
	public static function write($type, $resource, $filename) {
		switch ($type) {
			case 'gif':
			case IMAGETYPE_GIF:
				$success = imagegif($resource, $filename);
				break;
			case 'png':
			case IMAGETYPE_PNG:
				$success = imagepng($resource, $filename);
				break;
			case 'bmp':
			case IMAGETYPE_BMP:
				$success = imagewbmp($resource,$filename);
				break;
			case 'jpg':
			case 'jpeg':
			case IMAGETYPE_JPEG:
			default:
				$success = imagejpeg($resource, $filename, 100);
				break;
		}
		@chmod($filename, 0664);
		return $success;
	}

	/**
	 * 剪切图片
	 * @param $src_file
	 * @param $dst_file
	 * @param null $dst_width
	 * @param null $dst_height
	 * @param string $file_type
	 * @param int $dst_x
	 * @param int $dst_y
	 * @return bool
	 */
	public static function cut($src_file, $dst_file, $dst_width = null, $dst_height = null, $file_type = 'jpg', $dst_x = 0, $dst_y = 0) {
		if (!file_exists($src_file))
			return false;

		// Source information
		$src_info = getimagesize($src_file);
		$src = array(
			'width' => $src_info[0],
			'height' => $src_info[1],
			'ressource' => ImageManager::create($src_info[2], $src_file),
		);

		// Destination information
		$dest = array();
		$dest['x'] = $dst_x;
		$dest['y'] = $dst_y;
		$dest['width'] = !is_null($dst_width) ? $dst_width : $src['width'];
		$dest['height'] = !is_null($dst_height) ? $dst_height : $src['height'];
		$dest['ressource'] = ImageManager::createWhiteImage($dest['width'], $dest['height']);

		$white = imagecolorallocate($dest['ressource'], 255, 255, 255);
		imagecopyresampled($dest['ressource'], $src['ressource'], 0, 0, $dest['x'], $dest['y'], $dest['width'], $dest['height'], $dest['width'], $dest['height']);
		imagecolortransparent($dest['ressource'], $white);
		$return = ImageManager::write($file_type, $dest['ressource'], $dst_file);
		return $return;
	}

	/**
	 * 缩放图片
	 * @param $src_file
	 * @param $dst_file
	 * @param null $dst_width
	 * @param null $dst_height
	 * @param string $file_type
	 * @param bool $force_type
	 * @return bool
	 */
	public static function resize($src_file, $dst_file, $dst_width = null, $dst_height = null, $file_type = 'jpg', $force_type = false) {
		if (PHP_VERSION_ID < 50300)
			clearstatcache();
		else
			clearstatcache(true, $src_file);

		if (!file_exists($src_file) || !filesize($src_file))
			return false;
		list($src_width, $src_height, $type) = getimagesize($src_file);

		if ($type == IMAGETYPE_PNG && !$force_type)
			$file_type = 'png';

		//两不限
		if ((int) $dst_width <= 0 && (int) $dst_height <= 0) {
			$dst_width = $src_width;
			$dst_height = $src_height;
		}
		//限宽
		elseif ((int) $dst_width > 0 && (int) $dst_height <= 0) {
			$dst_height = round($src_height * ($dst_width / $src_width));
		}
		//限高
		elseif ((int) $dst_width <= 0 && (int) $dst_height > 0) {
			$dst_width = round($src_width * ($dst_height / $src_height));
		}

		$src_image = ImageManager::create($type, $src_file);

		$src_x = 0;
		$src_y = 0;
		$width_diff = $dst_width / $src_width;
		$height_diff = $dst_height / $src_height;

		if ($width_diff > 1 && $height_diff > 1) {
			$dst_width = $src_width;
			$dst_height = $src_height;
		}
		else {
			if ($width_diff < $height_diff) {
				$tmp_src_width = $dst_width * $src_height / $dst_height;
				$src_x = ($src_width - $tmp_src_width) / 2;
				$src_width = $tmp_src_width;
			}
			else {
				$tmp_src_height = $dst_height * $src_width / $dst_width;
				$src_y = ($src_height - $tmp_src_height) / 2;
				$src_height = $tmp_src_height;
			}
		}

		if (!ImageManager::checkImageMemoryLimit($src_file))
			return false;

		$dest_image = imagecreatetruecolor($dst_width, $dst_height);

		// If image is a PNG and the output is PNG, fill with transparency. Else fill with white background.
		if ($file_type == 'png' && $type == IMAGETYPE_PNG) {
			imagealphablending($dest_image, false);
			imagesavealpha($dest_image, true);
			$transparent = imagecolorallocatealpha($dest_image, 255, 255, 255, 127);
			imagefilledrectangle($dest_image, 0, 0, $dst_width, $dst_height, $transparent);
		}
		else {
			$white = imagecolorallocate($dest_image, 255, 255, 255);
			imagefilledrectangle($dest_image, 0, 0, $dst_width, $dst_height, $white);
		}

		imagecopyresampled($dest_image, $src_image, 0, 0, $src_x, $src_y, $dst_width, $dst_height, $src_width, $src_height);
		return (ImageManager::write($file_type, $dest_image, $dst_file));
	}

	public static function squre($src_file,$dest_file,$dest_type){
		list($src_width, $src_height, $type) = @getimagesize($src_file);
		if($src_width && $src_height && $type){
			$image=array('width'=>$src_width,'height'=>$src_height,'type'=>$type);
			switch($type){
				case IMAGETYPE_PNG:
					$image['image']=@imagecreatefrompng($src_file);
					break;
				case IMAGETYPE_JPEG:
					$image['image']=@imagecreatefromjpeg($src_file);
					break;
				case IMAGETYPE_BMP:
					$image['image']=@imagecreatefromwbmp($src_file);
					break;
				case IMAGETYPE_GIF:
					$image['image']=@imagecreatefromgif($src_file);
					break;
				default:
					$image['image']=false;
					break;
			}
			if($image['image']){
				if($image['width']>$image['height']){
					$image['dest_width']=$image['width'];
					$image['dest_height']=$image['width'];
					$image['start_x']=0;
					$image['start_y']=round(($image['width']-$image['height'])/2);
				}
				elseif($image['width']<$image['height']){
					$image['dest_width']=$image['height'];
					$image['dest_height']=$image['height'];
					$image['start_x']=round(($image['height']-$image['width'])/2);
					$image['start_y']=0;
				}
				else{
					if($dest_file && $dest_type)
						return self::write($dest_type,$image['image'],$dest_file);
					else
						return $image['image'];
				}
				$canvas=self::createWhiteImage($image['dest_width'],$image['dest_height']);
				if(@imagecopyresampled($canvas,$image['image'],$image['start_x'],$image['start_y'],0,0,$image['width'],$image['height'],$image['width'],$image['height'])){
					if($dest_file && $dest_type)
						return self::write($dest_type,$canvas,$dest_file);
					else
						return $canvas;
				}
			}
		}
		return false;
	}

	/**
	 * 检查文件是否真的是图片文件
	 * @param $filename
	 * @param null $file_mime_type
	 * @param null $mime_type_list
	 * @return bool
	 */
	public static function isRealImage($filename, $file_mime_type = null, $mime_type_list = null) {
		// Detect mime content type
		$mime_type = false;
		if (!$mime_type_list)
			$mime_type_list = array('image/gif', 'image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png');

		// Try 4 different methods to determine the mime type
		if (function_exists('finfo_open')) {
			$const = defined('FILEINFO_MIME_TYPE') ? FILEINFO_MIME_TYPE : FILEINFO_MIME;
			$finfo = finfo_open($const);
			$mime_type = finfo_file($finfo, $filename);
			finfo_close($finfo);
		}
		elseif (function_exists('mime_content_type'))
			$mime_type = mime_content_type($filename);
		elseif (function_exists('exec')) {
			$mime_type = trim(exec('file -b --mime-type ' . escapeshellarg($filename)));
			if (!$mime_type)
				$mime_type = trim(exec('file --mime ' . escapeshellarg($filename)));
			if (!$mime_type)
				$mime_type = trim(exec('file -bi ' . escapeshellarg($filename)));
		}

		if ($file_mime_type && (empty($mime_type) || $mime_type == 'regular file' || $mime_type == 'text/plain'))
			$mime_type = $file_mime_type;

		// For each allowed MIME type, we are looking for it inside the current MIME type
		foreach ($mime_type_list as $type)
			if (strstr($mime_type, $type))
				return true;

		return false;
	}

	/**
	 * 验证上传文件的类型是否为图片及大小是否越界
	 * @param $file
	 * @param int $max_file_size
	 * @return bool|string
	 */
	public static function validateUpload($file, $max_file_size = 0) {
		if ((int) $max_file_size > 0 && $file['size'] > (int) $max_file_size)
			return sprintf(Tools::displayError('Image is too large (%1$d kB). Maximum allowed: %2$d kB'), $file['size'] / 1024, $max_file_size / 1024);
		if (!ImageManager::isRealImage($file['tmp_name'], $file['type']) || !ImageManager::isCorrectImageFileExt($file['name']))
			return 'Image format not recognized, allowed formats are: .gif, .jpg, .png';
		if ($file['error'])
			return sprintf(Tools::displayError('Error while uploading image; please change your server\'s settings. (Error code: %s)'), $file['error']);
		return true;
	}

	/**
	 * 生成图片resource
	 * @param $type
	 * @param $filename
	 * @return resource
	 */
	public static function create($type, $filename) {
		switch ($type) {
			case IMAGETYPE_GIF :
				return imagecreatefromgif($filename);
			case IMAGETYPE_PNG :
				return imagecreatefrompng($filename);
			case IMAGETYPE_JPEG :
			default:
				return imagecreatefromjpeg($filename);
		}
	}

	/**
	 * 生成图片，填充白色
	 * @param $width
	 * @param $height
	 * @return resource
	 */
	public static function createWhiteImage($width, $height) {
		$image = imagecreatetruecolor($width, $height);
		$white = imagecolorallocate($image, 255, 255, 255);
		imagefill($image, 0, 0, $white);
		return $image;
	}

	/**
	 * 生成透明背景图片
	 * @param $width
	 * @param $height
	 * @return resource
	 */
	public static function createTransImage($width, $height) {
		$image = imagecreatetruecolor($width, $height);
		$white = imagecolorallocate($image, 255, 255, 255);
		imagefill($image, 0, 0, $white);
		imagecolortransparent($image,$white);
		return $image;
	}

	/**
	 * 通过后缀生成MimeType
	 * @param $file_name
	 * @return int|null|string
	 */
	public static function getMimeTypeByExtension($file_name) {
		$types = array(
			'image/gif' => array('gif'),
			'image/jpeg' => array('jpg', 'jpeg'),
			'image/png' => array('png')
		);
		$extension = substr($file_name, strrpos($file_name, '.') + 1);

		$mime_type = null;
		foreach ($types as $mime => $exts)
			if (in_array($extension, $exts)) {
				$mime_type = $mime;
				break;
			}

		if ($mime_type === null)
			$mime_type = 'image/jpeg';

		return $mime_type;
	}

	/**
	 * 获取文件扩展名
	 * @param $filename
	 * @return bool|string
	 */
	public static function getImageExt($filename) {
		$name_explode = explode('.', $filename);
		if (count($name_explode) >= 2) {
			return strtolower($name_explode[count($name_explode) - 1]);
		}
		else
			return false;
	}

}
