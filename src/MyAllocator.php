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

// Initial Dependencies
require_once(dirname(__FILE__) . '/MyAllocator/MaBaseClass.php');
require_once(dirname(__FILE__) . '/MyAllocator/Exception/MaException.php');
require_once(dirname(__FILE__) . '/MyAllocator/Api/MaApi.php');

// Configuration
foreach (glob(dirname(__FILE__) . '/MyAllocator/Config/*.php') as $file) {
    require_once($file);
}

// Exceptions
foreach (glob(dirname(__FILE__) . '/MyAllocator/Exception/*.php') as $file) {
    require_once($file);
}

// Utilities
foreach (glob(dirname(__FILE__) . '/MyAllocator/Util/*.php') as $file) {
    require_once($file);
}

// Objects
foreach (glob(dirname(__FILE__) . '/MyAllocator/Object/*.php') as $file) {
    require_once($file);
}

// APIs
foreach (glob(dirname(__FILE__) . '/MyAllocator/Api/Inbound/*.php') as $file) {
    require_once($file);
}

foreach (glob(dirname(__FILE__) . '/MyAllocator/Api/Outbound/*.php') as $file) {
    require_once($file);
}
