<?php
/**
 * 管理后台Controller
 * Created by IntelliJ IDEA.
 * User: chenzhidong
 * Date: 13-12-5
 * Time: 下午12:16
 */
class BControllerModel extends Yaf_Controller_Abstract{
	public function init(){
		//设置Controller的模板位置为模块目录下的views文件夹
		$this->setViewpath(APPLICATION_PATH . '/application/modules/' . $this->getModuleName() . '/views');
		$views = $this->initView();
	}
}
