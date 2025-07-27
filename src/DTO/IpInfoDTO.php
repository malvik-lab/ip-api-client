<?php

namespace MalvikLab\IpApiClient\DTO;

use DateTimeZone;

final readonly class IpInfoDTO
{
    public function __construct(
    public string $status,
    public string $continent,
    public string $continentCode,
    public string $country,
    public string $countryCode,
    public string $region,
    public string $regionName,
    public string $city,
    public string $district,
    public string $zip,
    public float  $lat,
    public float  $lon,
    public DateTimeZone $timezone,
    public int $offset,
    public string $currency,
    public string $isp,
    public string $org,
    public string $as,
    public string $asname,
    public string $reverse,
    public bool $mobile,
    public bool $proxy,
    public bool $hosting,
    public string $query
    ) {}
}