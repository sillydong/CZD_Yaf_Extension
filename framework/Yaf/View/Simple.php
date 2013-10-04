<?php
/**
 * Simple view class to help enforce private constructs.
 *
 */
class Yaf_View_Simple implements Yaf_View_Interface
{
    /**
     * List of Variables which will be replaced in the
     * template
     * @var array
     */
    protected $_tpl_vars = array();
    /**
     * Directory where the templates exists
     * @var string
     */
    protected $_tpl_dir = '';

    protected $_options = array();

    /**
     * Assigns variables to the view script via differing strategies.
     *
     * Yaf_View_Simple::assign('name', $value) assigns a variable called 'name'
     * with the corresponding $value.
     *
     * Yaf_View_Simple::assign($array) assigns the array keys as variable
     * names (with the corresponding array values).
     *
     * @see    __set()
     * @param  string|array The assignment strategy to use.
     * @param  mixed (Optional) If assigning a named variable, use this
     * as the value.
     * @return Yaf_View_Simple
     * @throws Yaf_Exception_LoadFailed_View if $name is
     * neither a string nor an array,
     */
    public function assign($name, $value = null)
    {
        // which strategy to use?
        if (is_string($name)) {
            // assign by name and value
            $this->_tpl_vars[$name] = $value;
        } elseif (is_array($name)) {
            // assign from associative array
            foreach ($name as $key => $val) {
                $this->_tpl_vars[$key] = $val;
            }
        } else {
            throw new Yaf_Exception(
                'assign() expects a string or array, received ' . gettype($name)
            );
        }
        return $this;
    }
    /**
     * Assigns by reference a variable to the view script.
     *
     * @param  string The name of the variable to be used in the template .
     * @param  mixed the variable value
     * @return Yaf_View_Simple
     * @throws Yaf_Exception_LoadFailed_View if $name is not a string,
     */
    public function assignRef($name, &$value)
    {
        // which strategy to use?
        if (is_string($name)) {
            // assign by name and value
            $this->_tpl_vars[$name] = $value;
        } else {
            throw new Yaf_Exception(
                'assign() expects a string, received ' . gettype($name)
            );
        }
        return $this;
    }
    /**
     * Set the path to find the view script used by render()
     *
     * @param string The directory to set as the path.
     * @return void
     */
    public function setScriptPath($templateDir)
    {
        if (is_string($templateDir) && Yaf_G::isAbsolutePath($templateDir)) {
            $this->_tpl_dir = $templateDir;
        }
        return $this;
    }

    /**
     * Return path to find the view script used by render()
     *
     * @return null|string Null if script not found
     */
    public function getScriptPath()
    {
        return $this->_tpl_dir;
    }

    public function clear($name='')
    {
        if ($name!='') {
            if (isset($this->_tpl_vars[$name])) {
                unset($this->_tpl_vars[$name]);
            }
        } else {
            //clear all variables
            $this->_tpl_vars = array();
        }
    }

    /**
     * Constructor.
     *
     * @param array $config Configuration key-value pairs.
     */
    public function __construct($templateDir, $options = array())
    {
        // set template path
        $this->setScriptPath($templateDir);
        $this->_options = $options;
    }

    /**
     * Processes a view script and displays the output.
     *
     * @param string $tpl The script name to process.
     * @param string $tpl_vars The variables to use in the view.
     * @return string The script output.
     */
    public function display($tpl, $tplVars=array())
    {
        if (!is_string($tpl) || $tpl == null) {
            return false;
        }
        // find the script file name using the private method
        $template = $this->_script($tpl);
        echo $this->_run($template, $tplVars);
        return true;
    }
    /**
     * Processes a view script and returns the output.
     *
     * @param string $tpl The script name to process.
     * @param string $tpl_vars The variables to use in the view.
     * @return string The script output.
     */
    public function evaluate($tpl_content, $vars=array())
    {
        if (!is_string($tpl_content) || $tpl_content == null) {
            return false;
        }
        return $this->_run($tpl_content, $vars, true);
    }

    /**
     * return the assigned template variable
     *
     * @param  string $name
     * @return null
     */
    public function get($name='')
    {
        if ($name!='') {
            if (isset($this->_tpl_vars[$name])) {
                return $this->_tpl_vars[$name];
            }
        } else {
            return $this->_tpl_vars;
        }
        return null;
    }

    /**
     * return the assigned template variable
     *
     * @param  string $name
     * @return null
     */
    public function __get($name)
    {
        return $this->get($name);
    }

    /**
     * Allows testing with empty() and isset() to work inside
     * templates.
     *
     * @param  string $key
     * @return boolean
     */
    public function __isset($name)
    {
        return isset($this->_tpl_vars[$name]);
    }

    /**
     * Assigns a variable or an associative array to the view script.
     * @see assign()
     *
     * @param string $name The variable name or array.
     * @param mixed $value The variable value.
     * @return void
     */
    public function __set($name, $value)
    {
        return $this->assign($name, $value);
    }

    /**
     * Allows unset() on object properties to work
     *
     * @param string $key
     * @return void
     */
    public function __unset($name)
    {
        if (isset($this->_tpl_vars[$name])) {
            unset($this->_tpl_vars[$name]);
        }
    }



    /**
     * Processes a view script and returns the output.
     *
     * @param string $tpl The script name to process.
     * @param string $tpl_vars The variables to use in the view.
     * @return string The script output.
     */
    public function render($tpl, $tplVars=array())
    {
        if (!is_string($tpl) || $tpl == null) {
            return false;
        }
        // find the script file name using the private method
        $template = $this->_script($tpl);
        return $this->_run($template, $tplVars);
    }




    /**
     * Finds a view script from the available directory.
     *
     * @param string $name The base name of the script.
     * @return void
     */
    protected function _script($name)
    {
        if (preg_match('#\.\.[\\\/]#', $name)) {
            throw new Yaf_Exception(
                'Requested scripts may not include parent '.
                'directory traversal ("../", "..\\" notation)'
            );
        }
        if ($this->_tpl_dir == '') {
            throw new Yaf_Exception_LoadFailed_View(
                'Could not determine the view script path, '.
                'you should call Yaf_View_Simple::setScriptPath to specific it'
            );
        }
        if (Yaf_G::isAbsolutePath($name) && is_readable($name)) {
            return $name;
        } else if (is_readable($this->_tpl_dir . DIRECTORY_SEPARATOR . $name)) {
            return $this->_tpl_dir . DIRECTORY_SEPARATOR . $name;
        }
        throw new Yaf_Exception_LoadFailed_View(
            "Unable to find template " . $this->_tpl_dir .
            DIRECTORY_SEPARATOR . $name
        );
    }

    protected function _run($template, $vars, $useEval = false)
    {
        if ($vars == null && count($this->_tpl_vars)>0) {
            $vars = $this->_tpl_vars;
        } else {
            $vars = array_merge($vars, $this->_tpl_vars);
        }
        if ($vars!=null) {
            extract($vars);
        }
        ob_start();
        if ($useEval == true) {
            eval('?>'.$template.'<?');
        } else {
            include($template);
        }
        $content = ob_get_clean();
        return $content;
    }

}
