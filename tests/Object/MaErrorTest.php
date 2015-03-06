<?php
/**
 * MyAllocator BuildToUs PHP SDK MaError Tests
 *
 * @package     myallocator/myallocator-php-sdk-ota
 * @author      Nathan Helenihi <support@myallocator.com>
 * @copyright   Copyright (c) MyAllocator
 * @license     http://mit-license.org/
 * @link        https://github.com/MyAllocator/myallocator-php-sdk-ota
 */

namespace MyAllocator\phpsdkota\tests;
 
use MyAllocator\phpsdkota\src\Object\MaError;
 
class MaErrorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @author nathanhelenihi
     * @group common
     */
    public function testClass()
    {
        $obj = new MaError();
        $this->assertEquals('MyAllocator\phpsdkota\src\Object\MaError', get_class($obj));
    }

    /**
     * @author nathanhelenihi
     * @group common
     */
    public function testConstructorDefault()
    {
        $obj = new MaError();

        $errors = $obj->getMappings();

        $this->assertEquals($obj->id, MA_OTA_ERR);
        $this->assertEquals($obj->type, $errors[MA_OTA_ERR]['type']);
        $this->assertEquals($obj->msg, $errors[MA_OTA_ERR]['msg']);
    }

    /**
     * @author nathanhelenihi
     * @group common
     */
    public function testConstructorError()
    {
        $data = 'Bad data';
        $obj = new MaError(MA_OTA_ERR_JSON_INVALID, $data);

        $errors = $obj->getMappings();

        $this->assertEquals($obj->id, MA_OTA_ERR_JSON_INVALID);
        $this->assertEquals($obj->type, $errors[MA_OTA_ERR_JSON_INVALID]['type']);
        $this->assertEquals($obj->msg, $errors[MA_OTA_ERR_JSON_INVALID]['msg']);
        $this->assertEquals($obj->data, $data);
    }

    /**
     * @author nathanhelenihi
     * @group common
     */
    public function testConstructorErrorInvalidShouldFail()
    {
        $data = 'Bad data';
        $obj = new MaError(9000, $data);

        $errors = $obj->getMappings();

        $this->assertEquals($obj->id, MA_OTA_ERR);
        $this->assertEquals($obj->type, $errors[MA_OTA_ERR]['type']);
        $this->assertEquals($obj->msg, $errors[MA_OTA_ERR]['msg']);
        $this->assertEquals($obj->data, $data);
    }

    /**
     * @author nathanhelenihi
     * @group common
     */
    public function testToArray()
    {
        $data = 'Bad data';
        $obj = new MaError(MA_OTA_ERR_JSON_INVALID, $data);

        $errors = $obj->getMappings();

        $this->assertSame($obj->toArray(), array(
            'id' => MA_OTA_ERR_JSON_INVALID,
            'type' => $errors[MA_OTA_ERR_JSON_INVALID]['type'],
            'msg' => $errors[MA_OTA_ERR_JSON_INVALID]['msg'],
            'data' => $data
        ));
    }
}
