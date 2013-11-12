<?php
/**
 * chenzhidong
 * 2013-5-3
 */

class PSCWS {
	private static $instance = null;
	private $scws = null;

	const MULTI_NONE = 0;
	const MULTI_SHORT = 1;
	const MULTI_DOUBLE = 2;
	const MULTI_MAIN = 4;
	const MULTI_ALL = 8;

	public function __construct() {
		$this->scws = scws_new();
		$this->scws->set_charset('utf8');
		$this->scws->set_rule(ini_get('scws.default.fpath') . '/rules.utf8.ini');
		$this->scws->set_dict(ini_get('scws.default.fpath') . '/dict.utf8.xdb');
		$this->scws->set_duality(true);
		$this->scws->set_ignore(true);
	}

	public static function getInstance() {
		if (extension_loaded('scws')) {
			if (self::$instance == null) {
				self::$instance = new PSCWS();
			}
			return self::$instance;
		}
		else {
			throw new Exception('extension SCWS not loaded');
		}
	}

	/**
	 * 获取分词结果
	 * @param $string
	 * @param bool $doclean
	 * @param int $multi
	 * @return array
	 */
	public function getWords($string, $doclean = true, $multi = self::MULTI_DOUBLE) {
		$this->scws->set_multi($multi);
		$this->scws->send_text($string);
		$words = array();
		while ($res = $this->scws->get_result()) {
			//$words = array_merge($words, $res);
			foreach ($res as $word) {
				if ($word['idf'] > 0) {
					$words[] = array('word' => $word['word'], 'idf' => $word['idf'], 'attr' => $word['attr']);
				}
			}
		}
		return $doclean ? self::cleanWords($words) : $words;
	}

	/**
	 * 保留'n','v','vn','a','nz','nr'词性的词
	 * @param $words
	 * @return array
	 */
	public static function cleanWords($words) {
		if (!empty($words) && is_array($words)) {
			foreach ($words as $key => $word) {
				if ($word['idf'] < 4 || !in_array($word['attr'], array('n', 'v', 'vn', 'a', 'nz', 'nr'))) {
					unset($words[$key]);
				}
			}
			$words = Tools::arrayUnique2d($words);
			uasort($words, array('Tools', 'cmpWord'));
		}
		return $words;
	}

	public function __destruct() {
		$this->scws->close();
	}
}
