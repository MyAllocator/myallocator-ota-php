<?php
/**
 * MyAllocator BuildToUs PHP SDK Response Object
 *
 * @package     myallocator/myallocator-php-sdk-ota
 * @author      Nathan Helenihi <support@myallocator.com>
 * @copyright   Copyright (c) MyAllocator
 * @license     http://mit-license.org/
 * @link        https://github.com/MyAllocator/myallocator-php-sdk-ota
 */

namespace MyAllocator\phpsdkota\src\Object;
use MyAllocator\phpsdkota\src\Object\MaError;

class MaResponse
{
    /**
     * @var boolean The result: true = success, false = error
     */
    public $success = true;

    /**
     * @var boolean Data to be returned.
     */
    public $data = null;

    /**
     * @var array Array of errors. [{id:'', type:'', msg:''}, ...]
     */
    public $errors = array();

    /**
     * Set response to success and return an object response.
     *
     * @param mixed $data Data to return in successful response.
     *
     * @return \MyAllocator\phpsdkota\src\Object\MaResponse Response object.
     */
    public function success($data = null)
    {
        $this->success = true;
        $this->data = $data;
        return $this;
    }

    /**
     * Add an error to the response object.
     *
     * @param int $error The Error code.
     * @param string $msg Custom error message.
     *
     * @return \MyAllocator\phpsdkota\src\Object\MaResponse Response object.
     */
    public function error($id, $data = null)
    {
        $this->success = false;
        $this->errors[] = new \MyAllocator\phpsdkota\src\Object\MaError($id, $data);
        return $this;
    }

    /**
     * Convert response object to an array.
     *
     * @return array Response array.
     */
    public function toArray()
    {
        $response = array(
            'success' => $this->success,
            'data' => $this->data,
            'errors' => array()
        );

        foreach ($this->errors as $err) {
            $response['errors'][] = $err->toArray();
        }

        // If no errors, set errors null
        if (empty($response['errors'])) {
            $response['errors'] = null;
        }

        // If no data, set data null
        if ($response['data'] === null) {
            $response['data'] = null;
        }

        return $response;
    }
}
