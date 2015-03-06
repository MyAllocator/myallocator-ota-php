<?php
/**
 * MyAllocator UpdateProfile outbound API.
 * Update OTA information in MyAllocator.
 *
 * @package     myallocator/myallocator-php-sdk-ota
 * @author      Nathan Helenihi <support@myallocator.com>
 * @copyright   Copyright (c) MyAllocator
 * @license     http://mit-license.org/
 * @link        https://github.com/MyAllocator/myallocator-php-sdk-ota
 */

namespace MyAllocator\phpsdkota\src\Api\Outbound;
use MyAllocator\phpsdkota\src\Api\MaApi;

/**
 * Outbound API
 *
 * Update OTA information in MyAllocator.
 */
class UpdateProfile extends MaApi
{
    /**
     * @var string The api to call.
     */
    protected $id = __CLASS__;

    /**
     * @var array Array of required and optional authentication and argument 
     *      keys (string) for API method.
     */
    protected $keys = array(
        'args' => array(
            'req' => array(),
            'opt' => array(
                'shared_secret',
                'ota_cid',
                'name',
                'api_url',
                'api_timeout',
                'api_version'
            )
        )
    );
}
