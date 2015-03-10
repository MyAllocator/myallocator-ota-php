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
        $rsp = new \MyAllocator\phpsdkota\src\Object\MaResponse();

        // Check DB for property_id match
        $auth_success = true;

        if (!$auth_success) {
            return $rsp->error(MA_OTA_ERR_AUTH_PROPERTY_INVALID);
        }

        return $rsp->success();
    }

    /**
     * Setup a new property on OTA.
     *
     * args['verb']*            string Defines the API endpoint method.
     * args['guid']*            string A unique 36 character code that identifies a request.
     * args['mya_property_id']* string The property_id in MyAllocator.
     * args['ota_property_id']* string The property_id in OTA.
     * args['ota_regcode']      string The ota regcode (password).
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
        $rsp = new \MyAllocator\phpsdkota\src\Object\MaResponse();

        $data = array(
            'Rooms' => array(
                array(
                    'ota_room_id' => '111',
                    'title' => 'King Room',
                    'occupancy' => '20',
                    'detail' => 'Some King Room details',
                    'dorm' => false
                ),
                array(
                    'ota_room_id' => '112',
                    'title' => 'Queen Room',
                    'occupancy' => '10',
                    'detail' => 'Some Queen Room details',
                    'dorm' => false
                ),
                array(
                    'ota_room_id' => '113',
                    'title' => 'Dorm Room',
                    'occupancy' => '10',
                    'detail' => 'Some Dorm Room details',
                    'dorm' => true
                )
            )
        );

        return $rsp->success($data);
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
        $rsp = new \MyAllocator\phpsdkota\src\Object\MaResponse();

        // Use channel test bookings from github
        $bookings = array(
            'boo-235872225.json' => 'https://raw.githubusercontent.com/MyAllocator/bookingsamples/master/boo-235872225.json',
            'exp-503365981.json' => 'https://raw.githubusercontent.com/MyAllocator/bookingsamples/master/exp-503365981.json'
        );

        // Assert booking with id exists
        if (!isset($bookings[$args['booking_id']])) {
            return $rsp->error(MA_OTA_ERR_BOOKING_NONEXIST, $args['booking_id']);
        }

        // Pull json booking and decode
        $booking = file_get_contents($bookings[$args['booking_id']]);
        $booking = json_decode($booking, true);

        $data = array(
            'Booking' => $booking
        );

        return $rsp->success($data);
    }

    /**
     * Get a list of bookings within a date range for a property.
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
    public function getBookingList($args)
    {
        $rsp = new \MyAllocator\phpsdkota\src\Object\MaResponse();

        $data = array(
            'Bookings' => array(
                array(
                    'booking_id' => 'boo-235872225.json',
                    'version' => 0
                ),
                array(
                    'booking_id' => 'exp-503365981.json',
                    'version' => 0
                )
            )
        );

        return $rsp->success($data);
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
        list($usec, $sec) = explode(' ', microtime());
        $usec = str_replace("0.", ".", $usec);  
        $date = date('Y-m-d H:i:s', $sec) . $usec;
        $log = 'Inbound API :: '.$date.' :: '.getmypid().' :: '.$str;
        if ($data) {
            $log .= " ($data)";
        }
        $log .= "\n";
        file_put_contents('/var/log/myallocator/buildToUs.log', $log, FILE_APPEND | LOCK_EX);
    }
}
