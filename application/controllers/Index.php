<?php
/**
 * @name IndexController
 * @author chenzhidong
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class IndexController extends FControllerModel {

	/** 
     * 默认动作
     * Yaf支持直接把Yaf_Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/sample/index/index/index/name/chenzhidong 的时候, 你就会发现不同
     */
	public function indexAction($name = "Stranger") {
		//1. fetch query
		$get = $this->getRequest()->getQuery("get", "default value");

		//2. fetch model
		$model = new SampleModel();

		//setDatas
		$model->setDatas(array('email'=>'sample@sample.com','nick'=>'nick','passwd'=>'123456','ip_address'=>Tools::getRemoteAddr()));

		//3. assign
		$this->_view->assign('content',$model->selectSample());
		$this->_view->assign('name',$name);

		//cache用法
		//Cache::getInstance()->get($key);
		//Cache::getInstance()->set($key);

		//4. render by Yaf, 如果这里返回FALSE, Yaf将不会调用自动视图引擎Render模板
        return TRUE;
	}
}
