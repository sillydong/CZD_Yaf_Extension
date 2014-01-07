<?php

/**
 * Created by IntelliJ IDEA.
 * User: chenzhidong
 * Date: 13-9-26
 * Time: 上午10:24
 */
class Simsimi {
	public static function getResponse($request) {
		$url = "http://www.simsimi.com/";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec($ch);
		curl_close($ch);
		list($header, $body) = explode("\r\n\r\n", $content);
		preg_match_all("/set\-cookie:([^\r\n]*);/iU", $header, $matches);
		if ($matches[1])
		{
			if (is_array($matches[1]))
			{
				$cookie = implode('; ', $matches[1]);
			}
			else
			{
				$cookie = $matches[1];
			}
			$cookie .= ';JSESSIONID=D7377356FFB38283A73E0DB385015DE6;popupCookie=true;locale=ch;sagree=true; selected_nc=ch; __utma=119922954.1488831110.1375456791.1381545568.1384225632.3;__utmb=119922954.7.9.1384225656789; __utmc=119922954; __utmz=119922954.1375456791.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none);';
			$header = array(
					'Cookie: ' . $cookie,
					'Host: www.simsimi.com',
					'Referer: http://www.simsimi.com/talk.htm',
					'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.76 Safari/537.36',
					'X-Requested-With: XMLHttpRequest'
			);

			$url = "http://www.simsimi.com/func/req?lc=ch&msg=" . $request;
			$content = Tools::curl($url, 'GET', null, $header);
			if ($content instanceof Exception)
			{
				return false;
			}
			else
			{
				$content = json_decode($content);
				if ($content->result == 100)
				{
					return $content->response;
				}
				else
				{
					Log::out("simi_error", 'E', json_encode($content));
				}
			}
		}

		return false;
	}
}
