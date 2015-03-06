<?php
/**
 * MyAllocator BuildToUs PHP SDK MaResponse Tests
 *
 * @package     myallocator/myallocator-php-sdk-ota
 * @author      Nathan Helenihi <support@myallocator.com>
 * @copyright   Copyright (c) MyAllocator
 * @license     http://mit-license.org/
 * @link        https://github.com/MyAllocator/myallocator-php-sdk-ota
 */

namespace MyAllocator\phpsdkota\tests;
 
use MyAllocator\phpsdkota\src\Object\MaResponse;
use MyAllocator\phpsdkota\src\Object\MaError;
 
class MaResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @author nathanhelenihi
     * @group common
     */
    public function testClass()
    {
        $obj = new MaResponse();
        $this->assertEquals('MyAllocator\phpsdkota\src\Object\MaResponse', get_class($obj));
    }

    /**
     * @author nathanhelenihi
     * @group common
     */
    public function testConstructorDefault()
    {
        $obj = new MaResponse();

        $this->assertEquals($obj->success, true);
        $this->assertEquals($obj->data, null);
    }

    /**
     * @author nathanhelenihi
     * @group common
     */
    public function testSuccess()
    {
        $obj = new MaResponse();
        $obj->success();

        $this->assertEquals($obj->success, true);
        $this->assertEquals($obj->data, null);
    }

    /**
     * @author nathanhelenihi
     * @group common
     */
    public function testError()
    {
        new MaError(); // Just to load error definitions.
        $obj = new MaResponse();
        $data = 'Bad data';
        $obj->error(MA_OTA_ERR_JSON_INVALID, $data);

        $errors = $obj->errors[0]->getMappings();

        $this->assertEquals($obj->success, false);
        $this->assertEquals($obj->errors[0]->id, MA_OTA_ERR_JSON_INVALID);
        $this->assertEquals($obj->errors[0]->type, $errors[MA_OTA_ERR_JSON_INVALID]['type']);
        $this->assertEquals($obj->errors[0]->msg, $errors[MA_OTA_ERR_JSON_INVALID]['msg']);
        $this->assertEquals($obj->errors[0]->data, $data);
    }

    /**
     * @author nathanhelenihi
     * @group common
     */
    public function testToArray()
    {
        new MaError(); // Just to load error definitions.
        $obj = new MaResponse();
        $data = 'Bad data';
        $obj->error(MA_OTA_ERR_JSON_INVALID, $data);

        $errors = $obj->errors[0]->getMappings();

        $this->assertSame($obj->toArray(), array(
            'success' => false,
            'data' => null,
            'errors' => array(
                array(
                    'id' => MA_OTA_ERR_JSON_INVALID,
                    'type' => $errors[MA_OTA_ERR_JSON_INVALID]['type'],
                    'msg' => $errors[MA_OTA_ERR_JSON_INVALID]['msg'],
                    'data' => $data
                )
            )
        ));
    }
}
