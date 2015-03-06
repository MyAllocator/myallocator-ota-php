<?php
/**
 * MyAllocator BuildToUs PHP SDK Inbound API Router
 *
 *  1. Receives incoming requests from the endpoint receiver.
 *  2. Authenticates the request.
 *  3. Validates the request data.
 *  4. Invokes the backend method.
 *  5. Responds to invoking script.
 *
 * @package     myallocator/myallocator-php-sdk-ota
 * @author      Nathan Helenihi <support@myallocator.com>
 * @copyright   Copyright (c) MyAllocator
 * @license     http://mit-license.org/
 * @link        https://github.com/MyAllocator/myallocator-php-sdk-ota
 */

namespace MyAllocator\phpsdkota\src\Api\Inbound;
use MyAllocator\phpsdkota\src\Api\Inbound\MaInboundInterface;
use MyAllocator\phpsdkota\src\Object\MaResponse;

class MaRouter
{
    /**
     * @var array Valid API endpoints and their required/optional arguments.
     */
    protected $apis = null;

    /**
     * @var array MyAllocator API configuration.
     */
    protected $config = null;

    /**
     * @var array Interface to OTA backend.
     */
    protected $interface = null;

    /**
     * Class contructor.
     *
     * @param \MyAllocator\phpsdkota\src\Api\Inbound\MaInboundInterface
     *  $interface The object implementing MaInboundInterface to invoke
     *  backend functionality.
     */
    public function __construct(MaInboundInterface $interface)
    {
        // Load configuration
        $this->config = require(dirname(__FILE__) . '/../../Config/MaConfig.php');

        // Load API's
        $this->apis = require(dirname(__FILE__) . '/../../Config/MaApisInbound.php');

        // Set inbound interface
        $this->interface = $interface;
    }

    /**
     * Router for inbound requests from MyAllocator.
     *
     * Receives API request, performs common functionality, and invokes method.
     *
     * @param string @post_body The JSON encoded post body.
     *
     * @return array The JSON decoded response array.
     */
    public function processRequest($post_body = null)
    {
        $rsp = new \MyAllocator\phpsdkota\src\Object\MaResponse();

        // Validate arg
        if (!$post_body) {
            return $rsp->error(MA_OTA_ERR_ARGS_INVALID)->toArray();
        }

        // Get post body
        try {
            $request = $this->decode($post_body);
        } catch (\Exception $e) {
            return $rsp->error(MA_OTA_ERR_JSON_INVALID, $e->getMessage())->toArray();
        }

        // JSON structure validation
        if (!is_array($request) || empty($request)) {
            return $rsp->error(MA_OTA_ERR_JSON_INVALID)->toArray();
        }

        // Authentication
        if (!isset($request['shared_secret'])) {
            return $rsp->error(MA_OTA_ERR_AUTH_INVALID)->toArray();
        } else {
            if ($request['shared_secret'] !== $this->config['shared_secret']) {
                return $rsp->error(MA_OTA_ERR_AUTH_INVALID)->toArray();
            } else {
                // Unset for security
                unset($request['shared_secret']);
            }
        }

        // API and data validation
        if (!isset($request['verb'])) {
            return $rsp->error(MA_OTA_ERR_VERB_INVALID)->toArray();
        } else if (!isset($this->apis[$request['verb']])) {
            return $rsp->error(MA_OTA_ERR_VERB_INVALID, $request['verb'])->toArray();
        } else {
            // Validate required keys
            foreach ($this->apis[$request['verb']]['args']['req'] as $key) {
                if (!isset($request[$key])) {
                    return $rsp->error(MA_OTA_ERR_ARGS_INVALID, $key)->toArray();
                }
            }
            // Prune unexpected keys (not required or optional)
            foreach ($request as $key => $val) {
                if (!in_array($key, $this->apis[$request['verb']]['args']['req']) &&
                    !in_array($key, $this->apis[$request['verb']]['args']['opt'])
                ) {
                    unset($request[$key]);
                }
            }
        }

        // Invoke method
        switch ($request['verb']) {
            case 'HealthCheck':
                $rsp->success();
                break;
            case 'SetupProperty':
                $rsp = $this->interface->setupProperty($request);
                break;
            case 'GetRoomTypes':
                $rsp = $this->interface->getRoomTypes($request);
                break;
            case 'GetBookingId':
                $rsp = $this->interface->getBookingId($request);
                break;
            case 'GetBookingList':
                $rsp = $this->interface->getBookingList($request);
                break;
            case 'ARIUpdate':
                $rsp = $this->interface->ARIUpdate($request);
                break;
            default: 
                $rsp->error(MA_OTA_ERR_VERB_INVALID);
                break;
        }

        // Validate response is of type MaResponse
        if (get_class($rsp) != 'MyAllocator\phpsdkota\src\Object\MaResponse') {
            $rsp = new \MyAllocator\phpsdkota\src\Object\MaResponse();
            $rsp->error(MA_OTA_ERR_RSP_INVALID);
        }

        return $rsp->toArray();
    }

    private function decode($json)
    {
        $result = json_decode($json, true);
        switch(json_last_error())
        {
            case JSON_ERROR_DEPTH:
                $error = 'Maximum stack depth exceeded';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $error = 'Unexpected control character found';
                break;
            case JSON_ERROR_SYNTAX:
                $error = 'Syntax error, malformed JSON';
                break;
            case JSON_ERROR_NONE:
            default:
                $error = '';                    
        }

        if (!empty($error)) {
            throw new \Exception('JSON Error: '.$error);        
        }
        
        return $result;
    }
}
