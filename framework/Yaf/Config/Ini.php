<?php
/**
 * Yaf Config Ini
 */
class Yaf_Config_Ini extends Yaf_Config_Simple
{
    /**
     * Loads the section $section from the config file $filename for
     * access facilitated by nested object properties.
     *
     * If the section name contains a ":" then the section name to the right
     * is loaded and included into the properties. Note that the keys in
     * this $section will override any keys of the same
     * name in the sections that have been included via ":".
     *
     * If the $section is null, then all sections in the ini file are loaded.
     *
     * If any key includes a ".", then this will act as a separator to
     * create a sub-property.
     *
     * example ini file:
     *      [all]
     *      db.connection = database
     *      hostname = live
     *
     *      [staging : all]
     *      hostname = staging
     *
     * after calling $data = new Yaf_Config_Ini($file, 'staging'); then
     *      $data->hostname === "staging"
     *      $data->db->connection === "database"
     *
     * @param  string        $filename
     * @param  mixed         $section
     * @param  boolean $readonly
     * @throws Yaf_Config_Exception
     * @return void
     */
    public function __construct($filename, $section = null)
    {
        if (empty($filename)) {
            Yaf_Exception::trigger_error(
                'Unable to find config file '.$filename, E_USER_ERROR
            );
            //throw new Yaf_Config_Exception('Filename is not set');
        }
        if (is_array($filename)) {
            $this->_config = $filename;
        } elseif (is_string($filename)) {

        $iniArray = $this->_loadIniFile($filename);

        if (null === $section) {
            // Load entire file
            $dataArray = array();
            foreach ($iniArray as $sectionName => $sectionData) {
                if (!is_array($sectionData)) {
                    $dataArray =
                        $this->_arrayMergeRecursive(
                            $dataArray, $this->_processKey(
                                array(), $sectionName, $sectionData
                            )
                        );
                } else {
                    $dataArray[$sectionName] = $this->_processSection(
                        $iniArray, $sectionName
                    );
                }
            }
            parent::__construct($dataArray, true);
        } else {
            // Load one or more sections
            if (!is_array($section)) {
                $section = array($section);
            }
            $dataArray = array();
            foreach ($section as $sectionName) {
                if (!isset($iniArray[$sectionName])) {
                    throw new Yaf_Config_Exception(
                        "There is no section '$sectionName' in '$filename'"
                    );
                }
                $dataArray = $this->_arrayMergeRecursive(
                    $this->_processSection($iniArray, $sectionName), $dataArray
                );
            }
            parent::__construct($dataArray, true);
        }
        } else {
            throw new Yaf_Exception_TypeError(
                'Invalid parameters provided, must be path of ini file'
            );
        }
    }

    /**
     * Retrieve a value and return null if there is no element set.
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function get ($name)
    {
        if ($name == null) {
            return false;
        }
        $result = null;
        if (array_key_exists($name, $this->_config)) {
            $result = $this->_config[$name];
        }
        if (is_array($result)) {
            $result = new self($result, $this->readonly());
        }
        return $result;
    }

    /**
     * Load the INI file from disk using parse_ini_file().

     * @param string $filename
     * @return array
     */
    protected function _parseIniFile($filename)
    {
        //set_error_handler(array($this, '_loadFileErrorHandler'));
        $iniArray = parse_ini_file($filename, true);
        //restore_error_handler();

        /*// Check if there was a error while loading file
        if ($this->_loadFileErrorStr !== null) {
            throw new Yaf_Config_Exception($this->_loadFileErrorStr);
        }*/

        return $iniArray;
    }

    /**
     * Load the ini file and preprocess the section separator (':' in the
     * section name (that is used for section extension) so that the resultant
     * array has the correct section names and the extension information is
     * stored in a sub-key called ';extends'. We use ';extends' as this can
     * never be a valid key name in an INI file that has been loaded using
     * parse_ini_file().
     *
     * @param string $filename
     * @throws Yaf_Config_Exception
     * @return array
     */
    protected function _loadIniFile($filename)
    {
        $loaded = $this->_parseIniFile($filename);
        $iniArray = array();
        foreach ($loaded as $key => $data) {
            $pieces = explode(':', $key);
            $thisSection = trim($pieces[0]);
            switch (count($pieces)) {
                case 1:
                    $iniArray[$thisSection] = $data;
                    break;

                case 2:
                    $extendedSection = trim($pieces[1]);
                    $iniArray[$thisSection] = array_merge(
                        array(';extends'=>$extendedSection), $data
                    );
                    break;

                default:
                    throw new Yaf_Config_Exception(
                        "Section '$thisSection' may not extend ".
                        "multiple sections in $filename"
                    );
            }
        }

        return $iniArray;
    }

    /**
     * Process each element in the section and handle the ";extends" inheritance
     * key. Passes control to _processKey() to handle the nest separator
     * sub-property syntax that may be used within the key name.
     *
     * @param  array  $iniArray
     * @param  string $section
     * @param  array  $config
     * @throws Yaf_Config_Exception
     * @return array
     */
    protected function _processSection($iniArray, $section, $config = array())
    {
        $thisSection = $iniArray[$section];
        if (is_array($thisSection)) {
            foreach ($thisSection as $key => $value) {
                if (strtolower($key) == ';extends') {
                    if (isset($iniArray[$value])) {
                            $config = $this->_processSection(
                                $iniArray, $value, $config
                            );
                    } else {
                        throw new Yaf_Config_Exception(
                            "Parent section '$value' cannot be found"
                        );
                    }
                } else {
                    $config = $this->_processKey($config, $key, $value);
                }
            }
        }
        return $config;
    }

    /**
     * Assign the key's value to the property list. Handles the
     * nest separator for sub-properties.
     *
     * @param  array  $config
     * @param  string $key
     * @param  string $value
     * @throws Yaf_Config_Exception
     * @return array
     */
    protected function _processKey($config, $key, $value)
    {
        if (strpos($key, '.') !== false) {
            $pieces = explode('.', $key, 2);
            if (strlen($pieces[0]) && strlen($pieces[1])) {
                if (!isset($config[$pieces[0]])) {
                    if ($pieces[0] === '0' && !empty($config)) {
                        // convert the current values in $config into an array
                        $config = array($pieces[0] => $config);
                    } else {
                        $config[$pieces[0]] = array();
                    }
                } elseif (!is_array($config[$pieces[0]])) {
                    throw new Yaf_Config_Exception(
                        "Cannot create sub-key for '{$pieces[0]}' ".
                        "as key already exists"
                    );
                }
                $config[$pieces[0]] = $this->_processKey(
                    $config[$pieces[0]], $pieces[1], $value
                );
            } else {
                throw new Yaf_Config_Exception("Invalid key '$key'");
            }
        } else {
            $config[$key] = $value;
        }
        return $config;
    }
}