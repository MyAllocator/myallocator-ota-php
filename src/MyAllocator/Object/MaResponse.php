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
use MyAllocator\phpsdkota\src\Api\Inbound\MaInboundInterface;
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
     * @var array Interface to OTA backend. Only used for logging here.
     */
    protected $logger = null;

    /**
     * Class contructor.
     *
     * @param \MyAllocator\phpsdkota\src\Api\Inbound\MaInboundInterface
     *  $interface The object implementing MaInboundInterface to invoke
     *  backend functionality.
     */
    public function __construct(MaInboundInterface $logger = null)
    {
        // Set inbound interface
        $this->logger = $logger;
    }

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
        $error = new \MyAllocator\phpsdkota\src\Object\MaError($id, $data);
        $this->log("Error", json_encode($error->toArray()));
        $this->errors[] = $error;
        return $this;
    }

    /**
     * Return array response.
     *
     * @return array Response array.
     */
    public function response()
    {
        $rsp = $this->toArray();
        $this->log("Response", json_encode($rsp));
        return $rsp; 
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
            'errors' => array()
        );

        // Add data to top level
        if ($this->data) {
            foreach($this->data as $k => $v) {
                $response[$k] = $v;
            }
        }

        foreach ($this->errors as $err) {
            $response['errors'][] = $err->toArray();
        }

        // If no errors, set errors null
        if (empty($response['errors'])) {
            $response['errors'] = null;
        }

        return $response;
    }

    /**
     * Set interface for logging.
     *
     * @return array Response array.
     */
    public function setLogger(MaInboundInterface $logger)
    {
        $this->logger = $logger;
    }

    private function log($str, $data = null)
    {
        if ($this->logger) {
            $this->logger->log($str, $data);
        }
    }
}
