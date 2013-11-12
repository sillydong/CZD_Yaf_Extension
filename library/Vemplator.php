<?php
/*
 Vemplator 0.6.1 - Making MVC (Model/Vemplator/Controller) a reality
Copyright (C) 2005-2008  Alan Szlosek

See LICENSE for license information.

20071217
- thought about flags to turn off caching ... but this needs more thought
20070819
- tweaks to variable transformation patterns
*/

class Vemplator {
	private $baseDirectory; // optional base path for template and compile directories
	private $compileDirectory; // directory to cache template files in. defaults to /tmp/
	private $templateDirectories; // array of directories to look for templates. can be relative to the baseDirectory
	private $data; // a stdClass object to hold the data passed to the template
	private $outputModifiers;

	/*
	 public $doCache; // flag for whether to cache
	public $doStripCode;
	*/

	/**
	 * Notable actions:
	 *    Sets the baseDirectory to the web server's document root
	 *    Sets default compile path to /tmp/HTTPHOST
	 */
	function __construct() {
		$this->baseDirectory = $this->appendSeparator(MAIL_TEMPLATE_DIR); // default to document root
		$this->compileDirectory = $this->appendSeparator(MAIL_CACHE_DIR);
		$this->data = new stdClass;
		$this->outputModifiers = array();

		//$this->doCache = false;
		//$this->doStripCode = true;
	}

	/*
	 * Makes sure folders have a trailing slash
	*/
	private function appendSeparator($path) {
		$path = trim($path);
		if (substr($path, strlen($path) - 1, 1) != DIRECTORY_SEPARATOR)
			$path .= DIRECTORY_SEPARATOR;
		return $path;
	}

	public function compilePath($path) {
		// prepend with base path if specified path doesn't start with a slash
		$temp = $this->appendSeparator($path);
		$this->compileDirectory = ($temp{0} != '/' ? $this->baseDirectory . $temp : $temp);
	}

	/**
	 * Assign a template variable.
	 * This can be a single key and value pair, or an associate array of key=>value pairs
	 */
	public function assign($key, $value = '') {
		if (is_array($key)) {
			foreach ($key as $n => $v)
				$this->data->$n = $v;
		}
		elseif (is_object($key)) {
			foreach (get_object_vars($key) as $n => $v)
				$this->data->$n = $v;
		}
		else {
			$this->data->$key = $value;
		}
	}

	public function append($key, $value = '') {
		if (!property_exists($this->data, $key)) {
			$this->data->$key = '';
		}
		$this->data->$key .= $value;
	}

	public function push($key, $value = null) {
		if (!property_exists($this->data, $key)) {
			$this->data->$key = array();
		}
		$data = $this->data->$key;
		$data[] = $value;
		$this->data->$key = $data;
	}

	/**
	 * Resets all previously-set template variables
	 */
	public function clear() {
		$this->data = new stdClass;
	}

	/**
	 * In charge of fetching and rendering the specified template
	 */
	public function output($template) {
		$out = '';
		$foundTemplate = false;
		if (file_exists($this->baseDirectory . $template)) {
			$out = $this->bufferedOutput($this->baseDirectory, $template);
		}
		else {
			throw new Exception('Tempate file: ' . $this->baseDirectory . $template . ' not found');
		}
		return $out;
	}

	/**
	 * Fetches the specified template, finding it in the specified path ... but only after trying to compile it first
	 */
	private function bufferedOutput($path, $template) {
		$this->compile($path, $template);

		ob_start();
		include($this->compileDirectory . $template);
		$out = ob_get_clean();
		return $out;
	}

	/**
	 * Compiles the template to PHP code and saves to file ... but only if the template has been updated since the last caching
	 * Uses Regular Expressions to identify template syntax
	 * Passes each match on to the callback for conversion to PHP
	 */
	private function compile($path, $template) {
		// moved from constructor
		if (!file_exists($this->compileDirectory))
			mkdir($this->compileDirectory);

		$templateFile = $path . $template;
		$compiledFile = $this->compileDirectory . $template;

		// don't spend time compiling if nothing has changed
		if (file_exists($compiledFile) && filemtime($compiledFile) >= filemtime($templateFile))
			return;

		$lines = file($templateFile);
		$newLines = array();
		$matches = null;
		foreach ($lines as $line) {
			$num = preg_match_all('/\{([^{}]+)\}/', $line, &$matches);
			if ($num > 0) {
				for ($i = 0; $i < $num; $i++) {
					$match = $matches[0][$i];
					$new = $this->transformSyntax($matches[1][$i]);
					$line = str_replace($match, $new, $line);
				}
			}
			$newLines[] = $line;
		}
		$f = fopen($compiledFile, 'w');
		fwrite($f, implode('', $newLines));
		fclose($f);
	}


	/**
	 * This is where the generation of PHP code takes place
	 */
	private function transformSyntax($input) {
		$from = array(
			//'/(^|\[|,|\(| |\+)([a-zA-Z_][a-zA-Z0-9_]*)($|\W|\.)/',
			//'/(^|\[|,|\(| |\+)([a-zA-Z_][a-zA-Z0-9_]*)($|\W|\.)/',
			'/(^|\[|,|\(|\+| )([a-zA-Z_][a-zA-Z0-9_]*)($|\.|\)|\[|\]|\+)/',
			'/(^|\[|,|\(|\+| )([a-zA-Z_][a-zA-Z0-9_]*)($|\.|\)|\[|\]|\+)/', // again to catch those bypassed by overlapping start/end characters
			'/\./',
		);
		$to = array(
			'$1$this->data->$2$3',
			'$1$this->data->$2$3',
			'->'
		);

		$parts = explode(':', $input);

		$string = '<?php ';
		switch ($parts[0]) { // check for a template statement
			case 'if':
			case 'switch':
				$string .= $parts[0] . '(' . preg_replace($from, $to, $parts[1]) . ') { ' . ($parts[0] == 'switch' ? 'default: ' : '');
				break;
			case 'foreach':
				$pieces = explode(',', $parts[1]);
				$string .= 'foreach(' . preg_replace($from, $to, $pieces[0]) . ' as ';
				$string .= preg_replace($from, $to, $pieces[1]);
				if (sizeof($pieces) == 3) // prepares the $value portion of foreach($var as $key=>$value)
				$string .= '=>' . preg_replace($from, $to, $pieces[2]);
				$string .= ') { ';
				break;
			case 'end':
			case 'endswitch':
				$string .= '}';
				break;
			case 'else':
				$string .= '} else {';
				break;
			case 'case':
				$string .= 'break; case ' . preg_replace($from, $to, $parts[1]) . ':';
				break;
			case 'include':
				$string .= 'echo $this->output("' . $parts[1] . '");';
				break;
			default:
				$string .= 'echo ' . preg_replace($from, $to, $parts[0]) . ';';
				break;
		}
		$string .= ' ?>';
		return $string;
	}
}

?>
