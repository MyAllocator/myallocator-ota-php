<?php
/**
 * MyAllocator outbound API autoload example.
 *
 *  1. Receives incoming requests from the endpoint receiver.
 *  2. Authenticates the request.
 *  3. Validates the request data.
 *  4. Invokes the backend method.
 *  5. Responds to invoking script.
 *
 * @package     myallocator/myallocator-php-sdk-ota
 * @author      Nathan Helenihi <support@myallocator.com>
 * @copyright   Copyright (c) MyAllocator
 * @license     http://mit-license.org/
 * @link        https://github.com/MyAllocator/myallocator-php-sdk-ota
 */

/*
 * You may use require_once similar to below to autoload
 * the MyAllocator PHP SDK. Composer package install is
 * preferred.
 */

require_once(dirname(__FILE__) . '/MyAllocator.php');

use MyAllocator\phpsdk\src\Api\HelloWorld;

$params = array(
    'Auth' => 'true',
    'hello' => 'world'
);

$api = new HelloWorld();
$api->setConfig('dataFormat', 'array');
try {
    $rsp = $api->callApiWithParams($params);
} catch (Exception $e) {
    $rsp = 'Oops: '.$e->getMessage();
}
var_dump($rsp);
