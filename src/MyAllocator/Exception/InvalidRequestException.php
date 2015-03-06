<?php
/**
 * MyAllocator InvalidRequestException
 *
 * The invalid request exception class. This exception is thrown when
 * a 404 not found is returned by the MyAllocator API.
 *
 * @package     myallocator/myallocator-php-sdk-ota
 * @author      Nathan Helenihi <support@myallocator.com>
 * @copyright   Copyright (c) MyAllocator
 * @license     http://mit-license.org/
 * @link        https://github.com/MyAllocator/myallocator-php-sdk-ota
 */

namespace MyAllocator\phpsdkota\src\Exception;
use MyAllocator\phpsdkota\src\Exception\MaException;

class InvalidRequestException extends MaException
{
}
