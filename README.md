# !!! This package is still in development. Don't use it quite yet !!!

# myallocator-php-sdk-ota

MyAllocator BuildToUs API PHP SDK (JSON). Online Travel Agencies (OTA's) can use this SDK to quickly and reliably integrate with the MyAllocator BuildToUs API to enable distribution into their systems.

MyAllocator BuildToUs API Version: 201408

MyAllocator BuildToUs API PHP SDK Documentation [http://myallocator.github.io/myallocator-php-sdk-ota-docs/] [TODO]

MyAllocator BuildToUs API Documentation [http://myallocator.github.io/apidocs/] [TODO]

MyAllocator BuildToUs API Integration Guide [TODO]

MyAllocator [https://www.myallocator.com/]

MyAllocator Development Support [devhelp@myallocator.com]

## Requirements

PHP 5.3.2 and later.

## Documentation

Please see http://myallocator.github.io/myallocator-php-sdk-ota-docs/ for the complete and up-to-date SDK documentation.

## Composer [TODO]

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

    git clone https://github.com/MyAllocator/myallocator-php-sdk.git

To use the bindings, add the following to a PHP script:

    require_once('/path/to/myallocator-php-sdk-ota/src/MyAllocator.php');

## Getting Started

A simple usage example with composer:

[TODO]

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

[TODO]

## Tests

You can run phpunit tests from the top directory:

    vendor/bin/phpunit --debug

#### Setup Local Environment Variables

[TODO]

Most of the test cases use local environment variables and will be skipped if not provided. Export the following local environment variables from your data to use with the related test cases:

    myallocator-sdk-php$ cat test/ENVIRONMENT_CREDENTIALS
    #!/bin/bash
    export ma_vendorId=xxxxx
    export ma_vendorPassword=xxxxx
    export ma_userId=xxxxx
    export ma_userPassword=xxxxx
    export ma_userToken=xxxxx
    export ma_propertyId=xxxxx
    export ma_PMSUserId=xxxxx
    myallocator-sdk-php$ source test/ENVIRONMENT_CREDENTIALS
