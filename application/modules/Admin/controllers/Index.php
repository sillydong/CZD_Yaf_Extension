<?php

/**
 * Created by IntelliJ IDEA.
 * User: chenzhidong
 * Date: 13-12-5
 * Time: 下午12:18
 */
class IndexController extends BControllerModel {
	public function indexAction() {
		$this->_view->assign('content', '您现在在管理后台');

		return true;
	}
}
