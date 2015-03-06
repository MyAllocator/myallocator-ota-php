<?php
/**
 * MyAllocator NotifyBooking outbound API.
 * Notify MyAllocator about a booking. MyAllocator then sends a request for the data. 
 *
 * @package     myallocator/myallocator-php-sdk-ota
 * @author      Nathan Helenihi <support@myallocator.com>
 * @copyright   Copyright (c) MyAllocator
 * @license     http://mit-license.org/
 * @link        https://github.com/MyAllocator/myallocator-php-sdk-ota
 */

namespace MyAllocator\phpsdkota\src\Api\Outbound;
use MyAllocator\phpsdkota\src\Api\MaApi;

class NotifyBooking extends MaApi
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
            'req' => array(
                'shared_secret',
                'ota_cid',
                'ota_property_id',
                'booking_id'
            ),
            'opt' => array()
        )
    );
}
