<?php
/**
 * MyAllocator BuildToUs PHP SDK MaRouter Tests
 *
 * @package     myallocator/myallocator-php-sdk-ota
 * @author      Nathan Helenihi <support@myallocator.com>
 * @copyright   Copyright (c) MyAllocator
 * @license     http://mit-license.org/
 * @link        https://github.com/MyAllocator/myallocator-php-sdk-ota
 */

namespace MyAllocator\phpsdkota\tests;

use MyAllocator\phpsdkota\src\Api\Inbound\MaRouter;
use MyAllocator\phpsdkota\src\Object\MaResponse;
use MyAllocator\phpsdkota\src\Object\MaError;
require_once(dirname(__FILE__) . '/fixtures/MaInboundInterfaceStub.php');

class MaRouterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @author nathanhelenihi
     * @group api
     * @group inbound
     */
    public function testClass()
    {
        $interface = new \MaInboundInterfaceStub();
        $obj = new MaRouter($interface);
        $this->assertEquals('MyAllocator\phpsdkota\src\Api\Inbound\MaRouter', get_class($obj));
    }

    /**
     * @author nathanhelenihi
     * @group api
     * @group inbound
     */
    public function testProcessRequestArgsNullShouldFail()
    {
        // Load error definitions
        new MaError();

        // Load router
        $interface = new \MaInboundInterfaceStub();
        $obj = new MaRouter($interface);

        // Test null arg
        $rsp = $obj->processRequest();
        $this->assertEquals(false, $rsp['success']);
        $this->assertEquals(MA_OTA_ERR_ARGS_INVALID, $rsp['errors'][0]['id']);
    }

    /**
     * @author nathanhelenihi
     * @group api
     * @group inbound
     */
    public function testProcessRequestJsonInvalidShouldFail()
    {
        // Load error definitions
        new MaError();

        // Load router
        $interface = new \MaInboundInterfaceStub();
        $obj = new MaRouter($interface);

        // Test null arg
        $request = "{oops'key': 'value'}";
        $rsp = $obj->processRequest($request);
        $this->assertEquals(false, $rsp['success']);
        $this->assertEquals(MA_OTA_ERR_JSON_INVALID, $rsp['errors'][0]['id']);

        // Test not array
        $request = '"this is a test"';
        $rsp = $obj->processRequest($request);
        $this->assertEquals(false, $rsp['success']);
        $this->assertEquals(MA_OTA_ERR_JSON_INVALID, $rsp['errors'][0]['id']);
    }

    /**
     * @author nathanhelenihi
     * @group api
     * @group inbound
     */
    public function testProcessRequestAuthInvalidShouldFail()
    {
        // Load error definitions
        new MaError();

        // Load router
        $interface = new \MaInboundInterfaceStub();
        $obj = new MaRouter($interface);

        // Test missing shared_secret
        $request = '{"verb":"HealthCheck"}';
        $rsp = $obj->processRequest($request);
        $this->assertEquals(false, $rsp['success']);
        $this->assertEquals(MA_OTA_ERR_AUTH_INVALID, $rsp['errors'][0]['id']);

        // Test invalid shared_secret
        $request = '{"verb":"HealthCheck", "shared_secret": "bad"}';
        $rsp = $obj->processRequest($request);
        $this->assertEquals(false, $rsp['success']);
        $this->assertEquals(MA_OTA_ERR_AUTH_INVALID, $rsp['errors'][0]['id']);
    }

    /**
     * @author nathanhelenihi
     * @group api
     * @group inbound
     */
    public function testProcessRequestVerbInvalidShouldFail()
    {
        // Load error definitions
        new MaError();

        // Load router
        $interface = new \MaInboundInterfaceStub();
        $obj = new MaRouter($interface);

        // Test missing verb
        $request = '{"shared_secret": "test"}';
        $rsp = $obj->processRequest($request);
        $this->assertEquals(false, $rsp['success']);
        $this->assertEquals(MA_OTA_ERR_VERB_INVALID, $rsp['errors'][0]['id']);

        // Test invalid verb
        $request = '{"verb":"HealthCheckOops", "shared_secret": "test"}';
        $rsp = $obj->processRequest($request);
        $this->assertEquals(false, $rsp['success']);
        $this->assertEquals(MA_OTA_ERR_VERB_INVALID, $rsp['errors'][0]['id']);
    }

    /**
     * @author nathanhelenihi
     * @group api
     * @group inbound
     */
    public function testProcessRequestApiHealthCheck()
    {
        // Load error definitions
        new MaError();

        // Load router
        $interface = new \MaInboundInterfaceStub();
        $obj = new MaRouter($interface);

        // Test api
        $request = '{"verb":"HealthCheck", "shared_secret": "test"}';
        $rsp = $obj->processRequest($request);
        $this->assertEquals(true, $rsp['success']);
        $this->assertEquals(null, $rsp['errors']);
    }

    /**
     * @author nathanhelenihi
     * @group api
     * @group inbound
     */
    public function testProcessRequestApiSetupProperty()
    {
        // Load error definitions
        new MaError();

        // Load router
        $interface = new \MaInboundInterfaceStub();
        $obj = new MaRouter($interface);

        // Test api
        $request = array(
            'shared_secret' => 'test',
            'verb' => 'SetupProperty',
            'guid' => '123',
            'mya_property_id' => 1,
            'ota_property_id' => 1,
            'ota_regcode' => 1
        );
        $rsp = $obj->processRequest(json_encode($request));
        $this->assertEquals(true, $rsp['success']);
        $this->assertEquals(null, $rsp['errors']);
    }

    /**
     * @author nathanhelenihi
     * @group api
     * @group inbound
     */
    public function testProcessRequestApiGetRoomTypes()
    {
        // Load error definitions
        new MaError();

        // Load router
        $interface = new \MaInboundInterfaceStub();
        $obj = new MaRouter($interface);

        // Test api
        $request = array(
            'shared_secret' => 'test',
            'verb' => 'GetRoomTypes',
            'guid' => '123',
            'mya_property_id' => 1,
            'ota_property_id' => 1
        );
        $rsp = $obj->processRequest(json_encode($request));
        $this->assertEquals(true, $rsp['success']);
        $this->assertEquals(null, $rsp['errors']);
    }

    /**
     * @author nathanhelenihi
     * @group api
     * @group inbound
     */
    public function testProcessRequestApiGetBookingId()
    {
        // Load error definitions
        new MaError();

        // Load router
        $interface = new \MaInboundInterfaceStub();
        $obj = new MaRouter($interface);

        // Test api
        $request = array(
            'shared_secret' => 'test',
            'verb' => 'GetBookingId',
            'guid' => '123',
            'mya_property_id' => 1,
            'ota_property_id' => 1,
            'booking_id' => 1,
            'booking_id_version' => 1
        );
        $rsp = $obj->processRequest(json_encode($request));
        $this->assertEquals(true, $rsp['success']);
        $this->assertEquals(null, $rsp['errors']);
    }

    /**
     * @author nathanhelenihi
     * @group api
     * @group inbound
     */
    public function testProcessRequestApiARIUpdate()
    {
        // Load error definitions
        new MaError();

        // Load router
        $interface = new \MaInboundInterfaceStub();
        $obj = new MaRouter($interface);

        // Test api
        $request = array(
            'shared_secret' => 'test',
            'verb' => 'ARIUpdate',
            'guid' => '123',
            'mya_property_id' => 1,
            'ota_property_id' => 1,
            'ota_room_id' => 1,
            'Rates' => 1,
            'Availability' => 1
        );
        $rsp = $obj->processRequest(json_encode($request));
        $this->assertEquals(true, $rsp['success']);
        $this->assertEquals(null, $rsp['errors']);
    }

    /**
     * @author nathanhelenihi
     * @group api
     * @group inbound
     */
    public function testProcessRequestApiGetBookingList()
    {
        // Load error definitions
        new MaError();

        // Load router
        $interface = new \MaInboundInterfaceStub();
        $obj = new MaRouter($interface);

        // Test api
        $request = array(
            'shared_secret' => 'test',
            'verb' => 'GetBookingList',
            'guid' => '123',
            'mya_property_id' => 1,
            'ota_property_id' => 1,
            'start_ts' => 1,
            'end_ts' => 1
        );
        $rsp = $obj->processRequest(json_encode($request));
        $this->assertEquals(true, $rsp['success']);
        $this->assertEquals(null, $rsp['errors']);
    }
}
