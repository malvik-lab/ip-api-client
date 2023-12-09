<?php

namespace MalvikLab\IpApiClient\DTO;

use DateTimeZone;

final readonly class IpInfoDTO
{
    public function __construct(
    public string $status,
    public string $country,
    public string $countryCode,
    public string $region,
    public string $regionName,
    public string $city,
    public string $zip,
    public float  $lat,
    public float  $lon,
    public DateTimeZone $timezone,
    public string $isp,
    public string $org,
    public string $as,
    public string $query
    ) {}
}