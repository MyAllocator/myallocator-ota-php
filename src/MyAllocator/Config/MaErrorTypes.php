<?php
/**
 * MyAllocator Error Codes
 *
 * @package     myallocator/myallocator-php-sdk-ota
 * @author      Nathan Helenihi <support@myallocator.com>
 * @copyright   Copyright (c) MyAllocator
 * @license     http://mit-license.org/
 * @link        https://github.com/MyAllocator/myallocator-php-sdk-ota
 */

if (!defined('MA_OTA_ERR')) {
    define('MA_OTA_ERR',                        3);
    define('MA_OTA_ERR_JSON_INVALID',           1145);
    define('MA_OTA_ERR_ARGS_INVALID',           3);
    define('MA_OTA_ERR_AUTH_INVALID',           1001);
    define('MA_OTA_ERR_AUTH_PROPERTY_INVALID',  1001);
    define('MA_OTA_ERR_VERB_INVALID',           3);
    define('MA_OTA_ERR_RSP_INVALID',            3);
    define('MA_OTA_ERR_BOOKING_NONEXIST',       1217);
}

return array(
    MA_OTA_ERR => array(
        'type' => 'ise',
        'msg' => 'Generic error should have custom msg'
    ),
    MA_OTA_ERR_JSON_INVALID => array(
        'type' => 'api',
        'msg' => 'Invalid JSON'
    ),
    MA_OTA_ERR_ARGS_INVALID => array(
        'type' => 'api',
        'msg' => 'Invalid or missing Api arguments'
    ),
    MA_OTA_ERR_AUTH_INVALID => array(
        'type' => 'api',
        'msg' => 'Invalid or missing authentication arguments'
    ),
    MA_OTA_ERR_AUTH_PROPERTY_INVALID => array(
        'type' => 'api',
        'msg' => 'Failed to authenticate the property'
    ),
    MA_OTA_ERR_VERB_INVALID => array(
        'type' => 'api',
        'msg' => 'Invalid or missing verb argument'
    ),
    MA_OTA_ERR_RSP_INVALID => array(
        'type' => 'api',
        'msg' => 'OTA is attempting to respond with invalid response'
    ),
    MA_OTA_ERR_BOOKING_NONEXIST => array(
        'type' => 'api',
        'msg' => 'The booking with id does not exist'
    )
);
