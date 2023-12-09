# IP-API Client

This unofficial library provides a simple interface to interact with the [ip-api.com](https://www.ip-api.com) service, allowing you to obtain geographic information based on the IP address.

## Installation
You can install this library using Composer. Run the following command:
```sh
composer require malvik-lab/ip-api-client
```

## Usage
### Example of Use
```php
<?php

use GuzzleHttp\Client;
use MalvikLab\IpApiClient\IpApiClient;

$ipApiClient = new IpApiClient(new Client());
$ipData = $ipApiClient->get('8.8.8.8');
```

### Available Methods
- **get($ip)**: Gets details about the specified IP address.

### Output Example
```php
MalvikLab\IpApiClient\DTO\DataDTO Object
(
    [limit] => MalvikLab\IpApiClient\DTO\LimitDTO Object
        (
            [ttl] => 60
            [rl] => 44
        )

    [ipInfo] => MalvikLab\IpApiClient\DTO\IpInfoDTO Object
        (
            [status] => success
            [country] => United States
            [countryCode] => US
            [region] => VA
            [regionName] => Virginia
            [city] => Ashburn
            [zip] => 20149
            [lat] => 39.03
            [lon] => -77.5
            [timezone] => DateTimeZone Object
                (
                    [timezone_type] => 3
                    [timezone] => America/New_York
                )

            [isp] => Google LLC
            [org] => Google Public DNS
            [as] => AS15169 Google LLC
            [query] => 8.8.8.8
        )

)
```

## Running Test
```sh
vendor/bin/phpunit tests --testdox
```