# !!! This package is still in development. Don't use it quite yet !!!

# myallocator-ota-php

MyAllocator BuildToUs API PHP SDK (JSON). Online Travel Agencies (OTA's) may use this SDK to quickly and reliably integrate with the MyAllocator BuildToUs API to enable distribution into their systems.

The MyAllocator BuildToUs API supports many OTA-inbound API's but only one OTA-outbound API (NotifyBooking). As a result, this SDK currently only implements the OTA-inbound API's defined in the MyAllocator BuildToUs API Documentation. You may implement the simple HTTP GET NotifyBooking API directly in your code base.

Note, this is not the PMS PHP SDK for PMS's. The PMS PHP SDK can be found at https://github.com/MyAllocator/myallocator-pms-php

MyAllocator BuildToUs API Version: 201503

MyAllocator BuildToUs API Documentation & Integration Guide [TODO]

MyAllocator BuildToUs API PHP SDK Documentation [http://myallocator.github.io/myallocator-ota-php-docs/]

MyAllocator [https://www.myallocator.com/]

MyAllocator Development Support [devhelp@myallocator.com]

## Requirements

PHP 5.3.2 and later.

## Documentation

Please see http://myallocator.github.io/myallocator-ota-php-docs/ for the complete and up-to-date SDK documentation.

## Composer Installation

You can install via composer. Add the following to your project's `composer.json`.

    {
        "require": {
            "myallocator/myallocator-php-sdk-ota": "1.*"
        }
    }

Then install via:

    composer.phar install

To use the bindings, either use Composer's autoload [https://getcomposer.org/doc/00-intro.md#autoloading]:

    require_once('vendor/autoload.php');

Or manually:

    require_once('/path/to/vendor/MyAllocator/myallocator-php-sdk-ota/src/MyAllocator.php');

## Manual Installation

Grab the latest version of the SDK:

    git clone https://github.com/MyAllocator/myallocator-ota-php.git

To use the bindings, add the following to a PHP script:

    require_once('/path/to/myallocator-ota-php/src/MyAllocator.php');

## Getting Started

#### Installation and usage example with composer installation:

    root@nate:/var/www# mkdir test
    root@nate:/var/www# cd test/
    root@nate:/var/www/test# echo '{"require": {"myallocator/myallocator-php-sdk-ota": "1.*"}}' > composer.json
    root@nate:/var/www/test# composer install
    Loading composer repositories with package information
    Installing dependencies (including require-dev)
      - Installing myallocator/myallocator-php-sdk-ota (1.0.0)
        Downloading: 100%         
    Writing lock file
    Generating autoload files
    root@nate:/var/www/test# cp vendor/myallocator/myallocator-php-sdk-ota/examples/Receiver/* .

Configure your hosts webserver at your desired endpoint to point to /var/www/test/MaReceiver.php. Send in a health check :)

    root@nate:/var/www/test# curl -v -H "Accept: application/json" -X POST -H "Content-Type: application/json" -d '{"verb":"HealthCheck", "mya_property_id":"123", "ota_property_id":"321", "shared_secret":"test"}' http://{your_ip}:{your_port}/

#### Installation and usage example with manual installation:

    root@nate:/var/www# mkdir -p test/lib
    root@nate:/var/www# cd test/lib/
    root@nate:/var/www/test/lib# git clone https://github.com/MyAllocator/myallocator-ota-php.git
    Cloning into 'myallocator-ota-php'...
    remote: Counting objects: 111, done.
    remote: Compressing objects: 100% (72/72), done.
    remote: Total 111 (delta 38), reused 101 (delta 31), pack-reused 0
    Receiving objects: 100% (111/111), 38.22 KiB | 0 bytes/s, done.
    Resolving deltas: 100% (38/38), done.
    Checking connectivity... done.
    root@nate:/var/www/test/lib# cd ..
    root@nate:/var/www/test# cp lib/myallocator-ota-php/examples/Receiver/* .

Edit require_once autoload in line 12 to:

    require_once(dirname(__FILE__) . '/lib/myallocator-ota-php/src/MyAllocator.php');

Configure your hosts webserver at your desired endpoint to point to /var/www/test/MaReceiver.php. Send in a health check :)

    root@nate:/var/www/test# curl -v -H "Accept: application/json" -X POST -H "Content-Type: application/json" -d '{"verb":"HealthCheck", "mya_property_id":"123", "ota_property_id":"321", "shared_secret":"test"}' http://{your_ip}:{your_port}/

## Configuration

The default configuration file can be found at at `src/MyAllocator/Config/Config.php`. The following is configurable:

#### paramValidationEnabled

The SDK supports parameter validation, which can be configured via the `paramValidationEnabled` configuration in `src/MyAllocator/Config/Config.php`. If you prefer to send a raw request for performance, or other reasons, set this configuration to false. If parameter validation is enabled:

1.  Required and optional Api keys are defined via $keys array in each Api class.
2.  Top level required and optional keys are validated prior to sending a request to MyAllocator.
3.  An ApiException is thrown if a required key is not present.
4.  Top level keys not defined in $keys are stripped from parameters.
5.  Minimum optional parameters are enforced.

#### dataResponse

Define what data you prefer to be included in Api responses. The response 'body', 'code', and 'headers' keys are not configurable and will always be included in a response. Each piece of data may be useful if you intend to store request and response data locally. The following keys in the dataResponse array below will cause the related data to be returned in all responses:

    1. timeRequest - The time immediately before the request is sent
        to MyAllocator (from Requestor). timeRequest is returned
        as a DateTime object.
    2. timeResponse - The time immediately after the response is
        received from MyAllocator (from Requestor). timeResponse is
        returned as a DateTime object.
    3. request - The exact request data sent from MyAllocator including
        authentication and provided parameters. The request is returned
        in the configured dataFormat format. Note, for xml, the request
        is stored in the result prior to url encoding.

#### debugsEnabled

Set `debugsEnabled` to true in `src/MyAllocator/Config/Config.php` to display request and response data in the SDK interface and API transfer data formats for an API request.

## API Response Format

A successful request call will return an array with the following response structure. By default, all key/values are returned. If you prefer to not receive request data or response['time'] in an Api response, you may configure the dataResponse array in `src/MyAllocator/Config/Config.php` to remove the data.

    return array(
        'request' => array(
            'time' => {DateTime Object},
            'body' => {Request body in dataFormat}
        ),
        'response' => array(
            'time' => {DateTime Object},
            'code' => {int},
            'headers' => {string},
            'body' => {Response body in dataFormat}
        )
    );

`request['time']` *(optional)* is a DateTime object representing the time immediately before sending the request to MyAllocator.

`request['body']` *(optional)* is the request body sent to MyAllocator in your configured dataFormat.

`response['time']` *(optional)* is a DateTime object representing the time immediately after receiving the response from MyAllocator.

`response['code']` is the HTTP response code.

`response['headers']` are the HTTP response headers.

`response['body']` is the response body.

Requests may also return any of the exceptions defined in `src/MyAllocator/Exception/`. Be sure to wrap your API calls in try blocks. You may use the `getHttpStatus`, `getHttpBody`, and `getJsonBody` methods defined in `/Exception/MaException.php` within an exception block for information. Additionally, the `getState` method may be called for an exception to retreive the state information for the request up to the point of failure in the same format as the response structure above (request/response). For example, if an HTTP connection timeout exception occurs, you may acess the request time/body and response code/headers via `getState`.

## Examples

Examples can be found in the `examples/` directory.

## Tests

You can run phpunit tests from the top directory:

    vendor/bin/phpunit --debug
