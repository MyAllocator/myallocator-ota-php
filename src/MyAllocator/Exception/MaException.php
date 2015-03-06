<?php
/**
 * MyAllocator MaException
 *
 * The MyAllocator base exception class.
 *
 * @package     myallocator/myallocator-php-sdk-ota
 * @author      Nathan Helenihi <support@myallocator.com>
 * @copyright   Copyright (c) MyAllocator
 * @license     http://mit-license.org/
 * @link        https://github.com/MyAllocator/myallocator-php-sdk-ota
 */

namespace MyAllocator\phpsdkota\src\Exception;

class MaException extends \Exception
{
    /**
     * @var array State data before the exception.
     */
    protected $state = null;

    /**
     * The constructor may set request/response parameters.
     *
     * @param string $msg The exception description.
     * @param array $args The request/response parameters.
     */
    public function __construct($msg, $state = null)
    {
        parent::__construct($msg);

        if (isset($state)) {
            $this->state = $state;
        }
    }

    /**
     * Get the state of an exception
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Get the http status code of an exception.
     */
    public function getHttpStatus()
    {
        if ($this->state && isset($this->state['response']['code'])) {
            return $this->state['response']['code'];
        } else {
            return null;
        }
    }

    /**
     * Get the http body of an exception.
     */
    public function getHttpBody()
    {
        if ($this->state && isset($this->state['response']['body'])) {
            return $this->state['response']['body'];
        } else {
            return null;
        }
    }

    /**
     * Get the http body as json of an exception.
     */
    public function getJsonBody()
    {
        if ($this->state && isset($this->state['response']['body_raw'])) {
            return $this->state['response']['body_raw'];
        } else {
            return null;
        }
    }
}
