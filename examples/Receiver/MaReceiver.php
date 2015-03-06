<?php
/**
 * MyAllocator BuildToUs Inbound API Receiver
 *
 * @package     myallocator/myallocator-php-sdk-ota
 * @author      Nathan Helenihi <support@myallocator.com>
 * @copyright   Copyright (c) MyAllocator
 * @license     http://mit-license.org/
 * @link        https://github.com/MyAllocator/myallocator-php-sdk-ota
 */

require_once(dirname(__FILE__) . '/../../src/MyAllocator.php');
require_once(dirname(__FILE__) . '/MaInboundInterfaceStub.php');

use MyAllocator\phpsdkota\src\Api\Inbound\MaRouter;

// Instantiate backend interface that implements MaInboundInterface
$interface = new MaInboundInterfaceStub();

// Instantiate inbound router with backend interface
$router = new \MyAllocator\phpsdkota\src\Api\Inbound\MaRouter($interface);

// Process request
$post_body = file_get_contents('php://input');
$response = $router->processRequest($post_body);

// Respond
header('Content-Type: application/json');
echo json_encode($response);
