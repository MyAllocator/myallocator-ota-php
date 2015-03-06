<?php
/**
 * MyAllocator API baseclass
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

namespace MyAllocator\phpsdkota\src\Api;
use MyAllocator\phpsdkota\src\MaBaseClass;
use MyAllocator\phpsdkota\src\Object\Auth;
use MyAllocator\phpsdkota\src\Util\Requestor;
use MyAllocator\phpsdkota\src\Util\Common;
use MyAllocator\phpsdkota\src\Exception\ApiException;
use MyAllocator\phpsdkota\src\Exception\RoleException;
use MyAllocator\phpsdkota\src\Exception\ApiAuthenticationException;

/**
 * The Base API class.
 */
class MaApi extends MaBaseClass
{
    /**
     * @var boolean Whether or not the API is currently enabled/supported.
     */
    protected $enabled = true;

    /**
     * @var string The api method.
     */
    protected $id = 'MaApi';

    /**
     * @var string The API role (Inbound or Outbound).
     */
    protected $role = 'Outbound';

    /**
     * @var array API request parameters to be included in API request.
     */
    private $params = null;

    /**
     * @var array Array of required and optional argument keys (string) for API method.
     */
    protected $keys = array(
        'args' => array(
            'req' => array(),
            'opt' => array()
        )
    );

    /**
     * Class contructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Set the parameters to be used in the API request. Parameters may
     * also be set at the time of API call via callApiWithParams().
     *
     * @param array $params API request parameters.
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * Call the API using previously set parameters (if any).
     *
     * @return mixed API response.
     */
    public function callApi()
    {
        return $this->processRequest($this->params);
    }

    /**
     * Call the API using provided parameters (if any).
     *
     * @param array $params API request parameters.
     * @return mixed API response.
     */
    public function callApiWithParams($params = null)
    {
        return $this->processRequest($params);
    }

    /**
     * Determine if the API is enabled.
     *
     * @return booleam True if the API is enabled.
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Validate and process/send the API request.
     *
     * @param array $params API request parameters.
     * @return mixed API response.
     */
    private function processRequest($params = null)
    {
        // Ensure this api is currently enabled/supported
        $this->assertEnabled();

        // Instantiate requester
        $requestor = new Requestor($this->config);

        // Set ota_cid and shared_secret from config if not provided
        if (!isset($params['ota_cid'])) {
            $params['ota_cid'] = $this->config['ota_cid'];
        }

        if (!isset($params['shared_secret'])) {
            $params['shared_secret'] = $this->config['shared_secret'];
        }

        // Validate and sanitize parameters
        if ($this->config['paramValidationEnabled']) {
            $params = $this->validateApiParameters($this->keys, $params);
        }

        // Add URI method and version to payload
        $params['_method'] = $this->id;
        $params['_version'] = $requestor->version;

        // Send request
        $response = $requestor->request('post', $this->id, $params);

        // Return result
        return $response;
    }

    /**
     * Assert the API is enabled.
     */
    private function assertEnabled()
    {
        if (!$this->enabled) {
            $msg = 'This API is not currently enabled/supported.';
            throw new ApiException($msg);
        }
    }

    /**
     * Validate parameters for an API.
     *
     * @param array $keys Array of required and optional 
     *  authentication and argument keys (string) for API method.
     * @param array $params API specific parameters.
     *
     * @return array Validated API parameters.
     */
    private function validateApiParameters($keys = null, $params = null)
    {
        // Assert API has defined an id/endpoint
        $this->assertApiId();

        // Assert API keys array structure is valid
        $this->assertKeysArrayValid($keys);

        // Assert keys array has minimum required optional parameters
        $this->assertKeysHasMinOptParams($keys, $params);

        // Assert required argument parameters exist (non-authentication)
        $this->assertReqParameters($keys, $params);

        // Remove extra parameters not defined in keys array
        $this->removeUnknownParameters($keys, $params);

        return $params;
    }

    /**
     * Assert the API id is set by the API class.
     */
    private function assertApiId()
    {
        // Assert minimum number of optional args exist if requirement exists
        if (!$this->id) {
            $msg = 'The API id has not be set in the API class.';
            throw new ApiException($msg);
        }
    }

    /**
     * Assert required API keys exist and are valid.
     *
     * @param array $keys Array of required and optional 
     *  authentication and argument keys (string) for API method.
     */
    private function assertKeysArrayValid($keys = null)
    {
        if ((!$keys) ||
            (!is_array($keys)) ||
            (!isset($keys['args'])) || 
            (!is_array($keys['args'])) ||
            (!isset($keys['args']['req'])) || 
            (!is_array($keys['auth']['req'])) ||
            (!isset($keys['args']['opt'])) || 
            (!is_array($keys['args']['opt']))
        ) {
            $msg = 'Invalid API keys provided. (HINT: Each '
                 . 'API class must define a $keys array with '
                 . 'specific key requirements. (HINT: View an /Api/[file] '
                 . 'for an example.)';
            throw new ApiException($msg);
        }
    }

    /**
     * Assert parameters include minimum number of optional
     * parameters as configured/defined by the API.
     *
     * @param array $keys Array of required and optional 
     *  authentication and argument keys (string) for API method.
     * @param array $params API specific parameters.
     *
     * @throws MyAllocator\phpsdkota\src\Exception\ApiException
     */
    private function assertKeysHasMinOptParams($keys, $params)
    {
        // Assert minimum number of optional args exist if requirement exists
        if ((isset($keys['args']['optMin'])) && 
            (!$params || count($params) < $keys['args']['optMin'])
        ) {
            $msg = 'API requires at least '.$keys['args']['optMin'].' optional '
                 . 'parameter(s). (HINT: Reference the $keys '
                 . 'property at the top of the API class file for '
                 . 'required and optional parameters.)';
            throw new ApiException($msg);
        }
    }

    /**
     * Validate required parameters for API.
     *
     * @param array $keys Array of required and optional 
     *  authentication and argument keys (string) for API method.
     * @param array $params API specific parameters.
     *
     * @throws MyAllocator\phpsdkota\src\Exception\ApiException
     */
    private function assertReqParameters($keys, $params = null)
    {
        if (!empty($keys['args']['req'])) {
            if (!$params) {
                $msg = 'No parameters provided. (HINT: Reference the $keys '
                     . 'property at the top of the API class file for '
                     . 'required and optional parameters.)';
                throw new ApiException($msg);
            }

            foreach ($keys['args']['req'] as $k) {
                if (!isset($params[$k])) {
                    $msg = 'Required parameter `'.$k.'` not provided. '
                         . '(HINT: Reference the $keys '
                         . 'property at the top of the API class file for '
                         . 'required and optional parameters.)';
                    throw new ApiException($msg);
                }
            }
        }
    }

    /**
     * Strip parameters not defined in API keys array.
     *
     * @param array $keys Array of required and optional 
     *  argument keys (string) for API method.
     * @param array $params API specific parameters.
     *
     * @return array API parameters with unknown parameters
     *  removed.
     */
    private function removeUnknownParameters($keys, $params)
    {
        $valid_keys = array_merge(
            $keys['args']['req'],
            $keys['args']['opt']
        );

        foreach ($params as $k => $v) {
            if (!in_array($k, $valid_keys)) {
                unset($params[$k]);
            }
        }

        return $params;
    }
}
