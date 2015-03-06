<?php
/**
 * MyAllocator BuildToUs PHP SDK UpdateProperty Tests
 *
 * @package     myallocator/myallocator-php-sdk-ota
 * @author      Nathan Helenihi <support@myallocator.com>
 * @copyright   Copyright (c) MyAllocator
 * @license     http://mit-license.org/
 * @link        https://github.com/MyAllocator/myallocator-php-sdk-ota
 */

namespace MyAllocator\phpsdkota\tests;

use MyAllocator\phpsdkota\src\Api\Outbound\UpdateProfile;

class UpdateProfileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @author nathanhelenihi
     * @group api
     * @group outbound
     */
    public function testClass()
    {
        $obj = new UpdateProfile();
        $this->assertEquals('MyAllocator\phpsdkota\src\Api\Outbound\UpdateProfile', get_class($obj));
    }

    /**
     * @author nathanhelenihi
     * @group api
     * @group outbound
     */
    public function testCallApi()
    {
        $obj = new UpdateProfile();

        if (!$obj->isEnabled()) {
            $this->markTestSkipped('API is disabled!');
        }

        // No parameters should throw exception
        $caught = false;
        try {
            $rsp = $obj->callApi();
        } catch (\exception $e) {
            $caught = true;
        }

        if (!$caught) {
            $this->fail('should have thrown an exception');
        }

        // TODO
/*
        $rsp = $obj->callApiWithParams(array(
            'ota_property_id' => 1,
            'booking_id' => 1
        ));
        //$this->assertTrue(isset($rsp['response']['body']['Bookings']));
*/
    }
}
