<?php

/**
 * 命令行Controller
 * Created by IntelliJ IDEA.
 * User: chenzhidong
 * Date: 13-12-5
 * Time: 下午12:16
 */
class CControllerModel extends Yaf_Controller_Abstract {
	public function init() {
		//判断请求非命令行请求则跳转到首页
		if (REQUEST_METHOD != 'CLI')
		{
			$this->redirect('/');
		}
	}
}
