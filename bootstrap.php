<?php
/**
 * Created by PhpStorm.
 * User: fafq
 * Date: 03.09.14
 * Time: 21:55
 */

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    $ds = '\\';
} else {
    $ds = '/';
}
define('DS', $ds);

$rootPath = dirname(__FILE__);
define('ROOT_PATH', $rootPath);

spl_autoload_register(function ($className) {
    $includeDirs = ['app', 'cfg', 'lib', 'model'];
    foreach ($includeDirs as $dir) {
        $path = ROOT_PATH . DS . $dir . DS  . $className . '.php';
        if (file_exists($path)) {
            require_once $path;
            break;
        }
    }
});