<?php
/**
 * Created by PhpStorm.
 * User: fafq
 * Date: 02.09.14
 * Time: 22:48
 */
require_once dirname(__FILE__) . '/../bootstrap.php';

abstract class Kwas_Script_Abstract
{
    protected $_args = array();

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->_parseArgs();
    }

    /**
     * Parses command-line arguments.
     */
    protected function _parseArgs()
    {
        $argv = $_SERVER['argv'];
        $argc = $_SERVER['argc'];

        $arg = null;
        for ($i = 1; $i < $argc; $i++) {
            $matches = array();
            preg_match('/--([a-zA-Z]+[0-9]*)/', $argv[$i], $matches);
            if (!empty($matches)) {
                $arg = $matches[1];
                $this->_args[$arg] = null;
            }
            else {
                $this->_args[$arg] = $argv[$i];
                $arg = null;
            }
        }
    }

    /**
     * Fetches value of command-line argument with given name.
     *
     * @param $name string
     * @return bool|string
     */
    protected function _getArg($name)
    {
        if (is_string($name) && !empty($name) && isset($this->_args[$name])) {
            return (string) $this->_args[$name];
        }

        return false;
    }

    /**
     * Method stub. Executes the script.
     */
    abstract public function run();
}