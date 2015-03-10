<?php
/**
 * MyAllocator Inbound API Definitions
 *
 * @package     myallocator/myallocator-php-sdk-ota
 * @author      Nathan Helenihi <support@myallocator.com>
 * @copyright   Copyright (c) MyAllocator
 * @license     http://mit-license.org/
 * @link        https://github.com/MyAllocator/myallocator-php-sdk-ota
 */

return array(
    'HealthCheck' => array(
        'args' => array(
            'req' => array(
                'verb',
            ),
            'opt' => array()
        )
    ),
    'SetupProperty' => array(
        'args' => array(
            'req' => array(
                'verb',
                'mya_property_id',
                'ota_property_id',
                'ota_regcode'
            ),
            'opt' => array(
                'guid'
            )
        )
    ),
    'GetRoomTypes' => array(
        'args' => array(
            'req' => array(
                'verb',
                'mya_property_id',
                'ota_property_id',
            ),
            'opt' => array(
                'guid'
            )
        )
    ),
    'GetBookingId' => array(
        'args' => array(
            'req' => array(
                'verb',
                'mya_property_id',
                'ota_property_id',
                'booking_id'
            ),
            'opt' => array(
                'guid',
                'booking_id_version'
            )
        )
    ),
    'GetBookingList' => array(
        'args' => array(
            'req' => array(
                'verb',
                'mya_property_id',
                'ota_property_id',
            ),
            'opt' => array(
                'guid'
            )
        )
    ),
    'ARIUpdate' => array(
        'args' => array(
            'req' => array(
                'verb',
                'mya_property_id',
                'ota_property_id',
                'Inventory'
            ),
            'opt' => array(
                'guid'
            )
        )
    )
);
