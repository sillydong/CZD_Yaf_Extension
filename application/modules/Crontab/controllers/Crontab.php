<?php
/**
 * 命令行controller示例
 *
 * Created by IntelliJ IDEA.
 * User: chenzhidong
 * Date: 13-12-5
 * Time: 下午12:10
 */
class CrontabController extends CControllerModel{

	public function indexAction(){
		var_dump($this->getRequest());
		return false;
	}
}
