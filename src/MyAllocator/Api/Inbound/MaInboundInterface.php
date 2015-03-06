<?php
/**
 * MyAllocator BuildToUs PHP SDK Inbound API Interface
 *
 * @package     myallocator/myallocator-php-sdk-ota
 * @author      Nathan Helenihi <support@myallocator.com>
 * @copyright   Copyright (c) MyAllocator
 * @license     http://mit-license.org/
 * @link        https://github.com/MyAllocator/myallocator-php-sdk-ota
 */

namespace MyAllocator\phpsdkota\src\Api\Inbound;

/**
 * Inbound API interface. (MA -> OTA)
 */
interface MaInboundInterface
{
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
    public function setupProperty($args);

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
    public function getRoomTypes($args);

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
    public function getBookingId($args);

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
    public function getBookingList($args);

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
    public function ARIUpdate($args);
}
