<?php

/**
 * chenzhidong
 * 2013-5-10
 */
class CookiePlugin extends Yaf_Plugin_Abstract {
	public function routerShutdown(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {
		global $cookie;

		if (!Tools::isSpider())
		{
			if ($request->module == 'Index')
			{
				$cookie = new Cookie(SITE_NAME);
				if ($cookie->isLogin())
				{
					//验证用户登陆状态
				}
			}
			elseif ($request->module == 'Admin')
			{
				$cookie = new Cookie(SITE_NAME . '_admin', '/admin');
			}
			else
			{
				$cookie = new Cookie('test');
			}
		}
		else
		{
			$cookie = new Cookie('spider');
		}
	}
}
