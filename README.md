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

Configure your host's webserver at the desired endpoint to point to /var/www/test/MaReceiver.php. Send in a health check :)

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

Configure your host's webserver at the desired endpoint to point to /var/www/test/MaReceiver.php. Send in a health check :)

    root@nate:/var/www/test# curl -v -H "Accept: application/json" -X POST -H "Content-Type: application/json" -d '{"verb":"HealthCheck", "mya_property_id":"123", "ota_property_id":"321", "shared_secret":"test"}' http://{your_ip}:{your_port}/

## Configuration

The default configuration file can be found at at `src/MyAllocator/Config/MaConfig.php`. The following is configurable:

#### shared_secret

The shared_secret will be allocated to the OTA by MyAllocator after initial registration. The shared_secret is used to authenticate the MA <-> OTA communication.

#### debugsEnabled

Set `debugsEnabled` to true in `src/MyAllocator/Config/Config.php` to display request and response data in the SDK interface and API transfer data formats for an API request.

## Integration

This SDK is meant to be installed in the OTA's environment to act as an inbound API receiver for MyAllocator. It is not required for BuildToUs API integration, however, if an OTA is integrating via PHP we highly recommend utilizing the sdk to minimize your integration time and costs.

The SDK can be broken into three primary parts, the receiver, SDK library, and backend interface (to be implemented by OTA).

#### Receiver

The receiver is located at `examples/Receiver/MaReceiver.php` and is the actual endpoint script that receives the request and forwards to the SDK library. It is optional for an OTA to utilize this receiver. If you have an existing framework for exposing endpoints, please feel free to continue using it and simply invoke the SDK library similar to the receiver example. If an existing mechanism is not available and you would like a quick solution, please feel free to use the included receiver.

#### SDK Library

The SDK library is located at `src/MyAllocator` and consists of the inbound API router, API definitions, backend interface definition, and required infrastructure.

#### Backend Interface

The SDK library includes a backend interface definition location at `src/MyAllocator/Api/Inbound/MaInboundInterface.php` which must be implemented by your environment so that the router (MaRouter.php) may forward requests to your backend system. You must instantiate an object of the class that implements this interface and pass it into the MaRouter object's construct during instantiation. Take a look at `examples/Receiver/MaInboundInterfaceStub.php` for a stub/example interface implementation and `examples/Receiver/MaReceiver.php` for how it is instantiated and passed into MaRouter.

It is worth explicitly noting, the backend interface implementations must return an MaResponse object to the calling router (as suggested by the docblocks).

## Examples

Examples can be found in the `examples/` directory.

## Tests

You can run phpunit tests from the top directory:

    vendor/bin/phpunit --debug
