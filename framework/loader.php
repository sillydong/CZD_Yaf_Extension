<?php
function yaf_auto_load($classname)
{
    $yafNamespace = 'Yaf';
    $namespaceSeparator = '\\';
    $fileName = '';
    $namespace = '';
    if ($yafNamespace.$namespaceSeparator === substr($classname, 0, strlen($yafNamespace.$namespaceSeparator))) {
            $fileName = '';
            $namespace = '';
            if (false !== ($lastNsPos = strripos($classname, $namespaceSeparator))) {
                $namespace = substr($classname, 0, $lastNsPos);
                $classname = substr($classname, $lastNsPos + 1);
                $fileName = str_replace($namespaceSeparator, DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
            }
    }
    if ($namespace == 'Yaf' || stripos($namespace, 'Yaf'.$namespaceSeparator) === 0) {
        include_once(APPLICATION_PATH . '/framework/Yaf_Namespace/G.php');
        \Yaf\G::iniSet('yaf.use_namespace', true);
        $fileName = str_replace('Yaf'.DIRECTORY_SEPARATOR, 'Yaf_Namespace'.DIRECTORY_SEPARATOR, $fileName);
    }
    $path = $fileName. str_replace('_', DIRECTORY_SEPARATOR, $classname) . '.php';
    if (file_exists(APPLICATION_PATH . '/framework/' . $path )) {
        require_once(APPLICATION_PATH. '/framework/' . $path);
    }
    /*$path = str_replace("_", DIRECTORY_SEPARATOR, $classname);
    if (file_exists(APPLICATION_PATH . '/framework/' . $path . '.php')) {
        require_once(APPLICATION_PATH. '/framework/' . $path . '.php');
    }*/
}
spl_autoload_register('yaf_auto_load');