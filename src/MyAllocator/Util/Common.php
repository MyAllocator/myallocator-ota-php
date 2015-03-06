<?php
/**
 * Common methods used in the SDK.
 *
 * @package     myallocator/myallocator-php-sdk-ota
 * @author      Nathan Helenihi <support@myallocator.com>
 * @copyright   Copyright (c) MyAllocator
 * @license     http://mit-license.org/
 * @link        https://github.com/MyAllocator/myallocator-php-sdk-ota
 */

namespace MyAllocator\phpsdkota\src\Util;
use MyAllocator\phpsdkota\src\Object\Auth;
use MyAllocator\phpsdkota\src\Exception\ApiException;

abstract class Common
{
    /**
     * Get an auth object from the local ENV or test data.
     *
     * @param array $keys The authentication keys to set.
     * @param string $debug Enable debug.
     *
     * @return array(Auth, string) Authentication object and bool if pulled from ENV.
     *
     * @throws MyAllocator\phpsdkota\src\Exception\ApiException If no keys supplied.
     */
    public static function getAuthEnv($keys = null, $debug = false)
    {
        if (!$keys) {
            $msg = 'Keys parameter is required. (Keys to set from env)';
            throw new ApiException($msg);
        }

        /*
         * Some tests require all parameters to be from environment.
         * Otherwise, they are skipped.
         */
        $env = true;

        /*
         * To use, export the required environment vars:
         *   export ma_vendorId=VALUE
         *   export ma_vendorPassword=VALUE
         *   export ma_userId=VALUE
         *   export ma_userPassword=VALUE
         *   export ma_userToken=VALUE
         *   export ma_propertyId=VALUE
         *   export ma_PMSUserId=VALUE
         *   export ma_PMSPropertyId=VALUE
         */
        foreach ($keys as $k) {
            if (!($$k = getenv('ma_'.$k))) {
                // Key does not exist in environment, use test data
                $$k = '111';
                $env = false;
            }
        }

        $auth = new Auth();
        $auth->vendorId = isset($vendorId) ? $vendorId : null;
        $auth->vendorPassword = isset($vendorPassword) ? $vendorPassword : null;
        $auth->userId = isset($userId) ? $userId: null;
        $auth->userPassword = isset($userPassword) ? $userPassword : null;
        $auth->userToken = isset($userToken) ? $userToken : null;
        $auth->PMSUserId = isset($PMSUserId) ? $PMSUserId : null;
        $auth->propertyId = isset($propertyId) ? $propertyId : null;
        $auth->PMSPropertyId = isset($PMSPropertyId) ? $PMSPropertyId : null;
        $auth->debug = $debug;

        return array(
            'auth' => $auth,
            'from_env' => $env
        );
    }

    /**
     * Returns the name of a class using get_class with the namespaces stripped.
     *
     * @param object|string $object Object or Class Name to retrieve name
     *
     * @return string Name of class with namespaces stripped
     */
    public static function getClassName($object = null)
    {
        if (!is_object($object) && !is_string($object)) {
            return false;
        }

        $class = explode('\\', (is_string($object) ? $object : get_class($object)));
        return $class[count($class) - 1];
    }
}
