<?php
/**
 * Created by IntelliJ IDEA.
 * User: chenzhidong
 * Date: 13-11-19
 * Time: 下午2:55
 */
class ImageCombiner{
	const COMBINE_HORIZONTAL=1;
	const COMBINE_VERTICAL=2;

	private $srcs;
	private $src_infos;
	private $dest_type=IMAGETYPE_JPEG;
	private $dest_width=0;
	private $dest_height=0;
	private $combine_mode=self::COMBINE_VERTICAL;

	private $canvas;
	private $done=false;

	public function __construct($srcs,$mode=self::COMBINE_VERTICAL,$dest_width=0,$dest_height=0){
		$this->srcs=$srcs;
		$this->combine_mode=$mode;
		$this->dest_width=$dest_width;
		$this->dest_height=$dest_height;
		$this->canvas=null;
	}

	private function checkSrcs(){
		foreach($this->srcs as $key=>$src){
			$tmp=tempnam(Tools::sys_get_temp_dir(),'img_');
			if(Tools::saveFile($src,$tmp)){
				list($src_width, $src_height, $type) = @getimagesize($tmp);
				if($src_width && $src_height && $type && in_array($type,array(IMAGETYPE_BMP,IMAGETYPE_JPEG,IMAGETYPE_PNG,IMAGETYPE_GIF))){
					$image=array('width'=>$src_width,'height'=>$src_height,'type'=>$type,'image'=>$tmp);
					$this->src_infos[$key]=$image;
				}
				else{
					unset($this->srcs[$key]);
				}
			}
			else{
				unset($this->srcs[$key]);
			}
		}
	}

	private function checkSizes(){
		switch($this->combine_mode){
			case self::COMBINE_VERTICAL:
				if(!$this->dest_width){
					foreach($this->src_infos as $src){
						$this->dest_width=max($this->dest_width,$src['width']);
					}
				}
				foreach($this->src_infos as $src){
					$this->dest_height+=round($this->dest_width*$src['height']/$src['width']);
				}
				break;
			case self::COMBINE_HORIZONTAL:
				if(!$this->dest_height){
					foreach($this->src_infos as $src){
						$this->dest_height=max($this->dest_height,$src['height']);
					}
				}
				foreach($this->src_infos as $src){
					$this->dest_width+=round($this->dest_height*$src['width']/$src['height']);
				}
				break;
		}
	}

	private function combineVertical(){
		$destX=0;
		$destY=0;
		foreach($this->src_infos as $key=>$src){
			if($this->dest_width!=$src['width']){
				$dest_height = round($src['height'] * ($this->dest_width / $src['width']));
			}
			else
				$dest_height=$src['height'];
			switch($src['type']){
				case IMAGETYPE_PNG:
					$image=@imagecreatefrompng($src['image']);
					break;
				case IMAGETYPE_BMP:
					$image=@imagecreatefromwbmp($src['image']);
					break;
				case IMAGETYPE_GIF:
					$image=@imagecreatefromgif($src['image']);
					break;
				case IMAGETYPE_JPEG:
				default:
					$image=@imagecreatefromjpeg($src['image']);
					break;
			}
			if($image && !imagecopyresampled($this->canvas,$image,$destX,$destY,0,0,$this->dest_width,$dest_height,$src['width'],$src['height']))
				return false;
			if($image)
				imagedestroy($image);
			unlink($src['image']);
			$destY+=$dest_height;
		}
		return $this->canvas;
	}

	private function combineHorizontal(){
		$destX=0;
		$destY=0;
		foreach($this->src_infos as $key=>$src){
			if($this->dest_height!=$src['height']){
				$dest_width=round($src['width'] * ($this->dest_height/$src['height']));
			}
			else
				$dest_width=$src['width'];
			switch($src['type']){
				case IMAGETYPE_PNG:
					$image=@imagecreatefrompng($src['image']);
					break;
				case IMAGETYPE_BMP:
					$image=@imagecreatefromwbmp($src['image']);
					break;
				case IMAGETYPE_GIF:
					$image=@imagecreatefromgif($src['image']);
					break;
				case IMAGETYPE_JPEG:
				default:
					$image=@imagecreatefromjpeg($src['image']);
					break;
			}
			if($image && !imagecopyresampled($this->canvas,$image,$destX,$destY,0,0,$dest_width,$this->dest_height,$src['width'],$src['height']))
				return false;
			if($image)
				imagedestroy($image);
			unlink($src['image']);
			$destX+=$dest_width;
		}
		return true;
	}

	public function setDestType($type){
		$this->dest_type=$type;
	}

	public function getDestType(){
		return $this->dest_type;
	}

	private function combine(){
		if(!$this->done){
			if (PHP_VERSION_ID < 50300)
				clearstatcache();

			$this->checkSrcs();
			$this->checkSizes();

			if(!empty($this->src_infos)){
				$this->canvas=ImageManager::createTransImage($this->dest_width,$this->dest_height);
				switch($this->combine_mode){
					case self::COMBINE_HORIZONTAL:
						$this->done=$this->combineHorizontal();
						break;
					case self::COMBINE_VERTICAL:
						$this->done=$this->combineVertical();
						break;
				}
			}
		}
		return $this->done;
	}

	public function getCombination(){
		$image=$this->combine();
		if($image)
			return $this->canvas;
		return false;
	}

	public function showCombination(){
		$image=$this->combine();
		if($image){
			switch($this->getDestType()){
				case IMAGETYPE_GIF:
					header("Content-type: image/gif");
					imagegif($this->canvas);
					break;
				case IMAGETYPE_BMP:
					header("Content-type: image/bmp");
					imagewbmp($this->canvas);
					break;
				case IMAGETYPE_JPEG:
					header("Content-type: image/jpeg");
					imagejpeg($this->canvas);
					break;
				case IMAGETYPE_PNG:
					header("Content-type: image/png");
					imagepng($this->canvas);
					break;
			}
		}
		imagedestroy($this->canvas);
	}

	public function saveCombination($dest_file){
		$image=$this->combine();
		if($image){
			if(ImageManager::write($this->dest_type,$this->canvas,$dest_file)){
				imagedestroy($this->canvas);
				return true;
			}
		}
		return false;
	}
}
