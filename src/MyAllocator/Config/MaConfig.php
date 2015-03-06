<?php
/**
 * MyAllocator BuildToUs PHP SDK Configuration
 *
 * @package     myallocator/myallocator-php-sdk-ota
 * @author      Nathan Helenihi <support@myallocator.com>
 * @copyright   Copyright (c) MyAllocator
 * @license     http://mit-license.org/
 * @link        https://github.com/MyAllocator/myallocator-php-sdk-ota
 */

// TODO update comments
return array(
    'shared_secret' => 'test',
    'ota_cid' => 'test',

    /*
     * Enable/Disable basic request parameter validation.
     *
     * When enabled:
     *   1. Required and optional Api keys are defined as $keys
     *      array in each Api class.
     *   2. Top level required and optional keys are validated
     *      prior to sending a request to MyAllocator.
     *   3. If a required key is not present, an ApiException is thrown.
     *   4. If a top level key that is not defined in $keys is present,
     *      it is removed.
     *   5. Minimum optional parameters is enforced.
     *
     * Read dataFormat comment below for format specific validation notes.
     *
     * Available values: true, false
     */ 
    'paramValidationEnabled' => true, // true, false

    /**
     * Define what data you prefer to be included in Api responses.
     * The 'response', 'code', and 'headers' keys are not configurable
     * and will always be included in a response. Each piece of data
     * may be useful if you intend to store request and response data
     * locally. The following keys in the dataResponse
     * array below will cause the related data to be returned
     * in all responses:
     *
     *      1. timeRequest - The time immediately before the request is sent
     *          to MyAllocator (from Requestor). timeRequest is returned
     *          as a DateTime object.
     *      2. timeResponse - The time immediately after the response is
     *          received from MyAllocator (from Requestor). timeResponse is
     *          returned as a DateTime object.
     *      3. request - The exact request data sent from MyAllocator including
     *          authentication and provided parameters. The request is returned
     *          in the configured dataFormat format. Note, for xml, the request
     *          is stored in the result prior to url encoding.
     *
     * Note, leave as array() if you prefer to receive none of the data.
     *
     * Available keys: 'timeRequest', 'timeResponse', 'request'
     */
    'dataResponse' => array('timeRequest', 'timeResponse', 'request'), 

    /*
     * Enable/Disable debug logs.
     *
     * Available values: true, false
     */
    'debugsEnabled' => true
);
