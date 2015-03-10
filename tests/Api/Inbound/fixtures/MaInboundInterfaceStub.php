<?php
/**
 * MyAllocator BuildToUs PHP SDK Inbound API Interface Stub
 *
 * @package     myallocator/myallocator-php-sdk-ota
 * @author      Nathan Helenihi <support@myallocator.com>
 * @copyright   Copyright (c) MyAllocator
 * @license     http://mit-license.org/
 * @link        https://github.com/MyAllocator/myallocator-php-sdk-ota
 */

use MyAllocator\phpsdkota\src\Api\Inbound\MaInboundInterface;
use MyAllocator\phpsdkota\src\Object\MaResponse;

/**
 * Inbound API interface stub. (MA -> OTA)
 */
class MaInboundInterfaceStub implements \MyAllocator\phpsdkota\src\Api\Inbound\MaInboundInterface
{
    /**
     * Authenticate Myallocator/OTA property.
     *
     * After myallocator calls setupProperty, OTA stores mya_property_id to ota_property_id mapping.
     * On each request, validate the 1:1 mya_property_id to ota_property_id mapping.
     *
     * args['mya_property_id']* string The property_id in MyAllocator.
     * args['ota_property_id']* string The property_id in OTA.
     *
     * @param array $args (See above)
     *
     * @return \MyAllocator\phpsdkota\src\Object\MaResponse
     */
    public function authenticateProperty($args)
    {
        return new \MyAllocator\phpsdkota\src\Object\MaResponse();
    }

    /**
     * Setup a new property on OTA.
     *
     * args['verb']*            string Defines the API endpoint method.
     * args['guid']*            string A unique 36 character code that identifies a request.
     * args['mya_property_id']* string The property_id in MyAllocator.
     * args['ota_property_id']* string The property_id in OTA.
     * args['ota_regcode']      string ? TODO
     *
     * @param array $args (See above)
     *
     * @return \MyAllocator\phpsdkota\src\Object\MaResponse
     */
    public function setupProperty($args)
    {
        return new \MyAllocator\phpsdkota\src\Object\MaResponse();
    }

    /**
     * Get room type information for a property.
     *
     * args['verb']*            string Defines the API endpoint method.
     * args['guid']*            string A unique 36 character code that identifies a request.
     * args['mya_property_id']* string The property_id in MyAllocator.
     * args['ota_property_id']* string The property_id in OTA.
     *
     * @param array $args (See above)
     *
     * @return \MyAllocator\phpsdkota\src\Object\MaResponse
     */
    public function getRoomTypes($args)
    {
        return new \MyAllocator\phpsdkota\src\Object\MaResponse();
    }

    /**
     * Get information for a specific booking for a property.
     *
     * args['verb']*                string Defines the API endpoint method.
     * args['guid']*                string A unique 36 character code that identifies a request.
     * args['mya_property_id']*     string The property_id in MyAllocator.
     * args['ota_property_id']*     string The property_id in OTA.
     * args['booking_id']*          string The booking identifier.
     * args['booking_id_version']  string The OTA version at time of booking.
     *
     * @param array $args (See above)
     *
     * @return \MyAllocator\phpsdkota\src\Object\MaResponse
     */
    public function getBookingId($args)
    {
        return new \MyAllocator\phpsdkota\src\Object\MaResponse();
    }

    /**
     * Get a list of bookings within a date range for a property.
     *
     * args['verb']*            string Defines the API endpoint method.
     * args['guid']*            string A unique 36 character code that identifies a request.
     * args['mya_property_id']* string The property_id in MyAllocator.
     * args['ota_property_id']* string The property_id in OTA.
     * args['start_ts']*        string The start timestamp (YYYYMMDDtHHMMSSZ).
     * args['end_ts']*          string The end timestamp (YYYYMMDDtHHMMSSZ).
     *
     * @param array $args (See above)
     *
     * @return \MyAllocator\phpsdkota\src\Object\MaResponse
     */
    public function getBookingList($args)
    {
        return new \MyAllocator\phpsdkota\src\Object\MaResponse();
    }

    /**
     * Update inventory (rates and availability) for a property.
     *
     * args['verb']*            string Defines the API endpoint method.
     * args['guid']*            string A unique 36 character code that identifies a request.
     * args['mya_property_id']* string The property_id in MyAllocator.
     * args['ota_property_id']* string The property_id in OTA.
     * args['ota_room_id']*     string The room_id in OTA.
     * args['Rates']*           string The rates to update.
     * args['Availability']*    string The availability to update.
     *
     * @param array $args (See above)
     *
     * @return \MyAllocator\phpsdkota\src\Object\MaResponse
     */
    public function ARIUpdate($args)
    {
        return new \MyAllocator\phpsdkota\src\Object\MaResponse();
    }

    /**
     * Inbound API logs. Implement a logging method here to capture the inbound API logs.
     *
     * @param string $str The log.
     */
    public function log($str, $data = null)
    {
        return;
    }
}
