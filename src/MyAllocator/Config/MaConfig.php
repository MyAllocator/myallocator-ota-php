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

return array(
    /*
     * The shared secret among MyAllocator and OTA used for 
     * channel manager <-> OTA authentication. The shared secret is defined
     * by MyAllocator and shared with OTA.
     */
    'shared_secret' => 'test',

    /*
     * Enable/Disable debug logs.
     *
     * Available values: true, false
     */
    'debugsEnabled' => true
);
