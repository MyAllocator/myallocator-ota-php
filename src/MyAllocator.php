<?php
/**
 * MyAllocator Autoloader
 *
 * @package     myallocator/myallocator-php-sdk-ota
 * @author      Nathan Helenihi <support@myallocator.com>
 * @copyright   Copyright (c) MyAllocator
 * @license     http://mit-license.org/
 * @link        https://github.com/MyAllocator/myallocator-php-sdk-ota
 */

//Required packages
if (!function_exists('curl_init')) {
  throw new Exception('MyAllocator needs the CURL PHP extension.');
}

if (!function_exists('json_decode')) {
  throw new Exception('MyAllocator needs the JSON PHP extension.');
}

if (!function_exists('mb_detect_encoding')) {
  throw new Exception('MyAllocator needs the Multibyte String PHP extension.');
}

// Configuration
foreach (glob(dirname(__FILE__) . '/MyAllocator/Config/*.php') as $file) {
    require_once($file);
}

// Objects
foreach (glob(dirname(__FILE__) . '/MyAllocator/Object/*.php') as $file) {
    require_once($file);
}

// Inbound APIs
foreach (glob(dirname(__FILE__) . '/MyAllocator/Api/Inbound/*.php') as $file) {
    require_once($file);
}
