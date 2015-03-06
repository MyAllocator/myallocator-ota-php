<?php
/**
 * The MyAllocator base class to be extended by API's and Utilities.
 *
 * @package     myallocator/myallocator-php-sdk-ota
 * @author      Nathan Helenihi <support@myallocator.com>
 * @copyright   Copyright (c) MyAllocator
 * @license     http://mit-license.org/
 * @link        https://github.com/MyAllocator/myallocator-php-sdk-ota
 */

namespace MyAllocator\phpsdkota\src;

class MaBaseClass
{
    /**
     * @var array MyAllocator API configuration.
     */
    protected $config = null;

    /**
     * Class contructor
     */
    public function __construct()
    {
        // Load configuration from file
        $this->config = require(dirname(__FILE__) . '/Config/MaConfig.php');
    }

    /**
     * Set an API configuration key.
     *
     * @param key $key The configuration key. 
     * @param value $value The configuration key value. 
     *
     * @return boolean|null Result of the set.
     */
    public function setConfig($key = null, $value = null)
    {
        if ($key == null || $value == null) {
            return null;
        }
        return ($this->config[$key] = $value);
    }

    /**
     * Get an API configuration value by key.
     *
     * @param key $key The configuration key. 
     *
     * @return mixed|null The configuration value.
     */
    public function getConfig($key)
    {
        return (isset($this->config[$key])) ? $this->config[$key] : null;
    }

    /**
     * Echoes a string if debugsEnabled is set to true.
     *
     * @param string $str The string to echo.
     *
     */
    protected function debug_echo($str)
    {
        $this->debug('echo', $str);
    }

    /**
     * Dumps an object/variable if debugsEnabled is set to true.
     *
     * @param mixed $obj The object or vairable to dump.
     */
    protected function debug_var_dump($obj)
    {
        $this->debug('var_dump', $obj);
    }

    /**
     * Prints an array if debugsEnabled is set to true.
     *
     * @param array $array The array to print.
     */
    protected function debug_print_r($array)
    {
        $this->debug('print_r', $array);
    }

    /**
     * Generates some output if debugsEnabled is set to true.
     *
     * @param string $type The output type.
     * @param mixed $mixed The object, array, or variable.
     */
    protected function debug($type, $mixed)
    {
        if ($this->config && $this->config['debugsEnabled']) {
            switch ($type) {
                case 'echo':
                    echo $mixed;
                    break;
                case 'print_r':
                    print_r($mixed);
                    break;
                case 'var_dump':
                    var_dump($mixed);
                    break;
            }
        }
    }
}
